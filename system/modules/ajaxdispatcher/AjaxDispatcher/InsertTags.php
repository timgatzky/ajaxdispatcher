<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @copyright 	Tim Gatzky 2014
 * @author  	Tim Gatzky <info@tim-gatzky.de>
 * @package  	ajaxdispatcher
 * @link 		http://contao.org
 * @license  	http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */
 
/**
 * Namespace
 */
namespace AjaxDispatcher;

/**
 * Class file
 * InsertTags
 */
class InsertTags extends \Contao\Controller
{
	/**
	 * Current object instance (Singleton)
	 * @var object
	 */
	protected static $objInstance;
	
	/**
	 * Instantiate this class and return it (Factory)
	 * @return object
	 * @throws Exception
	 */
	public static function getInstance()
	{
		if (!is_object(self::$objInstance))
		{
			self::$objInstance = new self();
		}

		return self::$objInstance;
	}
	
	/**
	 * Replace regular inserttags
	 *
	 * @param string
	 * @return mixed
	 */
	public function replaceTags($strTag)
	{
		$arrElements = explode('::', $strTag);
		switch($arrElements[0])
		{
			default:
				return false;
				break;
		}
	
		return false;
	}
	
	/**
	 * Replace inserttags comming from ajax
	 * @param string
	 * @return string
	 */
	public function replaceTagsFromAjax($strTag)
	{
	  	// strip the insert tag, just in case
	  	$strTag = str_replace(array('{{','}}'), '', $strTag);
	  	
	  	return $this->replaceInsertTags('{{'.$strTag.'}}');
	}	
}