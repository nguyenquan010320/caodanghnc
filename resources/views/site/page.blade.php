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
<section class="i330 productCategory p-b-10 p-t-10">
  <div class="i331 container">
    <div class="i332 heading m-b-0">
      <h1 class="i333 m-b-0 text-left">{!!$title!!}</h1>
      {{-- <p class="i334 text-left m-b-0">{!!$s['desc'] or '' !!}</p> --}}
    </div>
  </div>
</section>
<hr class="i335 p-0 m-0">
<section class="i336 productCategory">
  <div class=container>
    <div class="i337 chi-tiet-bai-viet" data-lightbox=gallery>
    	{{-- {!!$s["desc_full"]!!} --}}
      {!! preg_replace('/src="(.*?)"/', ' data-lightbox="gallery-item" href="\1" src="\1" ', $s['desc_full'])!!}
    </div>
  </div>
</section>
{{-- <section class=" " id="">
  <div class=" container">
    <div class=" heading">
      <h2 class=" "></h2>
    </div>
    <div class=" ">
      <div class=" row">
        <div class=" col-md-6">
          <div class=" ">
          </div>
        </div>
        <div class=" col-md-6">
          <div class=" ">
          </div>
        </div>
      </div>
    </div>
  </div>
</section> --}}
@endsection
