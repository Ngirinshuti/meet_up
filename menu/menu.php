<?php

function getActive($url)
{
    $found = strpos($_SERVER['REQUEST_URI'], $url);
    echo ($found !== false) ? "active" : "";
}

?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo getUrl("/css/font-awesome-4.5.0/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?php echo getUrl("/css/main.css") ?>">
</head>

<nav>
    <header>
        <a href="<?php echo $ROOT_URL; ?>" class="navLogo">MU</a>
        <div class="navSearch">
            <input type="search" placeholder="search" />
        </div>
        <div class="navUserImage">
            <img src="<?php echo getUrl("/images/{$me->profile_pic}");  ?>" alt="profile" />
        </div>
    </header>
    <ul>
        <li title="Home">
            <a data-tooltip="Home" class="<?php getActive(getUrl("/post/home.php")); ?>" href="<?php echo getUrl("/post/home.php"); ?>"><i class="fa fa-home"></i></a>
        </li>
        <li title="Stories"><a data-tooltip="stories" class="<?php getActive(getUrl("/stories")); ?>" href="<?php echo getUrl("/stories"); ?>"><i class="fa fa-book"></i></a> </li>
        <li title="Profile"><a data-tooltip="Profile" class="<?php getActive(getUrl("/friends/profile.php")); ?>" href="<?php echo getUrl("/friends/profile.php"); ?>"><i class="fa fa-user"></i></a></li>
        <li title="Friends">
            <a data-tooltip="friends" class="<?php getActive(getUrl("/friends/friends.php")); ?>" href="<?php echo getUrl("/friends/friends.php"); ?>">
                <i class="fa fa-users"></i>
            </a>
        </li>
        <li title="Messages">
            <a data-tooltip="messages" class="<?php getActive(getUrl("/message")); ?>" href="<?php echo getUrl("/message"); ?>">
                <i class="fa fa-wechat"></i>
                <?php echo ($unread > 0) ? '<span class="badge-red">' . $unread . '</span>' : ''; ?>
            </a>
        </li>
        <li title="Settings">
            <a href="#"> <i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span></span></a>
            <ul class="subNav">
                <li>
                    <a href="<?php echo getUrl("/friends/logout.php"); ?>">Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>