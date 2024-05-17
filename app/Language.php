<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Language extends Model
{
  use SoftDeletes;
  public $timestamps = true;

  public static function getRecord($deleted=false,$active=null) {
    $query = Language::query();
    if($deleted){ $query = $query->withTrashed(); }
    if(!empty($active)){ $query = $query->where('active', $active);}
    return $query->get()->toArray();
  }

  public static function getRecordReindex($deleted=false,$active=null) {
    $data = Language::getRecord($deleted,$active);
    $dataNew = [];
    foreach ($data as $d) {
      $dataNew[$d['vi']] = $d;
      // $dataNew[$d['en']] = $d;
      // $dataNew[$d['ja']] = $d;
      // $dataNew[$d['ko']] = $d;
      // $dataNew[$d['zh']] = $d;
    }
    return $dataNew;
  }
}
