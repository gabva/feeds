<?php

namespace Modules\Feeds\Composers\Frontend;

use Illuminate\Contracts\View\View;
use Modules\Core\Contracts\Setting;
use Modules\Feeds\Repositories\FeedRepository;

class HomeViewComposer
{
    public function __construct(FeedRepository $feed, Setting $setting)
    {
        $this->feed = $feed;
        $this->setting = $setting;
    }

    public function compose(View $view)
    {
        $view->with('feeds',$this->feed->all_entries_merged( 0,$this->setting->get('feeds::entries-per-page')));

    }


}