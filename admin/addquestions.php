<?php
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
error_reporting(0);
$num = 1;
include('../src/config.php');
if (isset($_POST['submit'])) {
    $question = $_REQUEST['question'];
    $option1 = $_REQUEST['option1'];
    $option2 = $_REQUEST['option2'];
    $option3 = $_REQUEST['option3'];
    $option4 = $_REQUEST['option4'];
    $answer = $_REQUEST['answer'];
    $title = $_GET['title'];
    $q_id = $_REQUEST['q_id'];
    $sql = "INSERT INTO `addquestions`(`q_id`,`title`,`name`, `option1`, `option2`, `option3`, `option4`, `answer`) VALUES ($q_id,'$title','$question','$option1','$option2','$option3','$option4','$answer')";
    if ($conn->query($sql)) { ?>
        <script>
            alert("QUESTION ADD SUCCESSFULL!!")
        </script>
<?php  } else {
    }
}

?>
<?php
if (isset($_GET['name'])) {
    if ($_GET['action'] == 'remove') {
        $name = $_GET['name'];
        $sql = "DELETE FROM addquestions WHERE `name`='$name'";
        $result = mysqli_query($conn, $sql);
    }
}
?>
<?php include("header.php"); ?>

<body>
    <?php include('navigation.php'); ?>
    <form actin="" method="POST">
        <p>
            <p><label for="questions">Enter Your Questions Number <input type="number" name="q_id"></label>
            </p>
            <p>
                <p><label for="questions">Enter Your Questions <br><textarea rows="5" cols="50" name="question"></textarea></label>
                </p>
            </p>
            <p>
                <p><label for="questions">Option1<input type="text" name="option1"></label>
                </p>
                <p><label for="questions">Option2<input type="text" name="option2"></label>
                </p>
                <p><label for="questions">Option3<input type="text" name="option3"></label>
                </p>
                <p><label for="questions">Option4<input type="text" name="option4"></label>
                </p>
                <p>
                    <label>Answer</label>
                    <select name="answer" id="answer_option" class="form-control">
                        <option value="">Select</option>
                        <option value="1">1 Option</option>
                        <option value="2">2 Option</option>
                        <option value="3">3 Option</option>
                        <option value="4">4 Option</option>
                    </select>
                </p>
                <p>
                    <input type="submit" name="submit" value="SUBMIT">
                </p>
    </form>
    <?php
    show();
    function show()
    { ?>
        <table>
            <tr>
                <th>Question NO</th>
                <th>Title</th>
                <th>Name</th>
                <th>Option 1</th>
                <th>Option 2</th>
                <th>Option 3</th>
                <th>Option 4</th>
                <th>ACTION</th>
            </tr>
            <?php $s = 0;
            error_reporting(0);
            include('../src/config.php');
            $title = $_GET['title'];
            $sql = "SELECT * FROM addquestions where `title`='$title' ORDER BY q_id ASC";
            $result = mysqli_query($conn, $sql); ?>
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['q_id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['option1']; ?></td>
                        <td><?php echo $row['option2']; ?></td>
                        <td><?php echo $row['option3']; ?></td>
                        <td><?php echo $row['option4']; ?></td>
                        <td><a href="addquestions.php?name=<?php echo $row['name']; ?>&action=remove">REMOVE</a></td>
                    </tr>
                <?php   } ?>
            <?php   } ?>
        </table>
    <?php }
    ?>
</body>

</html>