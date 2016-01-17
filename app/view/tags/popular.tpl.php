<?php 
	 if (isset($tags[0])){

		$html = "<div class='sidebar-module sidebar-module-inset'><h2 class='medium-form-heading'>" . $title . " <i class='fa fa-tags'></i></h2><div class='air'></div>";
		foreach ($tags as $tag) {
			$html .= "<a class='tags' style='margin-right:2px; margin-top:1px;' href=" . $this->url->create('tags/id/' . $tag->id) . "> " . $tag->name . "</a>";
		}
		$html .= "</div>";
		echo $html;
	}
	?> 