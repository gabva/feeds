<?php namespace Modules\Feeds\Presenters;

use Laracasts\Presenter\Presenter;

class FeedPresenter extends Presenter
{

    public function status() {

        return trans('feeds::feeds.status.'.$this->entity->statuses[$this->entity->status]);

    }

}