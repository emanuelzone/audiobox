<?php
namespace Anax\User;

class CEditForm extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;
    /**
     * Constructor
     *
     */
    public function __construct(User $user)
    {
        parent::__construct([], [
        'acronym' => [
            'type'        => 'text',
			'placeholder' => 'Användarnamn',
			'id'		  => 'inputName',
			'class'		  => 'form-control',
            'label'       => 'Användarnamn',
            'required'    => true,
            'validation'  => ['not_empty'],
            'value'       => $user->acronym,  
        ],
        'text' => [
            'type'        => 'textarea',
			'placeholder' => 'Några rader om dig..',
			'id'		  => 'inputText',
			'class'		  => 'form-control',
            'label'       => 'Presentation',
            'value'       => $user->text,
        ],
        'email' => [
            'type'        => 'text',
			'placeholder' => 'Email',
			'id'		  => 'inputEmail',
			'class'		  => 'form-control',
			'label'       => 'Email',
            'required'    => true,
            'validation'  => ['not_empty', 'email_adress'],
            'value'       => $user->email,
        ],
        'id' => [
            'type'        => 'hidden',
            'value'       => $user->id,
        ],
        'submit' => [
            'type'      => 'submit',
			'class'		=> 'btn btn-lg btn-primary btn-block',
            'value'     => 'Spara ändringar',
            'callback'  => function() {

                $res = $this->di->dispatcher->forward([
                    'controller' => 'user',
                    'action'     => 'update',
                    'params'     => [ $this->Value('id'), $this->Value('acronym'), $this->Value('email'), $this->Value('text')]
                ]);

                $this->saveInSession = true;
                return $res;
            }
        ],
    ]);
    }

}