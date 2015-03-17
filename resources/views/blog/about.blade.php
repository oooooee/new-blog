@extends('layout.master')

@section('header')

    @include('common.nav')

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url({{ asset('assets/img/about-bg.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1>About Me</h1>
                        <hr class="small">
                        <span class="subheading">This is what I do.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@stop

@section('content')

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p>人生不是一场物质的盛宴，而是一次灵魂的修炼，使它在谢幕之时比开幕之初更为高尚。</p>
                <p>活着与修行——有的人活着，但不懂得如何才是修行；也有的人修行了许多年，却不懂得如何好好活着。。。生活，要带上修行的感悟；修行，也要多想一想生活的意义。。。当我们活过了每一天的阳光和风雨，鼓起勇气走过了一切好的和坏的，才能够懂得圆满的真意。</p>
            </div>
        </div>
    </div>

@stop

@section('footer')
    @include('common.footer')
@stop

