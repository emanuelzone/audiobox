<?php 
		if($this->UserController->isUserLoggedIn()) {
			
?>
					<span class="login-user">
						<a href="<?=$this->url->create('questions/create/');?>"><i class="fa fa-plus"></i> Lägg till ny fråga</a>
					</span>
               


<?php
			}

?>







