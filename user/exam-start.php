<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:user.php');
}
$username = $_SESSION['username'];

include('header.php'); ?>
<?php include("../src/config.php"); ?>

<body>
    <?php include("navigation.php"); ?>
    <?php
    show();
    function show()
    { ?>
        <form action="check.php" method="POST">
            <table>
                <?php
                error_reporting(0);
                include('../src/config.php');
                $title = $_GET['title'];
                $sql = "SELECT * FROM addquestions  where `title`='$title'";
                $_SESSION['title'] = $title;
                $result = mysqli_query($conn, $sql); ?>
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td id="quiz-title" colspan="3"><?php
                                                            echo "Question:\t" . $i++ . " " . $row['name']; ?></td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="check[<?php echo $row['q_id']; ?>]" value="<?php echo 1; ?>"><?php echo $row['option1']; ?> </td>
                            <td><input type="radio" name="check[<?php echo $row['q_id']; ?>]" value="<?php echo 2; ?>"><?php echo $row['option2']; ?> </td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="check[<?php echo $row['q_id']; ?>]" value="<?php echo 3; ?>"><?php echo $row['option3']; ?> </td>
                            <td><input type="radio" name="check[<?php echo $row['q_id']; ?>]" value="<?php echo 4;  ?>"><?php echo $row['option4']; ?> </td>
                        </tr>

                        </tr>

                        </tr>
                    <?php
                    } ?>

                <?php   } ?>
            </table>
        <?php }
        ?>
        <td colspan="3">

            <input type="submit" name="submit" value="SUBMIT">
        </td>
        </form>

</body>

</html>