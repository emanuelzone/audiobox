
<?php
	 if (isset($users[0])){
	 	$users = array_reverse($users);

$html = "<div class='row'><h2 class='medium-form-heading'>Aktiva användare &#40;" . count($users) . "&#41; <i class='fa fa-users'></i></h2></div>";	
$html .= "<div class='row questions user-start'> ";
		foreach ($users as $user) {

			$html .= "<a data-toggle='tooltip' data-placement='top' title='" . $user->acronym . "' href=" . $this->url->create('user/id/' . $user->id) . "><img src=" . get_gravatar($user->email,46) . " alt='" . $user->acronym . "' /></a>";

		}
		
		$html .= "</div>";

		echo $html;


	}

?> 

