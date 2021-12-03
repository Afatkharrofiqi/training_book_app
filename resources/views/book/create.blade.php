@extends('layouts.app')

@section('css_custom')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.4/dist/select2-bootstrap4.min.css">
@endsection

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
                                    <input id="judul" name="judul" type="text" class="form-control" placeholder="Masukan judul" value="{{ old('judul') }}">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <input id="tahun" name="tahun" type="text" class="form-control" placeholder="Masukan tahun" value="{{ old('tahun') }}">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                                <div class="col-sm-10">
                                    <input id="cover" name="cover" type="file" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="category" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select id="category" name="category[]" multiple class="form-control">
                                        @foreach ($category as $cat)
                                            @foreach (old('category') ?? [] as $oldId)
                                                @if($cat->id == $oldId)
                                                    <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        <option></option>
                                    </select>
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

@section('js_custom')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(function(){
            $('#category').select2({
                placeholder: 'Pilih kategori',
                ajax: {
                    url: '{{ route('category.all') }}',
                    processResults: function(data){
                        return {
                            results: data.map(function(item){
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            })
                        }
                    }
                }
            })
        })
    </script>
@endsection
