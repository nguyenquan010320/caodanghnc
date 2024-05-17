<?php

namespace App\Http\Controllers;
use Mail;
use Request;
use View;
use Counter;
use Cache;
use Session;
use App\Helpers\Helper;

class SiteController extends Controller
{
  private $siteModel;
  private $categoryModel;
  private $postModel;
  private $commentModel;
  private $orderModel;
  private $faqModel;
  private $customerModel;
  private $slugModel;
  private $site;
  private $category;
  private $post;
  private $mailData;
  private $lang;
  private $languages;

  public function __construct(){
    $this->siteModel = app("App\Site");  
    $this->categoryModel = app("App\Category");  
    $this->postModel = app("App\Post");  
    $this->commentModel = app("App\Comment");  
    $this->orderModel = app("App\Order");  
    $this->faqModel = app("App\Faq");  
    $this->customerModel = app("App\Customer");  
    $this->languageModel = app("App\Language");  
    $this->slugModel = app("App\Slug");  
    $this->lang='';

    // Nhận biết ngôn ngữ
    if(!empty(LANGUAGES)){
      $languages = unserialize(LANGUAGES);
      $textLengh = 7;
      if (starts_with(Request::root(), 'https://')){ $textLengh = 8; }
      if (starts_with(Request::root(), 'https://www.')){ $textLengh = 12; }
      if (starts_with(Request::root(), 'http://www.')){ $textLengh = 11; }
      if (starts_with(Request::root(), 'http://') || starts_with(Request::root(), 'https://')){
        foreach ($languages as $o => $k) {
          if(substr(Request::root(), $textLengh) == $o && $k!='vi'){
            $this->lang=$k;
          }
        }
      }
    }

    $this->site = Cache::rememberForever($this->lang.'site.construct.site', function () {
      return $this->siteModel->getRecordReindexFrontEnd($this->lang);
    });

    $domain = 'http://'.$_SERVER['HTTP_HOST'];
    if($this->site['che-do-bao-mat-https'] == '1'){
      $domain = 'https://'.$_SERVER['HTTP_HOST'];
    }
    View::share('domain', $domain);
    
    $this->category = Cache::rememberForever($this->lang.'site.construct.category', function () {
      return $this->categoryModel->getRecordReindex($this->lang);
    });
    
    $this->post = Cache::remember($this->lang.'site.construct.post',86400, function () {
      $postNew = $this->postModel->getRecordReindex($this->lang,$this->category,false,'','ISNULL(`order`) ASC,`order` ASC,`created_at` DESC,`id` DESC',1);
      foreach ($postNew as $k=>$p) {
        if($p['created_at'] > date('Y-m-d 23:59:59')){
          unset($postNew[$k]);
        }
      }
      return $postNew;
    });
    // $this->order = Cache::rememberForever('site.construct.order', function () {
    //   return $this->orderModel->getRecordReindex();
    // });
    $this->faq = Cache::rememberForever('site.construct.faq', function () {
      return $this->faqModel->getRecordReindex();
    });
    $this->customer = Cache::rememberForever('site.construct.customer', function () {
      return $this->customerModel->getRecordReindex();
    });
    $this->languages = Cache::rememberForever('site.construct.languages', function () {
      return $this->languageModel->getRecordReindex();
    });
    $this->slug = Cache::rememberForever('site.construct.slug', function () {
      return $this->slugModel->getRecordReindex();
    });

    $tags = Cache::rememberForever('site.construct.tags', function () {
      $allTags = [];
      foreach ($this->post as $p) {
        $allTags = array_merge($allTags,explode(',', $p['keyword']));
      }
      $allTags = array_filter($allTags);
      $allTags = array_map('trim', $allTags);
      $allTagsNew = array_count_values($allTags);
      arsort($allTagsNew);
      return $allTagsNew;
    });
    View::share('tags', $tags);

    View::share('site', $this->site);
    View::share('category', $this->category);
    View::share('post', $this->post);
    View::share('customer', $this->customer);
    View::share('faq', $this->faq);
    View::share('lang', $this->lang);
    View::share('title', $this->site['tieu-de-trang']);
    View::share('desc', $this->site['gioi-thieu-trang']);
    View::share('keyword', $this->site['tu-khoa-trang']);
    View::share('languages', $this->languages);
  }

  public function index(){
    $data = [];

    // $textLengh = 7;
    // if (starts_with(Request::root(), 'https://')){ $textLengh = 8; }
    // if (starts_with(Request::root(), 'https://www.')){ $textLengh = 12; }
    // if (starts_with(Request::root(), 'http://www.')){ $textLengh = 11; }
    // if (starts_with(Request::root(), 'http://') || starts_with(Request::root(), 'https://')){
    // foreach($this->post as $p){
    //   if(in_array(9, $p['categoryParent']) && !empty($p['field9']) && substr(Request::root(), $textLengh) == $p['field9']){
    //     return SiteController::post('',$p['id']);
    //   }
    // }
    //   if(substr(Request::root(), $textLengh) == 'duanvinhomesvuyen.com.vn'){
    //     return SiteController::post('',$id=19);
    //   }
    //   if(substr(Request::root(), $textLengh) == 'vinhomes-vuyenhaiphong.vn'){
    //     return SiteController::post('',$id=20);
    //   }
    // }

    Counter::count('index');
    return view("site.index",$data);
  }

  public function thanhcong(){
    $data = [];
    return view("site.thanhconglp",$data);
  }

  public function sitemap(){
    $data = [];
    return view("site.sitemap",$data);
  }
  public function rss(){
    $data = [];
    return view("site.rss",$data);
  }

  public function findBySlug($link){
    if(isset($this->slug['/'.$link])){
      $slug = $this->slug['/'.$link];
      if($slug['type']=='category' && !empty($this->category[$slug['item']])){
        return $this->category('',$slug['item']);
      }elseif($slug['type']=='post' && !empty($this->post[$slug['item']])){
        return $this->post('',$slug['item']);
      }
    }
    return abort(404);
  }

  public function search(){
    $data = [];
    Counter::count('search');
    $data['searchKeyword'] = $searchKeyword = Helper::cleanText(Request::get('searchKeyword'));
    $data['searchCategory'] = $searchCategory = Helper::cleanText(Request::get('searchCategory'));
    if(!empty($searchKeyword) || !empty($searchCategory)){
      $data['postList'] = $this->postModel->getRecordReindex($this->lang,$this->category,false,$searchKeyword,'`title` ASC',1);
      if(!empty($searchKeyword)){
        $data['title'] = Helper::lang('Tìm kiếm cho từ khóa',$this->lang,$this->languages).' "'.$searchKeyword.'"';
      }else{
        $data['title'] = Helper::lang('Tìm kiếm ',$this->lang,$this->languages);
      }
      if(!empty($searchCategory) && isset($this->category[$searchCategory])){
        $data['title'] .= ' '.Helper::lang('thuộc danh mục',$this->lang,$this->languages).' '.$this->category[$searchCategory]['title'];
      }
      foreach ($data['postList'] as $k => $p) {
        // product only
        // if(!in_array(2, $p['categoryParent'])){
        //   unset($data['postList'][$k]); 
        // }
        if(!empty($searchCategory) && !in_array($searchCategory, $p['categoryParent'])){
          unset($data['postList'][$k]); 
        }
      }
      if(count($data['postList']) > 0){
        $data['desc'] =  Helper::lang('Tìm thấy',$this->lang,$this->languages).' '.count($data['postList']).' '.Helper::lang('kết quả',$this->lang,$this->languages);
      }else{
        $data['desc'] = Helper::lang('Không tìm thấy kết quả nào',$this->lang,$this->languages);
      }
    }else{
      $data['postList'] = [];
      $data['title'] = Helper::lang('Tìm kiếm',$this->lang,$this->languages);
      $data['desc'] = Helper::lang('Không tìm thấy kết quả nào',$this->lang,$this->languages);
    }


    $data['id']=2;
    $data['s']=$this->category[2];
    $data['breadcumb'] = ['/'=>Helper::lang('Trang chủ',$this->lang,$this->languages),'/tim-kiem?searchKeyword='.$searchKeyword => Helper::lang('Tìm kiếm',$this->lang,$this->languages)];
    $data['currentFilter']='/tim-kiem?searchKeyword='.$searchKeyword;

    // paging
    $perPage = env('PAGING_PERPAGE');
    if(count($data['postList']) > $perPage){
      $data['page'] = Request::get('page');
      if(empty($data['page'])){$data['page']=1;}
      if(empty($perPage)){$perPage = 20;}
      $data['numPage'] = intval(ceil(count($data['postList'])/$perPage));
      $data['postList'] = array_slice($data['postList'], ($data['page']-1)*$perPage, $perPage, true);
    }

    if (Request::isMethod('post')) {
      return view("site.productCategoryAjax",$data);
    }

    return view("site.searchCategory",$data);
  }

  public function category($path='',$id=0){
    if(empty($this->category[$id])){
      return redirect('/');
    }
    $item = $this->category[$id];
    Counter::count('category', $id);
    if(empty($item['type'])){
      $item['type'] = 'post';
    }
    $data = ['id'=>$id,'s'=>$item];
    if(!empty($item['title'])) {$data['title'] = $item['title'];}
    if(!empty($item['google_title'])) {$data['title'] = $item['google_title'];}
    if(!empty($item['desc'])) {$data['desc'] = $item['desc'];}
    if(!empty($item['google_desc'])) {$data['desc'] = $item['google_desc'];}
    if(!empty($item['keyword'])) {$data['keyword'] = $item['keyword'];}
    
    $data['breadcumb'] = ['/'=>Helper::lang('Trang chủ',$this->lang,$this->languages)];
    foreach ($item['categoryParent'] as $b) {
      if(!empty($b) && $b!=3 && isset($this->category[$b])){
        $data['breadcumb'][$this->category[$b]['link']] = $this->category[$b]['title'];
      }
    }
    $data['breadcumb'][$item['link']] = $item['title'];

    $data['filter'] = Request::all();
    $data['currentFilter']=$item['link'].'?';

    if(isset($data['filter']['order'])){
      $data['currentFilter'].="&order={$data['filter']['order']}";
      $postList = $this->postModel->getRecordReindex($this->lang,$this->category,false,'',unserialize(ORDER_OPTION)[$data['filter']['order']]['code'],1);
    }else{
      $postList = $this->post;
    }

    $data['postList'] = [];
    foreach ($postList as $p) {
      if(in_array($id,$p['categoryParent'])){
        $data['postList'][$p['id']] = $p;
      }
    }

    if(isset($data['filter']['favorite'])){ // favorite filter
      $data['postList'] = [];
      $favoriteProducts = (!empty($_COOKIE['favoriteProducts'])) ? explode(',', $_COOKIE['favoriteProducts']):[];
      foreach ($favoriteProducts as $f) {
        $data['postList'][$f] = $this->post[$f];
      }
    }

    // apply filter
    if(!empty($data['filter'])){
      foreach ($data['filter'] as $k => $f) {
        if(!empty($f) && !in_array($k, ['page','favorite','order'])){
          $data['currentFilter'].='&'.$k.'='.$f;
          if($k=='title'){
            $data['title']=$f;
          } else {
            $fArray = explode(',', $f);
            $fArray = array_filter($fArray);
            foreach ($data['postList'] as $kp => $p) {
              if (array_key_exists($k,$p)){
                if($k=='price'){
                  if(!empty($p['price_real'])){
                    if($f == '1'){
                      if($p['price_real'] > 5000000){
                        unset($data['postList'][$kp]);
                      }
                    }elseif($f == '5'){
                      if($p['price_real'] < 5000000 || $p['price_real'] > 8000000){
                        unset($data['postList'][$kp]);
                      }
                    }elseif($f == '8'){
                      if($p['price_real'] < 8000000 || $p['price_real'] > 12000000){
                        unset($data['postList'][$kp]);
                      }
                    }elseif($f == '12'){
                      if($p['price_real'] < 12000000){
                        unset($data['postList'][$kp]);
                      }
                    }
                  }else{
                    unset($data['postList'][$kp]);
                  }
                }else{
                  if(!is_array($p[$k])){
                    $p[$k] = explode(',', $p[$k]);
                  }
                  if(!Helper::checkArrayInArray($fArray, $p[$k])){
                    unset($data['postList'][$kp]);
                  }
                }
              }
            }
          }
        }
      }
    }

    // paging
    $perPage = env('PAGING_PERPAGE');
    if(count($data['postList']) > $perPage){
      $data['page'] = Request::get('page');
      if(empty($data['page'])){$data['page']=1;}
      if(empty($perPage)){$perPage = 20;}
      $data['numPage'] = intval(ceil(count($data['postList'])/$perPage));
      $data['postList'] = array_slice($data['postList'], ($data['page']-1)*$perPage, $perPage, true);
    }

    if (Request::isMethod('post')) {
      if(!empty($item['theme']) && view()->exists('site.'.$item['theme'].'Ajax')){
        return view("site.".$item['theme'].'Ajax',$data);
      }
      if(View::exists("site.".$item['type']."CategoryAjax")){
        return view("site.".$item['type']."CategoryAjax",$data);
      }else{
        return view("site.postCategoryAjax",$data);
      }
    }

    if(!empty($item['theme']) && view()->exists('site.'.$item['theme'])){
      return view("site.".$item['theme'],$data);
    }
    if(View::exists("site.".$item['type']."Category")){
      return view("site.".$item['type']."Category",$data);
    }else{
      return view("site.postCategory",$data);
    }
  }

  public function post($path='',$id=0){
    if (Request::get('preview')) {
      $this->post = Cache::rememberForever($this->lang.'site.post.post', function () {
        return $this->postModel->getRecordReindex($this->lang,$this->category,false,'','');
      });
    }
    if(empty($this->post[$id])){
      return redirect('/');
    }

    $item = $this->post[$id];
    Counter::count('post', $id);
    $data = Cache::rememberForever($this->lang.'site.post.data'.$id, function () use ($item) {
      $item['desc_full'] = '';
      $itemFromDB = $this->postModel->getRecordById($this->lang,$item['id']);
      if(isset($itemFromDB[0]) && isset($itemFromDB[0]['desc_full'])){
        $item['desc_full'] = $itemFromDB[0]['desc_full'];
        $item['desc_full'] = preg_replace('/src="(.*?)"/', ' data-lightbox="gallery-item" href="\1" src="\1" ', $item['desc_full']);
        $item['desc_full'] = str_replace('target="_blank"', 'target="_blank" rel="nofollow"', $item['desc_full']);
        $item['desc_full'] = Helper::youtube($item['desc_full']);
      }
      $data = ['id'=>$item['id'],'s'=>$item];
      if(!empty($item['title'])) {$data['title'] = $item['title'];}
      if(!empty($item['google_title'])) {$data['title'] = $item['google_title'];}
      if(!empty($item['desc'])) {$data['desc'] = $item['desc'];}
      if(!empty($item['google_desc'])) {$data['desc'] = $item['google_desc'];}
      if(!empty($item['keyword'])) {$data['keyword'] = $item['keyword'];}

      $data['breadcumb'] = ['/'=>Helper::lang('Trang chủ',$this->lang,$this->languages)];
      foreach ($item['categoryInfo']['categoryParent'] as $b) {
        if(!empty($b) && $b!=1 && $b!=3 && isset($this->category[$b])){
          $data['breadcumb'][$this->category[$b]['link']] = $this->category[$b]['title'];
        }
      }
      if($item['categoryInfo']['id']!=1){
        $data['breadcumb'][$item['categoryInfo']['link']] = $item['categoryInfo']['title'];
      }
      if(sizeof($data['breadcumb']) < 3){
        $data['breadcumb'][$item['link']] = $item['title'];
      }

      $data['relatedPost'] = Helper::relatedPost($item,$this->post,env('PRODUCT_RELATED'));
      $data['featuredPost'] = Helper::featuredPost($item,$this->post,env('PRODUCT_RELATED'));
      $data['comment'] = $this->commentModel->getRecord(false,$item['id'],1);
      return $data;
    });

    if (Request::get('dich')) {
      return view("site.dich",$data);
    }

    if(!empty($item['theme']) && view()->exists('site.'.$item['theme'])){
      return view("site.".$item['theme'],$data);
    }
    if($item['categoryInfo']['type'] == 'gallery'){
      return view("site.gallery",$data);
    }
    if($item['categoryInfo']['type'] == 'page'){
      return view("site.page",$data);
    }
    if(Request::get('quickView') && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
      return view("site.productQuickView",$data);
    }
    if($item['categoryInfo']['type'] == 'product'){
      return view("site.product",$data);
    }
    return view("site.post",$data);
  }

  public function updateDataElement() {
    if (Request::isMethod('post')) {
      $element = Request::get('element');
      $info = json_decode(Request::get('json_data'));
      $data = [];
      if(!empty($info) && is_array($info)){
        foreach ($info as $f) {
          if(isset($data[$f->name])){
            $data[$f->name] .= ','.$f->value;
          }else{
            $data[$f->name] = $f->value;
          }
        }
      }
      if($element == 'mail-to-admin'){
        // $data['subject'] = $this->post[3]['title'];
        // $data['html'] = $this->post[3]['desc_full'];

        // if(isset($data['Mã nhân viên'])){
        //   $data['html'] = str_replace('[Mã nhân viên]', $data['Mã nhân viên'], $data['html']);
        //   $data['subject'] = str_replace('[Mã nhân viên]', $data['Mã nhân viên'], $data['subject']);
        // }
        if(empty($data['subject'])){$data['subject'] = env('COMPANY_WEBSITE');}
        $data['subject'] .= ' #'.$_SERVER['HTTP_HOST'].' #'.date('Y-m-d-H:i:s');
        
        if(!env('IHAPPY_MAIL_SERVICE')){
          try {
            $this->mailData = $data;
            Mail::send('mail.default', ['data'=>$data], function($message){
              $data = $this->mailData;
              if(empty($data['mail-to'])){$data['mail-to'] = $this->site['dia-chi-email-nhan-thong-bao'];}
              if(!empty($data['Email'])){$data['mail-to'] .= ','.$data['Email'];}
              $data['mail-to'] .= ',noreply@duy9.name.vn';
              $data['mail-to'] = str_replace(';', ',', $data['mail-to']);
              $data['mail-to'] = explode(',', str_replace(' ', '', $data['mail-to']));
              if(empty($data['subject'])){$data['subject'] = env('COMPANY_WEBSITE');}
              $message->to($data['mail-to'], env('COMPANY_NAME'))->subject('Thông báo từ website: '.$data['subject']);
            });
          } catch(\Exception $e){}
        }
        if(empty($data['Name'])) $data['Name'] = '';
        if(empty($data['Phone'])) $data['Phone'] = '';
        if(empty($data['Email'])) $data['Email'] = '';
        if(empty($data['Address'])) $data['Address'] = '';
        if(empty($data['Note'])) $data['Note'] = '';
        if(empty($data['Product Name'])) $data['Product Name'] = '';
        if(empty($data['Product Id'])) $data['Product Id'] = '';
        if(empty($data['Product Price'])) $data['Product Price'] = '';
        $customer = [
          'name'=>$data['Name'],
          'phone'=>$data['Phone'],
          'email'=>$data['Email'],
          'address'=>$data['Address'],
          'created_at' => date('Y-m-d H:i:s'),
        ];
        $customerId = $this->customerModel->insertGetId($customer);
        $products = [];
        if(!empty($data['Product Name'])){
          $products[] = [
            'id'=>$data['Product Id'],
            'name'=>$data['Product Name'],
            'quantity'=>1,
            'price'=>preg_replace("/[^0-9]/","",$data['Product Price']),
          ];
          Counter::count('order', $data['Product Id']);
        }

        $order = [
          'customer' => $customerId,
          'product'=>json_encode($products),
          'amount'=>preg_replace("/[^0-9]/","",$data['Product Price']),
          'note'=>$data['Note'],
          'status'=>'Pending',
          'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->orderModel->insert($order);
      }
      if($element == 'giohang'){
        if(empty($data['subject'])){$data['subject'] = env('COMPANY_WEBSITE');}
        $data['subject'] .= ' #'.$_SERVER['HTTP_HOST'].' #'.date('Y-m-d-H:i:s');
        if(!env('IHAPPY_MAIL_SERVICE')){
          try {
            $this->mailData = $data;
            Mail::send('mail.default', ['data'=>$data], function($message){
              $data = $this->mailData;
              if(empty($data['mail-to'])){$data['mail-to'] = $this->site['dia-chi-email-nhan-thong-bao'];}
              if(!empty($data['Email'])){$data['mail-to'] .= ','.$data['Email'];}
              $data['mail-to'] .= ',noreply@duy9.name.vn';
              $data['mail-to'] = str_replace(';', ',', $data['mail-to']);
              $data['mail-to'] = explode(',', str_replace(' ', '', $data['mail-to']));
              if(empty($data['subject'])){$data['subject'] = env('COMPANY_WEBSITE');}
              $message->to($data['mail-to'], env('COMPANY_NAME'))->subject('Thông báo từ website: '.$data['subject']);
            });
          } catch(\Exception $e){}
        }
        $customer = [
          'name'=>$data['Name'],
          'phone'=>$data['Phone'],
          'email'=>$data['Email'],
          'address'=>$data['Address'],
          'created_at' => date('Y-m-d H:i:s'),
        ];
        $customerId = $this->customerModel->insertGetId($customer);
        $products = [];
        for ($i=1; $i < 101; $i++) { 
          if(isset($data['Product '.$i])){
            $product = explode('/', $data['Product '.$i]);
            $pid = explode(':', $product[0])[0];
            $products[] = [
              'id'=>$pid,
              'name'=>explode(':', $product[0])[1],
              'quantity'=>explode(':', $product[1])[1],
              'price'=>preg_replace("/[^0-9]/","",explode(':', $product[2])[1]),
            ];
            if(!empty($pid)){
              Counter::count('order', explode(':', $product[0])[0]);
            }
          }
        }
        $order = [
          'customer' => $customerId,
          'product'=>json_encode($products),
          'amount'=>preg_replace("/[^0-9]/","",$data['Amount']),
          'payment'=>$data['Payment'],
          'note'=>$data['Note'],
          'status'=>'Pending',
          'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->orderModel->insert($order);
        Session::forget('giohang');
      }
      if($element == 'faq'){
        if(empty($data['subject'])){$data['subject'] = env('COMPANY_WEBSITE');}
        $data['subject'] .= ' #'.$_SERVER['HTTP_HOST'].' #'.date('Y-m-d-H:i:s');
        if(!env('IHAPPY_MAIL_SERVICE')){
          try {
            $this->mailData = $data;
            Mail::send('mail.default', ['data'=>$data], function($message){
              $data = $this->mailData;
              if(empty($data['mail-to'])){$data['mail-to'] = $this->site['dia-chi-email-nhan-thong-bao'];}
              if(!empty($data['Email'])){$data['mail-to'] .= ','.$data['Email'];}
              $data['mail-to'] .= ',noreply@duy9.name.vn';
              $data['mail-to'] = str_replace(';', ',', $data['mail-to']);
              $data['mail-to'] = explode(',', str_replace(' ', '', $data['mail-to']));
              if(empty($data['subject'])){$data['subject'] = env('COMPANY_WEBSITE');}
              $message->to($data['mail-to'], env('COMPANY_NAME'))->subject('Thông báo từ website: '.$data['subject']);
            });
          } catch(\Exception $e){}
        }
        $customer = [
          'name'=>$data['Name'],
          'phone'=>$data['Phone'],
          'email'=>$data['Email'],
          'password'=>$data['Password'],
          'created_at' => date('Y-m-d H:i:s'),
        ];
        $customerId = $this->customerModel->insertGetId($customer);
        $faq = [
          'customer' => $customerId,
          'title'=>$data['Title'],
          'note'=>$data['Note'],
          'status'=>'Pending',
          'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->faqModel->insert($faq);
      }
      if($element == 'comment'){
        $data['jsondata'] = json_encode($data);
        if(!isset($data['active'])){
          $data['active'] = 0;
        }
        unset($data['email']);
        unset($data['phone']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->commentModel->insert($data);
      }
      Cache::flush();

      if($element == 'cart'){
        ini_set('session.gc_maxlifetime', 30*24*60*60);
        ini_set('session.cookie_lifetime', 30*24*60*60);
        if(!empty(Session::get('giohang'))){
          $giohang = (array)json_decode(Session::get('giohang'),true);
        }else{
          $giohang = [];
        }
        $dontAdd = false;
        foreach ($giohang as &$g) {
          if($data['id'] == $g['id']){
            if(!isset($g['quantity'])){$g['quantity'] = 1;}
            $g['quantity'] += $data['quantity'];
            $dontAdd = true;
          }
        }
        if(!$dontAdd){
          $giohang[] = $data;
        }
        if(!empty($data['id'])){
          Counter::count('cart', $data['id']);
        }

        $giohang = json_encode($giohang);
        session(['giohang'=>$giohang]);
      }

      if($element == 'delete-cart'){
        $giohang = (array)json_decode(Session::get('giohang'));
        $giohangNew = [];
        foreach ($giohang as $k => $g) {
          if($k!=$data['delete-key']){
            $giohangNew[$k] = $g;
          }
        }
        $giohangNew = json_encode($giohangNew);
        session(['giohang'=>$giohangNew]);
      }

      if($element == 'update-cart'){
        $giohang = (array)json_decode(Session::get('giohang'));
        $giohangNew = [];
        foreach ($giohang as $k => $g) {
          $g = (array) $g;
          if($k==$data['update-key']){
            foreach ($data as $k2 => $d2) {
              if(isset($g[$k2])){
                $g[$k2] = $d2;
                $giohangNew[$k] = $g;
              }
            }
          }else{
            $giohangNew[$k] = $g;
          }
        }
        $giohangNew = json_encode($giohangNew);
        session(['giohang'=>$giohangNew]);
      }
      echo 1;
    }
  }
}
