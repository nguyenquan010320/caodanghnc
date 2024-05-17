<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
  use SoftDeletes;
  public $timestamps = true;

  public static function getRecord($deleted=false,$active=null) {
    $query = Customer::query();
    if($deleted){ $query = $query->withTrashed(); }
    if(!empty($active)){ $query = $query->where('active', $active);}
    $query = $query->orderBy('id', 'desc');
    return $query->get()->toArray();
  }

  public static function getRecordReindex($deleted=false,$active=null) {
    $data = Customer::getRecord($deleted,$active);
    $dataNew = [];
    foreach ($data as $d) {
      $dataNew[$d['id']] = $d;
    }
    return $dataNew;
  }
}
