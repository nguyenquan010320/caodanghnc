<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Slug extends Model
{
  use SoftDeletes;
  public $timestamps = true;

  public static function getRecord($deleted=false) {
    $query = Slug::query();
    if($deleted){ $query = $query->withTrashed(); }
    $query = $query->orderBy('id', 'desc');
    return $query->get()->toArray();
  }

  public static function getRecordReindex($deleted=false) {
    $data = Slug::getRecord($deleted);
    $dataNew = [];
    foreach ($data as $d) {
      $dataNew[$d['link']] = $d;
    }
    return $dataNew;
  }
}
