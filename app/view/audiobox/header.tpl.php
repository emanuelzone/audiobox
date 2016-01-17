<nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         	</button>
			<a class='navbar-brand' href='<?=$this->url->create('')?>'><img class='sitelogo' src='<?=$this->url->asset("img/audiobox.png")?>' alt='AUDIOBOX'/></a>
		</div>

			<!-- <Navbar> -->
			<div id="navbar" class="main-menu navbar-collapse collapse">
			<?php if ($this->views->hasContent('navbar')) : ?>
			<?php $this->views->render('navbar')?>
			<?php endif; ?>
			</div>
        

	</div>
</nav>


<div class="user-nav">
	<div class="container"> 
		<div class="row">
        
        <div class="col-md-6"><a href="#"><i class="fa fa-envelope"></i></a><a href="#"><i class="fa fa-facebook-square"></i></a><a href="#"><i class="fa fa-twitter-square"></i></a><a href="#"><i class="fa fa-instagram"></i></a><a href="#"><i class="fa fa-google-plus-square"></i></a></div>
        
	<div class="col-md-6">
	<?php if ($this->views->hasContent('topnav')) : ?>
	<?php $this->views->render('topnav')?>
	<?php endif; ?>
	</div>
            
</div>          
</div>           
</div>
