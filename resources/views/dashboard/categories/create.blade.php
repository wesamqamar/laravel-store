@extends('layouts.dashboard')
@section('title','Categories Create')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>

@endsection

@section('content')
<div class="mb-5">
</div>
 <form action="{{ route('dashboard.categorise.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    @include('dashboard.categories._form')


 </form>

@endsection
