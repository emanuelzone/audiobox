
<?php
			$html = "<div class='col-md-12 spacer'>";
			$html .= "<img style='float:left; margin-right:4px;' class='user-list' src=" . get_gravatar($user->email,80) . ">";
			$html .= "<h1 style='margin:0; padding:0;'>" . $user->acronym . "</h1><p class='OpenSans'>Blev medlem: " . $user->created  . "<br>Användar ID: " . $user->id . "</p>";
			$html .= "</div>";
			
			// IF logged in view edit link
			$html .= "<div class='col-md-12 spacer'>";
			if($edit) {
				$editLink =  "<a href=" . $this->url->create('user/edit/' . $user->id) . ">Redigera profil <i class='fa fa-long-arrow-right'></i></a>"; 
			}
			else {
				$editLink =  "<a href='http://www.student.bth.se/~maem14/phpmvc/project/audiobox/webroot/login'><i class='fa fa-lock'></i> Logga in för att editera</a>"; 
			}
			$html .= "</div>";

			///////////////////////////////////

			// Presentation
			$html .= "<div class='col-md-12 spacer'>";
			if(empty($user->text)){
				$html .= "<p>" . $user->acronym  . " har inte skrivit någon presentation ännu </p>" . $editLink;
			}
			else {
				$html .= "<p>" . $this->textFilter->doFilter($user->text, 'shortcode, markdown') . "</p>" . $editLink;
			}
			

			$html .= "<hr /></div>";
			
			///////////////////////////////////
			
			// Questions
			$html .= "<div class='col-md-12 spacer'>";
		
			if(!empty($questions)) {
			$html .= "<h2 class='questions-form-heading'>Frågor som " . $user->acronym . " har ställt &#40;" . count($questions) . "&#41; <i class='fa fa-comments-o'></i></h2>";

			
			foreach ($questions as $question) {
				$tags = $this->TagsController->getTagsByQuestion($question->id);
				$answers = $this->AnswersController->getAnswers($question->id);

				$html .= "<div class='col-md-12 comment-question'>";
				$html .= "<a href=" . $this->url->create('questions/id/' . $question->id) . ">" . $question->subject . "</a><span style='color:#F2F2F2'> (" . count($answers) . " svar) </span>";
				$html .= "<span class='date'>" . $question->created . "</span>";
				$html .= "</div>";
			}
				
			}
		
			$html .= "</div>";
		
		///////////////////////////////////
		
		// Tags
		$html .= "<div class='col-md-12 spacer'>";
		
		if(!empty($questions)) {
			$html .= "<h2 class='questions-form-heading'>Populära taggar av " . $user->acronym . " <i class='fa fa-tags'></i></h2>";
						foreach ($questions as $question) {
				$tags = $this->TagsController->getTagsByQuestion($question->id);
				$answers = $this->AnswersController->getAnswers($question->id);
				

					foreach ($tags as $id => $name) {
						$html .= "<a class='tags' style='margin-top:2px;' href=" . $this->url->create('tags/id/' . $id) . ">" . $name . "</a> "; 
					}

			}

			
		}
		
		
		$html .= "</div>";

		///////////////////////////////////
		
		// Disqusion
		$html .= "<div class='col-md-12 spacer'>";
		if(!empty($discussions)) {
			
			$html .= "<h2 class='questions-form-heading'>Diskussioner som " . $user->acronym . " har detltagit i <i class='fa fa-bullhorn'></i></h2>";
			foreach ($discussions as $discussion) {
				$question = $this->QuestionsController->getQuestion($discussion->questionId);
				extract($question);
				$user = $this->UserController->getUserAction($userId);
				$tags = $this->TagsController->getTagsByQuestion($id);
				$answers = $this->AnswersController->getAnswers($id);

				$html .= "<div class='col-md-12 comment-question'>";
				$html .= "<a href=" . $this->url->create('questions/id/' . $id) . ">" . $subject . "</a> <span style='color:#F2F2F2'> (" . count($answers) . " svar) </span>";
				$html .= "<span class='date'>" . $created . "</span>";
				$html .= "</div>";
	
		}
		}
		
			$html .= "</div>";
			

			
			
		// Print it out	
		echo $html;

?>
