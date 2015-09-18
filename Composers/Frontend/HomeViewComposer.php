<?php

namespace Modules\Feeds\Composers\Frontend;

use Illuminate\Contracts\View\View;
use Modules\Feeds\Repositories\FeedRepository;

class HomeViewComposer
{
    public function __construct(FeedRepository $feed)
    {
        $this->feed = $feed;
    }

    public function compose(View $view)
    {
        $view->with('feeds',$this->feed->all_entries_merged());
    }


}