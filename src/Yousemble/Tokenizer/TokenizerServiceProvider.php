<?php namespace Yousemble\Tokenizer;

use Illuminate\Support\ServiceProvider;

class TokenizerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('yousemble/tokenizer');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('Yousemble\Tokenizer\Contracts\Tokenizer', 'Yousemble\Tokenizer\Tokenizer');
    $this->app->bind('Yousemble\Tokenizer\Contracts\TokenRepository', 'Yousemble\Tokenizer\EloquentTokenRepository');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
