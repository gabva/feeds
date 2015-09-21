<?php namespace Modules\Feeds\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Feed extends Model
{
    use PresentableTrait;



    protected $table = 'feeds';
    protected $fillable = ['id','name','url','status','comment'];
    protected $presenter = 'Modules\Feeds\Presenters\FeedPresenter';
    protected $appends = ['is_facebook'];

    public $statuses = [

        0 => 'pending',
        1 => 'published',
        2 => 'unpublished'

    ];



    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }

    public function getIsFacebookAttribute()
    {
        $url = parse_url($this->url);
        return ($url['host'] == 'www.facebook.com');

    }

}
