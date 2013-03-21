<!DOCTYPE html>
<html>
  <head>
    <title>Progress - Back-end</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
    <link href="css/daterangepicker.css" rel="stylesheet" media="screen">
  </head>
  <body>
  	<div class="navbar navbar-static-top navbar-inverse">
    	<div class="navbar-inner">
      		<div class="container">
        		<a class="brand" href="admin.php">Progress - Admin</a>
	     	</div>
      	</div>
    </div>
    <div class="container">
		<?php require_once 'connect.php'; ?>
    	<div class="row">
    		<div class="span9">
				<?php $editPost = $_GET['id'];
					if(!isset($editPost)) {
				?>
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#projecttab1" data-toggle="tab">Add a project</a>
					</li>
					<li>
						<a href="#projecttab2" data-toggle="tab">Edit a project</a>
					</li>
				</ul>
				<div class="tab-content">
				    <div class="tab-pane active" id="projecttab1">
					<?php } ?>
    					<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
		    			  <fieldset>
							<?php if(!isset($editPost)) { ?>
		    			    	<legend>New project</legend>
		    			    <label>Project name</label>
		    			    <input type="text" name="projectname" placeholder="Virgin Galactic" required>
		    			    <label>Project date range</label>
		    			    <div class="input-prepend">
		    			     	<span class="add-on">
		    			     		<i class="icon-calendar"></i>
		    			     	</span>
		    			     	<input type="text" name="projectdate" id="projectdate" value="" required>
		    			    </div>
		    			    <label>Project members</label>
							<?php 
								getMembers(); 
							?>
							<?php } else { ?>
								<legend>Edit project</legend>
							<?php } ?>
							<?php 
								getProject($editPost); 
							?>
		    			    <hr/>
							<?php if(!isset($editPost)) { ?>
		    			    	<button type="submit" name="addProject" class="btn">Add project</button>
							<?php } else { ?>
								<div id="deleteProject" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
								  <div class="modal-header">
								    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								    <h3>Delete project</h3>
								  </div>
								  <div class="modal-body">
								    <p>Are you sure you want to delete this project?</p>
								  </div>
								  <div class="modal-footer">
								    <button class="btn" data-dismiss="modal" aria-hidden="true">Keep this project</button>
								    <button type="submit" name="deleteProject" class="btn btn-danger">Yes I'm sure, delete this project</button>
								  </div>
								</div>
								<button type="submit" name="updateProject" class="btn btn-primary">Save changes</button>
								<a href="#deleteProject" role="button" class="btn btn-danger" data-toggle="modal">Delete project</a>
								<button type="button" name="cancelUpdate" class="btn" onclick="window.location='admin.php?updateCancelled'">Cancel</button>
							<?php } ?>
		    			  </fieldset>
		    			</form>
					<?php if(!isset($editPost)) { ?>
					</div>
					<div class="tab-pane" id="projecttab2">
						<legend>Select project</legend>
						<table class="table table-striped table-hover">
							<thead>
								<tr>
							    	<th>#</th>
							        <th>Project name</th>
							        <th>Deadline</th>
							        <th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php getAllProjects(); ?>
							</tbody>
						</table>
					</div>
				</div>
			<?php } ?>
    		</div>
    		<div class="span3">
				<ul class="nav nav-tabs">
					<?php $editEmployee = $_GET['member'];
						if(!isset($editEmployee)) {
					?>
						<li class="active">
					<?php } else { ?>
						<li>
					<?php } ?>
						<a href="#employeetab1" data-toggle="tab">Add</a>
					</li>
					<?php
						if(isset($editEmployee)) {
					?>
						<li class="active">
					<?php } else { ?>
						<li>
					<?php } ?>
						<a href="#employeetab2" data-toggle="tab">Edit</a>
					</li>
				</ul>
				<div class="tab-content">
				    <div class="tab-pane <?php if(!isset($editEmployee)) { ?>active<?php } ?> well well-admin" id="employeetab1">
    					<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	    					<fieldset>
	    				    	<legend>Employees</legend>
	    				    	<label>Name</label>
	    				    	<div class="input-prepend">
	    				    	 	<span class="add-on">
	    				    	 		<i class="icon-user"></i>
	    				    	 	</span>
	    				    	 	<input type="text" name="name" placeholder="Richard Branson" required>
	    				    	 </div>
	    				    	<label>Facebook ID</label>
	    				    	<div class="input-prepend">
	    				    	 	<span class="add-on">
	    				    	 		<i class="icon-thumbs-up"></i>
	    				    	 	</span>
	    				    		<input class="fbid" data-content="To get a users Facebook ID just fill in their profile url on <a href='http://findmyfacebookid.com' target='_blank'>this</a> page." data-original-title="Facebook ID" data-toggle="popover" data-trigger="focus" data-placement="left" type="text" name="fbid" placeholder="1337" required>
	    				    	</div>
	    				    	<label>Birthday</label>
	    				    	<div class="input-prepend">
	    				    	 	<span class="add-on">
	    				    	 		<i class="icon-calendar"></i>
	    				    	 	</span>
	    				    	 	<input type="text" class="memberbirthday" name="birthday" placeholder="11/05/1987" required>
	    				    	</div>
	    				    	<label>Department</label>
	    				    	<div class="input-prepend">
	    				    	 	<span class="add-on">
	    				    	 		<i class="icon-briefcase"></i>
	    				    	 	</span>
	    				    	 	<select name="position">
										<?php
											getPositions();
										?>
	    				    	 	</select>
	    				    	</div>
	    				    	<button type="submit" name="addMember" class="btn">Add member</button>
	    				 	</fieldset>
	    				</form>
					</div>
					<div class="tab-pane <?php if(isset($editEmployee)) { ?>active<?php } ?> well well-admin" id="employeetab2">
						<?php if(!isset($editEmployee)) { ?>
							<legend>Employees</legend>
							<table class="table table-striped table-hover">
								<thead>
									<tr>
								        <th>Name</th>
									</tr>
								</thead>
								<tbody>
									<?php getAllEmployees(); ?>
								</tbody>
							</table>
						<?php } else { ?>
							<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
		    					<fieldset>
									<legend>Edit employee</legend>
									<?php getEmployee($editEmployee); ?>
									<input type="checkbox" name="delete" value="delete"> Delete employee
									<button type="submit" name="updateMember" class="btn btn-primary">Save changes</button>
									<button type="button" name="cancelUpdate" class="btn" onclick="window.location='admin.php?updateMemberCancelled'">Cancel</button>
								</fieldset>
							</form>
						<?php } ?>
					</div>
    			</div>
				<ul class="nav nav-tabs">
					<?php $editDepartment = $_GET['department'];
						if(!isset($editDepartment)) {
					?>
						<li class="active">
					<?php } else { ?>
						<li>
					<?php } ?>
						<a href="#departmenttab1" data-toggle="tab">Add</a>
					</li>
					<?php
						if(isset($editDepartment)) {
					?>
						<li class="active">
					<?php } else { ?>
						<li>
					<?php } ?>
						<a href="#departmenttab2" data-toggle="tab">Edit</a>
					</li>
				</ul>
				<div class="tab-content">
				    <div class="tab-pane <?php if(!isset($editDepartment)) { ?>active<?php } ?> well well-admin" id="departmenttab1">
    					<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	    					<fieldset>
    				    		<legend>Department</legend>
    				    		<label>Department name</label>
    				    		<input type="text" name="position" placeholder="Front-end developer" required>
    				    		<button type="submit" name="addPosition" class="btn">Add department</button>
    				 		</fieldset>
    					</form>
					</div>
					<div class="tab-pane <?php if(isset($editDepartment)) { ?>active<?php } ?> well well-admin" id="departmenttab2">
						<?php if(!isset($editDepartment)) { ?>
							<legend>Edit department</legend>
							<table class="table table-striped table-hover">
								<thead>
									<tr>
								        <th>Department name</th>
									</tr>
								</thead>
								<tbody>
									<?php getAllDepartments(); ?>
								</tbody>
							</table>
						<?php } else { ?>
							<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
		    					<fieldset>
									<legend>Edit department</legend>
									<?php getDepartment($editDepartment); ?>
									<input type="checkbox" name="delete" value="delete"> Delete department
									<button type="submit" name="updateDepartment" class="btn btn-primary">Save changes</button>
									<button type="button" name="cancelUpdate" class="btn" onclick="window.location='admin.php?updateDepartmentCancelled'">Cancel</button>
								</fieldset>
							</form>
						<?php } ?>
					</div>
    			</div>
    		</div>
    	</div>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/date.js"></script>
    <script src="js/daterangepicker.js"></script>
	<script src="js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
           	$('#projectdate').daterangepicker();
			$('#fbid').popover({html : true});
			$("#projecttab2 table").tablesorter();		
        });
    </script>
	<?php mysql_close($link); ?>
  </body>
</html>