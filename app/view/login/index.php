<?php 
/**
 * This is a Anax pagecontroller.
 *
 */
// Get environment & autoloader and the $app-object.
require __DIR__.'/config_with_app.php';
$app->session();
// Config
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);
$app->theme->configure(ANAX_APP_PATH . 'config/theme_audiobox.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_audiobox.php');
$app->topnav->configure(ANAX_APP_PATH . 'config/topnav.php');
if($app->session->has(\Anax\User\User::$loginSession)) {
	$app->topnav->configure(ANAX_APP_PATH . 'config/topnav_logout.php');
		$app->views->add('users/user', [
        ], 'topnav');
}

// Content //

// DB Setup
$app->router->add('setupdb', function() use ($di) { 

	// Namespace
	$tagsToQuestion = new \Anax\Tags\TagToQuestion();
	$question = new \Anax\Questions\Questions();
	$tag = new \Anax\Tags\Tags();
	$user = new \Anax\User\User();
	$answer = new \Anax\Answers\Answers();
	$comments = new \Anax\Comments\Comments();
	
	// Setup DI
	$tag->setDI($di);
	$question->setDI($di);
	$user->setDI($di);
	$answer->setDI($di);
	$comments->setDI($di);
	$tagsToQuestion->setDI($di);
	$tagsToQuestion->dropTable();
	$tag->setup();
	$question->setup();
	$user->setup();
	$answer->setup();
	$comments->setup();
	$tagsToQuestion->setup();
});
 
// Startpage 
$app->router->add('', function() use ($app) {
	// Add extra assets to make Twitter bootstrap and SQL work.
    $latestQuestions = $app->QuestionsController->getLatestQuestions(5);
	$latestQuestionz = $app->QuestionsController->getLatestQuestions(10);
	$latestQuestionsStart = $app->UserController->getMostActiveUsers(16);
    $popularTags = $app->TagsController->getPopularTags(10);
    $activeUsers = $app->UserController->getMostActiveUsers(3);
	$activeUsersStartMain = $app->UserController->getMostActiveUsers(10);
	$activeUsersStart = $app->UserController->getMostActiveUsers(6);
	// Page content
	$app->theme->setVariable('title', "Välkommen");
		$app->views->add('users/main', [
            'users' => $activeUsersStart,
			'title' => 'Aktiva Användare'
        ]);
		$app->views->add('questions/question', [
        'questions' => $latestQuestionz,]
		);
		$app->views->add('welcome/audiobox', [
        ], 'aside');
        $app->views->add('tags/popular', [
            'tags' => $popularTags,
            'title' => 'Populära taggar'
        ], 'aside');
        $app->views->add('users/active', [
            'users' => $activeUsersStart,
            'title' => 'Aktiva användare'
        ], 'aside');
		$app->views->add('questions/questions_sidebar', [
            'questions' => $latestQuestions,
            'title' => 'Senaste frågorna'
        ], 'aside');
		$app->views->add('social/socialmedia', [
            'title' => 'Social media'
        ], 'aside');
		
	
	$app->theme->setVariable('slider', "Start")
			   ->setVariable('slider', "<div class='slider'>
			<img src='img/logo_slider.png' alt='Audiobox' />
			<h1 class='blog-title'>The Audiobox Community</h1>
			<p class='lead blog-description'>The official homepage of creating a community with Bootstrap.</p>
        	<a href='http://www.student.bth.se/~maem14/phpmvc/project/audiobox/webroot/register'><button type='button' class='btn btn-primary'>Skapa användare</button></a> <a href='http://www.student.bth.se/~maem14/phpmvc/project/audiobox/webroot/login'><button type='button' class='btn btn-default'>Logga in</button></a>
		</div>
		");

});

// Login page 
$app->router->add('login', function() use ($app) {
	$latestQuestions = $app->QuestionsController->getLatestQuestions(5);
    $popularTags = $app->TagsController->getPopularTags(10);
    $activeUsers = $app->UserController->getMostActiveUsers(3);
	$activeUsersStartMain = $app->UserController->getMostActiveUsers(10);
	$activeUsersStart = $app->UserController->getMostActiveUsers(6);
	
	$form = $app->UserController->loginAction();
	// Page content
	$app->theme->setVariable('title', "Logga in")
	           ->setVariable('main', "
		    <h1>Välkommen!</h1><hr />
			<div class='row'>
		    <div class='col-md-6'><p>" . $form . "</p></div>
			<div class='col-md-6'><p style='text-align:center;'><img src='img/logo_slider.png' alt='Audiobox' /></p><p style='text-align:center;'>Logga in med din användarnamn och ditt lösenord!</p></div>
			</div>
			
		"); 
		
		$app->views->add('welcome/audiobox', [
        ], 'aside');
        $app->views->add('tags/popular', [
            'tags' => $popularTags,
            'title' => 'Populära taggar'
        ], 'aside');
        $app->views->add('users/active', [
            'users' => $activeUsersStart,
            'title' => 'Aktiva användare'
        ], 'aside');
		$app->views->add('questions/questions_sidebar', [
            'questions' => $latestQuestions,
            'title' => 'Senaste frågorna'
        ], 'aside');
		$app->views->add('social/socialmedia', [
            'title' => 'Social media'
        ], 'aside');
		
});
// Logout page 
$app->router->add('logout', function() use ($app) {
	
	$latestQuestions = $app->QuestionsController->getLatestQuestions(5);
    $popularTags = $app->TagsController->getPopularTags(10);
    $activeUsers = $app->UserController->getMostActiveUsers(3);
	$activeUsersStartMain = $app->UserController->getMostActiveUsers(10);
	$activeUsersStart = $app->UserController->getMostActiveUsers(6);
	
	$app->UserController->logoutAction();
	$form = $app->UserController->loginAction();
	// Page content
	$app->theme->setVariable('title', "Utloggad")
	           ->setVariable('main', "
		    <h1>Skapa användare</h1><hr />
			<div class='row'>
		    <div class='col-md-6'><p>" . $form . "</p></div>
			<div class='col-md-6'><p style='text-align:center;'><img src='img/logo_slider.png' alt='Audiobox' /></p><p style='text-align:center;'>Fyll i formuläret och skapa din användare. <br 7>Vi ses i forumet!</p></div>
			</div>
		"); 
		
		$app->views->add('welcome/audiobox', [
        ], 'aside');
        $app->views->add('tags/popular', [
            'tags' => $popularTags,
            'title' => 'Populära taggar'
        ], 'aside');
        $app->views->add('users/active', [
            'users' => $activeUsersStart,
            'title' => 'Aktiva användare'
        ], 'aside');
		$app->views->add('questions/questions_sidebar', [
            'questions' => $latestQuestions,
            'title' => 'Senaste frågorna'
        ], 'aside');
		$app->views->add('social/socialmedia', [
            'title' => 'Social media'
        ], 'aside');
});
// Register user
$app->router->add('register', function() use ($app) {
	
	$latestQuestions = $app->QuestionsController->getLatestQuestions(5);
    $popularTags = $app->TagsController->getPopularTags(10);
    $activeUsers = $app->UserController->getMostActiveUsers(3);
	$activeUsersStartMain = $app->UserController->getMostActiveUsers(10);
	$activeUsersStart = $app->UserController->getMostActiveUsers(6);
	
	$form = $app->UserController->registerAction();
	// Page content
	$app->theme->setVariable('title', "Registrera ny användare")
	           ->setVariable('main', "
			   
		    <h1>Skapa användare</h1><hr />
			<div class='row'>
		    <div class='col-md-6'><p>" . $form . "</p></div>
			<div class='col-md-6'><p style='text-align:center;'><img src='img/logo_slider.png' alt='Audiobox' /></p><p style='text-align:center;'>Fyll i formuläret och skapa din användare. <br 7>Vi ses i forumet!</p></div>
			</div>
		");
		
		$app->views->add('welcome/audiobox', [
        ], 'aside');
        $app->views->add('tags/popular', [
            'tags' => $popularTags,
            'title' => 'Populära taggar'
        ], 'aside');
        $app->views->add('users/active', [
            'users' => $activeUsersStart,
            'title' => 'Aktiva användare'
        ], 'aside');
		$app->views->add('questions/questions_sidebar', [
            'questions' => $latestQuestions,
            'title' => 'Senaste frågorna'
        ], 'aside');
		$app->views->add('social/socialmedia', [
            'title' => 'Social media'
        ], 'aside');
 
});

// Om oss
$app->router->add('about', function() use ($app) {
	
	$latestQuestions = $app->QuestionsController->getLatestQuestions(5);
    $popularTags = $app->TagsController->getPopularTags(10);
    $activeUsers = $app->UserController->getMostActiveUsers(3);
	$activeUsersStartMain = $app->UserController->getMostActiveUsers(10);
	$activeUsersStart = $app->UserController->getMostActiveUsers(6);
	
	 $content = $app->fileContent->get('about.md');
     $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
	// Page content
	$app->theme->setVariable('title', "About us")
			   ->setVariable('pageheader', "<h1>Om oss</h1><img class='img-responsive' src='http://www.student.bth.se/~maem14/phpmvc/project/audiobox/webroot/img/about.jpg' alt='Audiobox' />")
	           ->setVariable('main', $content);
			   
		$app->views->add('welcome/audiobox', [
        ], 'aside');
        $app->views->add('tags/popular', [
            'tags' => $popularTags,
            'title' => 'Populära taggar'
        ], 'aside');
        $app->views->add('users/active', [
            'users' => $activeUsersStart,
            'title' => 'Aktiva användare'
        ], 'aside');
		$app->views->add('questions/questions_sidebar', [
            'questions' => $latestQuestions,
            'title' => 'Senaste frågorna'
        ], 'aside');
		$app->views->add('social/socialmedia', [
            'title' => 'Social media'
        ], 'aside');
 
});
$app->router->handle();
// Render the response using theme engine.
$app->theme->render();