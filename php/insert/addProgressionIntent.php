<?php 
    header("content-type: application/json; charset=UTF-8");  

    function main(){
        /* MAIN ROUTINE
        @var $dataReceived  object  collection of data sent
        @var $response      object  collection of data to send back
        */

        //include PHP scripts for accessing the database
        require '../connect/connectUser.php';
        require '../token/token.php';

        //set the default response
        $response = array(
            "successCode" => 0, 
            "message"     => "not valid token"
        );  

        //capture the input and decode it
        $dataReceived = json_decode(file_get_contents('php://input'));
        
        //debugging
        //echo("The data received is: \n");
        //print_r($dataReceived);
        //die();

        //grab the webToken
        $token = $dataReceived->token;

        //determine of the webToken is valid
        if (verifyToken($token, getKey())){
            //run the insert routine to add the data
            $response = addProgressionIntent($conn, $dataReceived->formData);
        }
         
        //send the results back
        echo json_encode($response);

        //close the connection  
        $conn = null;
    }

    function addProgressionIntent($conn, $data){
        /*
        FUNCTION to run an INSERT query to add Progression Intent
        @params  $conn  object  connection to the database
        @params  $data  JSON    collection of data received from client
        
        @var  $response dictionary JSON to return to the JavaScript script
        @var  $query    object     query object
        @var  $sql      string     holds the SQL script
        */
        
        //set default response as an associative array (dictionary)  
        $response = array(
            "successCode" => 0, 
            "message"     => ""
        );  
        
        //prepare the SQL string for the query
        $sql = "INSERT INTO progressionIntent (d6aNumber, dateEntered, progressionIntent, bestUni, course) 
                VALUES(:d6aNumber, :dateEntered, :progressionIntent, :bestUni, :course)";

        //prepare the query to run
        $query = $conn->prepare($sql);
        
        //create the timestamp
        $thisDate = date("Y-m-d h:i:s", time());

        //bind data to the parameters  
        $query->bindParam(':d6aNumber',         $data->d6anumber);                 
        $query->bindParam(':dateEntered',       $thisDate);                 
        $query->bindParam(':progressionIntent', $data->progressionIntent);                 
        $query->bindParam(':bestUni',           $data->bestUni);                 
        $query->bindParam(':course',            $data->course);
                                                      
        try {
            //execute the Query     
            $query->execute();

            //amend the response object
            $response["successCode"] = 1;
            $response["message"] = "data was added successfully";
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