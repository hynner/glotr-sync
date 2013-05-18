<?php

if($_POST["name"])
{
    $error = $container["services"]["servers"]->register($_POST["name"], $_POST["password"], $_POST["password2"]);
     if($_GET["no-redir"])
	{
		if($error === FALSE)
		{
		    ?>
			    <div id="code">OK</div>
		    <?php
		}
	}
    elseif($error === FALSE)
        redirect("sign-in");
}
?>
<h2>Add server</h2>
<?php if($error): ?>
	<div id="code">ERROR</div>
	<p id="error"><?php echo $error ?></p>
<?php endif; ?>
<form action="" method="post">
    <table>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" /></td>
        </tr>
        <tr>
            <td>Password again</td>
            <td><input type="password" name="password2" /></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" />
            </td>
        </tr>
    </table>
</form>
