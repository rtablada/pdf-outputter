<?php

require_once('vendor/autoload.php');

$outputter = new Rtablada\PdfOutput\PdfOutputter();
$file = new Illuminate\Filesystem\Filesystem;
$manager = new Rtablada\PdfOutput\HTMLToPDFManager(__DIR__, $outputter, $file);

$manager->buildPDFFromString('<h2>Test</h2>');
