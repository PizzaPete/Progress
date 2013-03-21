<?php
	$db_host = 'localhost';
	$db_user = 'database_user';
	$db_pass = 'database_password';
	$db_name = 'database_name';
	
	$link = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
	mysql_select_db($db_name) or die(mysql_error());
	
	if(isset($_POST['addProject'])) {
		$name = $_POST['projectname'];
		$startdate = substr($_POST['projectdate'], 0, 10);
		$enddate = substr($_POST['projectdate'], 13, 23);
		$startdate = date("Y-m-d",strtotime(str_replace('/','-',$startdate)));
		$enddate = date("Y-m-d",strtotime(str_replace('/','-',$enddate)));
		if(!empty($_POST['memberbox'])) {
		    foreach($_POST['memberbox'] as $check) {
		    	$members .= $check.','; 
		    }
		}
		mysql_query("INSERT INTO projects(project, startdate, enddate, members) VALUES('".mysql_real_escape_string($name)."', '".mysql_real_escape_string($startdate)."', '".mysql_real_escape_string($enddate)."', '".mysql_real_escape_string($members)."')"); 
		echo '<div class="alert fade in"><button data-dismiss="alert" class="close" type="button">×</button>New project successfully added.</div>';
	}
	
	if(isset($_POST['updateProject'])) {
		$id = $_POST['projectid'];
		$name = $_POST['projectname'];
		$startdate = substr($_POST['projectdate'], 0, 10);
		$enddate = substr($_POST['projectdate'], 13, 23);
		$startdate = date("Y-m-d",strtotime(str_replace('/','-',$startdate)));
		$enddate = date("Y-m-d",strtotime(str_replace('/','-',$enddate)));
		if (isset($_POST['finished'])) {
			$status = 1;
		} else {
			$status = 0;
		}
		if(!empty($_POST['memberbox'])) {
		    foreach($_POST['memberbox'] as $check) {
		    	$members .= $check.','; 
		    }
		}
		mysql_query("UPDATE projects SET project='".mysql_real_escape_string($name)."', startdate='".mysql_real_escape_string($startdate)."', enddate='".mysql_real_escape_string($enddate)."', members='".mysql_real_escape_string($members)."', status='".mysql_real_escape_string($status)."' WHERE id = '".mysql_real_escape_string($id)."'"); 
		echo '<div class="alert fade in"><button data-dismiss="alert" class="close" type="button">×</button>Project successfully updated.</div>';
	}
	
	if(isset($_POST['deleteProject'])) {
		$id = $_POST['projectid'];
		
		mysql_query("DELETE FROM projects WHERE id = '".mysql_real_escape_string($id)."'"); 
		echo '<div class="alert fade in"><button data-dismiss="alert" class="close" type="button">×</button>Project successfully deleted.</div>';
	}
	
	if(isset($_GET['updateCancelled'])) {
		echo '<div class="alert fade in"><button data-dismiss="alert" class="close" type="button">×</button>Project was not updated.</div>';
	}
	
	if(isset($_POST['addMember'])) {
		$name = $_POST['name'];
		$fbid = $_POST['fbid'];
		$birthday = date("Y-m-d",strtotime(str_replace('/','-',$_POST['birthday'])));
		$position = $_POST['position'];
		mysql_query("INSERT INTO members(name, fbid, birthday, function) VALUES('".mysql_real_escape_string($name)."', '".mysql_real_escape_string($fbid)."', '".mysql_real_escape_string($birthday)."', '".mysql_real_escape_string($position)."')"); 
		echo '<div class="alert fade in"><button data-dismiss="alert" class="close" type="button">×</button>New member successfully added.</div>';
	}
	
	if(isset($_POST['updateMember'])) {
		$id = $_POST['memberid'];
		$name = $_POST['name'];
		$fbid = $_POST['fbid'];
		$birthday = date("Y-m-d",strtotime(str_replace('/','-',$_POST['birthday'])));
		$position = $_POST['position'];
		if (isset($_POST['delete'])) {
			mysql_query("DELETE FROM members WHERE id = '".mysql_real_escape_string($id)."'"); 
			echo '<div class="alert fade in"><button data-dismiss="alert" class="close" type="button">×</button>Employee successfully deleted.</div>';
		} else {
			mysql_query("UPDATE members SET name='".mysql_real_escape_string($name)."', fbid='".mysql_real_escape_string($fbid)."', birthday='".mysql_real_escape_string($birthday)."', function='".mysql_real_escape_string($position)."' WHERE id = '".mysql_real_escape_string($id)."'"); 
			echo '<div class="alert fade in"><button data-dismiss="alert" class="close" type="button">×</button>Employee updated successfully.</div>';
		}
	}
	
	if(isset($_GET['updateMemberCancelled'])) {
		echo '<div class="alert fade in"><button data-dismiss="alert" class="close" type="button">×</button>Employee was not updated.</div>';
	}
	
	if(isset($_POST['addPosition'])) {
		$position = $_POST['position'];
		mysql_query("INSERT INTO positions(name) VALUES('".mysql_real_escape_string($position)."')"); 
		echo '<div class="alert fade in"><button data-dismiss="alert" class="close" type="button">×</button>New department successfully added.</div>';
	}
	
	if(isset($_POST['updateDepartment'])) {
		$id = $_POST['departmentid'];
		$name = $_POST['position'];
		if (isset($_POST['delete'])) {
			mysql_query("DELETE FROM positions WHERE id = '".mysql_real_escape_string($id)."'"); 
			echo '<div class="alert fade in"><button data-dismiss="alert" class="close" type="button">×</button>Department successfully deleted.</div>';
		} else {
			mysql_query("UPDATE positions SET name='".mysql_real_escape_string($name)."' WHERE id = '".mysql_real_escape_string($id)."'"); 
			echo '<div class="alert fade in"><button data-dismiss="alert" class="close" type="button">×</button>Department updated successfully.</div>';
		}
	}
	
	if(isset($_GET['updateDepartmentCancelled'])) {
		echo '<div class="alert fade in"><button data-dismiss="alert" class="close" type="button">×</button>Department was not updated.</div>';
	}
	
	function getProjects() {	
		$getProjects = mysql_query("SELECT * FROM projects WHERE status = 0 ORDER BY enddate ASC");
		while ($rows = mysql_fetch_array($getProjects)) {
			echo '<li><div class="row"><div class="span3"><strong>'.$rows['project'].'</strong></div>';
			
			$now = time();
			$startdate = strtotime($rows['startdate']);
			$enddate = strtotime($rows['enddate']);
			$totalDateDiff = $enddate - $startdate;
			$currentDateDiff = $now - $startdate;			
			$progression = 100*($now - $startdate)/($enddate - $startdate);
			
			$progressclass = '';
			$labelclass = '';
			if(round($progression, 2) > 25 && round($progression, 2) <= 50) {
				$progressclass = 'progress-success';
				$labelclass = 'label-warning';
			} elseif (round($progression, 2) > 50 && round($progression, 2) < 75) {
				$progressclass = 'progress-warning';
				$labelclass = 'label-warning';
			} else if(round($progression, 2) > 75) {
				$progressclass = 'progress-danger';
				$labelclass = 'label-danger';
			}
			
			echo '<div class="span3 progressbar"><div class="progress '.$progressclass.' progress-striped"><div class="bar" style="width: '.$progression.'%"></div></div></div>';
			echo '<div class="span1"><span class="label '.$labelclass.'">'.date("d m",strtotime(str_replace('/','-',$rows['enddate']))).'</span></div>';
			echo '<div class="span2 users">';
			
			$membersArray = explode(',', $rows['members']);
			
			foreach ($membersArray as $value) {
			    $getMembers = mysql_query("SELECT * FROM members WHERE id = '".$value."'");
				while($row = mysql_fetch_array($getMembers)) {
					echo '<img class="userimage" data-toggle="tooltip" title="'.$row['name'].'" src="http://graph.facebook.com/'.$row['fbid'].'/picture?width=20&height=20" alt="'.$row['name'].'" />';
					
				}
			}
			echo '</div></div></li>';
		}
	}
	
	function getAllProjects() {	
		$getProjects = mysql_query("SELECT * FROM projects ORDER BY enddate ASC");
		while ($rows = mysql_fetch_array($getProjects)) {
			if($rows['status'] == 1) { $status = 'Completed'; $class='class="success clickable"'; } else { $status = 'Active'; $class='class="clickable"'; }
			
			echo '<tr '.$class.' onclick="window.location=\'admin.php?id='.$rows['id'].'\'"><td>'.$rows['id'].'</td>';
			echo '<td>'.$rows['project'].'</td>';
			echo '<td>'.date("d/m/Y",strtotime($rows['enddate'])).'</td>';			
			echo '<td>'.$status.'</td></tr>';
		}
	}
	
	function getProject($id) {	
		$getProject = mysql_query("SELECT * FROM projects WHERE id = '".$id."'");
		while ($rows = mysql_fetch_array($getProject)) {
			echo '<input type="hidden" name="projectid" value="'.$id.'">';
			echo '<label>Project name</label>';
		    echo '<input type="text" name="projectname" value="'.$rows['project'].'" required>';
			echo '<label>Project date range</label>';
		    echo '<div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>';
		    echo '<input type="text" name="projectdate" id="projectdate" value="'.date("d/m/Y",strtotime($rows['startdate'])).' - '.date("d/m/Y",strtotime($rows['enddate'])).'" required></div>';
			echo '<label>Project status</label>';
			if($rows['status'] == 1) {
				echo '<input type="checkbox" name="finished" value="finished" checked> Finished';
			} else {
				echo '<input type="checkbox" name="finished" value="unfinished"> Finished';
			}
			echo '<label>Project members</label>';
			getProjectMembers($rows['members']);
		}
	}
	
	function getMembers() {	
		$getPositions = mysql_query("SELECT * FROM positions");
		echo '<ul class="nav nav-tabs">';
		$i = 0;
		$j = 0;
		$tabs ='';
		while ($rows = mysql_fetch_array($getPositions)) {
			if($i == 0) {
				$class="active";
			} else {
				$class = '';
			}
			echo '<li class="'.$class.'"><a href="#tab'.$rows['id'].'" data-toggle="tab">'.$rows['name'].'</a></li>';
				$tabs .= '<div class="tab-pane '.$class.'" id="tab'.$rows['id'].'">';
				$getMembers = mysql_query("SELECT * FROM members WHERE function = '".$rows['id']."'");
				while($row = mysql_fetch_array($getMembers)) {
					if($j == 0) {
						$class="active";
					} else {
						$class="";
					}
					
					$tabs .= '<label class="checkbox inline">';
					$tabs .= '<input type="checkbox" name="memberbox[]" value="'.$row['id'].'">'.$row['name'];
					$tabs .= '</label>';
					//echo $row['name']; 
				}
				$tabs .= '</div>';
				
			$i++;
		}
		echo '</ul>';
		echo '<div class="tab-content">'.$tabs.'</div>';
	}
	
	function getAllEmployees() {	
		$getProjects = mysql_query("SELECT * FROM members ORDER BY name");
		while ($rows = mysql_fetch_array($getProjects)) {			
			echo '<tr class="clickable" onclick="window.location=\'admin.php?member='.$rows['id'].'\'">';
			echo '<td>'.$rows['name'].'</td></tr>';
		}
	}
	
	function getEmployee($id) {	
		$getProject = mysql_query("SELECT * FROM members WHERE id = '".$id."'");
		while ($rows = mysql_fetch_array($getProject)) {
			echo '<input type="hidden" name="memberid" value="'.$id.'">';
			echo '<label>Name</label>';
		    echo '<div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span><input type="text" value="'.$rows['name'].'" name="name" placeholder="Richard Branson" required></div>';
			echo '<label>Facebook ID</label><div class="input-prepend"><span class="add-on"><i class="icon-thumbs-up"></i></span><input class="fbid" data-content="To get a users Facebook ID just fill in their profile url on <a href=\'http://findmyfacebookid.com\' target=\'_blank\'>this</a> page." data-original-title="Facebook ID" data-toggle="popover" data-trigger="focus" data-placement="left" value="'.$rows['fbid'].'" type="text" name="fbid" placeholder="1337" required></div>';
			echo '<label>Birthday</label><div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input type="text" class="memberbirthday" name="birthday" placeholder="11/05/1987" value="'.date("d/m/Y",strtotime($rows['birthday'])).'" required></div>';
			echo '<label>Department</label><div class="input-prepend"><span class="add-on"><i class="icon-briefcase"></i></span><select name="position">';
			getPositions($rows['function']);
			echo '</select></div>';
		}
	}
	
	function getBirthdays() {	
		$getBirthdays = mysql_query("SELECT * FROM members WHERE birthday + INTERVAL EXTRACT(YEAR FROM NOW()) - EXTRACT(YEAR FROM birthday) YEAR BETWEEN CURRENT_DATE() - INTERVAL 30 DAY AND CURRENT_DATE() + INTERVAL 30 DAY ");
		
		echo '<div class="wrapper"><p class="lead">Birthdays</p><ul class="nav nav-tabs nav-stacked">';
		
		while ($rows = mysql_fetch_array($getBirthdays)) {
			$oldDate = $rows['birthday'];
			$arr = explode('-', $oldDate);
			$newDate = $arr[2].'-'.$arr[1].'-'.date(Y);
		
			$now = time();
			$birthday = strtotime($newDate);
			$datediff = $birthday - $now;
			
			if((floor($datediff/(60*60*24)) + 1) == 1) {
				$days = (floor($datediff/(60*60*24)) + 1).' day';
			} elseif((floor($datediff/(60*60*24)) + 1) == 0) {
				$days = 'today';
			} else {
				$days = (floor($datediff/(60*60*24)) + 1).' days';
			}
			
			echo '<li><strong>'.$days.' - </strong>'.$rows['name'].'</li>';
		}
		if(mysql_num_rows($getBirthdays) == 0) {
			echo '<li>Bummer! No cake within the next 30 days :(</li></ul></div>';
		} else {
			echo '</ul></div>';
		}
	}
	
	function getProjectMembers($members) {
		$getPositions = mysql_query("SELECT * FROM positions");
		echo '<ul class="nav nav-tabs">';
		$i = 0;
		$j = 0;
		$tabs ='';
		while ($rows = mysql_fetch_array($getPositions)) {
			if($i == 0) {
				$class="active";
			} else {
				$class = '';
			}
			echo '<li class="'.$class.'"><a href="#tab'.$rows['id'].'" data-toggle="tab">'.$rows['name'].'</a></li>';
				$tabs .= '<div class="tab-pane '.$class.'" id="tab'.$rows['id'].'">';
				$getMembers = mysql_query("SELECT * FROM members WHERE function = '".$rows['id']."'");
				while($row = mysql_fetch_array($getMembers)) {
					if($j == 0) {
						$class="active";
					} else {
						$class="";
					}
					$projectMembers = explode(',',$members);
					if (in_array($row['id'], $projectMembers)) {
					  $checked = 'checked';
					} else {
					  $checked = '';
					}	
					
					$tabs .= '<label class="checkbox inline">';
					$tabs .= '<input type="checkbox" name="memberbox[]" '.$checked.' value="'.$row['id'].'">'.$row['name'];
					$tabs .= '</label>';
				}
				$tabs .= '</div>';

			$i++;
		}
		echo '</ul>';
		echo '<div class="tab-content">'.$tabs.'</div>';
	}
	
	function getAllDepartments() {	
		$getProjects = mysql_query("SELECT * FROM positions ORDER BY name");
		while ($rows = mysql_fetch_array($getProjects)) {
			echo '<tr class="clickable" onclick="window.location=\'admin.php?department='.$rows['id'].'\'">';
			echo '<td>'.$rows['name'].'</td></tr>';
		}
	}
	
	function getPositions($id) {	
		$getPositions = mysql_query("SELECT * FROM positions");
		while ($rows = mysql_fetch_array($getPositions)) {
			if($id == $rows['id']) {
				$class ='selected';
			} else {
				$class = '';
			}
			echo '<option value="'.$rows['id'].'" '.$class.'>'.$rows['name'].'</option>';
		}
	}
	
	function getDepartment($id) {	
		$getProject = mysql_query("SELECT * FROM positions WHERE id = '".$id."'");
		while ($rows = mysql_fetch_array($getProject)) {
			echo '<input type="hidden" name="departmentid" value="'.$id.'">';
			echo '<label>Department name</label>';
		    echo '<input type="text" value="'.$rows['name'].'" name="position" placeholder="Front-end developer" required>';
		}
	}	
?>