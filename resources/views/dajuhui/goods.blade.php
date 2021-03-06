@extends('layout.master')

@section('header')
    @include('common.dajuhui_nav')

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

@endsection

@section('footer')
    @include('common.footer')
@stop

@section('content')

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                @foreach($articles as $key => $article)

                    <div class="posts-expand" style="opacity: 1; display: block; transform: translateY(0px);">
                        <div class="post post-type-normal">
                            <div class="post-header">
                                <h1 class="post-title">
                                    <a class="post-title-link" href="{{$article->url}}">
                                        {{$article->from}}-----{{ $article->title }}
                                    </a>
                                </h1>
                                <div class="post-meta">
                                    <span class="post-time">
                                    发表于 {{substr($article->created_at, 0, 10)}}
                                    </span>
                                </div>
                            </div>

                            <div class="post-body">
                                <h5>商品链接：{{$article->url}}</h5>
                                {!! strip_tags($article->content, '<img>') !!}
                            </div>
                            <div class="post-footer">
                                @if($key != count($articles)-1)
                                    <hr>
                                @endif
                                <div class="post-eof"></div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Pager -->
                <ul class="pager">
                    {!! $articles->render() !!}
                </ul>
            </div>
        </div>
    </div>

@stop



