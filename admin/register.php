<?php
include('../src/config.php');
$error = array();
$message = '';
if (isset($_POST['submit'])) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $repassword = $_REQUEST['password2'];
    $gender = $_REQUEST['gender'];
    $email = $_REQUEST['email'];
    $mobile = $_REQUEST['mobile'];
    $address = $_REQUEST['address'];
    $role = 'user';
    $sql = "SELECT * FROM signup";
    $result = mysqli_query($conn, $sql);
    $x = true;
    $y = false;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // echo "username: " . $row["username"] . " - password: " . $row["password"] . " " . $row["role"] . "<br>";
            if ($email == $row['email']) {
                $x = false;
                $y = true;
            }
        }
    }
    if ($y) {
        echo "<p id='message'>*EMAIL ID IS ALREADY EXIST</p>";
    }
    if ($password != $repassword) {
        echo "<p id='message'>*PASSWORD IS NOT MATCHED</p>";
    } else if ($x) {
        $sql = "INSERT into signup
                VALUES ('','$username', '$password','$gender', '$email',$mobile,'$role','$address')";
        if ($conn->query($sql) === true) {
            echo "<p id='success'>*SUCESSFULL REGISTER</p>";
            echo "<p id='success'>*NOW YOU CAN LOGIN</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        Register
    </title>

</head>

<body>
    <div id="wrapper">
        <div id="signup-form">
            <h2>Sign Up</h2>
            <form action="" method="POST">
                <p>
                    <label for="username">Enter Username: <input type="text" name="username" required></label>
                </p>
                <p>
                    <label for="password">Enter Password <input type="password" name="password" required></label>
                </p>
                <p>
                    <label for="password2">Enter Confirm Password<input type="password" name="password2" required></label>
                </p>
                <label>Select Gender</label>
                <select name="gender" class="small-input">
                    <option value="male">MALE</option>
                    <option value="female">FEMALE</option>
                </select>
                <p>
                    <label for="mobile"> Enter Mobile No: <input type="mobile" name="mobile" required></label>
                </p>
                <p>
                    <label for="email">Enter Email Address <input type="email" name="email" required></label>
                </p>
                <p><label for="address">Enter Your Address <br><textarea rows="5" cols="50" name="address"></textarea></label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Submit">
                </p>
                <p>
                    <a href="login.php">Login</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>