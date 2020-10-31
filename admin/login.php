<!DOCTYPE html>
<html>

<head>
    <title>login</title>

</head>

<body>
    <?php include('../src/config.php') ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (isset($_POST['submit'])) {
            $user = $_POST['username'];
            $pass = $_POST['password'];
            // $role = $_POST['role'];
            $sql = "SELECT * FROM signup";
            $result = mysqli_query($conn, $sql);
            //print_r($result);
        }
        $x = true;
        if (mysqli_num_rows($result) > 0) {
            //echo "yes...."; "<br>"
            while ($row = mysqli_fetch_assoc($result)) {
                // echo "username: " . $row["username"]. " - password: " . $row["password"]. " " . $row["role"]."<br>";

                if ($user == $row["username"] && $pass == $row["password"]) {
                    //echo "yes it is here!!!!!!! admin";

                    if ($row["role"] == "admin") {
                        session_start();
                        $_SESSION['username'] = $row["username"];
                        $_SESSION['password'] = $row["password"];
                        $_SESSION['role'] = $row["admin"];
                        header('location:admin.php');
                    } else {
                        session_start();
                        $_SESSION['username'] = $row["username"];
                        $_SESSION['password'] = $row["password"];
                        $_SESSION['role'] = $row["user"];
                        header('location:../user/user.php');
                        $x = true;
                    }
                }
            }
            if ($x) {
                echo '<p>*INVALID USERNAME OR PASSWORD</p>';
            }
        }
    }
    mysqli_close($conn);
    ?>
    <h1> LOG IN</h1>
    <form action="" method="POST">
        <p>
            <label for="username">Username: <input type="text" name="username" required></label>
        </p>
        <p>
            <label for="password">Password: <input type="text" name="password" required></label>
        </p>
        <p> <input type="submit" name="submit" value="log in"></p>
        <p> FOR NEW USER ?<a href="register.php"> SIGN UP</a></p>
    </form>
</body>

</html>