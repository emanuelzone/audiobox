
<?php
	$question =	$question->getProperties();
	extract($question);
?>



<?php
			$user = $this->UserController->getUserAction($userId);
			$tags = $this->TagsController->getTagsByQuestion($id);
			$questionId = $id;
			
			//Back
			$html = "<a href=" . $this->url->create('questions/list') . "><i class='fa fa-arrow-left'></i> Till alla frågor</a><hr />";
			$html .= "<div class='one-question'>";
			$html .= "<section class='main-question'>";
			$html .= "<h1>" . $subject . "</h1>";
			$html .= "<i class='fa fa-pencil'></i> <a href=" . $this->url->create('user/id/' . $user->id) . ">" . $user->acronym . "</a> <i class='fa fa-clock-o'></i> <span class='date'>" . $created . "</span> <br />";
			$html .= "<div class='spacer'></div>";
			$html .= "" . $iframe . "";
			$html .= "<article><p>";
			$html .= $this->textFilter->doFilter($text, 'shortcode, markdown') . "</p></article><br />tags <i class='fa fa-tags'></i> ";

			//Tags
				foreach ($tags as $id => $name) {
					$html .= "<a class='tags' style='margin-right:2px;' href=" . $this->url->create('tags/id/' . $id) . ">" . $name . "</a>"; 
				}

			//Comments
			$html .= "<div class='air'></div>";
			$html .= "<h2 class='questions-form-heading'><i class='fa fa-comments-o'></i> Kommentarer</h2>";

		$comments = $this->CommentsController->getCommentsForQuestion($questionId);
		foreach ($comments as $comment) {
			$user = $this->UserController->getUserAction($comment->userId);

			$html .= "<div class='col-md-12 comment-question'><p><a href=" . $this->url->create('user/id/' . $user->id) . "><img src=" . get_gravatar($user->email,30) . " alt='" . $user->acronym . "' /></a> <a href=" . $this->url->create('user/id/' . $user->id) . ">" . $user->acronym . "</a> <span class='date OpenSans' style='float:right;'>" . $comment->created . "</span><p>";
				$html .= "<p>" . $comment->text . "</p></div>";
		}
		
				//Leave comment
				if($this->UserController->isUserLoggedIn()) {
				$html .= "<br /><a href=" . $this->url->create('comments/form/question/' . 	$questionId ) . "><i class='fa fa-commenting'></i> Lämna kommentar</a>";
				}
				else {
				$html .= "<a href='http://www.student.bth.se/~maem14/phpmvc/project/audiobox/webroot/login'><i class='fa fa-lock'></i> Logga in för att lägga till en kommentar</a>";
				}

		
		//Leave Answer
		$html .= "<h2 class='questions-form-heading'><i class='fa fa-reply'></i> " . count($answers) . " Svar</h2>";
		$html .= "<section class='answers'>";
				foreach ($answers as $answer) {
					$answer =	$answer->getProperties();
					extract($answer);
					$user = $this->UserController->getUserAction($userId);
					$html .= "<div class='col-md-12 comment-question' style='margin-bottom:20px;'>";
					$html .= "<p><a href=" . $this->url->create('user/id/' . $user->id) . "><img src=" . get_gravatar($user->email,30) . " alt='" . $user->acronym . "' /></a> <a href=" . $this->url->create('user/id/' . $user->id) . ">" . $user->acronym . "</a> <span class='date OpenSans' style='float:right;'>" . $comment->created . "</span><p>";
				
					$html .= "<article>";
					
					$html .= $this->textFilter->doFilter($text, 'shortcode, markdown') . "</p>";
					
					$html .= "</article>";
					$html .= "<span class='user'>";

					$html .= "<a href=" . $this->url->create('comments/form/answer/' . $id) . "><i class='fa fa-plus'></i> Lämna kommentar på svaret</a>";
					
					$comments = $this->CommentsController->getCommentsForAnswer($id);
					foreach ($comments as $comment) {
						$user = $this->UserController->getUserAction($comment->userId);
				$html .= "<div class='col-md-12 comment-on-question'>
				
				<p><a href=" . $this->url->create('user/id/' . $user->id) . ">
				<img src=" . get_gravatar($user->email,30) . " alt='" . $user->acronym . "' /></a> 
				<a href=" . $this->url->create('user/id/' . $user->id) . ">" . $user->acronym . "</a> 
				<span class='date OpenSans' style='float:right;'>" . $comment->created . "</span><p>";
				$html .= "<p>" . $comment->text . "</p>";
				$html .= "</div>";
					}
					$html .= "</div>";
				}
		$html .= "</section></div>";
		
		
				//Add Aswer
				if($this->UserController->isUserLoggedIn()) {

				$html .= "<h2 class='questions-form-heading'><i class='fa fa-plus'></i> Lägg till ett svar</h2>";
				$html .= "<div class='air'></div>";

				}
				else {
				$html .= "<div class='air'></div>";
				$html .= "<div class='col-md-12' style='height:20px;'></div>";
				$html .= "<div class='air'></div>";
				}
		
		
		echo $html;
		echo $form;
	
	
?> 	
