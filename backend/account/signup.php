<script>
    $("#btnSubmit").on("click", function () {
    //METHOD to handle click event of submit button
    //@var:  userDetails  JSON   data for new user

    //get the user details from the form
    let pattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    let email = gatherData($("#email"), pattern)

    pattern = /^[A-Z][a-z]+$/;
    let firstName = gatherData($("#firstname"), pattern)

    pattern = /^[A-Z][a-z]+$/;
    let lastName = gatherData($("#lastname"), pattern)

    pattern = /^[A-Za-z0-9]+$/;
    let username = gatherData($("#username"), pattern)

    pattern = /^[A-Za-z*_]+$/;
    let password = gatherData($("#pwd1"), pattern)

    pattern = /^[A-Za-z*_]+$/;
    let password2 = gatherData($("#pwd2"), pattern)

    //determine if the passwords are correct and that they match
    let passwordCheck = true
    if (!password.valid || !password2.valid) {
        passwordCheck = false
    }
    else {
        if (password.value != password2.value) {
            passwordCheck.false
        }
    }

    //test if there is something to send
    if (email.valid && firstName.valid && lastName.valid && username.valid && passwordCheck) {

        let userDetails = {
            email: $('#email').val(),
            firstname: $('#firstname').val(),
            lastname: $('#lastname').val(),
            username: $('#username').val(),
            password: $('#pwd1').val()
        }

        //send the data to the PHP script
        postSignup("../php/account/signup.php", JSON.stringify(userDetails));
    }

})

function postSignup(phpScript, dataToSend) {
    /*FUNCTION to send data and handle the response
    @param dataToSend  JSON    collection to send 
    @param phpScript   string  path to the php file
    @var   jxhr        object  instance of a POST request
    */

    //POST the data to the PHP script  
    var jqxhr = $.post(phpScript, dataToSend,
        function (responseJSON) {
            /*
            CALLBACK function to handleResponse
            @param responseJSON object data returned 
            */

            //check the response code
            switch (responseJSON.successCode) {
                case 1:
                    //success, so go to login page
                    alert("Signup was successful! Now login please.")
                    window.location.assign("../html/login.html");

                    break;
                default:
                    //show the response message
                    alert(responseJSON.message)
            }
        } //END of callback function
    ) //END of POST             
} //END of function 
</script>
<?php 
    header("content-type: application/json; charset=UTF-8");  

    function main(){
        /* MAIN ROUTINE
        @var $dataReceived  object  collection of data sent
        @var $response      object  collection of data to send back
        */


        //include PHP scripts for accessing the database
        require '../connect/connectUser.php';

        //capture the input and decode it
        $dataReceived = json_decode(file_get_contents('php://input'));
        
        //debugging
        //echo("The data received is: \n");
        //print_r($dataReceived);
        //die();

        //run the add user subroutine
        $response = addNewUser($conn, $dataReceived);
         
        //send the results back
        echo json_encode($response);

        //close the connection  
        $conn = null;
    }

    function addNewUser($conn, $data){
        /*
        FUNCTION to run an INSERT query to create a new user
        @params  $conn  object  connection to the database
        @params  $data  JSON    collection of data received from client
        
        @var  $response dictionary JSON to return to the JavaScript script
        @var  $query    object     query object
        @var  $sql      string     holds the SQL script
        */
        
        //set default response as an associative array (dictionary)  
        $response = array(
            "successCode" => 0, 
            "data"        => "",
            "message"     => ""
        );  
        
        //prepare the parameterised SQL for the query
        $sql = $conn->prepare("INSERT INTO users  
                VALUES(:email, :firstname, :lastname, :username, :password)");


        //bind data to the parameters  
        $sql->bindParam(':email',     $data->email);                 
        $sql->bindParam(':firstname', $data->firstname);                 
        $sql->bindParam(':lastname',  $data->lastname);                 
        $sql->bindParam(':username',  $data->username);   
        
        //grab the password to encrypt it
        $password = $data->password;
        
        //encrypt the password using the hashing algorithm
        $options = ['cost'=>12];
        $encPassword = password_hash($password, PASSWORD_BCRYPT, $options);

        //bind encrypted password to the password attribute
        $sql->bindParam(':password',  $encPassword);                 
                                              
        try {
            //execute the Query     
            $sql->execute();

            //amend the response object
            $response["successCode"] = 1;
        }
        catch(PDOException $e) {
            //deal with error in running the query
            $response["successCode"] = 0;
            $response["message"] = $e->getMessage();
        }
        
        //return the response
        return $response; 
    }
    
    //run main
    main();
?>
