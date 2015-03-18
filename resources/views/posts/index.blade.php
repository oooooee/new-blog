@extends('layout.master')

@section('header')
    @include('common.nav')
    <header class="intro-header" style="background-image: url('{{asset('/assets/img/home-bg.jpg')}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Coke Vincent</h1>
                        <hr class="small">
                        <span class="subheading">一盏灯、一个随身听、一本书</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@stop

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
                                    <a class="post-title-link" href="/{{$article->slug}}">
                                       {{ $article->title }}
                                    </a>
                                </h1>
                                <div class="post-meta">
                                    <span class="post-time">
                                    发表于 {{substr($article->created_at, 0, 10)}}
                                    </span>
                                    <span class="post-comments-count">
                                        &nbsp; | &nbsp;
                                        <a href="/2015/03/13/Mac-OS-X-配置AMP环境/#comments">
                                            <span class="post-comments-count ds-thread-count" data-thread-key="2015/03/13/Mac-OS-X-配置AMP环境/">
                                                暂无评论
                                            </span>
                                        </a>
                                    </span>
                                </div>
                            </div>

                            <div class="post-body">

                                <div style="max-height: 600px;overflow: hidden;">
                                    {!! $article->body_html !!}
                                </div>
                                {{--<h3 id="">前言</h3>--}}
                                {{--<p>因为每次重新安装系统都需要配置一下Apache、MySQL、PHP的环境，网上的文章又不完整或者不完全符合自己的情况，所以写下一篇文章来记录一下，保证99%配置成功，还剩1%由于各种奇葩环境原因。。。主要从 6 个方面进行记录：</p>--}}
                                {{--<ol>--}}
                                    {{--<li>启动Apache</li>--}}
                                    {{--<li>建立个人的网站目录</li>--}}
                                    {{--<li>启动php的解析功能</li>--}}
                                    {{--<li>安装、启动mysql</li>--}}
                                    {{--<li>修改mysql root密码</li>--}}
                                    {{--<li>使用客户端连接mysql</li>--}}
                                {{--</ol>--}}
                                <div class="post-more-link text-center">
                                    <a class="btn"href="/{{$article->slug}}">
                                        阅读全文 »
                                    </a>
                                </div>
                            </div>
                            <div class="post-footer">
                                {{--<div class="post-tags">
                                    <a href="/tags/Mac/">
                                        #Mac
                                    </a>
                                    <a href="/tags/Apache/">
                                        #Apache
                                    </a>
                                    <a href="/tags/MySQL/">
                                        #MySQL
                                    </a>
                                    <a href="/tags/PHP/">
                                        #PHP
                                    </a>
                                </div>--}}
                                @if($key != count($articles)-1)
                                    <hr>
                                @endif
                                <div class="post-eof"></div>
                            </div>
                        </div>
                      {{--  <a href="/{{$article->slug}}">
                            <h2 class="post-title">
                                {{$article->title}}
                            </h2>
                            <h3 class="post-subtitle">
                                {{$article->content}}
                            </h3>
                        </a>
                        <p class="post-meta">Posted by <a href="#">Vincent</a> on {{substr($article->created_at, 0, 10)}}</p>--}}
                    </div>
                @endforeach

                {{--<hr>
                <div class="post-preview">
                    <a href="post.html">
                        <h2 class="post-title">
                            I believe every human has a finite number of heartbeats. I don't intend to waste any of mine.
                        </h2>
                    </a>
                    <p class="post-meta">Posted by <a href="#">Start Bootstrap</a> on September 18, 2014</p>
                </div>
                <hr>
                <div class="post-preview">
                    <a href="post.html">
                        <h2 class="post-title">
                            Science has not yet mastered prophecy
                        </h2>
                        <h3 class="post-subtitle">
                            We predict too much for the next year and yet far too little for the next ten.
                        </h3>
                    </a>
                    <p class="post-meta">Posted by <a href="#">Start Bootstrap</a> on August 24, 2014</p>
                </div>
                <hr>
                <div class="post-preview">
                    <a href="post.html">
                        <h2 class="post-title">
                            Failure is not an option
                        </h2>
                        <h3 class="post-subtitle">
                            Many say exploration is part of our destiny, but it’s actually our duty to future generations.
                        </h3>
                    </a>
                    <p class="post-meta">Posted by <a href="#">Start Bootstrap</a> on July 8, 2014</p>
                </div>
                <hr>--}}
                <!-- Pager -->
                <ul class="pager">
                    <li class="next">
                        <a href="#">Older Posts &rarr;</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@stop









