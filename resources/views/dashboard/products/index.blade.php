@extends('layouts.dashboard')
@section('title','Products')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Products</li>

@endsection

@section('content')
<div class="mb-5">
<a href=" {{ route('dashboard.products.create') }}" class="btn btn-sm btn-outline-primary ">Create</a>
{{-- <a href="{{ route('dashboard.products.trash') }}" class="btn btn-sm btn-outline-dark ">Trash</a> --}}
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

            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Store</th>
            <th>Status</th>
            <th>Creatted At</th>
        </tr>
    </thead>

    <tbody>

        @forelse ( $products as $product )

        <tr>
            <td >{{@$product->id  }}</td>
            <td>{{@$product->name }}</td>
            <td>{{@$product->category->name}}</td>
            <td>{{@$product->store->name }}</td>
            <td>{{@$product->status}}</td>
            <td>{{@$product->created_at  }}</td>
            <td><a href="{{ route('dashboard.products.edit', $product->id ) }}" class="btn btn-sm btn-outline-success" > Edit</a>
            </td>


            <td>
                <form action="{{ route('dashboard.products.destroy',$product->id) }}" method="post">
                @csrf
                <input type="hidden" name="_methode" value="delete">
                @method('delete')
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>

            </form>

            </td>
            @empty
            <td colspan="8" >
                No products Defined
            </td>

            @endforelse
        </tr>


    </tbody>

</table>
{{ $products->withQueryString()->appends(['search'])->links() }}

@endsection
