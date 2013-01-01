<?php
Application::configuration(array(
	'defaultController'	=>	'Controller_home',
	'defaultAction'	=>	'index'
));

Router::addAlias('start/to/togo', array('home'));

