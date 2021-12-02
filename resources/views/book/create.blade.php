@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Add Book</div>
                    <div class="card-body">
                        @component('components.error')
                        @endcomponent
                        <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-2">
                                <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input id="judul" name="judul" type="text" class="form-control" placeholder="Masukan judul">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <input id="tahun" name="tahun" type="text" class="form-control" placeholder="Masukan tahun">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                                <div class="col-sm-10">
                                    <input id="cover" name="cover" type="file" class="form-control">
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
