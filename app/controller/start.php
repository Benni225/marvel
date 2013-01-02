<?php
class Controller_Start{
	public function indexAction(){
		Redirect::to(array('home'));
	}
}