@extends('layouts.frontend')
@section('content')
@include('module.breadcumb')
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "NewsArticle",
    "mainEntityOfPage": 
    {
      "@type": "WebPage",
      "@id": "{!!$domain or '' !!}{!!$s['link'] or ''!!}"
    },
    "headline": "{!!$s['title'] or ''!!}",
    "image": [
    "{!!$domain or '' !!}{!!$s['img'] or ''!!}"
    ],
    "datePublished": "{!!$s['created_at'] or ''!!}",
    "dateModified": "{!!$s['updated_at'] or $s['created_at'] or '' !!}",
    "author": 
    {
      "@type": "Person",
      "name": "{!!env('DB_DATABASE')!!}"
    },
    "publisher": 
    {
      "@type": "Organization",
      "name": "{!!env('COMPANY_NAME')!!}",
      "logo": 
      {
        "@type": "ImageObject",
        "url": "{!!$domain or '' !!}@site('anh-logo')"
      }
    },
    "description": "{!!str_replace('"','',trim(strip_tags($s['desc'])))!!}"
  }
</script>
<section class="productCategory p-b-10 p-t-10">
  <div class="container">
    <div class="heading m-b-0">
      <h1 class="m-b-0 text-left">{!!$title!!}</h1>
      {{-- <p class="text-left m-b-0">{!!$s['desc'] or '' !!}</p> --}}
    </div>
  </div>
</section>
<hr class="p-0 m-0">
<section class="productCategory">
  <div class=container>
    <div class="chi-tiet-bai-viet">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          {!!$s["desc_full"]!!}
        </div>
      </div>
      <div class="m-t-20">
        <p class="text-center"><button type="button" class="btn btn-my" onclick="$('.formkh').hide();$('.formlogin').show();"><i class="fa fa-sign-in"></i>Đăng nhập</button><button type="button" class="btn btn-my" onclick="$('.formkh').hide();$('.formnew').show();"><i class="fa fa-plus"></i>Đăng câu hỏi mới</button></p>
      </div>
      <form class="m-b-30 formkh formlogin" style="display: none;" method="post" action="{!!$s['link'] or '' !!}">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div style="background: #eee;padding: 20px;">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="email">Email (*)</label>
                    <input type="email" name="Email" class="form-control email" value="{!!Request::get('Email')!!}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="password">Mật khẩu để xem kết quả (*)</label>
                    <input type="password" name="Password" class="form-control password" value="{!!Request::get('Password')!!}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group text-center">
                    <label for="">&nbsp;</label>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-my" data-action="@lang('Khách hàng đăng nhập xem câu hỏi')" type="submit" style="width: 100%">@lang('Xem kết quả')</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <form data-element="faq" class="m-b-30 formkh formnew" {{-- style="display: none;" --}}>
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div style="background: #eee;padding: 20px;">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Tên của bạn (*)</label>
                    <input type="text" name="Name" class="form-control name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone">Số điện thoại (*)</label>
                    <input type="text" name="Phone" class="form-control phone">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email (*)</label>
                    <input type="email" name="Email" class="form-control email" value="{!!Request::get('Email')!!}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password">Mật khẩu để xem kết quả (*)</label>
                    <input type="password" name="Password" class="form-control password" value="{!!Request::get('Password')!!}">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="Title">Tiêu đề câu hỏi</label>
                    <input type="text" name="Title" class="form-control">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="message">Nội dung câu hỏi</label>
                    <textarea type="text" name="Note" rows="5" class="form-control"></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group text-center">
                    <input type="hidden" name="mail-to" value="@site('dia-chi-email-nhan-thong-bao')">
                    <input type="hidden" name="subject" value="@lang('Khách hàng gửi câu hỏi')">
                    <button class="btn btn-my btn-send-mail" data-action="@lang('Khách hàng gửi câu hỏi')" type="button">@lang('Gửi câu hỏi')</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      @if (Request::isMethod('post'))
      <?php
      $email = Request::get('Email');
      $password = Request::get('Password');
      $customerId = [];
      foreach ($customer as $c) {
        if(trim(strtolower($c['email'])) == trim(strtolower($email)) && trim($c['password']) == trim($password)){
          $customerId[] = $c['id'];
        }
      }
      ?>
      @if(empty($customerId))
      <blockquote class="blockquote-color text-light"><p class=" text-center">Quý khách chưa có câu hỏi nào đăng lên hệ thống, hoặc quý khách nhập sai email/mật khẩu để xem kết quả</p></blockquote>
      @else
      <table class="table table-bordered m-t-30">
        <thead>
          <tr>
            <th>STT</th>
            <th>Ngày</th>
            <th>Câu hỏi</th>
            <th>Câu trả lời</th>
            <th>Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          @php($i=1)
          @foreach($faq as $p) @if(in_array($p['customer'], $customerId))
          <tr>
            <td>{!!$i++!!}</td>
            <td>{!!$p['created_at'] or ''!!}</td>
            <td>
              <p><b>{!!$p['title'] or ''!!}</b></p>
              <p>{!!$p['note'] or ''!!}</p>
            </td>
            <td>{!!$p['answer'] or ''!!}</td>
            <td>@if($p['active']==0) @lang('Chưa trả lời') @else @lang('Đã trả lời') @endif</td>
          </tr>
          @endif @endforeach
        </tbody>
      </table>
      @endif
      @endif
      
    </div>
  </div>
</section>
@endsection
