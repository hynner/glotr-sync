<?php
ob_start();
session_start();
// important for glotr, if not send, socket will be waiting uselessly
header("Connection: close", true);

require "config/conf.php";
require "functions.php";
require "classes/baseDB.php";
require "classes/mysql.php";
require "classes/TransferPacket.php";
require "services/base.php";
require "services/users.php";
require "services/updates.php";
require "services/servers.php";
$container = array();
$container["database"] = new mysql($host, $usrname, $passwd, $dbname);
// compression settings
$container["compression"] = "plain";
$compressions = array("gzcompress", "bzcompress");
$container["compression"] = "plain";
$container["availableCompressions"] = array();
foreach($compressions as $c)
{
	if(function_exists($c))
		$container["availableCompressions"][] = $c;
}
if(!empty($container["availableCompressions"]))
{
	$container["compression"] = $container["availableCompressions"][0];
}

$container["max_transfer_items"] = $max_transfer_items;
$container["services"]["users"] = new users($container);
$container["services"]["servers"] = new servers($container);
$container["services"]["updates"] = new updates($container);
$container["persistent"] = &$_SESSION["persistent"];
if($container["persistent"]["user_logged"])
    $container["user"] = $container["services"]["users"]->get($container["persistent"]["user_logged"]);

$pages = array("home","sign-in", "sign-out", "install", "register", "add_server", "input");
$page = $_GET["pg"];
$args = $_GET["args"];

if(!in_array($page, $pages))
    $page = $pages[0];

