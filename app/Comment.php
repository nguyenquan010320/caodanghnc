<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
  use SoftDeletes;
  public $timestamps = true;

  public static function getRecord($deleted=false,$post=null,$active=null,$date=null) {
    $query = Comment::query();
    if($deleted){ $query = $query->withTrashed(); }
    if(!empty($post)){ $query = $query->where('post', $post);}
    if(!is_null($active)){ $query = $query->where('active', $active);}
    // if(!empty($date)){ $query = $query->whereRaw('Date(created_at) <= DATE_ADD(CURDATE(), INTERVAL -'.$date.' DAY)');}
    $query = $query->orderBy('id', 'desc');
    return $query->get()->toArray();
  }
}
