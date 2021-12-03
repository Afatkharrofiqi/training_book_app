@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Management Book</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 col-md-3 col-lg-2">
                            <a href="{{ route('book.create') }}" class="btn btn-dark btn-block mb-2">Add Book</a>
                        </div>
                    </div>
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table caption-top">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Cover</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Category</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $key => $book)
                                <tr>
                                    <th scope="row">{{ $books->firstItem() + $key }}</th>
                                    <td>{{ $book->judul }}</td>
                                    <td>
                                        @if($book->cover)
                                            <img src="{{ asset('storage/'. $book->cover) }}" alt="Book Cover" width="100px">
                                        @else
                                            <p>Cover belum diset</p>
                                        @endif
                                    </td>
                                    <td>{{ $book->tahun }}</td>
                                    <td>
                                        <ul>
                                            @forelse ($book->categories as $category)
                                                <li>{{ $category->name }}</li>
                                            @empty
                                                <li> Tidak memiliki kategori </li>
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td>{{ $book->created_at }}</td>
                                    <td>{{ $book->updated_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('book.edit', ['book' => $book->id]) }}" class="btn btn-primary">Edit</a>
                                        @component('components.delete')
                                            @slot('url')
                                                {{ route('book.destroy', ['book' => $book->id]) }}
                                            @endslot
                                            @slot('value')
                                                Hapus
                                            @endslot
                                        @endcomponent
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"> Data empty </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
