@extends('front.base')
@section('content')
<!-- start -->
<div class="bread">
  <div class="w1160 clearfix">
      <p class="page_nav clearfix">
        <a href="/training" @if( $sty ==1 ) class="on"  @endif>安全培训</a><a href="/service_training" @if( $sty ==2 ) class="on"  @endif>服务培训</a>
      </p>
  </div>  
</div>
<div class="wap_box">
  <span class="bk30">&nbsp;</span>
  <div class="w1160 clearfix">
    <!-- start -->
    {!! $article->comtent !!}
    <!-- end -->
  </div>
</div>

<!-- end -->
@endsection