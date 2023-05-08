@extends('master')

@section('title', 'Edit Song')

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
    <div class="card-header">Edit Song</div>
    <div class="card-body">
        <form method="post" action="{{ route('songs.update', $song->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">Song Title</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" value="{{ $song->title }}"/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">Song Artist</label>
                <div class="col-sm-10">
                    <input type="text" name="artist" class="form-control" value="{{ $song->artist }}" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">Song Length</label>
                <div class="col-sm-10">
                    <input type="number" min="1" name="length" class="form-control" required value="{{ $song->length }}" />
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-label-form">Category</label>
                <div class="col-sm-10">
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            @if ($category->id == $song->category_id)                                
                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-sm-2 col-label-form">Song Image</label>
                <div class="col-sm-10">
                    <input type="file" name="image" />
                    <br />
                    <img src="{{ asset('images/' . $song->image) }}" width="100" class="img-thumbnail" />
                    <input type="hidden" name="hidden_image" value="{{ $song->image }}" />
                </div>
            </div>
            <div class="text-center">
                <input type="hidden" name="hidden_id" value="{{ $song->id }}" />
                <input type="submit" class="btn btn-primary" value="Save" />
            </div>
        </form>
    </div>
</div>

@endsection('content')
