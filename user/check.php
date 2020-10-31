<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:user.php');
}
error_reporting(0);
$username = $_SESSION['username'];
if (isset($_SESSION['result']) || isset($_SESSION['count']) || isset($_SESSION['negative1'])) {
    $result1 = $_SESSION['result'];
    $count = $_SESSION['count'];
    $negative = $_SESSION['negative1'];
}
include('header.php'); ?>

<body>
    <?php include("navigation.php"); ?>

    <div id="res">
        <table>
            <tr>
                <td id="quiz-title" colspan="2">
                    YOUR RESULT
                </td>
            </tr>
            <tr>
                <td>Questions Attempted</td>
                <td> <?php
                        if ($count > 0) {
                            echo "Out of 5, You have attempt " . $count . " option.";
                        } else {
                            echo "Out of 5, You have attempt " . 0 . " option.";
                        } ?></td>
            </tr>
            <tr>
                <td>Negative Marks</td>
                <td>
                    <?php if ($negative < 0) {
                        echo $negative;
                    } else {
                        echo 0;
                    } ?>
                </td>
            </tr>
            <tr>
                <td>Your Score Is</td>
                <?php $res = $result1 + $negative; ?>
                <td> <?php echo $res; ?></td>
            </tr>
            <tr>
                <td>Your Percentage Is</td>
                <td> <?php $per = ($res * 100) / 5;
                        if ($per > 0) {
                            echo $per . "%";
                        } else {
                            echo "0" . "%";
                        }
                        ?></td>
            </tr>
            <tr>
                <td>Your Result Is</td>
                <td> <?php if ($per > 40) {
                            echo "<span id='pass'>PASS</span>";
                        } else {
                            echo "<span id='fail'>fail</span>";
                        }
                        ?></td>
            </tr>

        </table><br><br>
        <a href="logout.php" id="btn-logout">LOGOUT</a>
    </div>
    <?php
    unset($_SESSION['result']);
    unset($_SESSION['count']);
    unset($_SESSION['negative1']);
    ?>
</body>

</html>