<!-- Questions frontpage -->


<?php 
	
	$html = "<div class='row'><h2 class='medium-form-heading'>Aktuella frågor &#40;" . count($questions) . "&#41; <i class='fa fa-comments-o'></i></h2></div>";
	foreach ($questions as $question) {
			$user = $this->UserController->getUserAction($question->userId);
			$tags = $this->TagsController->getTagsByQuestion($question->id);
			$answers = $this->AnswersController->getAnswers($question->id);
			$user = $this->UserController->getUserAction($question->userId);
			
			$html .= "<div class='row questions'> ";
			$html .= "<div class='col-md-9 spacer'><span class='date'>Av: <a href=" . $this->url->create('user/id/' . $user->id) . "> " . $user->acronym . "</a> &#124; " . $question->created . "</span></div>";
			$html .= "<div class='col-md-8 spacer q-heading'><a class='subject' href=" . $this->url->create('questions/id/' . $question->id) . ">" . $question->subject . " &#40;" . count($answers) . "&#41;</a></div>";
			
			$html .= "<div class='col-md-4 spacer tags-column'>tags <i class='fa fa-tags'></i> ";
				foreach ($tags as $id => $name) {
					

					

				$html .= "<a class='tags' href=" . $this->url->create('tags/id/' . $id) . ">" . $name . "</a> ";

					
		
				}

			$html .= "</div>";
			$html .= "</div>";


	}
	
	$html .= "<br />";
	$html .= "<a class='subject' href=" . $this->url->create('questions/list') . ">Till alla frågor <i class='fa fa-long-arrow-right'></i>
</a>";

	

		echo $html;




	?> 


