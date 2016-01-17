<?php
namespace Anax\User;

class CLoginForm extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;
    /**
     * Constructor
     *
     */
    public function __construct()
    {
        parent::__construct([], [
        'acronym' => [
            'type'        => 'text',
			'placeholder' => 'Användarnamn',
			'id'		  => 'inputEmail',
			'class'		  => 'form-control',
            'label'       => 'Användarnamn',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'password' => [
            'type'        => 'password',
			'placeholder' => 'Lösenord',
			'id'		  => 'inputPassword',
			'class'		  => 'form-control',
            'label'       => 'Lösenord: ',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'submit' => [
            'type'      => 'submit',
			'class'		=> 'btn btn-lg btn-primary btn-block',
            'value'     => 'Logga in',
            'callback'  => function() {

                $res = $this->di->dispatcher->forward([
                    'controller' => 'user',
                    'action'     => 'login',
                    'params'     => [true ,$this->Value('acronym'), $this->Value('password')]
                ]);

                $this->saveInSession = true;
                return $res;
            }
        ],
    ]);

    }
}