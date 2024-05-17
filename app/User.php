<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
  use Notifiable;
  use SoftDeletes;
  public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'password', 'remember_token',
    ];
    

    public static function getRecord($deleted=false,$active=null,$date=null) {
      $query = User::query();
      if($deleted){ $query = $query->withTrashed(); }
      if(!is_null($active)){ $query = $query->where('active', $active);}
      if(!empty($date)){ $query = $query->whereRaw('Date(created_at) <= DATE_ADD(CURDATE(), INTERVAL -'.$date.' DAY)');}
      $query = $query->orderBy('id', 'asc');
      return $query->get()->toArray();
    }

    public static function getRecordReindex($deleted=false,$active=null,$date=null) {
      $data = User::getRecord($deleted,$active,$date);
      $dataNew = [];
      foreach ($data as $d) {
        if($d['email'] != 'ihappy.asia@gmail.com' && $d['email'] != 'reset@website.com'){
          $dataNew[$d['id']] = $d;
        }
      }
      return $dataNew;
    }
  }
