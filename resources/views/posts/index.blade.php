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
                @foreach($articles as $article)

                    <div class="post-preview">
                        <a href="/{{$article->slug}}">
                            <h2 class="post-title">
                                {{$article->title}}
                            </h2>
                            <h3 class="post-subtitle">
                                {{$article->content}}
                            </h3>
                        </a>
                        <p class="post-meta">Posted by <a href="#">Vincent</a> on {{substr($article->created_at, 0, 10)}}</p>
                    </div>

                    <hr>

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

    <hr>

@stop









