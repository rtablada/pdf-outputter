<?php namespace Rtablada\PdfOutput;

use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Environment as View;
use Illuminate\Support\Facades\Response;

class LaravelPDFOutputter
{
	protected $manager;
	protected $file;
	protected $view;
	protected $response;

	public function __construct(HTMLToPDFManager $manager, Filesystem $file, View $view, Response $response)
	{
		$this->manager = $manager;
		$this->view = $view;
		$this->file = $file;
		$this->response = $response;
	}

	public function buildPDFDownloadFromString($string)
	{
		$pdfPath = $this->manager->buildPDFFromString($string);

		while (!$this->file->exists($pdfPath)) {
			sleep(0.01);
		}

		return $this->response->download($pdfPath);
	}

	public function buildPDFDownloadFromView($viewName, $data = array(), $mergeData = array())
	{
		$view = $this->view->make($viewName, $data, $mergeData);

		return $this->buildPDFDownloadFromString($view->render());
	}
}
