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

        {!! Form::open(['url'=>'mdf_custom']) !!}

        {!! Form::label('custom_word', '定制信息') !!}

        <br />

        <textarea style="width:600px;" name="custom_word" id="custom_word">{{$data}}</textarea>

        <br />

        {!! Form::submit('提交') !!}
        <p style="color: #ff0000">
            注：每个关键词之前用 '|' 隔开
        </p>

        {!! Form::close() !!}

    </div>

@stop



