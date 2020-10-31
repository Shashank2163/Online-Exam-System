<?php
include('../src/config.php');
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
if (isset($_POST['submit'])) {
    $title = $_REQUEST['exam-title'];
    $total_question = $_REQUEST['total_question'];
    $marks = $_REQUEST['marks'];
    $negativemarks = $_REQUEST['marks_per_wrong_answer'];
    $buttons = $_REQUEST['buttons'];

    $sql = "SELECT * FROM addexamdetails";
    $result = mysqli_query($conn, $sql);
    $sql1 = "INSERT INTO `addexamdetails` VALUES ('$title',$total_question,$marks,$negativemarks,'$buttons')";

    if ($conn->query($sql1)) { ?>
        <script>
            alert("SUCCSEEFULLY ADD EXAM DETAILS")
        </script>
<?php
    }
}
?>
<?php
if (isset($_GET['title'])) {
    if ($_GET['action'] == 'remove') {
        $title = $_GET['title'];
        $sql = "DELETE FROM addexamdetails WHERE `title`='$title'";
        $result = mysqli_query($conn, $sql);
        $sql1 = "DELETE FROM addquestions WHERE `title`='$title'";
        $result1 = mysqli_query($conn, $sql1);
    }
}
?>

<?php include('header.php'); ?>

<body>
    <?php include('navigation.php'); ?>
    <div id="exam-title-div">
        <form action="" method="POST">
            <p>
                <label for="exam-title">Exam Title: <input type="text" name="exam-title" class="cmd-title" required></label>
            </p>
            <p> <label for="no_of_quesions">Number Of Questions:
                    <select name="total_question" class="cmd-title">
                        <option value="">Select</option>
                        <option value="5">5 Question</option>
                        <option value="10">10 Question</option>
                    </select>
                </label>
            </p>
            <p> <label for="marks">Select Marks
                    <select name="marks" class="cmd-title">
                        <option value="">Select</option>
                        <option value="1">+1 Mark</option>
                    </select>
                </label>
            </p>
            <p> <label for="negative_marks">Select Negative Marks
                    <select name="marks_per_wrong_answer" class="cmd-title">
                        <option value="">Select</option>
                        <option value="1">-1 Mark</option>
                    </select>
                </label>
            </p>
            <p> <label for="buttons">Select TO Enable Or Disable Skip Button
                    <select name="buttons" class="cmd-title">
                        <option value="">Select</option>
                        <option value="enable">Enable</option>
                        <option value="disable">Disable</option>
                    </select>
                </label>
            </p>
            <p>
                <p>
                    <input type="submit" name="submit" value="Submit">
                </p>
            </p>

        </form>
    </div>
    <?php
    show();
    function show()
    {
        include('../src/config.php');
        $sql = "SELECT * FROM addexamdetails";
        $result = mysqli_query($conn, $sql); ?>
        <table>
            <tr>
                <th>Title</th>
                <th>No of Questions</th>
                <th>Marks</th>
                <th>Negative Marks</th>
                <th>ACTION</th>
                <th>ADD QUESTIONS</th>
            </tr>
            <?php $s = 0;
            $result = mysqli_query($conn, $sql); ?>
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['total_questions']; ?></td>
                        <td><?php echo $row['marks']; ?></td>
                        <td><?php echo $row['negativemarks']; ?></td>
                        <td><a href="addexamdetails.php?title=<?php echo $row['title']; ?>&action=remove">REMOVE</a></td>
                        <td><a href="addquestions.php?title=<?php echo $row['title']; ?>&no=<?php echo $row['total_questions']; ?>">ADD QUESTIONS</a></td>
                    </tr>
                <?php
                } ?>
            <?php
            } ?>
        </table>
    <?php
    }
    ?>
</body>

</html>