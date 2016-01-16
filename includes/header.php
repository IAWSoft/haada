<header>
	<?php
		session_start();		    
		//get name page for active class
		$page_name= $_SERVER["REQUEST_URI"];
		if($page_name=="/"){ $index='class="active"'; }
		else if($page_name=="/main.php"){ $main='class="active"'; }
		else if($page_name=="/add_task.php"){ $add='class="active"'; }
		else if($page_name=="/incidences.php"){ $incidences='class="active"'; }
		else if($page_name=="/register.php"){ $register='class="active"'; }
		else if($page_name=="/user.php"){ $users='class="active"'; }
	?>
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container ConNav">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion-RA">
					<span class="sr-only">Desplegar / Ocultar Menu</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="./" class="navbar-brand"><img class="img-thumbnail ajustado" src="images/logo.jpg" alt=""></a> 
			</div>	

<div class="collapse navbar-collapse" id="navegacion-RA">
	<ul class="nav navbar-nav">
	
		<?php
		//If there aren't noone logged, display that
		if (!isset($_SESSION['user']))
		{
			echo '
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a data-toggle="modal" data-target="#myModalLogin" href="#myModalLogin"><i class="fa fa-sign-in"></i>&nbsp;Login</a></li></ul>
			';
		}
		//If there are a logged user, display one of the next cases according to the user permissions.
		else
		{
			
			$user = $_SESSION['user'];
			$permissions = $_SESSION['level'];
		
			if($permissions == 1)
			{
			echo '
				<li '.$index.'><a href="./"><i class="fa fa-home"></i>&nbsp;Home</a></li>
				<li '.$main.'><a href="main.php"><i class="fa fa-tasks"></i>&nbsp;Tasks</a><li>
				<li '.$incidences.'><a href="incidences.php"><i class="fa fa-book"></i>&nbsp;Incidences</a><li>
				<li '.$register.'><a href="register.php"><i class="fa fa-plus"></i>&nbsp;New user</a><li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li '.$users.'><a href="user.php"><i class="fa fa-user"></i>&nbsp;'.$user.'</a></li>
				<li><a href="includes/logout.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
			</ul>';	
			}
			elseif($permissions == 2)
			{
				echo '
				<li '.$index.'><a href="./"><i class="fa fa-home"></i>&nbsp;Home</a></li>
				<li '.$incidences.'><a href="incidences.php"><i class="fa fa-tasks"></i>&nbsp;Incidences</a><li>
				<li '.$add.'><a href="add_task.php"><i class="fa fa-book"></i>&nbsp;New Incidence</a><li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li '.$users.'><a href="user.php"><i class="fa fa-user"></i>&nbsp;'.$user.'</a></li>
				<li><a href="includes/logout.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
			</ul>';	
			}
		}	

		?>
		</div>
		</div>	
	</nav>
</header>