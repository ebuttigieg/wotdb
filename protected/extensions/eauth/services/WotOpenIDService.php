<?php
/**
 */

require_once dirname(dirname(__FILE__)).'/EOpenIDService.php';

/**
 * Google provider class.
 * @package application.extensions.eauth.services
 */
class WotOpenIDService extends EOpenIDService {

	protected $name = 'wot';
	protected $title = 'World of tanks';
	protected $type = 'OpenID';
	protected $jsArguments = array('popup' => array('width' => 880, 'height' => 520));

	protected $url = 'https://ru.wargaming.net/id';
	protected $requiredAttributes = array(
//		'name' => array('firstname', 'namePerson/first'),
		'name' => array( 'nickname', 'namePerson/friendly'),
//		'lastname' => array('lastname', 'namePerson/last'),
//		'email' => array('email', 'contact/email'),
//		'language' => array('language', 'pref/language'),


	);



	protected function fetchAttributes() {
		$this->attributes['url']=$this->attributes['id'];
		if(preg_match('/https:\/\/ru.wargaming.net\/id\/(\d+)-.*?\//', $this->attributes['id'],$matches))
			$this->attributes['id']=$matches[1];
		echo '<pre>';
		var_dump($this);
//		var_dump($this);
//		$this->attributes['name']
//		$this->attributes['name']
		die();
//		$this->attributes['fullname'] = $this->attributes['name'].' '.$this->attributes['lastname'];
	}
}