<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> MeetUp MeetUs</title>
    <link rel="stylesheet" href="../css/font-awesome-4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style2.css">
</head>

<body>
    <div class="header container w3-theme-dark">
        <div class="left w3-bar">
            <img src="../images/<?php echo $me->profile_pic; ?>" alt="profile" />
            <div class="search">
                <input type="search" placeholder="search" />
            </div>
        </div>
        <ul>
            <li title="Home"><a href="../post/home.php"><i class="fa fa-home"></i></a></li>
            <li title="Stories" class="">
                <a href="../stories/index.php">
                    <i class="fa fa-book"></i>
                </a>
            </li>
            <li title="Profile"><a href="../friends/profile.php"><i class="fa fa-user"></i></a></li>
            <li title="Friends" class="active">
                <a href="../friends/friends.php">
                    <i class="fa fa-users"></i>
                    <?php echo ($req_num > 0) ? '<span class="badge-red">' . $req_num . '</span>' : ''; ?>
                </a>
            </li>

            <li title="Messages">
                <a href="../message/">
                    <i class="fa fa-wechat"></i>
                    <?php echo ($unread > 0) ? '<span class="badge-red">' . $unread . '</span>' : ''; ?>
                </a>
            </li>
            <li title="Settings">
                <a href="#"> <i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span></span></a>

            </li>
            <li id="notation">
                <i class="fa fa-bars"></i>
                <a id="logout" class="w3-card-4 w3-animate-bottom w3-theme-light" href="../friends/logout.php">
                    <i class="fa fa-sign-out" style="font-size: 12px;"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</body>

</html>