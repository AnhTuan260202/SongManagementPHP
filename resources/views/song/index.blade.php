@extends('master')

@section('title', 'Songs')

@section('content')

@if($message = Session::get('success'))

<div class="alert alert-success">
    {{ $message }}
</div>

@endif

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"><b>Song Data</b></div>
            <div class="col col-md-6">
                <a href="{{ route('songs.create') }}" class="btn btn-success btn-sm float-end">Add</a>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm float-end m-r">Đăng xuất</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Artist</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            @if(count($data) > 0)

                @foreach($data as $key => $row)
                    <tr>
                        <td>{{ $data->firstItem() + $key }}</td>
                        <td><img src="{{ asset('images/' . $row->image) }}" width="75" /></td>
                        <td>{{ $row->title }}</td>
                        <td>{{ $row->artist }}</td>
                        <td>{{ $row->category_name }}</td>
                        <td>
                            <form method="post" action="{{ route('songs.destroy', $row->id) }}">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('songs.show', $row->id) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ route('songs.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
                            </form>

                        </td>
                    </tr>

                @endforeach

            @else
                <tr>
                    <td colspan="5" class="text-center">No Data Found</td>
                </tr>
            @endif
        </table>
        {!! $data->links('pagination::bootstrap-5') !!}
    </div>
</div>

@endsection