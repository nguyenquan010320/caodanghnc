@ifturnon('bat-tinh-nang-binh-luan')
<link class="i854 "  href="/public/frontend/bootstrap-rating.css" rel="stylesheet">
<script class="i855 "  type="text/javascript" src="/public/frontend/bootstrap-rating.min.js"></script>
<h3 class="i856 tieu-de-h3">Đánh giá</h3>
<div class="i857 comments" id="danhgia">
  @ifturnon('bat-tinh-nang-binh-luan-facebook')
  <div class="i858 fb-comments" data-href="{!!'http://'.$_SERVER['HTTP_HOST'].$s['link']!!}" data-width="100%" data-numposts="5"></div>
  @else
  <div class="i859 comment-list">
    @php($avg = [])
    @forelse($comment as $c)
    @php($avg[] = $c['rating'])
    @if(empty($c['parent']))
    <div class="i860 comment">
      <div class="i861 image"><img alt="{!!$c['name'] or '' !!}" src="/public/frontend/image/nobody.png" class="i862 avatar"></div>
      <div class="i863 text">
        <div class="i864 product-rate">
          @for($i=1;$i<=$c['rating'];$i++) <i class="i865 fa fa-star"></i> @endfor
          @for($i=$c['rating']+1;$i<=5;$i++) <i class="i866 fa fa-star-o"></i> @endfor
        </div>
        <h5 class="i867 name">{!!(empty($c['name']))?'Khách truy cập':$c['name']!!}</h5>
        @if(!empty($c['created_at']))<span class="i868 comment_date">@lang('Đăng vào') {!!Helper::timevn($c['created_at'])!!}</span>@endif
        <a class="i869 comment-reply-link" href="javascript:void(0)" data-parent="{!!$c['id'] or '' !!}">@lang('Trả lời')</a>
        <div class="i870 text_holder">
          {{-- <p class="i871 " >{!!preg_replace("/\d/u", "*", $c['comment'])!!}</p> --}}
          <p class="i872 " >{!! $c['comment'] or ''!!}</p>
        </div>
      </div>
      @foreach($comment as $c2) @if($c2['parent']==$c['id'])
      <div class="i873 comment">
        <div class="i874 image"><img alt="{!!$c2['name'] or '' !!}" src="/public/frontend/image/nobody.png" class="i875 avatar"></div>
        <div class="i876 text">
          <h5 class="i877 name">{!!$c2['name'] or '' !!}</h5>
          @if(!empty($c2['created_at']))<span class="i878 comment_date">@lang('Đăng vào') {!!Helper::timevn($c2['created_at'])!!}</span>@endif
          <div class="i879 text_holder">
            <p class="i880 " >{!!preg_replace("/\d/u", "*", $c2['comment'])!!}</p>
          </div>
        </div>
      </div>
      @endif @endforeach
    </div>
    @endif @empty
    <p class="i881 " >@lang('Hiện chưa có đánh giá nào')</p>
    @endforelse    
    <div class="i882 respond-form p-t-20" id="guibinhluan">
      <div class="i883 respond-comment m-b-10"><b class="i884 " >Gửi đánh giá</b></div>
      <form class="i885 form-gray-fields" data-element=comment>
        <div class="i886 row">
          <div class="i887 col-sm-4">
            <div class="i888 form-group">
              <label class="i889 upper" for="phone">Xếp hạng</label>
              <input type="hidden" name="rating" class="i890 rating" id="ratingne" data-filled="fa fa-star" data-empty="fa fa-star-o"/>
            </div>
          </div>
          <div class="i891 col-sm-4">
            <div class="i892 form-group">
              <label class="i893 upper" for="name">@lang('Tên của bạn') (*)</label>
              <input class="i894 form-control name" name="name" placeholder="@lang('Tên của bạn')" aria-required="true" type="text">
              <input class="i895 "  type="hidden" name="parent" value=""/>
              <input class="i896 "  type="hidden" name="post" value="{!!$s['id'] or '' !!}"/>
              @if(Auth::check())
              <input class="i897 "  type="hidden" name="active" value="1"/>
              @endif
              @php($avg = array_filter($avg))
            </div>
          </div>
              {{-- <div class="i898 col-sm-4">
                <div class="i899 form-group">
                  <label class="i900 upper" for="name">Email</label>
                  <input class="i901 form-control" name="email" placeholder="Email" aria-required="true" type="text">
                  <input type="hidden" class="i902 rating" name="rating" value="5" data-filled="fa fa-check" data-empty="fa fa-star-o"/>
                </div>
              </div> --}}
              <div class="i903 col-sm-4">
                <div class="i904 form-group">
                  <label class="i905 upper" for="phone">@lang('Số điện thoại') (*)</label>
                  <input class="i906 form-control phone" name="phone" placeholder="@lang('Số điện thoại')" aria-required="true" type="text">
                </div>
              </div>
            </div>
            <div class="i907 row">
              <div class="i908 col-sm-12">
                <div class="i909 form-group">
                  <label class="i910 upper" for="comment">Nội dung đánh giá (*)</label>
                  <textarea class="i911 form-control" name="comment" rows="2" placeholder="@lang('Lời bình luận')" aria-required="true"></textarea>
                </div>
              </div>
            </div>
            <div class="i912 row m-t-15">
              <div class="i913 col-md-12">
                <div class="i914 form-group text-right">
                  <button class="i915 btn btn-my btn-send-mail" data-action="@lang('Gửi bình luận')" type="button">@lang('Gửi bình luận')</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <script class="i916 "  type="text/javascript">
          $('#danhgia').on('click', '.comment-reply-link', function(event) {
            console.log(1); 
            $("html, body").animate({ scrollTop: $('#guibinhluan').offset().top-200 }, 500);
            console.log(1); 
            $('#danhgia').find('input[name="parent"]').val($(this).data('parent'));
            $('#ratingne').rating();
          });
        </script>
      </div>
      @endif
    </div>
    @endif