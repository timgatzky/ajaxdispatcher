
/**
 * AjaxDispatcher Class
 *
 * @copyright 	Tim Gatzky 2014
 * @author  	Tim Gatzky <info@tim-gatzky.de>
 * @package  	ajaxdispatcher
 * @license  	http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */
 
var AjaxDispatcher = new Class(
{
	/**
	 * Inheritance
	 */
	Implements: [Options, Events],
	
	/**
	 * Options object
	 * @var object
	 */
	objOptions: {},
	
	/**
     * Path to dispatcher php file
     * @var string
     */
	strFilePath: 'system/modules/ajaxdispatcher/AjaxDispatcher/Core/AjaxDispatcher.php',
	
	/**
	 * Request method
	 * Since contao processes the javascript via $GLOBALS['TL_HEAD'] we can use the inserttag here to get a fresh request token
	 * and write it as default for any instances of this class
	 * @var string
	 */
	strMethod: 'post',
	
	/**
	 * Request token
	 * @var string
	 */
	strRequestToken: "{{request_token}}",
	
	/**
	 * Instance name
	 * @var string
	 */
	strName: '',
	
	/**
	 * Initialize Class and apply options
	 * @param object
	 */
	initialize: function(objOptions)
	{
		if(!objOptions)
		{
			return;
		}
		
		// set instance name when given
		this.strName = objOptions.name;
		
		if(objOptions.request_token)
		{
			this.strRequestToken = objOptions.request_token;
		}
		else if(objOptions.REQUEST_TOKEN)
		{
			this.strRequestToken = objOptions.REQUEST_TOKEN;
		}
		
		if(objOptions.method)
		{
			this.strMethod = objOptions.method;
		}
		
		this.setOptions(objOptions);
    },
    
    /**
	 * Send a request
	 * @param object
	 */
	send: function(objData)
	{
		var method = this.strMethod
		var instance = this;
		
		// allow dynamic method changes
		if(objData.__method)
		{
			method = objData.__method;
			delete objData.__method;
		}
		else if(objData.method)
		{
			method = objData.method;
		}
		
		// add the request token
		objData.REQUEST_TOKEN = this.strRequestToken;
		// send ajax request to dispatcher
		var request = new Request(
		{
			url		:	this.strFilePath,
			method	:	method,
			data	: 	objData,
			onSuccess:function(response)
			{
				var event = {};
				event.response = response;
				event.instance = instance;
				event.status = this.status;
				event.name = instance.strName;
				event.request = this;
				// trigger complete callback
				instance.complete(event);
			}
		}).send();
	},
	
	/**
	 * Complete function
	 * @param object
	 */
	complete:function(event)
    {
	   this.fireEvent('complete',event);
	   window.fireEvent('onAjaxResponse',event);
    },
    
	/**
	 * Simple post request
	 * @param object
	 */
	sendPOST: function(objData)
	{
		objData.__method = 'post';
		this.send(objData);
	},
	
	/**
	 * Simple get request
	 * @param object
	 */
	sendGET: function(objData)
	{
		objData.__method = 'get';
		this.send(objData);
	},
	
	/**
	 * Call to replace an insert tag. Response is an html string (or plain string)
	 * @param string
	 */
	replaceInsertTags: function(strInsertTag)
	{
		var data = {};
		data.action = 'replaceInsertTags';
		data.value = strInsertTag;
		this.send(data);
	}
});
