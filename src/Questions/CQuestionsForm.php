<?php
namespace Anax\Questions;

class CQuestionsForm extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;
    /**
     * Constructor
     *
     */
    public function __construct($tags = array())
    {   
        if(isset($tags[0])) {
            foreach ($tags as $tag) {
                $tagoptions[$tag->id] = $tag->name; 
            }
            
        parent::__construct([], [
        'subject' => [
            'type'        => 'text',
			'placeholder' => 'Rubrik',
			'id'		  => 'inputEmail',
			'class'		  => 'form-control',
            'label'       => 'Rubrik',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'text' => [
            'type'        => 'textarea',
			'placeholder' => 'Fråga',
			'id'		  => 'inputEmail',
			'class'		  => 'form-control',
            'label'       => 'Fråga',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'old_tags' => [
            'type'        => 'select-multiple',
			'placeholder' => 'Taggar',
			'id'		  => 'inputEmail',
			'class'		  => 'form-control',
            'options'     => $tagoptions,
            'label'       => 'Befintliga taggar',
        ],
        'new_tags' => [
            'type'        => 'text',
			'placeholder' => 'Tag?, ',
			'id'		  => 'inputEmail',
			'class'		  => 'form-control',
            'label'       => 'Skapa nya taggar, separera med komma-tecken',
        ],
        'submit' => [
            'type'      => 'submit',
			'class'		=> 'btn btn-lg btn-primary btn-block',
			'value'     => 'Skicka',
            'callback'  => function() {
                $old_tags = null;
                if(isset($_POST['old_tags'])) {
                    $old_tags = $_POST['old_tags'];
                }

                $res = $this->di->dispatcher->forward([
                    'controller' => 'questions',
                    'action'     => 'add',
                    'params'     => [$this->Value('subject'), $this->Value('text'), $old_tags, $this->Value('new_tags')]
                ]);

                $this->saveInSession = true;
                return $res;
            }
        ],
    ]);
    }
    
    else {
                parent::__construct([], [
        'subject' => [
            'type'        => 'text',
			'placeholder' => 'Rubrik',
			'id'		  => 'inputEmail',
			'class'		  => 'form-control',
            'label'       => 'Rubrik',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'text' => [
            'type'        => 'textarea',
			'placeholder' => 'Fråga',
			'id'		  => 'inputEmail',
			'class'		  => 'form-control',
            'label'       => 'Fråga',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'tags_new' => [
            'type'        => 'text',
			'placeholder' => 'Taggar',
			'id'		  => 'inputEmail',
			'class'		  => 'form-control',
            'label'       => 'Skapa nya taggar, separera med komma-tecken',
        ],
        'submit' => [
            'type'      => 'submit',
			'class'		=> 'btn btn-lg btn-primary btn-block',
            'callback'  => function() {

                $res = $this->di->dispatcher->forward([
                    'controller' => 'questions',
                    'action'     => 'add',
                    'params'     => [$this->Value('subject'), $this->Value('text')]
                ]);

                $this->saveInSession = true;
                return $res;
            }
        ],
        'submit-fail' => [
            'type'      => 'submit',
            'callback'  => function() {
                $this->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>");
                return false;
            }
        ],
    ]);

    }

    }


}