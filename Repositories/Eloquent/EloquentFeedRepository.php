<?php namespace Modules\Feeds\Repositories\Eloquent;

use Facebook\FacebookRequestException;
use League\Flysystem\Exception;
use Modules\Feeds\Repositories\FeedRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EloquentFeedRepository extends EloquentBaseRepository implements FeedRepository
{

    protected $rssDirectory = "storage/app/rss/";

    //    All et find sont overloadés
//    car ce model ne nécessite pas de traductions

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param  mixed  $data
     * @return object
     */
    public function create($data)
    {

       if (!$feed = $this->model->create($data)) return false;
        try {
            $this->getRSS($feed);
        }
        catch (\Exception $e)   {

            $this->destroy($feed);

dd($e);
            return false;

        }
       //$this->getRSS($feed);

       return $feed;

    }


    /**
     * @param  Model $feed
     * @return mixed
     */
    public function destroy($feed)
    {
        $this->deleteRSS($feed);

        return $feed->delete();
    }

    public function getStatuses() {

        $statuses = [];

        foreach ($this->model->statuses as $id=>$name) {

            $statuses[$id] = trans('feeds::feeds.status.'.$name);

        }

        return $statuses;
    }

    /**
     * Crée un RSS a partir du flux (fb ou non) et le store
     * @param $feed : feed got from the database
     * @return string
     * @throws \Facebook\FacebookRequestException
     */
    public function getRSS($feed)
    {

        //get directly the rss in the storage if exists
        if (Storage::exists($this->rssDirectory.'feed_' . $feed->id . '.xml')) {
            return Storage::get($this->rssDirectory.'feed_' . $feed->id . '.xml');
        }

        //if it's a facebook page : convert to rss
        if ($feed->is_facebook) {

            $url = parse_url($feed->url);

            $page = $url['path'];


            $application = array(
                'app_id' => getenv('FACEBOOK_APP_ID'),
                'app_secret' => getenv('FACEBOOK_APP_SECRET')
            );


            FacebookSession::setDefaultApplication($application['app_id'], $application['app_secret']);

            $session = new FacebookSession($application['app_id'].'|'.$application['app_secret']);



                $request = new FacebookRequest(
                    $session,
                    'GET',
                    '/' . $page . '/feed'
                );
                $response = $request->execute();

                $graphObject = $response->getGraphObject();

                $facebook_feed = $graphObject->asArray();




            $xml = '
<?xml version="1.0"?>
<rss version="2.0">
<channel>
<title>RSS '.$feed->name.'</title>
<description></description>
';

            foreach ($facebook_feed['data'] as $entry) {


                //récupere l'id de la page et l'id du post
                $ids = explode('_', $entry->id);


                if  (isset($entry->message))  { //si il y a un message


                    $title = Str::words($entry->message, 20, '...'); //limit mots
                    $pubDate = date("D, d M Y H:i:s T", strtotime($entry->created_time));


                    $item = '
             <item>
             <title><![CDATA[' . $title . ']]></title>
            <link>http://www.facebook.com/' . $ids[0] . '/posts/' . $ids[1] . '</link>
            <pubDate>' . date("r", strtotime($pubDate)) . '</pubDate>
            </item>';

                    $xml .= $item;


                }


            }

            $xml .= '</channel></rss>';

        } //if it's a classic rss
        else {
            $context = stream_context_create(array(
                'http' => array(
                    'user_agent' => 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11'
                )
            ));

            $xml = @file_get_contents($feed->url, FALSE, $context);

        }

        // if the file is not xml return false
        if (!substr($xml, 0, 5) == "<?xml") return false;


        $xml = trim($xml);

        Storage::put(
            $this->rssDirectory.'feed_' . $feed->id . '.xml',
            $xml
        );


        return $xml;

    }

    public function deleteRSS($feed)  {

        $file = $this->rssDirectory.'feed_'.$feed->id.'.xml';

        if (Storage::exists($file)) Storage::delete($file);

    }

    /**
     * Refresh all feeds file
     */
    public function refreshAll() {


        $feeds = $this->model->active()->get();

        foreach ($feeds as $feed) {

            $this->deleteRSS($feed);

            $this->getRSS($feed);

        }


    }

    public function all_entries_merged($start_at=0,$max_entries=100)
    {

        // Get all feed entries
        $entries = array();

        $feeds = $this->model->active()->get();

        foreach ($feeds as $feed) {


                $xml = $this->getRSS($feed);


            // Convert string to a SimpleXML object
            if ($xml) {

                $xml = simplexml_load_string($xml);


                $the_feed = $xml->xpath('/rss//item');


                foreach ($the_feed as $key => $item) {

                    $title = trim($item->title);
                    $title_nb_words = count(explode(' ', $title));

                    //si pas de titre ou - de 2 mots on vire.
                    if (empty($title) || $title_nb_words < 2)
                        unset($the_feed[$key]);
                    else
                        //sinon rajout du nom du flux
                        $the_feed[$key]->sexy_feed_title = $feed['name'];

                }


                $entries = array_merge($entries, $the_feed);
            }


        }

        // Sort feed entries by pubDate (desc)
        usort($entries, function ($x, $y) {
            return strtotime($y->pubDate) - strtotime($x->pubDate);
        });

        //nettoye le tableau
        //supprime les xmlelements pr le serializer (cache)
        //limit $max_entries entrees
        //
        foreach ($entries as $key => $entry) {

            //limit
            if ($key >= $max_entries || $key<$start_at) {

                unset($entries[$key]);

            } else {
                $entries[$key] = (array) $entry;

                foreach ($entry as $k => $v) {
                    $entries[$key][$k] = (string)$v;
                }


            }


        }

        return $entries;

    }

}
