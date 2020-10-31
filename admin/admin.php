<?php
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
include('../src/config.php');
?>
<?php include('header.php'); ?>

<body>
    <?php include("navigation.php") ?>
    <h2>MANAGE USER</h2>
    <?php
    if (isset($_GET['email'])) {
        if ($_GET['action'] == 'remove') {
            $email = $_GET['email'];
            $sql = "DELETE FROM signup WHERE `email`='$email'";
            $result = mysqli_query($conn, $sql);
        }
    }
    ?>
    <?php show1();
    function show1()
    {
        include('../src/config.php');
        $sql = "SELECT * FROM signup";
        $result = mysqli_query($conn, $sql); ?>
        <table id="add">
            <tr>
                <th>USERNAME</th>
                <th>PASSWORD</th>
                <th>GENDER</th>
                <th>Mobile</th>
                <th>EMAIL</th>
                <th>ROLE</th>
                <th>ACTION</th>
            </tr>
            <?php $s = 0;
            $result = mysqli_query($conn, $sql); ?>
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['role'] ?></td>
                        <td><a href="admin.php?email=<?php echo $row['email']; ?>&action=remove" id="remove">REMOVE</a></td>
                    </tr>
                <?php   } ?>
            <?php   } ?>
        </table>
    <?php  } ?>
</body>

</html>