<?php namespace Modules\Feeds\Http\Controllers\Admin;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Modules\Feeds\Entities\Feed;
use Modules\Feeds\Http\Requests\FeedRequest;
use Modules\Feeds\Repositories\FeedRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class FeedController extends AdminBaseController
{
    /**
     * @var FeedRepository
     */
    private $feed;

    public function __construct(FeedRepository $feed)
    {
        parent::__construct();

        $this->feed = $feed;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       $feeds = $this->feed->all();

        return view('feeds::admin.feeds.index', compact('feeds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $statuses = $this->feed->getStatuses();

        return view('feeds::admin.feeds.create',compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(FeedRequest $request)
    {
        $this->feed->create($request->all());

        Flash::success(trans('feeds::feeds.messages.feed created'));

        return redirect()->route('admin.feeds.feed.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Feed $feed
     * @return Response
     */
    public function edit(Feed $feed)
    {
        $statuses = $this->feed->getStatuses();

        return view('feeds::admin.feeds.edit', compact('feed','statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Feed $feed
     * @param  Request $request
     * @return Response
     */
    public function update(Feed $feed, Request $request)
    {
        $this->feed->update($feed, $request->all());

        Flash::success(trans('feeds::feeds.messages.feed updated'));

        return redirect()->route('admin.feeds.feed.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Feed $feed
     * @return Response
     */
    public function destroy(Feed $feed)
    {

        $this->feed->destroy($feed);

        Flash::success(trans('feeds::feeds.messages.feed deleted'));

        return redirect()->route('admin.feeds.feed.index');
    }
}
