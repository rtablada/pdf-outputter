<?php namespace Rtablada\PdfOutput;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Response;

class PDFOutputterServerProvider extends ServiceProvider
{

	public function boot()
	{
		$this->package('rtablada/pdf-output');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('pdf-output.outputter', function($app) {
			return new PdfOutputter;
		});

		$this->app->singleton('pdf-output.manager', function($app) {
			$temp_directory = $this->app['config']->get('pdf-output::temp_directory');

			return new HTMLToPDFManager($temp_directory, $app['pdf-output.outputter'], $app['files']);
		});

		$this->app->singleton('pdf-output.response-outputter', function($app) {
			HTMLToPDFManager $manager, Filesystem $file, View $view, Response $response
			return new LaravelPDFOutputter($app['pdf-output.manager'], $app['view'], new Response);
		});
	}

	public function provides()
	{
		return array(
			'pdf-output.outputter',
			'pdf-output.manager',
			'pdf-output.response-outputter',
		);
	}

}
