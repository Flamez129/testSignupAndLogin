<?php include("../header.php") ?>
<br/><br/>
    <div class="container">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h1>Register your details</h1>
                <a href="../../index.php"><p>Back to the registration page</p></a>

                <div class="row">
                    <form action="signup.php" method="post">
                        <label for="email">Email:</label>
                        <input type="text" name="email"><br>

                        <label for="email">Firstname:</label>
                        <input type="text" name="firstname"><br>

                        <label for="email">Lastname:</label>
                        <input type="text" name="lastname"><br>

                        <label for="email">Username:</label>
                        <input type="text" name="username"><br>

                        <label for="email">Password:</label>
                        <input type="password" name="password1"><br>

                        <label for="email">Confirm Password:</label>
                        <input type="password" name="password2"><br>
                        <input type="submit">

                        <!--
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email">
                        </div>

                        <div class="form-group">
                            <label for="firstname">Firstname:</label>
                            <input type="text" class="form-control" id="firstname">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Lastname:</label>
                            <input type="text" class="form-control" id="lastname">
                        </div>

                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username">
                        </div>

                        <div class="form-group">
                            <label for="pwd1">Password:</label>
                            <input type="password" class="form-control" id="pwd1">
                        </div>

                        <div class="form-group">
                            <label for="pwd2">Confirm Password:</label>
                            <input type="password" class="form-control" id="pwd2">
                        </div>
                        <br />
                        <button type="button" class="btn btn-secondary" id="btnSubmit">Signup</button>
                        -->
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include("../footer.php") ?>