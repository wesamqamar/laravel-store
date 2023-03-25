@extends('layouts.dashboard')
@section('title','Categories Edit')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories </li>

@endsection

@section('content')
<div class="mb-5">
</div>
 <form action="{{ route('dashboard.categorise.update',$category->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
 @include('dashboard.categories._form',[
    'button_lable'=>'Update'
 ])
 </form>

@endsection
