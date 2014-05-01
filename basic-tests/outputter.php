<?php

require_once('vendor/autoload.php');

$outputter = new Rtablada\PdfOutput\PdfOutputter();

$inFile = __DIR__ . '/outputter.html';
$outFile = __DIR__ . '/outputter.pdf';
$outputter->createPDF($inFile, $outFile);
