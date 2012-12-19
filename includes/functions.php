<?php
    //functions
    
    function mysql_prep($value)
	{
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists("mysql_real_escape_string");
		
		if($new_enough_php)
		{
			if($magic_quotes_active)
			{
				$value = stripslashes($value);
			}
		}else
		{
			if(!$magic_quotes_active)
			{
				$value = addslashes($value);	
			}
		}
		return $value;
	}
    
	function redirect_to($location = NULL)
	{
		header("location: {$location}");
		exit;
	}
	
    function confirm_query($query)
	{
		if(!$query)
		{
			die("Mysql squery failed! " . mysql_error());
		}
	}
	
	function get_all_subjects()
	{
		global $sql_connect;
		
		$query = "SELECT * 
		FROM subjects 
		ORDER BY position ASC";
		 
		$subject_set = mysql_query($query, $sql_connect);
		confirm_query($subject_set);
		
		return $subject_set;
	}
	
	function get_pages_to_subjects($subject)
	{
		global $sql_connect;
		
		$query = "SELECT * 
		FROM pages 
		WHERE subject_id = {$subject} 
		ORDER BY position ASC";
		 
		$page_set = mysql_query($query, $sql_connect);
		confirm_query($page_set);
		
		return $page_set; 
	}
	
	function get_subject_by_id($subject_id)
	{
		global $sql_connect;
		
		$query = "SELECT * ";
		$query .= "FROM subjects ";
		$query .= "WHERE id = " . $subject_id . " ";
		$query .= "LIMIT 1";
		
		$result_set = mysql_query($query, $sql_connect);
		confirm_query($result_set);
		
		if($subject = mysql_fetch_array($result_set))
		{
			return $subject; 
		}else
			return NULL;
	}
	
	function get_page_by_id($page_id)
	{
		global $sql_connect;
		
		$query = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE id = " . $page_id . " ";
		$query .= "LIMIT 1";
		
		$result_set = mysql_query($query, $sql_connect);
		confirm_query($result_set);
		
		if($page = mysql_fetch_array($result_set))
		{
			return $page; 
		}else
			return NULL;
	}
	
	function selected_page()
	{
		global $sel_subj;
		global $sel_page;
		
		if(isset($_GET["subj"]))
		{
			$sel_subj = get_subject_by_id($_GET["subj"]);
			$sel_page = NULL;
		}elseif(isset($_GET["page"]))
		{
			$sel_subj = NULL;
			$sel_page = get_page_by_id($_GET["page"]);
			
		}else
		{
			$sel_subj = NULL;
			$sel_page = NULL;
		}			
	}
	
	function navigation($sel_subj,$sel_page)
	{
			$output = "<ul class=\"subjects\">";
			
				$subject_set = get_all_subjects();
				
				while($subject = mysql_fetch_array($subject_set))
				{
					$output .= "<li"; 
					if($subject["id"] == $sel_subj['id']){ $output .= " class=\"selected\""; };
					$output .= "><a href=\"edit_subject.php?subj=" . urlencode($subject["id"]). 
					"\">{$subject["menu_name"]}</a></li>";
					
					$page_set = get_pages_to_subjects($subject["id"]);									
							
					$output .= "<ul class = \"pages\">";
						while($page = mysql_fetch_array($page_set))
						{
							$output .= "<li"; 
							if($page["id"] == $sel_page['id']){ $output .= " class=\"selected\""; };
							$output .= "><a href=\"content.php?page=" . urlencode($page["id"]).
							"\">{$page["menu_name"]}</li>";
						}
					$output .= "</ul>";
				}
		$output .= "</ul>";	
		
		return $output;
	}
?>