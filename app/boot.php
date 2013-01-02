<?php
Application::configuration(array(
	'defaultController'	=>	'home',
	'defaultAction'	=>	'index'
));

Router::addAlias('start/to', array('home'));

