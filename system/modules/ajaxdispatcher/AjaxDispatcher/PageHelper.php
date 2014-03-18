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
class PageHelper extends \Contao\Frontend
{
	/**
	 * Include javascript to page
	 * called from generatePage HOOK
	 */
	public function includeJavascript()
	{
		$GLOBALS['TL_JAVASCRIPT']['ajaxDispatcher'] = AJAXDISPATCHER_PATH.'/assets/js/AjaxDispatcher.js';
	}	
}