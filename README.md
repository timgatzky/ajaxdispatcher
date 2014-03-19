ajaxdispatcher
=================

About
-----

Contao extension for ajax handling in contao frontend or backend.


Usage
-----

```
/**
 * Examples of working with the AjaxDispatcher class
 */
window.addEvent('domready', function()
{
	// OOP approach
	var myAjax = new AjaxDispatcher();
	myAjax.replaceInsertTags('insert_article::3');
	myAjax.addEvent('complete', function(event)
	{
		var txt = event.response;
	});
	
	// triggers the onAjaxResponse directely
	new AjaxDispatcher().replaceInsertTags('insert_article::3');
});

// DOM listener
window.addEvent('onAjaxResponse', function(event)
{
	var txt = event.response;
});
```

Create your own ajax responses using the getAjaxResponse HOOK.

```
$GLOBALS['TL_HOOKS']['getAjaxResponse'];

public function myAjaxResponse($strAction,$arrSubmitted,$objDispatcher)
{
	return 'Hello';
}
```

see the examples.js for more examples
