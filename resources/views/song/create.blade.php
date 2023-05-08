@extends('master')

@section('title', 'Create Song')

@section('content')

@if($errors->any())

<div class="alert alert-danger">
    <ul>
    @foreach($errors->all() as $error)

        <li>{{ $error }}</li>

    @endforeach
    </ul>
</div>

@endif

<div class="card">
    <div class="card-header">Add Song</div>
    <div class="card-body">
        <form method="post" action="{{ route('songs.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">Song Title</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">Song Artist</label>
                <div class="col-sm-10">
                    <input type="text" name="artist" class="form-control" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">Song Length</label>
                <div class="col-sm-10">
                    <input type="number" min="1" name="length" class="form-control" required value="1" />
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-label-form">Category</label>
                <div class="col-sm-10">
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-label-form">Song Image</label>
                <div class="col-sm-10">
                    <input type="file" name="image" />
                </div>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Add" />
            </div>
        </form>
    </div>
</div>

@endsection('content')
