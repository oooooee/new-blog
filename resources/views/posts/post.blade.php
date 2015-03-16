@extends('layout.master')

@section('header')

    @include('common.nav')

<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('{{asset('/assets/img/post-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-heading">
                    <h1>Man must explore, and this is exploration at its greatest</h1>
                    <h2 class="subheading">Problems look mighty small from 150 miles up</h2>
                    <span class="meta">Posted by <a href="#">Start Bootstrap</a> on August 24, 2014</span>
                </div>
            </div>
        </div>
    </div>
</header>

@stop
@section('content')
<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1" id="markdownContent">
                {!! $article->body_html !!}

                <!-- 多说评论框 start -->
                <div class="ds-thread" data-thread-key="{{ $article->slug }}" data-title="{{ $article->title }}" data-url="{{ setting('site_url').$article->slug }}"></div>
                <!-- 多说评论框 end -->
                <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
                <script type="text/javascript">
                    var duoshuoQuery = {short_name:"coke-vincent"};
                    (function() {
                        var ds = document.createElement('script');
                        ds.type = 'text/javascript';ds.async = true;
                        ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                        ds.charset = 'UTF-8';
                        (document.getElementsByTagName('head')[0]
                        || document.getElementsByTagName('body')[0]).appendChild(ds);
                    })();
                </script>
                <!-- 多说公共JS代码 end -->
            </div>

        </div>
    </div>
</article>

<hr>

@stop

@section('footer')
    @include('common.footer')
@stop


