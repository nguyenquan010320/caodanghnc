<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Helpers\Helper;

class Category extends Model
{
  use \App\Http\Traits\BindsDynamically;
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  public $timestamps = true;
  
  public static function getRecord($lang='',$deleted=false,$type='',$limit=null) {
    $query = new Category;
    $query->bind('mysql', $lang.'categories'); 
    if($deleted){ $query = $query->withTrashed(); }
    if(!empty($type)){ $query = $query->where('type',$type); }
    if(!empty($limit)){ $query = $query->limit($limit); }

    $query = $query->orderBy(DB::raw('ISNULL(`order`)', 'ASC'))->orderBy(DB::raw('`order`', 'ASC'))->orderBy(DB::raw('`title`', 'ASC'));
    return $query->get()->toArray();
  }

  public static function getRecordReindex($lang='',$deleted=false,$type='',$limit=null) {
    $data = Category::getRecord($lang,$deleted,$type,$limit);
    $newData = [];
    $post = Post::getRecord($lang);
    foreach ($data as $d) {
      if($d['parent']!=$d['id']){
        if(empty($d['link'])){ $d['link'] = '/'.Helper::getPathFromString($d['title']).'-2523'.$d['id']; }
        if(empty($d['img'])) { $d['img'] = '/public/upload/noimage.jpg'; }
        if(empty($d['img_thumb'])) { $d['img_thumb'] = str_replace('/upload/', '/thumbs/', $d['img']); }
        $d['img_other'] = json_decode($d['img_other'],true);
        $d['categoryParent'] = Category::getAllParentIdIncludeSelf($lang,$d['id'],$data);
        $d['categoryChild'] = Category::getAllChildIdIncludeSelf($lang,$d['id'],$data);
        $d['child'] = [];
        foreach ($data as $d2){
          if($d2['parent'] == $d['id']){
            $d['child'][] = $d2['id'];
          }
        }
        $d['childCount'] = count($d['child']);
        $d['hasChild'] = ($d['childCount'] > 0);
        $d['postId'] = array();
        foreach ($post as $p){
          if(Helper::checkArrayInArray(explode(',', $p['category']),$d['categoryChild'])){
            $d['postId'][] = $p['id'];
            if($d['img'] == '/public/upload/noimage.jpg'){
              if(!empty($p['img'])){
                $d['img'] = $p['img'];
                $d['img_thumb'] = str_replace('/upload/', '/thumbs/', $d['img']);
              }
            }
          }
        }
        $d['postCount'] = sizeof($d['postId']);
        $newData[$d['id']] = $d;
      }
    }
    return $newData;
  }

  public static function getAllParentIdIncludeSelf($lang='',$catId=0, $category=[]) {
    if(empty($category)){
      $category = Category::getRecord($lang);
    }
    $data = [(int)$catId];
    foreach ($category as $k=>$c) {
      if($c['id'] == $catId){
        $data = array_merge(Category::getAllParentIdIncludeSelf($lang,$c['parent'],$category),$data);
      }
    }
    return $data;
  }

  public static function getAllChildIdIncludeSelf($lang='',$catId=0, $category=[]) {
    if(empty($category)){
      $category = Category::getRecord($lang);
    }
    $data = [(int)$catId];
    foreach ($category as $k=>$c) {
      if($c['parent'] == $catId){
        $data = array_merge($data, Category::getAllChildIdIncludeSelf($lang,$c['id'],$category));
      }
    }
    return $data;
  }


}
