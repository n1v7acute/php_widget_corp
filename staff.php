<?php 
	$sql_connect = mysql_connect("localhost","root","rogina");
	
	if(!$sql_connect)
	{
		die("SQL connection failed!" . mysql_error());
	}
	
	$sql_select_db = mysql_select_db("widget", $sql_connect);
	
	if(!$sql_select_db)
	{
		die("SQL selection failed!" . mysql_error());
	}

?>

<?php include("includes/header.php"); ?>
			<table id="structure">
				<tr>
					<td id="navigation">
						&nbsp;
					</td>
					<td id="page">
						<h2>Staff Menu</h2>
						<p>Welcome to the staff area.</p>
						<ul>
							<li><a href="content.php">Manage Website Content</a></li>
							<li><a href="new_user.php">Add Staff User</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</td>
				</tr>
			</table>
<?php include("includes/footer.php"); ?>
<?php 
	mysql_close($sql_connect);
?>