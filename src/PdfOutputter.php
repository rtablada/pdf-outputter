<?php namespace Rtablada\PdfOutput;

class PdfOutputter
{
	protected $currentPath;

	public function __construct()
	{
		$this->currentPath = __DIR__;
		$this->generatorScriptPath = $this->currentPath . '/pdf-generator.js';
	}

	public function createPDF($inputPath, $outputPath)
	{
		$command = "node {$this->generatorScriptPath} {$inputPath} {$outputPath}";
		echo exec($command);
	}
}
