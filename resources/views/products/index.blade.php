@extends('layouts.layout')

@section('body')
<div class="container mt-3">
    <h2>Products</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td><img src="products/{{ $product->image }}" class="rounded-circle"
                            style="background-size:cover; background-position: center center;" width="50"
                            height="50"></td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <a href="products/{{ $product->id }}/edit" class="btn btn-dark btn-sm">Edit</a>
                    </td>
                    <td>
                        <form action="products/{{ $product->id }}/delete" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
