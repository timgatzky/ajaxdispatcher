ajaxdispatcher
=================

About
-----

Contao extension for ajax handling in contao frontend or backend.


Usage
-----

```
window.addEvent('domready', function()
{
	// just perform a simple call. use method:'get' to send as GET (default is POST)
	var myAjax = new AjaxDispatcher().send({hello:'world'});

	// replace an inserttag
	var myAjaxInsertTag = new AjaxDispatcher().replaceInsertTags('insert_article::3');
});

// event listener: send the response to the console
window.addEvent('getResponse', function(txt)
{
	console.log(txt);
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
