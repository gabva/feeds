<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/feeds'], function (Router $router) {
        $router->bind('feeds', function ($id) {
            return app('Modules\Feeds\Repositories\FeedRepository')->find($id);
        });
        $router->resource('feeds', 'FeedController', ['except' => ['show'], 'names' => [
            'index' => 'admin.feeds.feed.index',
            'create' => 'admin.feeds.feed.create',
            'store' => 'admin.feeds.feed.store',
            'edit' => 'admin.feeds.feed.edit',
            'update' => 'admin.feeds.feed.update',
            'destroy' => 'admin.feeds.feed.destroy',
        ]]);
// append

});
