<?php
namespace Anax\Answers;

class CAnswersForm extends \Mos\HTMLForm\CForm
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
        'text' => [
            'type'        => 'textarea',
			'placeholder' => '...',
			'id'		  => 'inputEmail',
			'class'		  => 'form-control',
            'label'       => 'Ditt svar',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'submit' => [
            'type'      => 'submit',
			'class'		=> 'btn btn-lg btn-primary btn-block',
            'value'     => 'Skicka',
            'callback'  => function() {
                $res = $this->di->dispatcher->forward([
                    'controller' => 'answers',
                    'action'     => 'add',
                    'params'     => [$this->Value('text')]
                ]);

                $this->saveInSession = true;
                return $res;
            }
        ],
    ]);
    
    }


}