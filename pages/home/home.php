<h2>Summary</h2>
<table>
	<tr>
		<td>Sync URL:</td>
		<td><?php echo makeURL("", true) ?></td>
	</tr>
    <tr>
        <td>Servers:</td>
        <td><?php echo $container["services"]["servers"]->count()?></td>
    </tr>
    <tr>
        <td>Users:</td>
        <td><?php echo $container["services"]["users"]->count()?></td>
    </tr>
    <tr>
        <td>Updates:</td>
        <td><?php echo $container["services"]["updates"]->count()?></td>
    </tr>


</table>

