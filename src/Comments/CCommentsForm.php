<?php
namespace Anax\Comments;

class CCommentsForm extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;
    /**
     * Constructor
     *
     */
    public function __construct($answerId = null, $questionId = null)
    {   
       
            
        parent::__construct([], [
        'text' => [
            'type'        => 'textarea',
			'placeholder' => '...',
			'id'		  => 'inputEmail',
			'class'		  => 'form-control',
            'label'       => 'Din kommentar',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'questionId' => [
            'type'        => 'hidden',
            'value'       => $questionId,
        ],
        'answerId' => [
            'type'        => 'hidden',
            'value'       => $answerId,
        ],
        'submit' => [
            'type'      => 'submit',
			'class'		=> 'btn btn-lg btn-primary btn-block',
            'value'     => 'Skicka',
            'callback'  => function() {
                $res = $this->di->dispatcher->forward([
                    'controller' => 'comments',
                    'action'     => 'addComment',
                    'params'     => [$this->Value('text'), $this->Value('answerId'), $this->Value('questionId')]
                ]);

                $this->saveInSession = true;
                return $res;
            }
        ],
    ]);
    
    }
}