<?php
if($_POST["name"])
{
    $error = $container["services"]["users"]->register($_POST["name"], $_POST["password"], $_POST["password2"]);
    if($error === FALSE)
        redirect("sign-in");
}
?>
<h2>Registration</h2>
<?php if($error): ?>
    <p id="error"><?php echo $error ?></p>
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


