<?php 
namespace App\Helpers;
use Illuminate\Database\Eloquent\Model;
use App\Site;
use App\Language;
use DOMDocument;
use Request;

class Helper
{
  public static function input($lang='',$languages=null,$item=[]) {
    if(empty($item['value_type'])) $item['value_type']='text';
    if($item['value_type'] == 'date'){
      return '<div class="input-group date">
      <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
      <input type="text" class="form-control pull-right datepicker" name="'.htmlspecialchars($item['code']).'" value="'.htmlspecialchars($item['value']).'">
      </div>';
    }
    if($item['value_type'] == 'text' && empty($item['value_ext'])){
      return '<input type="text" class="form-control" name="'.htmlspecialchars($item['code']).'" value="'.htmlspecialchars($item['value']).'">';
    }
    if($item['value_type'] == 'text' && !empty($item['value_ext'])){
      if($item['value_ext']=='đ'){
        return '<div class="input-group">
        <input type="text" class="form-control moneyinput" name="'.htmlspecialchars($item['code']).'" value="'.htmlspecialchars($item['value']).'"">
        <span class="input-group-addon">'.$item['value_ext'].'</span>
        </div>';
      }
      return '<div class="input-group">
      <input type="text" class="form-control" name="'.htmlspecialchars($item['code']).'" value="'.htmlspecialchars($item['value']).'"">
      <span class="input-group-addon">'.$item['value_ext'].'</span>
      </div>';
    }
    if($item['value_type'] == 'color'){
      return '<input type="color" class="form-control" name="'.htmlspecialchars($item['code']).'" value="'.htmlspecialchars($item['value']).'">';
    }
    if($item['value_type'] == 'onoff'){
      $text = '<select class="form-control" name="'.htmlspecialchars($item['code']).'">';
      if($item['value'] == '1'){
        $text .= '<option value="1" selected>'.Helper::langadmin('Bật',$lang,$languages).'</option>';
        $text .= '<option value="0">'.Helper::langadmin('Tắt',$lang,$languages).'</option>';
      }else{
        $text .= '<option value="1">'.Helper::langadmin('Bật',$lang,$languages).'</option>';
        $text .= '<option value="0" selected>'.Helper::langadmin('Tắt',$lang,$languages).'</option>';
      }
      $text .= '</select>';
      return $text;
    }
    if($item['value_type'] == 'img'){
      $text= '<div class="input-group">
      <input type="text" class="form-control" id="'.rand(111111,999999).'" name="'.htmlspecialchars($item['code']).'" value="'.htmlspecialchars($item['value']).'" placeholder="'.Helper::langadmin('Chưa có ảnh nào',$lang,$languages).'">
      <div class="input-group-btn"><a href="javascript:void(0)" class="btn btn-info file-btn">'.Helper::langadmin('Chọn ảnh',$lang,$languages).'</a><a href="javascript:void(0)" class="btn btn-default empty-btn">'.Helper::langadmin('Xóa',$lang,$languages).'</a></div>
      </div>';
      // if(strpos($item['value'],'://') !== false){
      //   $size = @getimagesize($item['value']);
      // }else{
      //   $size = @getimagesize('https://'.$_SERVER['HTTP_HOST'].$item['value']);
      // }
      // if(!empty($size) && is_array($size) && !empty($size[0]) && !empty($size[1])){
      //   $text .= '<p class="help-block">Kích thước: rộng '.$size[0].'px, cao '.$size[1].'px (không bắt buộc). Định dạng ảnh .jpg .png hoặc .gif</p>';
      // }else{
      //   $text .= '<p class="help-block">Định dạng .jpg .png hoặc .gif. Kích thước tùy ý.</p>';
      // }

      $text .= '<p class="help-block">'.Helper::langadmin('Định dạng .jpg .png hoặc .gif. Dung lượng tốt nhất dưới 200Kb.',$lang,$languages).'. <span></span></p>';
      $text .= '<img class="imagegetwh" src="'.htmlspecialchars($item['value']).'"/>';
      return $text;
    }
    if($item['value_type'] == 'video'){
      return '<div class="input-group">
      <input type="text" class="form-control file_name" id="'.htmlspecialchars($item['code']).'" name="'.htmlspecialchars($item['code']).'" value="'.htmlspecialchars($item['value']).'">
      <div class="input-group-btn"><a href="javascript:void(0)" class="btn btn-info file-btn"><i class="fa fa-folder-open"></i> Chọn file khác</a><a href="javascript:void(0)" class="btn btn-default empty-btn">'.Helper::langadmin('Xóa',$lang,$languages).'</a></div>
      </div>
      <p class="help-block">'.Helper::langadmin('Video cần có đuôi.mp4 và nên có dung lượng nhỏ',$lang,$languages).'</p>
      <video width=50% autobuffer loop=loop preload=auto muted controls>
      <source src="'.htmlspecialchars($item['value']).'" type=video/mp4>
      </video>';
    }
    if($item['value_type'] == 'file'){
      return '<div class="input-group">
      <input type="text" class="form-control file_name" id="'.htmlspecialchars($item['code']).'" name="'.htmlspecialchars($item['code']).'" value="'.htmlspecialchars($item['value']).'">
      <div class="input-group-btn"><a href="javascript:void(0)" class="btn btn-info file-btn"><i class="fa fa-folder-open"></i> Chọn file khác</a><a href="javascript:void(0)" class="btn btn-default empty-btn">'.Helper::langadmin('Xóa',$lang,$languages).'</a></div>
      </div>
      <p class="help-block">'.Helper::langadmin('File cần có định dạng .pdf, .xls,. xlsx, .doc,. docx, .zip, .rar',$lang,$languages).'</p>
      <p><a href="'.htmlspecialchars($item['value']).'" download="1">'.htmlspecialchars($item['value']).'</a></p>';
    }
    if($item['value_type'] == 'link'){
      return '<div class="input-group">
      <input type="text" class="form-control" id="'.htmlspecialchars($item['code']).'" name="'.htmlspecialchars($item['code']).'" value="'.htmlspecialchars($item['value']).'" style="background-repeat: repeat; background-image: none; background-position: 0% 0%;">
      <div class="input-group-btn"><button type="button" class="btn btn-default link-preview-btn">'.Helper::langadmin('Xem thử',$lang,$languages).'</button></div>
      </div>';
    }
    if($item['value_type'] == 'textarea'){
      return '<textarea class="textarea form-control" id="'.htmlspecialchars($item['code']).'" name="'.htmlspecialchars($item['code']).'">'.$item['value'].'</textarea>';
    }
    if($item['value_type'] == 'textarea'||$item['value_type'] == 'notextarea'){
      return '<textarea style="height:150px;" class="form-control" id="'.htmlspecialchars($item['code']).'" name="'.htmlspecialchars($item['code']).'">'.$item['value'].'</textarea>';
    }
    if($item['value_type'] == 'cktextarea'){
      return '<textarea class="cktextarea form-control" id="'.htmlspecialchars($item['code']).'" name="'.htmlspecialchars($item['code']).'">'.$item['value'].'</textarea>';
    }
  }

  public static function inputLabel($lang='',$languages=null,$item=[]){
    // return '<div class="form-group"><label>'.Helper::langadmin($item['title'],$lang,$languages).'</label>'.Helper::input($lang,$languages,$item).'</div>';
    return '<div class="form-group"><label>'.$item['title'].'</label>'.Helper::input($lang,$languages,$item).'</div>';
  }

  public static function inputLabelNormal($lang='',$languages=null,$type='',$label='',$name='',$value='',$ext='',$tooltip=''){
    $item = ['value_type'=>$type,'code'=>$name,'value'=>$value,'value_ext'=>$ext];
    if(!empty($tooltip)){
      return "<div class='form-group'><label>".Helper::langadmin($label,$lang,$languages)." <i class='fa fa-question-circle' data-toggle='tooltip' data-placement='right' title='".Helper::langadmin($tooltip,$lang,$languages)."'></i></label>".Helper::input($lang,$languages,$item)."</div>";
    }
    return "<div class='form-group'><label>".Helper::langadmin($label,$lang,$languages)."</label>".Helper::input($lang,$languages,$item)."</div>";
  }

  public static function boxFooter($lang='',$languages=null){
    return '<div class="box-footer">
    <a href="javascript:void(0)" class="btn btn-flat btn-primary save-btn">'.Helper::langadmin('Lưu',$lang,$languages).'</a>
    </div>';
  }

  public static function boxFooterElement($lang='',$languages=null,$id=''){
    return '<div class="box-footer">
    <a href="javascript:void(0)" class="btn btn-flat btn-primary save-btn-element">'.Helper::langadmin('Lưu',$lang,$languages).'</a>
    <a href="javascript:void(0)" class="btn btn-flat btn-default delete-btn-element" data-id="'.$id.'">'.Helper::langadmin('Xóa',$lang,$languages).'</a>
    </div>';
  }

  public static function boxFooterPost($lang='',$languages=null,$id='',$urlBack=''){
    return '<div class="box-footer">
    <a href="javascript:void(0)" class="btn btn-flat btn-primary save-btn-post" data-url-back="'.$urlBack.'" data-active="1">'.Helper::langadmin('Đăng',$lang,$languages).'</a>
    <a href="javascript:void(0)" class="btn btn-flat btn-default save-btn-post" data-url-back="'.$urlBack.'" data-active="0">'.Helper::langadmin('Lưu nháp',$lang,$languages).'</a>
    <a href="javascript:void(0)" class="btn btn-flat btn-default delete-btn-element" data-url-back="'.explode('-', $urlBack)[0].'" data-id="'.$id.'">'.Helper::langadmin('Xóa',$lang,$languages).'</a>
    </div>';
  }

  public static function date($value=''){
    return date('d/m/Y', strtotime($value));
  }

  public static function money($value='',$lang='',$languages){
    if(empty($value)) return Helper::lang('Giá liên hệ',$lang,$languages);
    $value = preg_replace("/[^0-9]/","",$value);
    return number_format(round($value)).'đ';
  }

  public static function lang($text='',$lang='',$languages){
    $text = trim($text);
    if(!empty($text)){
      if(empty($lang)) { $lang = 'vi'; }
      if(!empty($languages[$text][$lang])){
        return $languages[$text][$lang];
      }else{
        if(empty($languages[$text]['vi'])){
          Language::insert(['vi'=>$text,'en'=>$text,'ja'=>$text,'ko'=>$text,'zh'=>$text]);
        }
        return $text;
      }
    }
  }

  public static function langadmin($text='',$lang='',$languages){
    return $text;
  }

  public static function checkArrayInArray($array1=null,$array2=null){
    if(!is_array($array1)) {$array1 = [$array1];}
    if(!is_array($array2)) {$array2 = [$array2];}
    return !empty(array_intersect($array1, $array2));
  }

  public static function categoryMultiLayer($category=[], $selected=[], $dept=9999){
    if(!is_array($selected)){$selected = [$selected];}
    $text = '';
    foreach ($category as $c){
      if(empty($c['parent'])){
        $text .= '<option value="'.$c['id'].'" ';
        if (!empty($selected) && in_array($c['id'], $selected)){$text .= 'selected';}
        $text .= '>'.$c['title'].'</option>';
        if($dept>1){
          foreach ($category as $c2){
            if($c2['parent'] == $c['id']){
              $text .= '<option value="'.$c2['id'].'" ';
              if (!empty($selected) && in_array($c2['id'], $selected)){$text .= 'selected';}
              $text .= '>-- '.$c2['title'].'</option>';
              if($dept>2){
                foreach ($category as $c3){
                  if($c3['parent'] == $c2['id']){
                    $text .= '<option value="'.$c3['id'].'" ';
                    if (!empty($selected) && in_array($c3['id'], $selected)){$text .= 'selected';}
                    $text .= '>---- '.$c3['title'].'</option>';
                    if($dept>3){
                      foreach ($category as $c4){
                        if($c4['parent'] == $c3['id']){
                          $text .= '<option value="'.$c4['id'].'" ';
                          if (!empty($selected) && in_array($c4['id'], $selected)){$text .= 'selected';}
                          $text .= '>------ '.$c4['title'].'</option>';
                          if($dept>4){
                            foreach ($category as $c5){
                              if($c5['parent'] == $c4['id']){
                                $text .= '<option value="'.$c5['id'].'" ';
                                if (!empty($selected) && in_array($c5['id'], $selected)){$text .= 'selected';}
                                $text .= '>-------- '.$c5['title'].'</option>';
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    return $text;
  }

  public static function categoryMultiLayerByCatId($category=[], $selected=[], $dept=9999, $catId){
    if(!is_array($selected)){$selected = [$selected];}
    $text = '';
    foreach ($category as $c){
      if($c['id']==$catId){
        $text .= '<option value="'.$c['id'].'" ';
        if (!empty($selected) && in_array($c['id'], $selected)){$text .= 'selected';}
        $text .= '>'.$c['title'].'</option>';
        if($dept>1){
          foreach ($category as $c2){
            if($c2['parent'] == $c['id']){
              $text .= '<option value="'.$c2['id'].'" ';
              if (!empty($selected) && in_array($c2['id'], $selected)){$text .= 'selected';}
              $text .= '>-- '.$c2['title'].'</option>';
              if($dept>2){
                foreach ($category as $c3){
                  if($c3['parent'] == $c2['id']){
                    $text .= '<option value="'.$c3['id'].'" ';
                    if (!empty($selected) && in_array($c3['id'], $selected)){$text .= 'selected';}
                    $text .= '>---- '.$c3['title'].'</option>';
                    if($dept>3){
                      foreach ($category as $c4){
                        if($c4['parent'] == $c3['id']){
                          $text .= '<option value="'.$c4['id'].'" ';
                          if (!empty($selected) && in_array($c4['id'], $selected)){$text .= 'selected';}
                          $text .= '>------ '.$c4['title'].'</option>';
                          if($dept>4){
                            foreach ($category as $c5){
                              if($c5['parent'] == $c4['id']){
                                $text .= '<option value="'.$c5['id'].'" ';
                                if (!empty($selected) && in_array($c5['id'], $selected)){$text .= 'selected';}
                                $text .= '>-------- '.$c5['title'].'</option>';
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    return $text;
  }

  public static function timevn($time=0,$format='d/m/Y H:i'){
    return Helper::datevn($time,$format);
  }
  public static function datevn($time=0,$format='d/m/Y'){
    if (!$time) return '';
    if(!is_numeric($time)) $time = strtotime($time);
    $lang = [];
    $lang['sun'] = 'CN';
    $lang['mon'] = 'T2';
    $lang['tue'] = 'T3';
    $lang['wed'] = 'T4';
    $lang['thu'] = 'T5';
    $lang['fri'] = 'T6';
    $lang['sat'] = 'T7';
    $lang['sunday'] = 'Chủ nhật';
    $lang['monday'] = 'Thứ hai';
    $lang['tuesday'] = 'Thứ ba';
    $lang['wednesday'] = 'Thứ tư';
    $lang['thursday'] = 'Thứ năm';
    $lang['friday'] = 'Thứ sáu';
    $lang['saturday'] = 'Thứ bảy';
    $lang['january'] = 'Tháng Một';
    $lang['february'] = 'Tháng Hai';
    $lang['march'] = 'Tháng Ba';
    $lang['april'] = 'Tháng Tư';
    $lang['may'] = 'Tháng Năm';
    $lang['june'] = 'Tháng Sáu';
    $lang['july'] = 'Tháng Bảy';
    $lang['august'] = 'Tháng Tám';
    $lang['september'] = 'Tháng Chín';
    $lang['october'] = 'Tháng Mười';
    $lang['november'] = 'Tháng Mười Một';
    $lang['december'] = 'Tháng Mười Hai';
    $lang['jan'] = 'T01';
    $lang['feb'] = 'T02';
    $lang['mar'] = 'T03';
    $lang['apr'] = 'T04';
    $lang['may2'] = 'T05';
    $lang['jun'] = 'T06';
    $lang['jul'] = 'T07';
    $lang['aug'] = 'T08';
    $lang['sep'] = 'T09';
    $lang['oct'] = 'T10';
    $lang['nov'] = 'T11';
    $lang['dec'] = 'T12';

    $format = str_replace( "r", "D, d M Y H:i:s O", $format );
    $format = str_replace( ["D", "M"], ["[D]", "[M]"], $format );
    $return = date( $format, $time );

    $replaces = [
      '/\[Sun\](\W|$)/' => $lang['sun'] . "$1",
      '/\[Mon\](\W|$)/' => $lang['mon'] . "$1",
      '/\[Tue\](\W|$)/' => $lang['tue'] . "$1",
      '/\[Wed\](\W|$)/' => $lang['wed'] . "$1",
      '/\[Thu\](\W|$)/' => $lang['thu'] . "$1",
      '/\[Fri\](\W|$)/' => $lang['fri'] . "$1",
      '/\[Sat\](\W|$)/' => $lang['sat'] . "$1",
      '/\[Jan\](\W|$)/' => $lang['jan'] . "$1",
      '/\[Feb\](\W|$)/' => $lang['feb'] . "$1",
      '/\[Mar\](\W|$)/' => $lang['mar'] . "$1",
      '/\[Apr\](\W|$)/' => $lang['apr'] . "$1",
      '/\[May\](\W|$)/' => $lang['may2'] . "$1",
      '/\[Jun\](\W|$)/' => $lang['jun'] . "$1",
      '/\[Jul\](\W|$)/' => $lang['jul'] . "$1",
      '/\[Aug\](\W|$)/' => $lang['aug'] . "$1",
      '/\[Sep\](\W|$)/' => $lang['sep'] . "$1",
      '/\[Oct\](\W|$)/' => $lang['oct'] . "$1",
      '/\[Nov\](\W|$)/' => $lang['nov'] . "$1",
      '/\[Dec\](\W|$)/' => $lang['dec'] . "$1",
      '/Sunday(\W|$)/' => $lang['sunday'] . "$1",
      '/Monday(\W|$)/' => $lang['monday'] . "$1",
      '/Tuesday(\W|$)/' => $lang['tuesday'] . "$1",
      '/Wednesday(\W|$)/' => $lang['wednesday'] . "$1",
      '/Thursday(\W|$)/' => $lang['thursday'] . "$1",
      '/Friday(\W|$)/' => $lang['friday'] . "$1",
      '/Saturday(\W|$)/' => $lang['saturday'] . "$1",
      '/January(\W|$)/' => $lang['january'] . "$1",
      '/February(\W|$)/' => $lang['february'] . "$1",
      '/March(\W|$)/' => $lang['march'] . "$1",
      '/April(\W|$)/' => $lang['april'] . "$1",
      '/May(\W|$)/' => $lang['may'] . "$1",
      '/June(\W|$)/' => $lang['june'] . "$1",
      '/July(\W|$)/' => $lang['july'] . "$1",
      '/August(\W|$)/' => $lang['august'] . "$1",
      '/September(\W|$)/' => $lang['september'] . "$1",
      '/October(\W|$)/' => $lang['october'] . "$1",
      '/November(\W|$)/' => $lang['november'] . "$1",
      '/December(\W|$)/' => $lang['december'] . "$1"
    ];

    return preg_replace( array_keys( $replaces ), array_values( $replaces ), $return );
  }

  public static function readMore($descFull='',$num_words=20) {
    $descFull = strip_tags($descFull);
    $words = [];
    $words = explode(" ", $descFull, $num_words);
    $shown_string = "";
    if(count($words) == $num_words){
      $words[$num_words-1] = "...";
    }
    $shown_string = implode(" ", $words);
    if(strlen($shown_string) > ($num_words*5+5)){
      $shown_string = mb_substr($shown_string, 0, ($num_words*5));
    }
    return $shown_string;
  }

  public static function youtube($descFull='',$autoplay=false,$width=560,$height=315){

    if(substr($descFull, -3,3) == 'mp4'){
      if($autoplay){
        return '<video class="" width="1920" height="1080" autoplay loop muted playsinline data-ignore data-autoplay><source src="'.$descFull.'" type="video/mp4" /></video>';
      }else{
        return '<video class="" width="1920" height="1080" playsinline data-ignore data-autoplay><source src="'.$descFull.'" type="video/mp4" /></video>';
      }
    }

    if($autoplay){
      $autoplay = '?autoplay=1&mute=1';
    }

    // https://www.tiktok.com/@drthuannhakhoa/video/7316823337160690962
    $descFull = preg_replace("/\<a href\=\"https\:\/\/www.tiktok.com(.+?)\>(.+?)\<\/a\>/i", "$2", $descFull);
    $descFull = preg_replace("/\s*[a-zA-Z\/\/:\.]*tiktok.com\/\@([a-zA-Z0-9\-_]+)\/video\/([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<blockquote class=\"tiktok-embed\" cite=\"https://www.tiktok.com/@$1/video/$2\" data-video-id=\"$2\" style=\"max-width: 605px;min-width: 325px;\" > <section> </section> </blockquote> <script async src=\"https://www.tiktok.com/embed.js\"></script>",$descFull);

    // https://www.facebook.com/watch/?v=221665197569948
    $descFull = str_replace(['facebook.com/reel/'], 'facebook.com/watch/?v=', $descFull);
    $descFull = preg_replace("/\<a href\=\"https\:\/\/www.facebook.com(.+?)\>(.+?)\<\/a\>/i", "$2", $descFull);
    $descFull = preg_replace("/facebook.com\/([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)\/videos\//i", "facebook.com/watch/?v=", $descFull);
    $descFull = preg_replace("/\s*[a-zA-Z\/\/:\.]*facebook.com\/watch\/\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<div class=\"fb-video\" data-href=\"https://www.facebook.com/watch/?v=$1\" data-width=\"".$width."\" data-show-text=\"false\"></div>",$descFull);
    
    $descFull = str_replace(['youtu.be/','youtube.com/shorts/'], 'youtube.com/watch?v=', $descFull);
    $descFull = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"".$width."\" height=\"".$height."\" style=\"width: 100%\" src=\"//www.youtube.com/embed/$1".$autoplay."\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>",$descFull);

    return $descFull;
  }

  public static function youtubeThumb($url='') {
    $url = str_replace('youtube.com/shorts/', 'youtube.com/watch?v=', $url);
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
    if(!empty($matches[0])){
      $matches[0] = substr($matches[0], 0, 11);
      return 'https://i1.ytimg.com/vi/'.$matches[0].'/hqdefault.jpg';
    }else{
      return '/thumbs/gt.jpg';
    }
  }

  public static function addAlt($html='',$alt='') {
    $pattern = '#<img(?!.*alt=")(.+src="(([^"]+/)?(.+)\..+)"[^ /]*)( ?\/?)>#i';
    if(!empty($alt)) {
      return preg_replace($pattern, '<img$1 alt="'.$alt.'"$5>', $html);
    }else{
      return preg_replace($pattern, '<img$1 alt="$4"$5>', $html);
    }
  }

  public static function cleanText($string) {
    return preg_replace('/[^A-Za-z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀẾỂưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\- ]/', '', $string);
  }

  public static function getPathFromString($text){
    $marTViet=["à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
    "ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
    ,"ế","ệ","ể","ễ",
    "ì","í","ị","ỉ","ĩ",
    "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
    ,"ờ","ớ","ợ","ở","ỡ",
    "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
    "ỳ","ý","ỵ","ỷ","ỹ",
    "đ",
    "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
    ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
    "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
    "Ì","Í","Ị","Ỉ","Ĩ",
    "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
    ,"Ờ","Ớ","Ợ","Ở","Ỡ",
    "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
    "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
    "Đ"];

    $marKoDau=["a","a","a","a","a","a","a","a","a","a","a"
    ,"a","a","a","a","a","a",
    "e","e","e","e","e","e","e","e","e","e","e",
    "i","i","i","i","i",
    "o","o","o","o","o","o","o","o","o","o","o","o"
    ,"o","o","o","o","o",
    "u","u","u","u","u","u","u","u","u","u","u",
    "y","y","y","y","y",
    "d",
    "A","A","A","A","A","A","A","A","A","A","A","A"
    ,"A","A","A","A","A",
    "E","E","E","E","E","E","E","E","E","E","E",
    "I","I","I","I","I",
    "O","O","O","O","O","O","O","O","O","O","O","O"
    ,"O","O","O","O","O",
    "U","U","U","U","U","U","U","U","U","U","U",
    "Y","Y","Y","Y","Y",
    "D"];
    return str_replace(' ','-', preg_replace('!\s+!', ' ', preg_replace('/[^a-z0-9]/i', ' ', strtolower(str_replace($marTViet,$marKoDau ,$text)))));
  }

  public static function checkEmptyString($string){
    if (strpos($string, '<img') !== false) {return false;}
    return empty(str_replace(' ','', preg_replace('!\s+!', ' ', preg_replace('/[^a-z0-9]/i', ' ', strtolower(strip_tags(str_replace("&nbsp;",' ', $string)))))));
  }

  public static function countFavorites(){
    if(empty($_COOKIE['favoriteProducts'])){
      return 0;
    }else{
      return count(explode(',',$_COOKIE['favoriteProducts']));
    }
  }

  public static function isInFavorites($id=null){
    if(empty($id)){
      return false;
    }else{
      return (isset($_COOKIE['favoriteProducts']) && in_array($id, explode(',',$_COOKIE['favoriteProducts'])));
    }
  }

  public static function relatedPost($thisPost=[],$allPost=[],$length=4){
    if(empty($thisPost)||empty($allPost)){
      return [];
    }else{
      $relatedPost = [];
      $relatedStrong = [];
      foreach ($allPost as $p){
        if($thisPost['id']!=$p['id']){
          $relatedStrong[$p['id']] = sizeof(array_filter(array_unique(array_intersect($p['categoryParent'],$thisPost['categoryParent'])))); // find the most related products by the same category
        }
      }
      asort($relatedStrong);
      $relatedStrong = array_slice($relatedStrong, (0-$length), $length, true);
      foreach ($relatedStrong as $k => $p){
        $relatedPost[] = $allPost[$k];
      }
      $relatedPost = array_reverse($relatedPost);
      return $relatedPost;
    }
  }

  public static function featuredPost($thisPost=[],$allPost=[],$length=4){
    if(empty($thisPost)||empty($allPost)){
      return [];
    }else{
      $featuredPost = [];
      $featuredStrong = [];
      foreach ($allPost as $p) {
        if($thisPost['title']!=$p['title']){
          $featuredStrong[$p['id']] = 1000;// find the most featured products by points
          if(isset($p['categoryParent'][2]) && isset($thisPost['categoryParent'][2]) && $p['categoryParent'][2] == $thisPost['categoryParent'][2]) // same category level 2
          $featuredStrong[$p['id']] += 1000;
          if(!empty($p['categoryParent']['order'])){
            $featuredStrong[$p['id']] -= $p['categoryParent']['order']; // lower `order` field value is better
          }
          if(!empty($p['categoryOther']['khuyenmai'])){
            $featuredStrong[$p['id']] += count($p['categoryOther']['khuyenmai']); // more khuyenmai categories is better
          }
          if(!empty($p['price_promo'])){
            $featuredStrong[$p['id']] += 1; // have promotion price is better
          }
          if(!empty($p['rating'])){
            $featuredStrong[$p['id']] += $p['rating']; // have higher rating is better
          }
        }
      } 
      asort($featuredStrong);
      $featuredStrong = array_slice($featuredStrong, (0-$length), $length, true);
      foreach ($featuredStrong as $k => $p){
        $featuredPost[] = $allPost[$k];
      }
      $featuredPost = array_reverse($featuredPost);
      return $featuredPost;
    }
  }

  public static function randomString($length = 6) {
    return substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  }

  public static function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
  }

  public static function htmlTableToArray($html = ''){
    ini_set('default_charset', 'utf-8');
    $html = preg_replace('/\<img(.+?)\>/', ';;;; img $1 ;;;;', $html); 
    $DOM = new DOMDocument;
    $DOM->loadHTML($html);
    $items = $DOM->getElementsByTagName('tr');
    $return = array();
    foreach ($items as $node) {
      $str = array();
      foreach ($node->childNodes as $element) {
        $text = trim(iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', trim($element->nodeValue)));
        $text = preg_replace('/;;;; img (.+?) ;;;;/', '<img $1>', $text); 
        $str[] = $text;
      }
      $return[] = $str;
    }
    return $return;
  }

  public static function genMenu($catId=10, $category, $post, $s){
    $menu = [];
    foreach($category as $c){
      if($c['parent']==$catId){
        $thismenu = Helper::subMenu($c,$category,$post, $s);
        foreach($category as $c2){
          if($c2['parent']==$c['id']){
            $thismenu2 = Helper::subMenu($c2,$category,$post, $s);
            foreach($category as $c3){
              if($c3['parent']==$c2['id']){
                $thismenu3 = Helper::subMenu($c3,$category,$post, $s);
                $thismenu2['child'][] = $thismenu3;
                $thismenu2['dropdown'] = 'dropdown-submenu';
              }
            }
            $thismenu['child'][] = $thismenu2;
            $thismenu['dropdown'] = 'dropdown';
          }
        }
        //Xổ danh mục con 
        if($c['menuchild'] == '1'){
          foreach($category as $c2){
            if('c'.$c2['parent']==$c['menulinkin']){
              $thismenu2 = [
                'link' => $c2['link'],
                'name' => $c2['title'],
                'img' => $c2['img'],
                'desc' => strip_tags($c2['desc']),
              ];
              $thismenu['child'][] = $thismenu2;
              $thismenu['dropdown'] = 'dropdown';
            }
          }
        }
        //Xổ danh mục con và con của con
        if($c['menuchild'] == '2'){
          foreach($category as $c2){
            if('c'.$c2['parent']==$c['menulinkin']){
              $thismenu2 = [
                'link' => $c2['link'],
                'name' => $c2['title'],
                'img' => $c2['img'],
                'desc' => strip_tags($c2['desc']),
              ];
              foreach($category as $c3){
                if($c3['parent']==$c2['id']){
                  $thismenu3 = [
                    'link' => $c3['link'],
                    'name' => $c3['title'],
                    'img' => $c3['img'],
                    'desc' => strip_tags($c3['desc']),
                  ];
                  $thismenu2['child'][] = $thismenu3;
                  $thismenu2['dropdown'] = 'dropdown-submenu';
                }
              }
              $thismenu['child'][] = $thismenu2;
              $thismenu['dropdown'] = 'dropdown';
            }
          }
        }
        //Xổ bài viết con
        if($c['menuchild'] == '3'){
          foreach($post as $p){
            $menulinkin = substr($c['menulinkin'], 1);
            if(!empty($menulinkin) && in_array($menulinkin, $p['categoryParent'])){
              $thismenu2 = [
                'link' => $p['link'],
                'name' => $p['title'],
                'img' => $p['img_thumb'],
                'desc' => strip_tags($p['desc']),
              ];
              $thismenu['child'][] = $thismenu2;
              $thismenu['dropdown'] = 'dropdown';
            }
          }
        }
        $menu[] = $thismenu;
      }
    }
    return $menu;
  }

  public static function subMenu($c,$category,$post,$s){
    $thismenu = [
      'link' => '',
      'name' => '',
      'newtab' => '',
      'scrollto' => '',
      'dropdown' => '',
      'active' => '',
      'child' => [],
    ];
    $thismenu['link'] = $c['menulink'];
    $thismenu['name'] = $c['title'];
    $thismenu['img'] = $c['img'];
    $thismenu['desc'] = strip_tags($c['desc']);
    if($c['menunewtab'] == '1'){
      $thismenu['newtab'] = 'target="_blank"';
    }
    if(substr($c['menulink'], 0,1) == '#'){
      if(Request::is('/')){
        $thismenu['scrollto'] = 'scroll-to';
      }else{
        $thismenu['link'] = '/'.$thismenu['link'];
      }
    }
    if(!empty($c['menulinkin'])){
      $submenu = substr($c['menulinkin'], 0,1);
      $submenuid = preg_replace("/[^0-9]/","",$c['menulinkin']);
      //var_dump($submenu,$submenuid,isset($category[$submenuid]),isset($post[$submenuid]));
      if($submenu == 'c' && isset($category[$submenuid])){
        $thismenu['link'] = $category[$submenuid]['link'];
        if(!empty($s) && !empty($s['categoryParent']) && is_array($s['categoryParent']) && in_array($submenuid, $s['categoryParent'])){
          $thismenu['active'] = 'active';
        }
      }
      if($submenu == 'p' && isset($post[$submenuid])){
        $thismenu['link'] = $post[$submenuid]['link'];
        if(!empty($s) && !empty($s['id']) && $s['id'] == $submenuid){
          $thismenu['active'] = 'active';
        }
      }
    }
    return $thismenu;
  }

}