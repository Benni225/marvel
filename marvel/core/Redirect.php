<?php
class Redirect{
	public static function to(Array $redirection = array()){
		!empty($redirection[0])?Application::setController($redirection[0]):Application::setController('');
		!empty($redirection[1])?Application::setAction($redirection[1]):Application::setAction('');
		Application::run();
	}
}