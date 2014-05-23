<!DOCTYPE html>
<html>
  <head>
    <title>Progress</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
  </head>
  <body>
  	<div class="navbar navbar-static-top navbar-inverse">
    	<div class="navbar-inner">
      		<div class="container-fluid">
        		<a class="brand" href="index.php">Progress</a>
	     	</div>
      	</div>
    </div>
    <div class="container-fluid">
    	<div class="row">
    		<div class="span9">
    			<ul class="nav nav-tabs nav-stacked">
    			</ul>
    		</div>
    		<div class="span3">
    			<div class="well well-small">
    				<div id="time">
    					<script type="text/javascript">
    					function startTime()
    					{
    					var today=new Date();
    					var h=today.getHours();
    					var m=today.getMinutes();
    					// add a zero in front of numbers<10
    					m=checkTime(m);
    					document.getElementById('time').innerHTML=h+":"+m;
    					t=setTimeout(function(){startTime()},500);
    					}
    					
    					function checkTime(i)
    					{
    					if (i<10)
    					  {
    					  i="0" + i;
    					  }
    					return i;
    					}
    					startTime();
    					</script>
    				</div>
    			  	<div id="date">
	    			  	</script>
    			  	</div>
    			</div>
    		</div>
    	</div>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
        $(document).ready(function() {
			$('.userimage').tooltip();			
        });
    </script>
  </body>
</html>