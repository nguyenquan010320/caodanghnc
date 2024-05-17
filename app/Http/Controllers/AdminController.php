<?php

namespace App\Http\Controllers;
use Mail;
use Request;
use View;
use Hash;
use Auth;
use Cache;
use Excel;
use App\Helpers\Helper;

class AdminController extends Controller
{
  private $siteModel;
  private $categoryModel;
  private $postModel;
  private $commentModel;
  private $orderModel;
  private $faqModel;
  private $customerModel;
  private $slugModel;
  private $userModel;
  private $site;
  private $category;
  private $post;
  private $lang;
  private $languages;
  protected $excelData;

  public function __construct()
  {
    $this->middleware('auth');

    $this->siteModel = app("App\Site");
    $this->categoryModel = app("App\Category");  
    $this->postModel = app("App\Post");  
    $this->commentModel = app("App\Comment");  
    $this->orderModel = app("App\Order");  
    $this->faqModel = app("App\Faq");  
    $this->customerModel = app("App\Customer");  
    $this->languageModel = app("App\Language");  
    $this->slugModel = app("App\Slug");  
    $this->userModel = app("App\User");  
    $this->lang='';
    $this->langShow='';

    // Nhận biết ngôn ngữ
    if(!empty(LANGUAGES)){
      $languageSetting = unserialize(LANGUAGES);
      $textLengh = 7;
      if (starts_with(Request::root(), 'https://')){ $textLengh = 8; }
      if (starts_with(Request::root(), 'https://www.')){ $textLengh = 12; }
      if (starts_with(Request::root(), 'http://www.')){ $textLengh = 11; }
      if (starts_with(Request::root(), 'http://') || starts_with(Request::root(), 'https://')){
        foreach ($languageSetting as $o => $k) {
          if(substr(Request::root(), $textLengh) == $o && $k!='vi'){
            $this->lang=$k;
            // $this->langShow='en';
          }
        }
      }
    }

    $this->site = Cache::rememberForever($this->lang.'admin.construct.site', function () {
      return $this->siteModel->getRecordReindex($this->lang);
    });
    $this->category = Cache::rememberForever($this->lang.'admin.construct.category', function () {
      return $this->categoryModel->getRecordReindex($this->lang);
    });
    $this->post = Cache::rememberForever($this->lang.'admin.construct.post', function () {
      return $this->postModel->getRecordReindex($this->lang,$this->category,false,'','id DESC');
    });
    $this->order = Cache::rememberForever('admin.construct.order', function () {
      return $this->orderModel->getRecordReindex();
    });
    $this->faq = Cache::rememberForever('admin.construct.faq', function () {
      return $this->faqModel->getRecordReindex();
    });
    $this->customer = Cache::rememberForever('admin.construct.customer', function () {
      return $this->customerModel->getRecordReindex();
    });
    $this->languages = Cache::rememberForever('admin.construct.languages', function () {
      return $this->languageModel->getRecordReindex();
    });
    $this->slug = Cache::rememberForever('admin.construct.slug', function () {
      return $this->slugModel->getRecordReindex();
    });
    $this->user = Cache::rememberForever('admin.construct.user', function () {
      return $this->userModel->getRecordReindex();
    });

    View::share('site', $this->site);
    View::share('category', $this->category);
    View::share('post', $this->post);
    View::share('order', $this->order);
    View::share('faq', $this->faq);
    View::share('customer', $this->customer);
    View::share('currentLanguage', $this->lang);
    View::share('lang', $this->langShow);
    View::share('languages', $this->languages);
  }

  public function index(){
    $data = [];
    $data['orderWaiting'] = sizeof($this->orderModel->getRecord(false,0));
    $data['faqWaiting'] = sizeof($this->faqModel->getRecord(false,0));
    return view("admin.adIndex",$data);
  }

  public function adUploadExcel() {
    $data = [];
    return view("admin.adUploadExcel",$data);
  }

  public function adUploadExcelAjax() {
    $data = [];
    if(!empty(Request::get('fileExcel'))){
      $fileExcel = Request::get('fileExcel');
      if (strpos($fileExcel, 'http') !== false) {
        $fileExcel = parse_url($fileExcel, PHP_URL_PATH);
      }
    }
    Excel::load($fileExcel, function($reader) {
      $this->excelData = $reader->toArray(); 
    });

    $data['excel'] = $this->excelData;
    if(empty(Request::get('nhapvao'))){
      return view("admin.adUploadExcelAjax",$data);
    }else{
      $dataNew = [];
      foreach ($data['excel'] as $k=>$b) {
        if(!empty($b) && is_array($b)){
          $dataNew[$k] = [];
          foreach ($b as $kbc => $bc) {
            if(!empty($kbc)){
              $dataNew[$k][$kbc] = $bc;
            }
          }
          if(!empty($dataNew[$k]['ma_van_don'])){
            // $dataNew[$k]['nsxbaohanhden'] = date('Y-m-d',strtotime("+ ".$dataNew[$k]['thoigianbaohanh']." years",strtotime($dataNew[$k]['nsxbaohanhtu'])));
            // $dataNew[$k]['status'] = 'kho';
            $dataNew[$k]['created_at'] = date('Y-m-d H:i:s');
          }else{
            unset($dataNew[$k]);
          }
        }
      }
      var_dump($dataNew); 
      if(!empty($dataNew)){
        // $this->baohanhModel->insert($dataNew);
      }
    }
  }

  public function adSetting(){
    $data = [];
    $data['languageEdit'] = $this->languageModel->getRecord();
    return view("admin.adSetting",$data);
  }

  public function adFileExplorer() {
    $data = [];
    return view("admin.adFileExplorer",$data);
  }

  public function adStatistic() {
    $data = [];
    return view("admin.adStatistic",$data);
  }

  public function adOrder() {
    $data = [];
    $post = $this->orderModel->getRecord(true);
    $data['catId']=0;
    // Separate to groups by status
    $data['postList'] = [];
    $data['postList']['Chờ xử lý'] = [];
    $data['postList']['Đã hoàn tất'] = [];
    $data['postList']['Đã xóa'] = [];
    foreach ($post as $k=>$p) {
      if(!empty($p['deleted_at'])){
        $data['postList']['Đã xóa'][$k] = $p;
      }else{
        if($p['active']==1){
          $data['postList']['Đã hoàn tất'][$k] = $p;
        }
        if($p['active']==0){
          $data['postList']['Chờ xử lý'][$k] = $p;
        }
      }
    }
    return view("admin.adOrder",$data);
  }

  public function adCustomer() {
    $data = [];
    $data['customer'] = $this->customerModel->getRecordReindex();
    return view("admin.adCustomer",$data);
  }

  public function adFaq() {
    $data = [];
    $post = $this->faqModel->getRecord(true);
    $data['catId']=0;
    // Separate to groups by status
    $data['postList'] = [];
    $data['postList']['Chờ xử lý'] = [];
    $data['postList']['Đã hoàn tất'] = [];
    $data['postList']['Đã xóa'] = [];
    foreach ($post as $k=>$p) {
      if(!empty($p['deleted_at'])){
        $data['postList']['Đã xóa'][$k] = $p;
      }else{
        if($p['active']==1){
          $data['postList']['Đã hoàn tất'][$k] = $p;
        }
        if($p['active']==0){
          $data['postList']['Chờ xử lý'][$k] = $p;
        }
      }
    }
    return view("admin.adFaq",$data);
  }

  public function adUser() {
    $data = [];
    $data['postList'] = $this->userModel->getRecordReindex();
    return view("admin.adUser",$data);
  }

  public function adCategory($id) {
    $data = [];
    $data['id']=$id;
    $category = ['new'=> new $this->categoryModel];
    $category['new']['type'] = $this->category[$id]['type'];
    $category += $this->category;
    $data['category'] = $category;
    return view("admin.adCategory",$data);
  }

  public function adPost($catId) {
    $data = [];
    $data['catId']=$catId;
    $post = $this->post;

    // Filter by Category
    if(!empty(Request::get('category'))){
      $categoryFilter = Request::get('category');
      foreach ($post as $k2=>$p2) {
        if(!in_array($categoryFilter, $p2['categoryParent'])){
          unset($post[$k2]);
        }
      }
    }

    // Separate to groups by status
    $data['postList'] = [];
    $data['postList']['active'] = [];
    $data['postList']['inactive'] = [];
    // $data['postList']['deleted'] = [];
    foreach ($post as $k=>$p) { if(in_array($catId, $p['categoryParent'])){
      if(!empty($p['deleted_at'])){
        // $data['postList']['deleted'][$k] = $p;
      }else{
        if($p['active']==1){
          $data['postList']['active'][$k] = $p;
        }
        if($p['active']==0){
          $data['postList']['inactive'][$k] = $p;
        }
      }
    }}
    return view("admin.adPost",$data);
  }

  public function adPostEdit($catId,$id) {
    $data = [];
    if(empty($id)){
      $data['p'] = new $this->postModel;
    }else{
      $data['p'] = $this->post[$id];
      $data['p']['desc_full'] = '';
      $itemFromDB = $this->postModel->getRecordById($this->lang,$data['p']['id']);
      if(isset($itemFromDB[0]) && isset($itemFromDB[0]['desc_full'])){
        $data['p']['desc_full'] = $itemFromDB[0]['desc_full'];
      }
    }

    if(!empty(Request::get('copy'))){
      $data['p'] = $this->post[Request::get('copy')];
      $data['p']['desc_full'] = '';
      $itemFromDB = $this->postModel->getRecordById($this->lang,$data['p']['id']);
      if(isset($itemFromDB[0]) && isset($itemFromDB[0]['desc_full'])){
        $data['p']['desc_full'] = $itemFromDB[0]['desc_full'];
      }      
      $data['p']['id'] = '';
    }
    $data['catId'] = $catId;
    if($this->category[$data['catId']]['type']=='product'){return view("admin.adProductEdit",$data);}
    if($this->category[$data['catId']]['type']=='gallery'){return view("admin.adGalleryEdit",$data);}
    return view("admin.adPostEdit",$data);
  }

  public function adComment() {
    $data = [];
    $post = $this->commentModel->getRecord(true);
    $data['catId']=0;
    // Separate to groups by status
    $data['postList'] = [];
    $data['postList']['Chưa duyệt'] = [];
    $data['postList']['Đã duyệt'] = [];
    $data['postList']['Đã xóa'] = [];
    foreach ($post as $k=>$p) {
      if(!empty($p['deleted_at'])){
        $data['postList']['Đã xóa'][$k] = $p;
      }else{
        if($p['active']==1){
          $data['postList']['Đã duyệt'][$k] = $p;
        }
        if($p['active']==0){
          $data['postList']['Chưa duyệt'][$k] = $p;
        }
      }
    }
    return view("admin.adComment",$data);
  }

  public function updateDataFrontEnd() {
    if (Request::isMethod('post')) {
      $info = json_decode(Request::get('json_data'));
      foreach ($info as $f) {
        $this->siteModel->updateByCode($this->lang,$f->name, str_replace("\\", "\\\\", $f->value));
      }
      Cache::flush();
      echo 1;
    }
  }

  public function updateDataElement() {
    if (Request::isMethod('post')) {
      $element = Request::get('element');
      $info = json_decode(Request::get('json_data'));
      $data = [];
      $imgOther = [];
      $hasImgOther = false;
      $variant = [];
      foreach ($info as $f) {
        $value = str_replace('../public/', '/public/', $f->value);
              // img1 img2 img3...
        if(substr($f->name, 0,3) == 'img' && strlen($f->name) > 3 && $f->name!='img_cover' && $f->name!='img_cover_xs'){
          $hasImgOther = true;
          if(!empty($value)){
            foreach ($info as $f2) {
              if($f2->name == 'title_'.$f->name){
                $title = $f2->value;
              }
            }
            if(!empty($title)){
              $imgOther[] = [str_replace(' ', '%20', $value), $title];
            }else{
              $imgOther[] = [str_replace(' ', '%20', $value), $data['title']];
            }
          }
        }elseif(substr($f->name, 0,7) == 'variant' && strlen($f->name) > 7){
          $key = explode('_', $f->name);
          if(!empty($key[1]) && !empty($key[2])){
            if(!isset($variant[$key[2]])){
              $variant[$key[2]] = [];
            }
            $variant[$key[2]][$key[1]] = $value;
          }
        }elseif(substr($f->name, 0,6) == 'title_' && strlen($f->name) > 6){
          
        }else{
          if(isset($data[$f->name])){
            $data[$f->name] .= ','.$value;
          }        else{
            $data[$f->name] = $value;
          }
        }
      }

      if(!empty($variant)){
        foreach ($variant as $k => &$v) {
          if(empty($v) || empty($v['title'])){
            unset($variant[$k]);
          }
          $v['price'] = (empty($v['price'])) ? '0' : preg_replace("/[^0-9]/","",$v['price']);
        }
      }

      $id = $data['id'];
      unset($data['id']);
      unset($data['_wysihtml5_mode']);

      if(Request::get('active') !== null){
        $data['active'] = Request::get('active');
      }
      if($element == 'category' || $element == 'post'){
        if(!empty($data['img'])){
          $data['img'] = str_replace(' ', '%20', $data['img']);
          $data['img_thumb'] = str_replace('/upload/', '/thumbs/', $data['img']);
        }else{
          // $data['img'] = '/public/upload/noimage.jpg';
        }

        if(!empty($data['link'])){
          $data['link'] = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($data['link'], ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
          if(substr($data['link'], 0,1) != '/'){
            $data['link'] = '/'.$data['link'];
          }
        }
      }

      $this->categoryModel->bind('mysql', $this->lang.'categories'); 
      $this->postModel->bind('mysql', $this->lang.'posts'); 

      if($element == 'category'){
        if(!empty($id) && Request::get('delete')){
          $this->categoryModel->whereId($id)->delete();
        }elseif(!empty($id) && Request::get('restore')){
          $this->categoryModel->withTrashed()->whereId($id)->restore();
        }else{
          if(empty($data['order'])) { $data['order'] = 9999; }
          if($hasImgOther){
            $data['img_other'] = json_encode($imgOther);
          }
          if(empty($id)){
            $data['created_at'] = date('Y-m-d H:i:s');
            if(!empty($data['title'])){
              $id = $this->categoryModel->insertGetId($data);
            }
          }else{
            $this->categoryModel->whereId($id)->update($data);
          }
          //update slug
          if(isset($data['link'])){
            if(isset($this->slug[$data['link']])){
              $this->slugModel->whereId($this->slug[$data['link']]['id'])->update(['type'=>'category','item'=>$id]);
            }else{
              $this->slugModel->insert(['link'=>$data['link'],'type'=>'category','item'=>$id]);
            }
          }
        }
      }

      if($element == 'post'){
        if(!empty($id) && Request::get('delete')){
          $this->postModel->whereId($id)->delete();
        }
        elseif(!empty($id) && Request::get('restore')){
          $this->postModel->withTrashed()->whereId($id)->restore();
        }else{
          if(isset($data['desc_full'])){
            $data['desc_full'] = Helper::addAlt(html_entity_decode($data['desc_full']),$data['title']);
          }
          if(isset($data['spec'])){
            $data['spec'] = Helper::addAlt(html_entity_decode($data['spec']),$data['title']);
          }
          if(isset($data['desc'])){
            if(isset($data['desc_full']) && Helper::checkEmptyString($data['desc'])){
              $data['desc'] = Helper::readMore($data['desc_full']);
            }
            $data['desc'] = html_entity_decode($data['desc']);
          }
          if(empty($data['order'])) { $data['order'] = 9999; }
          if($hasImgOther){
            $data['img_other'] = json_encode($imgOther);
          }
          $data['variant'] = json_encode($variant);
          $data['price'] = (empty($data['price'])) ? '0' : preg_replace("/[^0-9]/","",$data['price']);
          $data['price_promo'] = (empty($data['price_promo'])) ? '0' : preg_replace("/[^0-9]/","",$data['price_promo']);
          if(isset($data['created_at']) && (empty($data['created_at']) || $data['created_at'] == '1970-01-01')) {
            $data['created_at'] = date('Y-m-d H:i:s');
          }
          $data['updated_at'] = date('Y-m-d H:i:s');
          if(empty($id)){
            if(empty($data['stock'])){
              $data['stock'] = 9999;
            }
            $data['stock'] = preg_replace("/[^0-9]/","",$data['stock']);
            //phải chọn category và tiêu đề mới cho insert
            if(!empty($data['category']) && !empty($data['title'])){ 
              $id = $this->postModel->insertGetId($data);
            }
          }else{
            $this->postModel->whereId($id)->update($data);
          }
          //update slug
          if(isset($data['link'])){
            if(isset($this->slug[$data['link']])){
              $this->slugModel->whereId($this->slug[$data['link']]['id'])->update(['type'=>'post','item'=>$id]);
            }else{
              $this->slugModel->insert(['link'=>$data['link'],'type'=>'post','item'=>$id]);
            }
          }
        }
      }

      if($element == 'order'){
        if(isset($data['comment_new'])){
          unset($data['comment_new']);
        }
        if(empty($id)){
          $this->orderModel->insert($data);
        }elseif(Request::get('delete')){
          $this->orderModel->whereId($id)->delete();
        }elseif(Request::get('restore')){
          $this->orderModel->withTrashed()->whereId($id)->restore();
        }else{
          $this->orderModel->whereId($id)->update($data);
          if(isset($data['active']) && $data['active']=='1'){
            $products = json_decode($this->order[$id]['product'],true);
            foreach($products as $pd){
              $newStock = $this->post[$pd['id']]['stock'] - $pd['quantity'];
              $this->postModel->whereId($pd['id'])->update(['stock'=>$newStock]);
            }
          }
          if(isset($data['active']) && $data['active']!='1'){
            $products = json_decode($this->order[$id]['product'],true);
            foreach($products as $pd){
              $newStock = $this->post[$pd['id']]['stock'] + $pd['quantity'];
              $this->postModel->whereId($pd['id'])->update(['stock'=>$newStock]);
            }
          }
        }
      }

      if($element == 'faq'){
        if(isset($data['comment_new'])){
          unset($data['comment_new']);
        }
        if(empty($id)){
          $this->faqModel->insert($data);
        }elseif(Request::get('delete')){
          $this->faqModel->whereId($id)->delete();
        }elseif(Request::get('restore')){
          $this->faqModel->withTrashed()->whereId($id)->restore();
        }else{
          $this->faqModel->whereId($id)->update($data);
        }
      }

      if($element == 'user'){
        if(isset($data['password'])){
          $data['password'] = bcrypt($data['password']);
        }
        if(empty($id)){
          $this->userModel->insert($data);
        }elseif(Request::get('delete')){
          $this->userModel->whereId($id)->delete();
        }elseif(Request::get('restore')){
          $this->userModel->withTrashed()->whereId($id)->restore();
        }else{
          $this->userModel->whereId($id)->update($data);
        }
      }

      if($element == 'comment'){
        if(empty($id)){
          $this->commentModel->insert($data);
        }elseif(Request::get('delete')){
          $this->commentModel->whereId($id)->delete();
        }elseif(Request::get('restore')){
          $this->commentModel->withTrashed()->whereId($id)->restore();
        }else{
          $this->commentModel->whereId($id)->update($data);
        }
      }

      if($element == 'language'){
        if(empty($id)){
          $this->languageModel->insert($data);
        }elseif(Request::get('delete')){
          $this->languageModel->whereId($id)->delete();
        }elseif(Request::get('restore')){
          $this->languageModel->withTrashed()->whereId($id)->restore();
        }else{
          $this->languageModel->whereId($id)->update($data);
        }
      }

      Cache::flush();
      echo 1;
    }
  }

  public function showChangePasswordForm(){
    return view('auth.changepassword');
  }

  public function changePassword(Request $request){
    if(empty(Request::get('current-password'))||empty(Request::get('new-password'))){
      return redirect()->back()->with("error","Vui lòng điền đầy đủ thông tin!");
    }
    if (!(Hash::check(Request::get('current-password'), Auth::user()->password))) {
      return redirect()->back()->with("error","Mật khẩu hiện tại không đúng!");
    }


      // Given password
    $password = Request::get('new-password');

      // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
      return redirect()->back()->with("error","Mật khẩu phải có độ dài ít nhất 8 ký tự và phải bao gồm ít nhất một chữ cái viết hoa, một chữ số và một ký tự đặc biệt.");
    }

    if (Hash::check(Request::get('new-password'), Auth::user()->password)) {
      return redirect()->back()->with("error","Mật khẩu mới đã được sử dụng trước đây, vui lòng dùng mật khẩu khác!");
    }

    $user = Auth::user();
    $user->password = bcrypt(Request::get('new-password'));
    $user->save();
    return redirect()->back()->with("success","Thay đổi mật khẩu thành công !");
  }
}
