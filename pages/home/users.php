<?php
$users = $container["services"]["users"]->getAll();
if($args[1] == "toggleActive" && $args[2])
{
    $container["services"]["users"]->toggleActive($args[2]);
    redirect("home/users");
}
?>
<h2>Users</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Active</th>
        <th>Actions</th>
    </tr>
    <?php foreach($users as $user): ?>
        <tr>
            <td><?php echo $user["id_user"]; ?></td>
            <td><?php echo $user["username"]; ?></td>
            <td><?php echo ($user["active"]=="1") ? "YES" : "NO"; ?></td>
            <td><a href="<?php echo makeUrl("home/users/toggleActive/$user[id_user]"); ?>">Toggle active</a></td>
        </tr>
    <?php endforeach; ?>
</table>
