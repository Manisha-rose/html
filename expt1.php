<?php
// define variables and set to empty values
$name = $email = $password = $confirm_password = $phone = "";
$nameErr = $emailErr = $passwordErr = $confirmErr = $phoneErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = trim($_POST["name"]);
    }

    if(empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = $_POST["email"];
    }

    if(empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
    } elseif(!preg_match("/^[0-9]{10}$/", $_POST["phone"])) {
        $phoneErr = "Phone number must be 10 digits";
    } else {
        $phone = $_POST["phone"];
    }

    if(empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } elseif(strlen($_POST["password"]) < 6) {
        $passwordErr = "Password must be at least 6 characters";
    } else {
        $password = $_POST["password"];
    }

    if(empty($_POST["confirm_password"])) {
        $confirmErr = "Confirm password is required";
    } elseif($_POST["confirm_password"] != $_POST["password"]) {
        $confirmErr = "Passwords do not match";
    } else {
        $confirm_password = $_POST["confirm_password"];
    }

    if($nameErr=="" && $emailErr=="" && $phoneErr=="" && $passwordErr=="" && $confirmErr=="") {
        echo "<h3 style='color:green; text-align:center;'>Registration Successful!</h3>";
        echo "<center>Name: $name <br>Email: $email <br>Phone: $phone</center>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Registration Form</title>
    <style>
        body {
            font-family: Arial;
            margin: 30px;
            text-align: center;  /* Center heading */
        }
        .box {
            width: 350px;
            padding: 20px;
            border:1px solid #ccc;
            margin: auto;        /* CENTER THE BOX */
            text-align: left;    /* Keep labels left-aligned */
        }
        .error { color: teal; }

        input[type="submit"], input[type="reset"] {
            background-color: teal;  
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<h2 style="color:teal;">Registration Form</h2>

<div class="box">
<form method="post" action="">

    Name: <br>
    <input type="text" name="name" value="<?php echo $name; ?>">
    <span class="error">* <?php echo $nameErr; ?></span><br><br>

    Email: <br>
    <input type="text" name="email" value="<?php echo $email; ?>">
    <span class="error">* <?php echo $emailErr; ?></span><br><br>

    Phone: <br>
    <input type="text" name="phone" value="<?php echo $phone; ?>">
    <span class="error">* <?php echo $phoneErr; ?></span><br><br>

    Password: <br>
    <input type="password" name="password">
    <span class="error">* <?php echo $passwordErr; ?></span><br><br>

    Confirm Password: <br>
    <input type="password" name="confirm_password">
    <span class="error">* <?php echo $confirmErr; ?></span><br><br>

    <input type="submit" value="Register">
    <input type="reset" value="Reset">

</form>
</div>

</body>
</html>

