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
                        <td><a href="exam-start1.php?title=<?php echo $row['title']; ?>">START</a></td>

                    </tr>
                <?php   } ?>
            <?php   } ?>
        </table>
    <?php }
    ?>

    </html>