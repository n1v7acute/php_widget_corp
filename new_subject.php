<?php require("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php selected_page() ?>
<?php include("includes/header.php"); ?>
			<table id="structure">
				<tr>
					<td id="navigation">
						<?php echo navigation($sel_subj,$sel_page); ?>
					</td>
					<td id="page">
						<h2>Add Subject</h2>
						<form action = "create_subject.php" method = "post">
							<p>Subject name:
								<input type = "text" name="menu_name" value = "" id = "" />
							</p>
							
							<p>Position:
								<select name = "position">
									<?php
										$get_all_subjects = get_all_subjects();
										$subject_count = mysql_num_rows($get_all_subjects);
										
										$count = 1;
										while($count <= $subject_count + 1)
										{
											echo "<option value = \"{$count}\">{$count}</option>";		
											$count++;
										}
									?>
									
								</select>
							</p>

							<p>Visible:
								<input type = "radio" name="visible" value = "0" id = "" /> No
								&nbsp;
								<input type = "radio" name="visible" value = "1" id = "" /> Yes
							</p>
							
							<input type = "submit" value = "Add subject" id = "" />
						</form>
						<br />
						<a href="content.php">cancel</a>
					</td>
				</tr>
			</table>
<?php require_once("includes/footer.php"); ?>
