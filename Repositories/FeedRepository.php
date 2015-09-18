<?php namespace Modules\Feeds\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface FeedRepository extends BaseRepository
{

    public function all();

    public function find($id);

    public function create($data);

    public function destroy($feed);

    public function getRSS($feed);

    public function deleteRSS($feed);

    public function refreshAll();

    public function all_entries_merged($start_at,$max_entries);

    public function getStatuses();
}
