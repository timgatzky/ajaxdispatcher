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
		if(isset($GLOBALS['TL_HEAD']['ajaxDispatcher']))
		{
			return;
		}
		
		$objFile = new \File(AJAXDISPATCHER_PATH.'/assets/js/AjaxDispatcher.js',true);
		$strBuffer = $objFile->getContent();
		$strBuffer = $this->replaceInsertTags($strBuffer);
		
		$token = REQUEST_TOKEN;
		$strBuffer = str_replace('{{request_token}}',$token,$strBuffer);
		
		// wrap script
		$strBuffer = '<script type="text/javascript">
		/* <![CDATA[ */'
		.$strBuffer.'
		/* ]]> */
		</script>';
		
		// Minify inline scripts
		// @copyright Contao, Leo Feyer
		if($GLOBALS['TL_CONFIG']['minifyMarkup'])
		{
			$strChunk = $strBuffer;
			$strChunk = str_replace(array("/* <![CDATA[ */\n", "<!--\n", "\n//-->"), array('/* <![CDATA[ */', '', ''), $strChunk);
			$strChunk = preg_replace(array('@(?<!:)//(?!W3C|DTD|EN).*@', '/[ \n\t]*(;|=|\{|\}|\[|\]|&&|,|<|>|\',|",|\':|":|: |\|\|)[ \n\t]*/'), array('', '$1'), $strChunk);
			$strChunk = trim($strChunk);
			$strBuffer = $strChunk;
		}
		
		$GLOBALS['TL_HEAD']['ajaxDispatcher'] = $strBuffer;
	}	
}