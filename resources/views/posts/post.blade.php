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
            </div>
        </div>
    </div>
</article>

<hr>

@stop

@section('footer')
    @include('common.footer')
@stop


