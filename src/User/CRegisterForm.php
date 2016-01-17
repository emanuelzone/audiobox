<?php
namespace Anax\User;

class CRegisterForm extends \Mos\HTMLForm\CForm
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
        'pwd-repeat' => [
            'type'        => 'password',
			'placeholder' => 'Lösenord',
			'id'		  => 'inputPassword',
			'class'		  => 'form-control',
            'label'       => 'Repetera lösenord',
            'required'    => true,
             'validation' => [
                'match' => 'password'
            ],
        ],
        'email' => [
            'type'        => 'text',
			'placeholder' => 'E-mail',
			'id'		  => 'inputEmail',
			'class'		  => 'form-control',
            'required'    => true,
            'validation'  => ['not_empty', 'email_adress'],
        ],
        'submit' => [
            'type'      => 'submit',
			'class'		=> 'btn btn-lg btn-primary btn-block',
            'value'     => 'Registrera dig',
            'callback'  => function() {

                $res = $this->di->dispatcher->forward([
                    'controller' => 'user',
                    'action'     => 'add',
                    'params'     => [$this->Value('acronym'), $this->Value('password'), $this->Value('email')]
                ]);

                $this->saveInSession = true;
                return $res;
            }
        ],
    ]);

    }

    public function getAcronym() {
        return $this->Value('acronym');
    }
}