<div id="output">
<?php

if($_GET["action"] == "ping")
{
	$code = "OK";
}
elseif($id_server =  $container["services"]["servers"]->login($_POST["name"], $_POST["password"]))
{
    $code =  "OK";
    switch($_POST["action"])
    {
	case "verify": ?>
	<div id="compression"><?php echo implode("|", $container["availableCompressions"]);?></div>
	<div id="max_transfer_items"><?php echo $container["max_transfer_items"]; ?></div>
	<?php
            break;
	case "input":
		$success = false;
		try{
			$packet = new TransferPacket($container["availableCompressions"], array());
			$packet->loadString($_POST["data"]);
			$items = $packet->getItems();
			foreach($items as $item)
			{
				$data = array(
				    "id_server" => $id_server,
				    "action" => $item["action"],
				    "data" => $item["data"],
				    "compression" => $item["compression"],
				    "timestamp" => $item["timestamp"]
				);
				$res =  $container["services"]["updates"]->insert($data);
				$success = $success || $res;
			}
		}
		catch(TransferException $e)
		{
			$code = $e->getMessage();
		}
		if(!$success)
		{
			$code = "ERROR";
		}
		break;
	case "download":
		$limit = $container["max_transfer_items"];
		if(isset($_POST["limit"]) && $_POST["limit"] > 0 && $_POST["limit"] < $container["max_transfer_items"] )
		{
			$limit = $_POST["limit"];
		}
		if(!$_POST["last_id"])
		{
			$_POST["last_id"] = 0;
		}
		$data = $container["services"]["updates"]->getUpdatesForServer($_POST["last_id"],$id_server, $limit);
		if(!empty($data))
		{

			try{
				$packet = new TransferPacket($container["availableCompressions"], explode("|", $_POST["compression"]));
				foreach($data as $d)
				{
					$packet->addItem($d);
				}
				$str = $packet->toString();
				?>
		<div id="data"><?php echo $str ?></div>

				<?php
			}
			catch(TransferException $e)
			{
				$code = $e->getMessage();
			}
		}
		else
		{
			?>
		<div id="data">NO-DATA</div>
		<?php
		}
		break;
    }

}
else
{
	$code =  "401";
}
?>
	<div id="code"><?php echo $code; ?></div>

</div>
