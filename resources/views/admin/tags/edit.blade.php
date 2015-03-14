@extends('admin.layout')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Edit Tag:{{ $tag->name }}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-8">
				{!! Form::model($tag,['method'=>'PATCH','url' => 'admin/tags/'.$tag->id]) !!}
					@include('admin.tags.form',['submitButtonText'=>'Update Tag'])
				{!! Form::close() !!}
			</div>
			<!-- /.col-lg-6 (nested) -->
		</div>
		<!-- /.row (nested) -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
@stop