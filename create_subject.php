<?php require("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php 
	$errors = array();
	$required_fields = array('menu_name', 'position', 'visible');
	foreach ($required_fields as $field_name) {
		if(!isset($_POST[$field_name]) || empty($_POST[$field_name]))
		$errors[] = $field_name;
	}
	
	$fields_with_lengths = array('menu_name' => 30);
	foreach ($fields_with_lengths as $field_name => $max_length) {
		if(strlen(trim(mysql_prep($_POST[$field_name]))) > $max_length)
		{
			$errors[] = $field_name;
		}
	}
	
	if(!empty($errors))	{
		redirect_to("new_subject.php");
	}
?>

<?php
    $menu_name 	= mysql_prep($_POST['menu_name']);
    $position	= mysql_prep($_POST['position']);
    $visible 	= mysql_prep($_POST['visible']);   
?>
<?php 

	$query = "INSERT INTO subjects(
			menu_name, position, visible
			) VALUES (
			'{$menu_name}', {$position}, {$visible}
			)";
			
	if(mysql_query($query, $sql_connect))
	{
		redirect_to("content.php");
	}else
		echo "<p>Mysql query error!</p>";
		echo "<p>". mysql_error() . "</p>";	
//
?>
<?php mysql_close() ?>
