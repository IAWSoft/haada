<?php

	$permissions = $_SESSION['level'];
			
	if($permissions == 1)
	{
		if(isset($_COOKIE['tickets']))
		{
		 echo'
		 <div class="modal fade" id="dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
			  <div class="modal-dialog size">
			    <div class="modal-content" style="min-width: 250px;">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title text-center" id="dialog"><span><img src="../images/logo_haada_trans_landscape.png" style="height: 30px;"></span></h4>
			      </div>
			      <div class="modal-body">
				     <div class="row center">
					<section class="posts col-md-12"> 
						<form action="includes/login.php" method="post" class="form-horizontal"> 
							<fieldset class="size2 text-center">
							    <div >
		         					   <h3>You have '.$_COOKIE['tickets'].' tickets pending </h3> 
		         					   <br/>
					            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
					             <a href="main.php" class="btn btn-success">View tickets</a>
			        			</div>
							</fieldset>
						</form>
					</section>	
						
						<!-- contact form ends -->	
							</div>	
				        </div>
			      </div>
			    </div><!-- /.modal-content -->
			</div><!-- /.modal -->';
						 
		}

	}														    
				                   
?>	