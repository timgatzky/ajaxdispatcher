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
 * Namespace
 */
namespace AjaxDispatcher\Core;

/**
 * Initialize the system
 */
define('TL_MODE', 'FE');
require str_replace('system/modules/ajaxdispatcher/AjaxDispatcher/Core/AjaxDispatcher.php','',$_SERVER['SCRIPT_FILENAME']).'/system/initialize.php';

/**
 * Class file
 * AjaxDispatcher
 */
class AjaxDispatcher
{
	/**
	 * Default sending method
	 * @var string
	 */
	protected $strMethod = 'POST';

	/**
	 * Run
	 */
	public function run()
	{
		$response = null;
		// set method dynamically on GET
		if(\Input::get('method'))
		{
			if(strtolower(\Input::get('method')) == 'get')
			{
				$this->strMethod = 'GET';
			}
		}

		$arrSubmitted = $this->prepareData($this->strMethod == 'POST' ? $_POST : $_GET);

		// call contaos executePreAction method and hook
		$strAction = \Input::post('action');
		if($strAction)
		{
			$objAjax = new \Contao\Ajax($strAction);
			$objAjax->executePreActions();
		}

		// HOOK allow extensions to send custom responses
		if (isset($GLOBALS['TL_HOOKS']['getAjaxResponse']) && count($GLOBALS['TL_HOOKS']['getAjaxResponse']) > 0)
		{
			foreach($GLOBALS['TL_HOOKS']['getAjaxResponse'] as $callback)
			{
				$objCallback = new $callback[0];
				$response = $objCallback->$callback[1]($strAction,$arrSubmitted,$this);
			}
		}
		
		// convert arrays and objects to json
		if(is_array($response) || is_object($response))
		{
			$response = json_encode($response);
		}

		echo $response == null ? $response = '' : $response;
	}


	/**
	 * Prepare submitted data
	 * @param array
	 */
	protected function prepareData($arrData)
	{
		$arrReturn = array();
		if($this->strMethod == 'POST' && count($arrData) > 0)
		{
			foreach($arrData as $k => $v)
			{
				$arrReturn[$k] = \Input::post($k);
			}
		}
		elseif($this->strMethod == 'GET' && count($arrData) > 0)
		{
			foreach($arrData as $k => $v)
			{
				$arrReturn[$k] = \Input::get($k);
			}
		}

		return $arrReturn;
	}
}
$objAjaxDispatcher = new \AjaxDispatcher\Core\AjaxDispatcher();
$objAjaxDispatcher->run();