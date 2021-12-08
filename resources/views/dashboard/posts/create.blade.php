@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create new posts</h1>
</div>

<div class="col-lg-8">
    <form method="POST" action="/dashboard/posts" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="masukkan post" autocomplete="off" value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category_id">Kategory</label>
            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                    <option disabled selected>=== Pilih Kategori ===</option>
                    @foreach($categories as $result)
                    <option value="{{ $result->id }}" {{ old('category_id') == $result->id ? 'selected' : '' }}>{{ $result->name }}</option>
                    @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="gambar">Thumbnail</label>
            <img class="img-preview img-fluid">
            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" onchange="previewImage()">
            @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <input id="body" type="hidden" name="body" class="@error('body') is-invalid @enderror" value="{{ old('body') }}">
            <trix-editor input="body"></trix-editor>
            @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-primary col-5 mt-3">tambahkan data sodara</button>
        </div>
    </form>
</div>
{{-- script matikan toolbar uploard trix editor --}}
<script>
    document.addEventListener('trix-file-accept', function(e){
        e.prevenDefault();
    })

    function previewImage() 
    {
        const image = document.querySelector('#gambar')
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent)
            {
                imgPreview.src = oFREvent.target.result;
            }
    }
</script>
@endsection