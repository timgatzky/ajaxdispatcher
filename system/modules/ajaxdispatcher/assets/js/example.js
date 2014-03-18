
window.addEvent('domready', function()
{
	// just perform a simple call. use method:'get' to send as GET (default is POST)
	var myAjax = new AjaxDispatcher().send({hallo:'welt'});

	// replace an inserttag
	var myAjaxInsertTag = new AjaxDispatcher().replaceInsertTags('insert_article::3');
	
	// just perform a simple POST call and send some data
	var myAjaxPost = new AjaxDispatcher().sendPOST({hallo:'welt'});
	
	// just perform a simple GET call and send some data
	var myAjaxGet = new AjaxDispatcher().sendGET({hallo:'welt'});
});

// event listener: send the response to the console
window.addEvent('getResponse', function(txt)
{
	console.log(txt);
});

window.addEvent('getResponseObject', function(obj)
{
	console.log(obj);
});