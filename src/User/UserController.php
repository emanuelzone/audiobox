<?php

namespace Anax\User;
 
/**
 * A controller for users and admin related events.
 *
 */
class UserController extends \Anax\MVC\CControllerBasic
{

    private $registerForm;

    private $loginForm;

    private $users;

    public function __construct() {
        $this->registerForm = new CRegisterForm();
        $this->loginForm = new CLoginForm();
        
        $this->users = new User();

    }

    public function setDI($di) {
        $this->di = $di;
        $this->registerForm->setDI($this->di);
        $this->loginForm->setDI($this->di);

        $this->users->setDI($this->di);
    }



    /**
     * Reset and setup database table
     *
     * @return void
     */
    public function setupAction()
    {
       $this->users->setup();
    }


    /**
     * Login user
     *
     * @return void
     */
    public function loginAction($login=false, $acronym=null, $password=null)
    {
        if($login) {
            $res = $this->users->login($acronym, $password);
            return $res;
        }

        else {
            $status = $this->loginForm->check();

            if($status === true) {
                $this->callbackSuccess($this->loginForm);
            }
            elseif($status === false) {
                $this->callbackFailLogin($this->loginForm);
            }
             return $this->loginForm->getHTML();
        
        }   
    }

    /**
     * Logout user
     *
     * @return void
     */
    public function logoutAction()
    {
        $this->users->logout();
        $this->redirectTo('login');
    }

    /**
     * List all users.
     *
     * @return void
     */
    public function listAction()
    {
     
        $all = $this->users->findAll();
		$latestQuestions = $this->QuestionsController->getLatestQuestions(5);
    	$popularTags = $this->TagsController->getPopularTags(10);
    	$activeUsers = $this->UserController->getMostActiveUsers(3);
		$activeUsersStartMain = $this->UserController->getMostActiveUsers(10);
		$activeUsersStart = $this->UserController->getMostActiveUsers(6);
     
        $this->theme->setTitle("Användare");
        $this->theme->setVariable('pageheader', "<h1>Alla användare</h1>");
        $this->views->add('users/list-all', [
            'users' => $all,
        ]);
		$this->views->add('welcome/audiobox', [
        ], 'aside');
		$this->views->add('tags/popular', [
            'tags' => $popularTags,
            'title' => 'Populära taggar'
        ], 'aside');
        $this->views->add('users/active', [
            'users' => $activeUsersStart,
            'title' => 'Aktiva användare'
        ], 'aside');
		$this->views->add('questions/questions_sidebar', [
            'questions' => $latestQuestions,
            'title' => 'Senaste frågorna'
        ], 'aside');
		$this->views->add('social/socialmedia', [
            'title' => 'Social media'
        ], 'aside');
    }

    /**
     * Get user with id or if no id - get current user.
     *
     * @param int $id of user to display
     *
     * @return obj User
     */
    public function getUserAction($id = null)
    {     
        if($id === null) {
            $user = $this->users->getLoggedInUser();
        }
        elseif (is_numeric($id)) {
            $user = $this->users->find($id);
        }


        return $user;
    }

    /**
     * Check if a user is logged in
     *
     * @param int $id of user to display
     *
     * @return boolean
     */
    public function isUserLoggedIn()
    {     
        $res = $this->users->isUserLoggedIn();

        return $res;
    }

    /**
     * List user with id.
     *
     * @param int $id of user to display
     *
     * @return void
     */
    public function idAction($id)
    {     
        
        $edit = false;
        $loggedIn = $this->users->getLoggedInUser();
        if($loggedIn->id === $id) {
            $edit = true;
        }
        $user = $this->users->find($id);
        $questions = $this->QuestionsController->getQuestionsByUser($id);
        $answers = $this->AnswersController->getAnswersByUser($id);

        $this->theme->setTitle($user->acronym);
        $this->views->add('users/list-one', [
            'user' => $user,
            'questions' => $questions,
            'discussions' => $answers,
            'edit'      => $edit
        ]);
    }

    /**
     * @return string - html form
     *
     */
    public function editAction($id)
    {
        $user = $this->users->find($id);
        $form = new CEditForm($user);
        $form->setDI($this->di);
        $status = $form->check();

        if($status === true) {
            $this->callbackSuccess($form);
        }
        elseif($status === false) {
            $this->callbackFailRegister($form);
        }

        $this->theme->setTitle( "Redigera profil för " . $user->acronym);
        $this->theme->setVariable('pageheader', "<h3>Redigera profil för &#91; " . $user->acronym . "  &#93;</h3>");
        if($this->users->isUserLoggedIn()) {
            $this->theme->setVariable('main', $form->getHTML());
        }
        else{
            $this->theme->setVariable('main', "
                    <h1>Redigera profil</h1>
                    <a href=" . $this->url->create('login') . ">Logga in för att kunna redigera din profil</a>");
        }


    }


    /**
     * @return string - html form
     *
     */
    public function registerAction()
    {
        
        $status = $this->registerForm->check();

        if($status === true) {
            $this->callbackSuccess($this->registerForm);
        }
        elseif($status === false) {
            $this->callbackFailRegister($this->registerForm);
        }
         return $this->registerForm->getHTML();
    }


    /**
     * Add new user.
     * @return void - redirects to login page.
     */
    public function addAction($acronym, $password, $email)
    {
		
		// Get date
        $now = gmdate('Y-m-d H:i:s');
		
		
        try {
            $res = $this->users->save([
            'acronym'  => $acronym,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
			'created' => $now
        ]);
            if ($res == true) {
                $url = $this->url->create('user/list/');
                $this->form->AddOutput("<p class='success'><i class='fa fa-check'></i> Grattis, du är nu registrerad!</p>");
            }
        }
        catch (\Exception $e) {
            $this->form->AddOutput("<p class='warning'><i class='fa fa-exclamation-triangle'></i> Användaren kunde inte bli registrerad, testa med ett annat användarnamn</p>");
            $this->redirectTo();
        }

        
        $this->redirectTo('login');
        return true;
    }

        /**
     * Add new user.
     * @return void - redirects to login page.
     */
    public function updateAction( $id ,$acronym, $email, $text)
    {
		
		// Get date
        $now = gmdate('Y-m-d H:i:s');
		
        try {
            $res = $this->users->save([
            'id'       => $id,
            'acronym'  => $acronym,
            'email'    => $email,
            'text'     => $text,
			'updated' => $now
        ]);
            if ($res == true) {
                $this->form->AddOutput("<p class='success'><i class='fa fa-check'></i> Dina ändringar har sparats</p>");
				$this->form->AddOutput("<p style='margin-top:20px;'><a href='http://www.student.bth.se/~maem14/phpmvc/project/audiobox/webroot/user/list'><i class='fa fa-arrow-left'></i> Tillbaka till användare</a></p>");
				$this->redirectTo();;
            }
        }
        catch (\Exception $e) {
            $this->form->AddOutput("<p class='warning'><i class='fa fa-exclamation-triangle'></i> Användarnamnet är inte unikt, försök med ett annat</p>");
            $this->redirectTo('users/list-one');
        }

        
        $this->redirectTo();
        return true;
    }

    /**
     * Get the most active users
     *
     * @param int how many users to return
     *
     * @return array of obj User
     */
    public function getMostActiveUsers($limit)
    {     
        $users = $this->users->findAll();
        $mostActive = array();
        foreach ($users as $user) {
           $questions = $this->QuestionsController->getQuestionsByUser($user->id);
           $answers = $this->AnswersController->getAnswersByUser($user->id);
           $mostActive[$user->id] = count($questions) + count($answers); 
        }
        arsort($mostActive);     
        $mostActiveUsers = array();
        foreach ($mostActive as $userId => $val) {
            foreach ($users as $user) {

                if($user->id == $userId) {
                    $mostActiveUsers[] = $user;

                }
            }
        }
        $topMostActive = array_reverse(array_slice($mostActiveUsers, 0, $limit));
        return $topMostActive;
        //return $mostActive;
    }

    private function callbackSuccess($form)
    {
            // What to do if the form was submitted?
            $user = $this->users->getLoggedInUser();
            $this->redirectTo('user/id/' . $user->id);
    }

    private function callbackFailLogin($form)
    {
            // What to do if the form was submitted?
            $form->AddOUtput("<p class='warning'><i class='fa fa-exclamation-triangle'></i> Användarnamn eller lösenord är felaktiga</p>");
            $this->redirectTo();
    }

    private function callbackFailRegister($form)
    {
            // What to do if the form was submitted?
            $form->AddOUtput("<p class='warning'><i class='fa fa-exclamation-triangle'></i> Något gick fel</p>");
            $this->redirectTo();
    }
 
}