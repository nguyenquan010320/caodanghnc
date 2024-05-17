<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Faq extends Model
{
  use SoftDeletes;
  public $timestamps = true;

  public static function getRecord($deleted=false,$active=null,$date=null) {
    $query = Faq::query();
    if($deleted){ $query = $query->withTrashed(); }
    if(!is_null($active)){ $query = $query->where('active', $active);}
    if(!empty($date)){ $query = $query->whereRaw('Date(created_at) <= DATE_ADD(CURDATE(), INTERVAL -'.$date.' DAY)');}
    $query = $query->orderBy('id', 'desc');
    return $query->get()->toArray();
  }

  public static function getRecordReindex($deleted=false,$active=null,$date=null) {
    $data = Faq::getRecord($deleted,$active,$date);
    $dataNew = [];
    foreach ($data as $d) {
      $dataNew[$d['id']] = $d;
    }
    return $dataNew;
  }
}
