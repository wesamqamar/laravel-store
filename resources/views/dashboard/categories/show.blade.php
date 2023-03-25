@extends('layouts.dashboard')
@section('title', $category->name )

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories </li>
<li class="breadcrumb-item active">{{ $category->name }} </li>

@endsection

@section('content')
<div class="mb-5">
</div>

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Store</th>
            <th>Status</th>
            <th>Creatted At</th>
        </tr>
    </thead>

    <tbody>

        @php
            $products= $category->products()->with('store')->latest()->paginate(5);
        @endphp
        @forelse ($products as $product )

        <tr>
            <td><img src="{{ asset('storage/'. $product->image) }}" alt="" height="50px"></td>
            <td>{{@$product->name }}</td>
            <td>{{@$product->store->name }}</td>
            <td>{{$product->status}}</td>
            <td>{{$product->created_at  }}</td>




            </td>
            @empty
            <td colspan="5" >No products Defined</td>
             @endforelse
        </tr>


    </tbody>

</table>
{{ $products->links() }}

@endsection
