<h2>Servers</h2>
<?php
if($args[2])
{
    switch ($args[1]) {
        case 'toggleActive':
            $container["services"]["servers"]->toggleActive($args[2]);
            break;
        case "delete":
            $container["services"]["servers"]->delete($args[2]);
            break;
    }
}
$servers = $container["services"]["servers"]->getAll();
?>
<?php if(count($servers) > 0): ?>
    <table>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Active</th>
			<th>Actions</th>
		</tr>
        <?php foreach($servers as $server): ?>
            <tr>
                <td><?php echo $server["id_server"]; ?></td>
                <td><?php echo $server["name"]; ?></td>
                <td><?php echo ($server["active"]=="1") ? "YES" : "NO"; ?></td>
            <td><a href="<?php echo makeUrl("home/servers/toggleActive/$server[id_server]"); ?>">Toggle active</a>
                <a href="<?php echo makeUrl("home/servers/delete/$server[id_server]"); ?>">delete</a></td>
            </tr>
        <?php endforeach; ?>

    </table>
<?php endif; ?>
