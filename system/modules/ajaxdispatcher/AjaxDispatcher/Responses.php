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
 * Imports
 */
use AjaxDispatcher\InsertTags as InsertTags;

/**
 * Class file
 * Responses
 * Provide custom responses for ajax requests
 */
class Responses
{
	/**
	 * Generate responses to ajax requests
	 * @param string
	 * @param array
	 * @param object
	 * @return mixed (prefered string. objects or arrays will be encoded to a json string)
	 */	
	public function getResponse($strAction,$arrData)
	{
		switch($strAction)
		{
			case 'replaceInsertTags':
				return InsertTags::getInstance()->replaceTagsFromAjax($arrData['value']);
				break;
			default:
				break;	
		}
		
		return '';
	}
}