<?php include("../header.php") ?>
<br/><br/>
    <div class="container">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h1>Login</h1>
                <a href="../../index.php"><p>Back to the registration page</p></a>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email">
                        </div>

                        <div class="form-group">
                            <label for="pwd1">Password:</label>
                            <input type="password" class="form-control" id="pwd1">
                        </div>

                        <br />
                        <button type="button" class="btn btn-secondary" id="btnSubmit">Login</button>

                    </div>

                </div>
            </div>
        </div>
    </div>
<?php include("../footer.php") ?>