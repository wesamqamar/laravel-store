@extends('layouts.dashboard')
@section('title','Trashed Categories')

@section('breadcrumb')
@parent
<li class="breadcrumb-item  ">Categories</li>
<li class="breadcrumb-item disaple">Trashed</li>

@endsection

@section('content')
<div class="mb-5">
<a href="{{ route('dashboard.categorise.index') }}" class="btn btn-sm btn-outline-primary ">Back</a>
</div>
<x-alert type="success" />
<x-alert type="info" />

<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-brtween mb-4 ">
<input name="name" placeholder ="Name" class="form-control mx-2"/>
<select name="status" class="form-control mx-2">
    <option value="">All</option>
    <option value="active" @selected(request('status')=='active') >Active</option>
    <option value="archived" @selected(request('status')=='archived')>Archived</option>
</select>
<button class="btn btn-dark mx-2">Filter</button>


</form>

<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Deleted At</th>
        </tr>
    </thead>

    <tbody>

        @forelse ( $categories as $category )

        <tr>
            <td><img src="{{ asset('storage/'. $category->image) }}" alt="" height="50px"></td>
            <td >{{$category->id  }}</td>
            <td>{{$category->name }}</td>
            <td>{{$category->status}}</td>
            <td>{{$category->deleted_at  }}</td>


            <td>
                <form action="{{ route('dashboard.categories.restore',$category->id) }}" method="post">
                @csrf
                @method('put')
                <button type="submit" class="btn btn-sm btn-outline-info">Restore</button>

            </form>

            <td>
                <form action="{{ route('dashboard.categories.force-delete',$category->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>

            </form>

            </td>
            @empty
            <td colspan="7" >
                No Categorise Defined
            </td>

            @endforelse
        </tr>


    </tbody>

</table>
{{ $categories->withQueryString()->appends(['search'])->links() }}

@endsection
