<!doctype html>
<html class='no-js' lang='<?=$lang?>'>
<head>
<meta charset='utf-8'/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?=$title . $title_append?></title>
<?php if(isset($favicon)): ?><link rel='icon' href='<?=$this->url->asset($favicon)?>'/><?php endif; ?>
<?php foreach($stylesheets as $stylesheet): ?>
<link rel='stylesheet' type='text/css' href='<?=$this->url->asset($stylesheet)?>'/>
<?php endforeach; ?>
    
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<?php if(isset($style)): ?><style><?=$style?></style><?php endif; ?>
<script src='<?=$this->url->asset($modernizr)?>'></script>
</head>

<body>

<!-- <Header> -->
	<?php if(isset($header)) echo $header?>
	<?php $this->views->render('header')?>
   

<!-- <Container> -->
<div class="container main-content">
<div class="row">



<!-- <Slider> -->
<?php if(isset($slider)) echo $slider?>
<?php $this->views->render('slider')?>

<!-- <Left Col> --> 
<div class="col-sm-9 blog-main">

<!-- <Pageheader> -->
<?php if(isset($pageheader)) echo $pageheader?>
<?php $this->views->render('pageheader')?>

<!-- <Left content> -->
<?php if(isset($main)) echo $main?><?php $this->views->render('main')?></div>

<!-- <Sidebar> -->
<?php if($this->views->hasContent('aside')):?>
<div class="col-sm-3 col-sm-offset-1 blog-sidebar">     
	
		<div class="sidebar-module">
			<?php if(isset($aside)) echo $aside?>
			<?php $this->views->render('aside')?>
        </div>

</div><?php endif;?>    


  
</div><!-- </row> -->
</div><!-- </container> -->


<!-- <Footer> -->
<?php if(isset($footer)) echo $footer?>
<?php $this->views->render('footer')?>
    

<?php if(isset($jquery)):?><script src='<?=$this->url->asset($jquery)?>'></script><?php endif; ?>

<?php if(isset($javascript_include)): foreach($javascript_include as $val): ?>
<script src='<?=$this->url->asset($val)?>'></script>
<?php endforeach; endif; ?>

<?php if(isset($google_analytics)): ?>
<script>
  var _gaq=[['_setAccount','<?=$google_analytics?>'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<?php endif; ?>


</body>
</html>
