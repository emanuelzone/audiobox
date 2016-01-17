
<?php 
		if($this->UserController->isUserLoggedIn()) {
				?>
					<nav class='button-nav'>
						<a href="<?=$this->url->create('questions/create/');?>">Lägg till ny fråga</a> 
					</nav>
				<?php
			}
		else {
				?>
					<nav class='button-nav'>
						<a href="<?=$this->url->create('login');?>"><i class="fa fa-lock"></i> Logga in för att kunna skriva frågor</a> 
					</nav>
				<?php
		}
	 if (isset($questions[0])){
	 	$questions = array_reverse($questions);
	
	$html = "<div class='row'><h2 class='medium-form-heading'>Alla frågor &#40;" . count($questions) . "&#41; <i class='fa fa-comments-o'></i></h2></div>";
	foreach ($questions as $question) {
			$user = $this->UserController->getUserAction($question->userId);
			$tags = $this->TagsController->getTagsByQuestion($question->id);
			$answers = $this->AnswersController->getAnswers($question->id);
			$user = $this->UserController->getUserAction($question->userId);
			
			$html .= "<div class='row questions'> ";
			$html .= "<div class='col-md-9 spacer'><img class='user-list' src=" . get_gravatar($user->email,40) . "> <span class='date'>Av: <a href=" . $this->url->create('user/id/' . $user->id) . "> " . $user->acronym . "</a> &#124; " . $question->created . "</span></div>";
			$html .= "<div class='col-md-8 spacer q-heading'><a class='subject' href=" . $this->url->create('questions/id/' . $question->id) . ">" . $question->subject . "  	&#40;" . count($answers) . "&#41;</a></div>";
			$html .= "<div class='col-md-4 spacer tags-column'>tags <i class='fa fa-tags'></i> ";
				foreach ($tags as $id => $name) {
					

				$html .= "<a class='tags' href=" . $this->url->create('tags/id/' . $id) . ">" . $name . "</a> ";

					
		
				}

			$html .= "</div>";
			$html .= "</div>";


	}

	

		echo $html;
	}
	?> 

