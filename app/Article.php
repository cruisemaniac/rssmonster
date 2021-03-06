<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Article extends Model
{
	protected $fillable = ['status', 'subject', 'url', 'image_url', 'content', 'published'];
	protected $table = 'articles';
	protected $appends = array('category_id');

	public function feed()
	{
		return $this->belongsTo('App\Feed');
	}

	public function getCategoryIdAttribute()
	{
		return DB::table('articles')->join('feeds', 'articles.feed_id', '=', 'feeds.id')->where('articles.id', $this->id)->max('feeds.category_id');
	}
}

?>
