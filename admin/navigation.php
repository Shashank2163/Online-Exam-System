<?php
echo '<h1 id="admin-panel">ADMIN PANEL</h1>
<ul>
        <li><a href="admin.php">DASHBOARD</a></li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">USERS</a>
            <div class="dropdown-content">
                <a href="manageuser.php">MANAGE USER</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">EXAM</a>
            <div class="dropdown-content">
                <a href="addexamdetails.php">ADD EXAM DETAILS</a>
            </div>
        </li>
        <li><a href="logout.php">LOGOUT</a></li></ul>';
