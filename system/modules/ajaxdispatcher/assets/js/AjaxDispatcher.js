
/**
 * AjaxDispatcher Class
 *
 * @copyright 	Tim Gatzky 2014
 * @author  	Tim Gatzky <info@tim-gatzky.de>
 * @package  	ajaxdispatcher
 * @link  		http://contao.org
 * @license  	http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */
 
var AjaxDispatcher = new Class(
{
	/**
	 * Imports
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
	 * @var string
	 */
	strMethod: 'post',
	
	/**
	 * Instance name
	 * @var string
	 */
	strName: '',
	
	/**
	 * Initialize Class and apply options
	 */
	initialize: function(objOptions)
	{
		if(!objOptions)
		{
			return;
		}
		
		// set instance name when given
		this.strName = objOptions.name;
		
		if(objOptions.method)
		{
			this.strMethod = objOptions.method;
		}
		
		this.setOptions(objOptions);
    },
    
     /**
	 * Send a request
	 * @string
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
