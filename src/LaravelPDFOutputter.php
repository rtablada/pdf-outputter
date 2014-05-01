<?php namespace Rtablada\PdfOutput;

use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Environment as View;
use Illuminate\Http\Response;

class LaravelPDFOutputter
{
	protected $manager;
	protected $view;
	protected $view;

	public function __construct(HTMLToPDFManager $manager, View $view, Response $response)
	{
		$this->manager = $manager;
		$this->view = $view;
		$this->response = $response;
	}

	public function buildPDFDownloadFromString($string)
	{
		$pdfPath = $this->manager->buildPDFFromString($view->__toString());

		return $this->response->download($pdfPath);
	}

	public function buildPDFDownloadFromView($viewName, $data = array(), $mergeData = array())
	{
		$view = $view->make($viewName, $data, $mergeData);

		return $this->buildPDFDownloadFromString($view->render());
	}
}
