<?php require("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php selected_page() ?>
<?php include("includes/header.php"); ?>
			<table id="structure">
				<tr>
					<td id="navigation">
						<?php echo navigation($sel_subj,$sel_page); ?>
						<br />
						<a href="new_subject.php">+ Add a Subject</a>
					</td>
					<td id="page">
						<?php 
							if(!is_null($sel_subj))
							{
								echo "<h2>{$sel_subj["menu_name"]}</h2>";
							}elseif(!is_null($sel_page))
							{
								echo "<h2>{$sel_page["menu_name"]}</h2>";
								
								echo "<div class = \" page-content\">";
								
								echo $sel_page["content"];
								
								echo "</div>";
								
							}else
							{
								echo "<h2>Select a subject to be edit.</h2>";	
							}
						?>

					</td>
				</tr>
			</table>
<?php require_once("includes/footer.php"); ?>
