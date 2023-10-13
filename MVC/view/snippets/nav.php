
<nav>
    <a href="<?= ROOT ?>">HOME</a>
    <a href="<?= ROOT . "stamp" ?>">stamps</a>
    <a href="<?= ROOT . "user" ?>">users</a>
    <a href="<?= ROOT . "category" ?>">categories</a>
<?php if(isset($_SESSION["fingerPrint"]) && $_SESSION["name"] == "root"): ?>
    <a href="<?= ROOT . "panel" ?>">panel</a>
    <a href="<?= ROOT . "login/logout" ?>">logout</a>
<?php elseif(isset($_SESSION["fingerPrint"])): ?>
    <a href="<?= ROOT . "user/profile" ?>">profile</a>
    <a href="<?= ROOT . "login/logout" ?>">logout</a>
<?php else: ?>
    <a href="<?= ROOT . "login" ?>">login</a>
<?php endif ?>
</nav>