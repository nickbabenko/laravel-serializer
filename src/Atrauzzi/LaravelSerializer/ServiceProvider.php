<?php namespace Atrauzzi\LaravelSerializer {

	use Illuminate\Support\ServiceProvider as Base;
	//
	use Illuminate\Foundation\Application;
	use JMS\Serializer\Builder\CallbackDriverFactory;
	use JMS\Serializer\SerializerBuilder;
	use Doctrine\Common\Annotations\Reader;


	class ServiceProvider extends Base {

		public function boot() {
			//$this->package('atrauzzi/laravel-serializer', 'serializer');
		}

		public function register() {

			$this->app->singleton('JMS\Serializer\Serializer', function (Application $app) {

				/** @var \Illuminate\Config\Repository $config */
				$config = $app->make('Illuminate\Config\Repository');
				$serializerConfig = $config->get('serializer');

				return SerializerBuilder
					::create()
					->setCacheDir(storage_path('cache/serializer'))
					->setDebug($config->get('app.debug'))
					->addMetadataDir($serializerConfig['mappings']['directory'], $serializerConfig['mappings']['namespace'])
					->build()
				;

			});

		}

	}

}
