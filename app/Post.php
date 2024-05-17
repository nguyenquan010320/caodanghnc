<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Site;
use App\Helpers\Helper;

class Post extends Model
{
  use \App\Http\Traits\BindsDynamically;
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  public $timestamps = true;

  public static function getRecord($lang='',$deleted=false,$keyword='',$order='',$active=1,$paging=0) {
    $query = new Post;
    $query->bind('mysql', $lang.'posts'); 
    $query = $query->whereNotNull('category');
    if($deleted){ $query = $query->withTrashed(); }
    if(!empty($limit)){ $query = $query->limit($limit); }
    if($active!=''){ $query = $query->where('active', $active); }
    if(!empty($keyword)){ 
      $query = $query->where(function($query) use ($keyword) {
        $query->where('title', 'like', '%' . $keyword . '%')
        ->orWhere('keyword', 'like', '%' . $keyword . '%')
        ->orWhere('desc', 'like', '%' . $keyword . '%')
        ->orWhere('desc_full', 'like', '%' . $keyword . '%');
      });
      $query->where('id', '>', 3);
    }
    if(!empty($order)){
      $order = explode(',',$order);
      foreach ($order as $o) {
        $o = trim($o);
        $query = $query->orderBy(DB::raw(explode(' ', $o)[0]), explode(' ', $o)[1]);
      }
    }
    if(empty($paging)){
      return $query->get()->toArray();
    }else{
      return $query->paginate($paging)->toArray();
    }
  }

  public static function getRecordById($lang='',$id='') {
    $query = new Post;
    $query->bind('mysql', $lang.'posts'); 
    $query = $query->whereNotNull('category');
    if(!empty($id)){ 
      $query = $query->where('id', $id);
    }
    return $query->get()->toArray();
  }

  public static function getRecordReindex($lang='',$category=[],$deleted=false,$keyword='',$order='ISNULL(`order`) ASC,`order` ASC,ISNULL(`price`) ASC,(`price`=0) ASC,`price` ASC',$active='') {
    $category = (empty($category)) ? Category::getRecordReindex($lang,true) : $category;
    $data = Post::getRecord($lang,$deleted,$keyword,$order,$active);
    $newData = [];
    foreach ($data as $d) {
        if($d['id'] != 4) {
        // unset($d['desc_full']); //bỏ bớt cho đỡ nặng cache
      }
      if(empty($d['link'])){ $d['link'] = '/'.Helper::getPathFromString($d['title']).'-3425'.$d['id']; }
      if(empty($d['img'])) { $d['img'] = '/public/upload/noimage.jpg'; }
      if(empty($d['img_thumb'])) { $d['img_thumb'] = str_replace('/upload/', '/thumbs/', $d['img']); }
      if(!empty($d['video'])) { $d['video'] = str_replace('youtu.be/', 'www.youtube.com/watch?v=', $d['video']);}
      $d['img_other'] = json_decode($d['img_other'],true);
      $d['variant'] = json_decode($d['variant'],true);
      if($d['img'] == '/public/upload/noimage.jpg' && isset($d['img_other'][0][0])){
        $d['img'] = $d['img_other'][0][0];
        $d['img_thumb'] = str_replace('/upload/', '/thumbs/', $d['img']);
      }
      $d['category'] = explode(',', $d['category']);
      $d['price_real'] = (empty($d['price_promo'])) ? $d['price'] : $d['price_promo'];
      if(!empty($d['category']) && isset($category[$d['category'][0]])){
        $d['categoryInfo'] = $category[$d['category'][0]];
        $d['categoryParent'] = [];
        foreach ($d['category'] as $c) {
          $d['categoryParent'] = array_merge($d['categoryParent'],Category::getAllParentIdIncludeSelf($lang,$c,$category));
        }
        $newData[$d['id']] = $d;
      }
    }
    return $newData;
  }
}
