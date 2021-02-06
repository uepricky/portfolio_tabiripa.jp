<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_post extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'post_main_id';

    public function tag_map()
    {
        return $this->belongsTo('App\Models\Tag_map');
    }
}
