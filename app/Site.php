<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
  use \App\Http\Traits\BindsDynamically;

  public $timestamps = true;
  public static function getRecord($lang='') {
    $siteModel = new Site;
    $siteModel->bind('mysql', $lang.'sites'); 

    return $siteModel->where('deleted_at',null)
    ->get()
    ->toArray();
  }

  public static function getRecordReindex($lang='') {
    $data = Site::getRecord($lang);
    $newData = [];
    foreach ($data as $d) {
      $newData[$d['code']] = $d;
    }
    return $newData;
  }

  public static function getRecordReindexFrontEnd($lang='') {
    $data = Site::getRecord($lang);
    $newData = [];
    foreach ($data as $d) {
      $newData[$d['code']] = $d['value'];
    }
    return $newData;
  }

  public static function updateByCode($lang='',$code='',$value=''){
    if (empty($code)) {return false;}
    $siteModel = new Site;
    $siteModel->bind('mysql', $lang.'sites'); 
    return $siteModel->where('code',$code)->update(['value'=>$value]);
  }
}
