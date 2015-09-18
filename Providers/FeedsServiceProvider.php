<?php namespace Modules\Feeds\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Validator;
//use Modules\Feeds\Entities\Feed;
//use Modules\Feeds\Repositories\Eloquent\EloquentFeedRepository;

class FeedsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Validator::extend('rss', function($attribute, $value, $parameters) {
//
//            $feed = new EloquentFeedRepository(new Feed());
//            return $feed->getRSS();
//        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();

        $this->app->make('view')->composer('home', 'Modules\Feeds\Composers\Frontend\HomeViewComposer');
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

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Feeds\Repositories\FeedRepository',
            function () {
                $repository = new \Modules\Feeds\Repositories\Eloquent\EloquentFeedRepository(new \Modules\Feeds\Entities\Feed());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Feeds\Repositories\Cache\CacheFeedDecorator($repository);
            }
        );
// add bindings





    }
}
