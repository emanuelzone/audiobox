
<?php
	 if (isset($users[0])){
	 	$users = array_reverse($users);
	
		$html = "";
		foreach ($users as $user) {


			$html .= "<div class='col-md-12 comment-question'><a href=" . $this->url->create('user/id/' . $user->id) . "><img class='user-list' style='float:left; margin-right:4px;' src=" . get_gravatar($user->email,60) . "></a>
			 <a href=" . $this->url->create('user/id/' . $user->id) . ">" . $user->acronym . "</a>
			  <p class='OpenSans' style='font-size:10px;'>Användar ID: ". $user->id . "<br />
			  Blev medlem: " . $user->created  . "<br />
				Senast uppdaterad: " . $user->updated  . "</p>
			  ";
			  
			  if(empty($user->text)){
				$html .= "<p>" . $user->acronym  . " har inte skrivit något presentation ännu </p>";
			}
			else {
				$html .= "<p>" . $this->textFilter->doFilter($user->text, 'shortcode, markdown') . "</p>";
			}

			$html .= " </div><div class='air'></div>";
				

		}
		$html .= "";
		
		


	}
	echo $html;

?> 


