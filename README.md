ajaxdispatcher
=================

About
-----

Contao extension for ajax handling in contao frontend or backend.


Usage
-----

´´´
window.addEvent('domready', function()
{
	// just perform a simple call. use method:'get' to send as GET (default is POST)
	var myAjax = new AjaxDispatcher().send({hallo:'welt'});

	// replace an inserttag
	var myAjaxInsertTag = new AjaxDispatcher().replaceInsertTags('insert_article::3');
});

// event listener: send the response to the console
window.addEvent('getResponseText', function(txt)
{
	console.log(txt);
});
´´´

see the examples.js for more examples