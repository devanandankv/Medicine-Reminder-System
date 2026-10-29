<?php
include "config.php";

$message = "";

if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users(name,email,password)
            VALUES('$name','$email','$password')";

    if(mysqli_query($conn,$sql))
    {
        $message = "Registration Successful!";
    }
    else
    {
        $message = "Registration Failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">

<h1>Create Account</h1>

<?php
if($message!="")
{
    echo "<p>$message</p>";
}
?>

<form method="POST">

<input type="text"
name="name"
placeholder="Full Name"
required>

<br><br>

<input type="email"
name="email"
placeholder="Email Address"
required>

<br><br>

<input type="password"
name="password"
placeholder="Password"
required>

<br><br>

<input
type="submit"
name="register"
value="Register">

</form>

<br>

<a href="login.php">Already have an account? Login</a>

</div>

</body>
</html>