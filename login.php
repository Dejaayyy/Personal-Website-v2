<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DMB Login</title>

    <!-- Poppins Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
 
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="forms.css">
</head>

<body>
    <div class = "login-container">
        <?php
            if(isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];

                $errors = array();
                if (empty($email) || empty($password)) {
                    array_push($errors, "Email and password are required");
                } else {
                    require_once "db_conn.php";
                    $sql = "SELECT password FROM users WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    if($user) {
                        if(password_verify($password, $user["password"])) {
                            $_SESSION["users"] = "yes";
                            header("Location: contact.html");
                            die();
                        } else {
                            echo "<div class='alert alert-danger'>Password does not match</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Email not found</div>";
                    }
                }

                // Display any validation errors
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                }
            }
        ?>

        <form action="login.php" method="post">
            <h3>Login</h3>
            <div class="row">
                <div class="col">
                    <label for="email">Email Address:</label>
                    <input type="email" class="form-control" name="email" >
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" >
                </div>
            </div>

            <input type="submit" name="login" class="btn btn-primary" value ="Login" placeholder="Login" >
            <a href="registration.php" class="btn btn-primary">Go back</a>
        </form>

        <div><br><p>Not Registered yet? <a href="registration.php">Register Here</a></p></div>  

    </div>
    
</body>
</html>