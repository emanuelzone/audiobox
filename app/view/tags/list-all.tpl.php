<?php 
	 if (isset($tags[0])){
	 
		$html = "<div class='col-md-12'>";
		$html .= "<h1>". $title ."</h1><hr />";
		
		foreach ($tags as $tag) {
			$html .= "<a class='tags-list' href=" . $this->url->create('tags/id/' . $tag->id) . "> " . $tag->name . " (" . count($number[$tag->id]) . ")</a>";
		}
		
		$html .= "</div>";
		echo $html;
	}
	?> 