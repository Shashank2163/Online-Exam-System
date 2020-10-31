<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../admin/login.php');
}
$username = $_SESSION['username'];
include('header.php');
include("../src/config.php"); ?>

<body>
    <?php include("navigation.php"); ?>
    <?php
    show();
    function show()
    { ?>
        <form action="" method="GET">
            <table>
                <?php
                error_reporting(0);
                include('../src/config.php');
                $limit = 1;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                if (isset($_GET['title'])) {
                    $_SESSION['title'] = $_GET['title'];
                }
                $title = $_SESSION['title'];
                $sql = "SELECT * FROM addquestions where title='$title' and `q_id`=$page";

                $result = mysqli_query($conn, $sql); ?>
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td id="quiz-title" colspan="3"><?php
                                                            echo "Question:\t" . $row['q_id'] . " " . $row['name']; ?></td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="check[<?php echo $row['q_id']; ?>]" value="<?php echo 1; ?>"><?php echo $row['option1']; ?> </td>
                            <td><input type="radio" name="check[<?php echo $row['q_id']; ?>]" value="<?php echo 2; ?>"><?php echo $row['option2']; ?> </td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="check[<?php echo $row['q_id']; ?>]" value="<?php echo 3; ?>"><?php echo $row['option3']; ?> </td>
                            <td><input type="radio" name="check[<?php echo $row['q_id']; ?>]" value="<?php echo 4; ?>"><?php echo $row['option4']; ?> </td>
                        </tr>
                        </tr>
                        <input type="hidden" name="page" value="<?php echo $page + 1 ?>">

                        </tr>
                    <?php
                    } ?>
                    <td colspan="3">
                        <?php $title1 = $_SESSION['title'];
                        $sql1 = "SELECT  * from addquestions where `title`='$title1'";
                        $result1 = mysqli_query($conn, $sql1) or die("error");
                        if (mysqli_num_rows($result1) > 0) {
                            $total_records = mysqli_num_rows($result1);
                            $record = $total_records;
                            $total_page = ceil($total_records / $limit);
                        ?>
                        <?php
                        } ?>
                        <?php
                        // echo $total_page;
                        $sql1 = "SELECT * FROM addexamdetails where title='$title'";
                        $result1 = mysqli_query($conn, $sql1);
                        $result1 = mysqli_query($conn, $sql1);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $button = $row1['button'];
                            }
                        }
                        if ($total_page > $page) {
                            echo ' <input type="submit" name="submit" value="SUBMIT & NEXT" id="btn-logout">';
                            if ($button == "enable") {
                                echo '<br><br><a href="exam-start1.php?page=' . ($page + 1) . '" title="Next Page" id="btn-logout">SKIP</a>';
                            }
                        } else if ($total_page == $page) {
                            echo '<input type="submit" name="submit" value="SUBMIT" id="btn-logout">';
                        }
                        ?>
                    </td>
                <?php
                } ?>
                <?php if ($page > $total_page) {
                    echo '<div class="res2">
                    <h1>YOU SUCCESSFULLY DONE YOUR EXAM </h1>
                    <p>Thank you for spending  your precious time with us, we will contact you by email with your details.</p><br><br>
                   <p> <a href="check.php"  id="btn-logout" >SHOW RESULT</a></p>
                </div>';
                } ?>
            </table>

        </form>

    <?php
    }
    ?>

    <?php
    if (isset($_GET['check'])) {
        $count = count($_GET['check']);
        $_SESSION['count'] = $_SESSION['count'] + $count;
        $selected = $_GET['check'];
        foreach ($selected as $key => $value) {
            $q_id = $key;
            $ans = $value;
        }
        $result1 = 0;
        $negative = 0;
        $title = $_SESSION['title'];
        $sql = "SELECT answer from addquestions where title='$title' and q_id=$q_id";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_array($result);
        $checked = $rows['answer'] == $ans;
        if ($checked) {
            $result1++;
            $_SESSION['result'] = $_SESSION['result'] + $result1;
            // print_r($_SESSION);
        } else {
            $negative--;
            $_SESSION['negative1'] = $_SESSION['negative1'] + $negative;
        }
    }
    ?>
</body>

</html>