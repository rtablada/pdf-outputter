Laravel PhantomJS PDF Generator
---

Generating PDFs is terrible business.
Plus, why learn a new library when you already know HTML and CSS?

This package gives you the freedom to build downloadable PDF responses from the skills you already know.

Installation
---

To use this package you will need to have both PhantomJS and the `phantom` npm module installed in your project.
To accomplish this, in the root of your project run `npm install phantomjs` and `npm install phantom`.

Then in your `composer.json` file add `"rtablada/pdf-output": "dev-master"` to your `require` block.

Laravel Installation
---

To further install this in Laravel, add `'Rtablada\PdfOutput\PDFOutputterServerProvider',` to your providers list.
This will register the binding `pdf-output.response-outputter` in the IoC container.
Optionally, you can add `'PDF' => 'Rtablada\PdfOutput\PDFFacade',` to your facades.

To build a PDF Downloadable response from a View, simply run `PDF::buildPDFDownloadFromView('viewName', $data)`.
This will accept the same arguments as when using `View::make`.

If you feel that facades aren't your bag, then feel free to use this without facades like this:

```php
$outputter = app('pdf-output.response-outputter');
return $outputter->buildPDFDownloadFromView('viewName', $data)
```
