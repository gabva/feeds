<?php namespace Modules\Feeds\Console\Commands;

use Illuminate\Console\Command;
use Modules\Feeds\Entities\Feed;
use Modules\Feeds\Repositories\Eloquent\EloquentFeedRepository;

class Refresh extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'feeds:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh feeds';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $feeds = new EloquentFeedRepository(new Feed());

        $feeds->refreshAll();

        $this->comment('Feed refreshing ok');
    }

}