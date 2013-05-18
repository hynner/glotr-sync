<?php
if($_POST["name"] && $_POST["password"])
{
    $error = !$container["services"]["users"]->login($_POST["name"], $_POST["password"]);
}
if($container["user"])
    redirect("home");

?>
<h2>Log IN</h2>
<?php if($error): ?>
    <p>Wrong username or password!</p>
<?php endif; ?>
<form action="" method="post">
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="name" /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" /></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Sign in"/>
                <a href="<?php echo makeUrl("register")?>">register</a>
            </td>
        </tr>
    </table>
</form>
