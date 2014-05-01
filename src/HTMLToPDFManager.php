<?php namespace Rtablada\PdfOutput;

use Illuminate\Filesystem\Filesystem;

use Carbon\Carbon;

class HTMLToPDFManager
{
	protected $outputter;
	protected $file;

	public function __construct($tempDir = null, PdfOutputter $outputter, Filesystem $file)
	{
		$this->tempDir = $tempDir ?: __DIR__;
		$this->outputter = $outputter;
		$this->file = $file;
	}

	public function buildHtmlFileFromString($string, $time = null)
	{
		$path = $this->createHTMLFilePath();
		$this->file->put($path, $string);
		return $path;
	}

	public function buildPDFFromString($string)
	{
		$time = $this->getTimeToken();
		$htmlFilePath = $this->buildHtmlFileFromString($string, $time);
		$pdfFilePath = $this->createPDFFilePath($time);

		$this->outputter->createPDF($htmlFilePath, $pdfFilePath);
		$this->file->delete($htmlFilePath);
		return $pdfFilePath;
	}

	protected function createHTMLFilePath($time = null)
	{
		$time = $time ?: $this->getTimeToken();
		return $this->tempDir . '/' . $time . '.html';
	}

	protected function createPDFFilePath($time = null)
	{
		$time = $time ?: $this->getTimeToken();
		return $this->tempDir . '/' . $time . '.pdf';
	}

	protected function getTimeToken()
	{
		return Carbon::now()->format('ymdhms');
	}
}
