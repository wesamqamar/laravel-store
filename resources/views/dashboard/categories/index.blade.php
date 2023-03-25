@extends('layouts.dashboard')
@section('title','Categories')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>

@endsection

@section('content')
<div class="mb-5">
<a href=" {{ route('dashboard.categorise.create') }}" class="btn btn-sm btn-outline-primary ">Create</a>
<a href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-dark ">Trash</a>
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
            <th>Parent</th>
            <th>Ptoduct # </th>
            <th>Status</th>
            <th>Creatted At</th>
        </tr>
    </thead>

    <tbody>

        @forelse ( $categories as $category )

        <tr>
            <td><img src="{{ asset('storage/'. $category->image) }}" alt="" height="50px"></td>
            <td >{{$category->id  }}</td>
            <td><a href="{{ route('dashboard.categorise.show' , $category->id) }}">{{$category->name }}</a></td>
            <td>{{$category->parent->name  }}</td>
            <td>{{ $category->products_number }}</td>
            <td>{{$category->status}}</td>
            <td>{{$category->created_at  }}</td>
            <td><a href="{{ route('dashboard.categorise.edit', $category->id ) }}" class="btn btn-sm btn-outline-success" > Edit</a>
            </td>


            <td>
                <form action="{{ route('dashboard.categorise.destroy',$category->id) }}" method="post">
                @csrf
                <input type="hidden" name="_methode" value="delete">
                @method('delete')
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>

            </form>

            </td>
            @empty
            <td colspan="9" >
                No Categorise Defined
            </td>

            @endforelse
        </tr>


    </tbody>

</table>
{{ $categories->withQueryString()->appends(['search'])->links() }}

@endsection
