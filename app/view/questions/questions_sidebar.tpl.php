<!-- Questions frontpage -->
<?php 
	
	$html = "<div class='sidebar-module sidebar-module-inset'><h2 class='medium-form-heading'>" . $title . " <i class='fa fa-comments-o'></i></h2>";
	foreach ($questions as $question) {
			$answers = $this->AnswersController->getAnswers($question->id);
			$user = $this->UserController->getUserAction($question->userId);
			


			$html .= "<div class='user'><ul><li><a class='width' href=" . $this->url->create('questions/id/' . $question->id) . ">(" . count($answers) . ") " . $question->subject . "</a> </li></ul></div>";

	}

	$html .= "</div>";

		echo $html;


?> 


