<h1><?=$title?></h1>
<?php
		 if (isset($questions[0])){
		$html = "<div class='row'>";
		$html = "<p>Antal frågor: &#40;" . count($questions) . "&#41;</p><hr />";
		foreach ($questions as $question) {
			extract($question);

			$user = $this->UserController->getUserAction($userId);
			$tags = $this->TagsController->getTagsByQuestion($id);
			
			
			$html .= "<div class='question'><h4><img src=" . get_gravatar($user->email,40) . "> " . $subject . "</h4>";
			$html .= "<p class='date'>Av: <a href=" . $this->url->create('user/id/' . $user->id) . "> " . $user->acronym . "</a> &#124; " . $created . "</p><br />";
			$html .= "<article>" . $this->textFilter->doFilter($text, 'shortcode, markdown') . "<br />";
			$html .= "" . $iframe . "</article> <br />";
			$html .= "tags <i class='fa fa-tags'></i> ";
			
				
				foreach ($tags as $id => $name) {
					$html .= "<a class='tags' href=" . $this->url->create('tags/id/' . $id) . ">" . $name . "</a> ";
				}


			$html .= "</div><hr />";
		}
		$html .= "</div>";
		echo $html;
	}
	
?> 	
