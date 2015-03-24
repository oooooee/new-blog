<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Spider extends Model {

	//
    protected $table = 'spider_posts';

    protected $fillable = ['id', 'title', 'content', 'url', 'post_at', 'category', 'from', 'is_send'];

    public function add_new($spider){

        $rec = static::where('id', '=', $spider['id'])->get();

        if (!count($rec)) {
            static::create($spider);
            return true;
        } else {
            return false;
        }
    }
}
