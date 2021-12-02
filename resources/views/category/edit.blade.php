@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Edit Category</div>
                    <div class="card-body">
                        @component('components.error')
                        @endcomponent
                        <form action="{{ route('category.update', ['id' => $category->id]) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name Category</label>
                                <div class="col-sm-10">
                                    <input value="{{ $category->name }}" id="name" name="name_category" type="text" class="form-control" placeholder="Masukan nama kategori">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-dark mb-2" value='Submit'>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
