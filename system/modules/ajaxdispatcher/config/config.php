<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @copyright 	Tim Gatzky 2014
 * @author  	Tim Gatzky <info@tim-gatzky.de>
 * @package  	ajaxdispatcher
 * @link  		http://contao.org
 * @license  	http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Constants
 */
define('AJAXDISPATCHER_PATH','system/modules/ajaxdispatcher');

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('AjaxDispatcher\InsertTags','replaceTags');
$GLOBALS['TL_HOOKS']['generatePage'][] 		= array('AjaxDispatcher\PageHelper','includeJavascript');
$GLOBALS['TL_HOOKS']['getAjaxResponse'][] 	= array('AjaxDispatcher\Responses','getResponse');