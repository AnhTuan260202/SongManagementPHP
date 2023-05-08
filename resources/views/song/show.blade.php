@extends('master')

@section('title', 'Song Details')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"><b>Song Details</b></div>
            <div class="col col-md-6">
                <a href="{{ route('songs.index') }}" class="btn btn-primary btn-sm float-end">View All</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <label class="col-sm-2 col-label-form"><b>Song Title</b></label>
            <div class="col-sm-10">
                {{ $song->title }}
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-label-form"><b>Song Artist</b></label>
            <div class="col-sm-10">
                {{ $song->artist }}
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-label-form"><b>Category</b></label>
            <div class="col-sm-10">
                {{ $category->name }}
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-label-form"><b>Song Length</b></label>
            <div class="col-sm-10">
                {{ $song->length }}
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-sm-2 col-label-form"><b>Song Image</b></label>
            <div class="col-sm-10">
                <img src="{{ asset('images/' .  $song->image) }}" width="200" class="img-thumbnail" />
            </div>
        </div>
    </div>
</div>

@endsection('content')