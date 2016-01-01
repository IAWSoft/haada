<header>
	<?php
		session_start();
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
				<a href="./" class="navbar-brand"><img class="img-thumbnail ajustado" src="images/logo.jpg"></a> 
			</div>	

<div class="collapse navbar-collapse" id="navegacion-RA">
	<ul class="nav navbar-nav">
		<li><a href="./"><i class="fa fa-home"></i>&nbsp;Home</a></li>
		<?php

		if (!isset($_SESSION['user']))
		{
			echo '</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a data-toggle="modal" data-target="#myModalLogin" href="#myModalLogin"><i class="fa fa-sign-in"></i>&nbsp;Login</a></li></ul>
			';
		}
		else
		{
			$user = $_SESSION['user'];
			$permissions = $_SESSION['level'];
			
			if($permissions == 1)
			{
			echo '	
				<li><a href="#"><i class="fa fa-tasks"></i>&nbsp;Tasks</a><li>
				<li><a href="#"><i class="fa fa-book"></i>&nbsp;Incidences</a><li>
				<li><a href="register.php"><i class="fa fa-plus"></i>&nbsp;New user</a><li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#"><i class="fa fa-user"></i>&nbsp;'.$user.'</a></li>
				<li><a href="includes/logout.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
			</ul>';	
			}
			elseif($permissions == 2)
			{
				echo '	
				<li><a href="#"><i class="fa fa-tasks"></i>&nbsp;Tasks</a><li>
				<li><a href="#"><i class="fa fa-book"></i>&nbsp;Incidences</a><li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#"><i class="fa fa-user"></i>&nbsp;'.$user.'</a></li>
				<li><a href="includes/logout.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
			</ul>';	
			}
		}	

		?>


		</div>
	</nav>
</header>