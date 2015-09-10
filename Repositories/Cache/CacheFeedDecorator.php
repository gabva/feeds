<?php namespace Modules\Feeds\Repositories\Cache;

use Modules\Feeds\Repositories\FeedRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheFeedDecorator extends BaseCacheDecorator implements FeedRepository
{
    public function __construct(FeedRepository $feed)
    {
        parent::__construct();
        $this->entityName = 'feeds.feeds';
        $this->repository = $feed;
    }

    public function makeRSSFromFacebookPage($url) {

        return $this->cache
            ->tags($this->entityName, 'global')
            ->remember("{$this->locale}.{$this->entityName}.feed{$url}", $this->cacheTime,
                function () use ($url) {
                    return $this->repository->makeRSSFromFacebookPage($url);
                }
            );

    }

    public function all_entries_merged() {
        return $this->cache
            ->tags($this->entityName, 'global')
            ->remember("{$this->locale}.{$this->entityName}.all_entries_merged", $this->cacheTime,
                function () {
                    return $this->repository->all_entries_merged();
                }
            );
    }
}
