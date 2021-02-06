<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $primaryKey = 'post_main_id';

    public function budget()
	{
		return $this->belongsTo('App\Models\Budget');
    }
    
    public function term()
	{
		return $this->belongsTo('App\Models\Term');
    }
    
    public function tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }

    public function sub_post()
    {
        return $this->belongsTo('App\Models\Sub_post');
    }

    public function comment()
    {
        return $this->belongsTo('App\Models\comment');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
