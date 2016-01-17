<?php

// Namespace
	$tagsToQuestion = new \Anax\Tags\TagToQuestion();
	$question = new \Anax\Questions\Questions();
	$tag = new \Anax\Tags\Tags();
	$user = new \Anax\User\User();
	$answer = new \Anax\Answers\Answers();
	$comments = new \Anax\Comments\Comments();
	
	// Setup DI
	$tag->setDI($di);
	$question->setDI($di);
	$user->setDI($di);
	$answer->setDI($di);
	$comments->setDI($di);
	$tagsToQuestion->setDI($di);
	$tagsToQuestion->dropTable();
	$tag->setup();
	$question->setup();
	$user->setup();
	$answer->setup();
	$comments->setup();
	$tagsToQuestion->setup();