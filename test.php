<?php

require_once('vendor/autoload.php');

$outputter = new Rtablada\PdfOutput\PdfOutputter();

$inFile = __DIR__ . '/test.html';
$outFile = __DIR__ . '/test.pdf';
$outputter->createPDF($inFile, $outFile);
