@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create new category</h1>
</div>

<div class="col-lg-8">
    <form method="POST" action="/dashboard/categories">
        @csrf
        <div class="form-group">
            <label for="categories">category</label>
            <input type="text" class="form-control @error('categories') is-invalid @enderror" id="categories" name="categories" placeholder="masukkan post" autocomplete="off" value="{{ old('categories') }}">
            @error('categories')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-primary col-5 mt-3">tambahkan data sodara</button>
        </div>
    </form>
</div>
@endsection