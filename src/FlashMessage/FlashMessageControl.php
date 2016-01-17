<?php

namespace Anax\FlashMessage;
 
/* START FLASH MESSAGE CONTROLLER */

class FlashMessageControl implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

/* CONSTRUCT */

 public function __construct(){
        if(!isset($_SESSION['flashmsg'])){
            $_SESSION['flashmsg'] = array();
        }
    }

    public function addMessage($message, $type){
        $msg = array('content' => $message, 'type' => $type);
        $_SESSION['flashmsg'][] = $msg;
    }
    
	/* SUCCESS */
	public function addSuccessMsg($message){
    	$this->addMessage('success', $message);
    }
	
	/* INFORMATION */
    public function addInfoMsg($message){
        $this->message('info', $message);
    }
	
	/* ERROR */
    public function addErrorMsg ($message){
        $this->addMessage('error', $message);
    }
    
	/* wWARNING */
    public function addWarningMsg($message){
        $this ->message('warning', $message);
    }
    
    public function getFlashMessages(){
        
        $messages = $_SESSION['flashmsg'];
        $output = null;
        
        if($messages) {
            foreach ($messages as $key => $message) {
                $output .= "<p class='". $message['type'] . "'>" . $message['content'] . "</p>";
            }
        } else {
            $output = null;
        }
        return $output;
    }
     
/* SESSION CONTROLLER DELETE */

     public function deleteMessages(){
        $_SESSION['flashmsg'] = null;
    }
} /* END FLASH MESSAGE CONTROLLER*/