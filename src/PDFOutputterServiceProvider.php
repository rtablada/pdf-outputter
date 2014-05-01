<?php namespace Rtablada\PdfOutput;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Response;

class PDFOutputterServerProvider extends ServiceProvider
{

	public function boot()
	{
		$this->app['config']->package('rtablada/pdf-output', __DIR__.'/config', 'pdf-output');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->package('rtablada/pdf-output');

		$this->app->singleton('pdf-output.outputter', function($app) {
			return new PdfOutputter;
		});

		$this->app->singleton('pdf-output.manager', function($app) {
			$tempDir = $this->app['config']->get('pdf-output::temp_directory')
				?: storage_path('pdf-output');

			$file = $app['files'];
			if (!$file->exists($tempDir)) {
				$app['files']->makeDirectory($tempDir, 0777, true);
			}

			return new HTMLToPDFManager($tempDir, $app['pdf-output.outputter'], $file);
		});

		$this->app->singleton('pdf-output.response-outputter', function($app) {
			return new LaravelPDFOutputter($app['pdf-output.manager'], $app['files'], $app['view'], $app->make('Illuminate\Support\Facades\Response'));
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
