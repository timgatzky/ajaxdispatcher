<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package ajaxdispatcher
 * @link    https://contao.org
 */

/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'AjaxDispatcher',
));

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'AjaxDispatcher\Core\AjaxDispatcher'	=> 'system/modules/ajaxdispatcher/AjaxDispatcher/Core/AjaxDispatcher.php',
	'AjaxDispatcher\PageHelper'				=> 'system/modules/ajaxdispatcher/AjaxDispatcher/PageHelper.php',
	'AjaxDispatcher\InsertTags'				=> 'system/modules/ajaxdispatcher/AjaxDispatcher/InsertTags.php',
	'AjaxDispatcher\Responses'				=> 'system/modules/ajaxdispatcher/AjaxDispatcher/Responses.php',
));