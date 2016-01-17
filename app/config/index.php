<?php 
/**
 * This is a Anax pagecontroller.
 *
 */
// Get environment & autoloader and the $app-object.
require __DIR__.'/config_with_app.php';
$app->session();
// Set link style
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);
$app->theme->configure(ANAX_APP_PATH . 'config/theme_audiobox.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_audiobox.php');
$app->topnav->configure(ANAX_APP_PATH . 'config/topnav.php');
if($app->session->has(\Anax\User\User::$loginSession)) {
	$app->topnav->configure(ANAX_APP_PATH . 'config/topnav_logout.php');
	$app->topnav->configure(ANAX_APP_PATH . 'config/nav_user.php');
}
//var_dump($di);
// Set up db
$app->router->add('setup', function() use ($di) { 
	
	$t2q = new \Anax\Tags\TagToQuestion();
	$q = new \Anax\Questions\Questions();
	$t = new \Anax\Tags\Tags();
	$u = new \Anax\User\User();
	$a = new \Anax\Answers\Answers();
	$c = new \Anax\Comments\Comments();
	$t->setDI($di);
	$q->setDI($di);
	$u->setDI($di);
	$a->setDI($di);
	$c->setDI($di);
	$t2q->setDI($di);
	$t2q->dropTable();
	$t->setup();
	$q->setup();
	$u->setup();
	$a->setup();
	$c->setup();
	$t2q->setup();
	/*$app->TagsController->dropTable();
    $app->UserController->setupAction();
    $app->QuestionsController->setupAction();
    $app->AnswersController->setupAction();
    $app->CommentsController->setupAction();
    $app->TagsController->setupAction();*/
    //$app->QuestionsController->listAction();
	// Prepare the page content


});
// Get pages
 
// Startpage 
$app->router->add('', function() use ($app) {
	// Add extra assets to make Twitter bootstrap and SQL work.
    $latestQuestions = $app->QuestionsController->getLatestQuestions(5);
	$latestQuestionz = $app->QuestionsController->getLatestQuestions(20);
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
			<img src='img/logo_slider.png' />
			<h1 class='blog-title'>The Audiobox Community</h1>
			<p class='lead blog-description'>The official homepage of creating a community with Bootstrap.</p>
        	<p><a href='http://www.student.bth.se/~maem14/phpmvc/project/all-about-burgers/webroot/register'><button type='button' class='btn btn-primary'>Skapa användare</button></a> <a href='http://www.student.bth.se/~maem14/phpmvc/project/all-about-burgers/webroot/login'><button type='button' class='btn btn-default'>Logga in</button></a></p>
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
			   ->setVariable('pageheader', "<div class='pageheader'><h1>Logga in</h1></div>")
	           ->setVariable('main', "
			   
		    <h1>Logga in</h1>
		    <p>" . $form . "</p>
			
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
			   ->setVariable('pageheader', "<div class='pageheader'><h1>Utloggad</h1></div>")
	           ->setVariable('main', "
		    <h1>Logga in</h1>
		    <p>" . $form . "</p>
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
// Register page 
$app->router->add('register', function() use ($app) {
	
	$latestQuestions = $app->QuestionsController->getLatestQuestions(5);
    $popularTags = $app->TagsController->getPopularTags(10);
    $activeUsers = $app->UserController->getMostActiveUsers(3);
	$activeUsersStartMain = $app->UserController->getMostActiveUsers(10);
	$activeUsersStart = $app->UserController->getMostActiveUsers(6);
	
	$form = $app->UserController->registerAction();
	// Page content
	$app->theme->setVariable('title', "Register new user")
			   ->setVariable('pageheader', "<div class='pageheader'><h1>Registrera ny användare</h1></div>")
	           ->setVariable('main', "
			   
		    <h1>Register</h1>
		    <p>" . $form . "</p>
			
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
// MAIN MENU PAGES
// Most pages are handled by the automatic routing webroot/controller/param/param
// About page 
$app->router->add('about', function() use ($app) {
	
	$latestQuestions = $app->QuestionsController->getLatestQuestions(5);
    $popularTags = $app->TagsController->getPopularTags(10);
    $activeUsers = $app->UserController->getMostActiveUsers(3);
	$activeUsersStartMain = $app->UserController->getMostActiveUsers(10);
	$activeUsersStart = $app->UserController->getMostActiveUsers(6);
	
	 $content = $app->fileContent->get('about.md');
     $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
	// Prepare the page content
	$app->theme->setVariable('title', "About us")
			   ->setVariable('pageheader', "<div class='pageheader'><h1>Om oss</h1></div>")
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