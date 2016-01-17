
<?php
	 if (isset($users[0])){
	 	$users = array_reverse($users);

		$html = "<div class='sidebar-module sidebar-module-inset'><h2 class='medium-form-heading'>" . $title . " <i class='fa fa-users'></i></h2>";

		foreach ($users as $user) {

			$html .= "<div class='user'><ul><li><a href=" . $this->url->create('user/id/' . $user->id) . "><img src=" . get_gravatar($user->email,40) . " alt='" . $user->acronym . "' />" . $user->acronym . "</a></li></ul>";

			
			/*if(empty($user->text)){
				$html .= "<article>" . $user->acronym  . " har inte skrivit något presentation ännu</article>";
			}
			else {
				$html .= "<article>" . $this->textFilter->doFilter($user->text, 'shortcode, markdown') . "</article>";
			}*/

				
			$html .= "</div>";
		}
		$html .= "</div>";
		echo $html;


	}

	?> 
