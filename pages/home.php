<?php
if(!$container["user"])
    redirect("sign-in");

$subpages = array("home","users", "servers");
$subpg = $args[0];
if(!in_array($subpg, $subpages))
{
    $subpg = $subpages[0];
}
?>
<div id="home">
    <a href="<?php echo makeUrl("sign-out");?>">Sign out</a>
    <?php require "modules/menu.php";?>
    <div id="content">
        <?php require "pages/home/$subpg.php"; ?>
    </div>
</div>
