@if(!empty($numPage))
<div class="i1046 text-center p-20">
<ul class="i1047 pagination">
  @if($page!=1)
  <li class="i1048 " ><a class="i1049 "  href="{!!$currentFilter.'&page='.($page-1)!!}" aria-label="Previous" data-filter="page" data-value="{{$page-1}}"> <span class="i1050 "  aria-hidden="true"><i class="i1051 fa fa-angle-left"></i></span> </a></li>
  @endif

  @php($show3DotsPrev=false)
  @php($show3DotsNext=false)

  @for($i=1;$i<=$numPage;$i++)
    @if($i==$page)<li class="i1052 active"><a class="i1053 "  href="{!!$currentFilter.'&page='.$i!!}">{{$i}}</a></li>
    @else
      @if($i!=$numPage && $i!=1 && $i>($page+1))
        @unless($show3DotsPrev)
          @php($show3DotsPrev=true)
          <li class="i1054 " ><a class="i1055 "  href="javascript:void(0)">…</a> </li>
        @endunless
      @elseif($i!=$numPage && $i!=1 && $i<($page-1))
        @unless($show3DotsNext)
          @php($show3DotsNext=true)
          <li class="i1056 " ><a class="i1057 "  href="javascript:void(0)">…</a></li>
        @endunless
      @else
      <li class="i1058 " ><a class="i1059 "  href="{!!$currentFilter.'&page='.$i!!}" data-filter="page" data-value="{{$i}}">{{$i}}</a></li>
      @endif
    @endif
  @endfor
  
  @if($page!=$numPage)
  <li class="i1060 " ><a class="i1061 "  href="{!!$currentFilter.'&page='.($page+1)!!}" data-filter="page" data-value="{{$page+1}}" aria-label="Next"> <span class="i1062 "  aria-hidden="true"><i class="i1063 fa fa-angle-right"></i></span> </a></li>
  @endif
</ul>
</div>
@endif