<?php

	namespace Webartisans\Utilities;

	use Illuminate\Support\ServiceProvider;

	class UtilitiesServiceProvider extends ServiceProvider {

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
			$this->package('webartisans/utilities');
		}

		/**
		 * Register the service provider.
		 *
		 * @return void
		 */
		public function register()
		{
			
			$this->registerLanguage();
			$this->registerURL();

		}

		/**
		 * Register Language Class
		 *
		 * @return void
		 */
		public function registerLanguage()
		{

			$this->app['language'] = $this->app->share(function($app)
	        {

	            return new Libraries\Language\Language;
	            
	        });

		}

		/**
		 * Register UtilitiesURL Class
		 *
		 * @return void
		 */
		public function registerURL()
		{

			$this->app['utilitiesurl'] = $this->app->share(function($app)
	        {

	            return new Libraries\UtilitiesURL\UtilitiesURL;
	            
	        });

		}

		/**
		 * Get the services provided by the provider.
		 *
		 * @return array
		 */
		public function provides()
		{
			return array('language', 'utilitiesurl');
		}

	}