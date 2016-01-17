
<?php
			extract($content);
			$user = $this->UserController->getUserAction($userId);
			
			// Tillbaka
			$html = "<a href=" . $this->url->create('questions/list') . "><i class='fa fa-arrow-left'></i> Tillbaka till alla frågor</a>";
			$html .= "<hr />";
			
			// Article
			$html .= "<h4>Kommentera</h4>";
			$html .= "<article></p>";
			$html .= $this->textFilter->doFilter($text, 'shortcode, markdown') . "</p></article>";
			$html .= "<img class='user-list' src=" . get_gravatar($user->email,40) . "> <a href=" . $this->url->create('user/id/' . $user->id) . "> " . $user->acronym . "</a>";
			$html .= "<hr />";

			// Kommentera
		foreach ($comments as $comment) {
			$html .= "<div class='col-md-12 comment-question' style='margin-bottom:20px;'>";
			$user = $this->UserController->getUserAction($comment->userId);
			$html .= "<p><a href=" . $this->url->create('user/id/' . $user->id) . "><img src=" . get_gravatar($user->email,30) . " alt='" . $user->acronym . "' /></a> <a href=" . $this->url->create('user/id/' . $user->id) . ">" . $user->acronym . "</a> <span class='date OpenSans' style='float:right;'>" . $comment->created . "</span><p>";
						$html .= "<p>" . $comment->text . "</p><br />";
			$html .= "</div>";
			}

		echo $html;
		echo $form;
				
?> 	


