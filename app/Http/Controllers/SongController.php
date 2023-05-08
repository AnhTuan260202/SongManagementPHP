<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Song::paginate(10);
        $data = DB::table('songs')
            ->join('categories', 'songs.category_id', '=', 'categories.id')
            ->select('songs.id', 'songs.title', 'songs.artist', 'categories.name as category_name', 'songs.image', 'songs.created_at')
            // ->latest('title')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('song.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('song.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'category_id' => 'required|exists:categories,id',
            'length' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10240|dimensions:min_width=1,min_height=1,max_width=10000,max_height=10000',
        ]);

        $file_name = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);

        $song = new Song();
        $song->title = $request->title;
        $song->artist = $request->artist;
        $song->category_id = $request->category_id;
        $song->length = $request->length;
        $song->image = $file_name;

        $song->save();

        return redirect()->route('songs.index')->with('success', 'Song added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        $category = Category::find($song->category_id);
        return view('song.show', compact('song', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        $categories = Category::all();
        return view('song.edit', compact('song', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Song $song)
    {
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'category_id' => 'required|exists:categories,id',
            'length' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10240|dimensions:min_width=1,min_height=1,max_width=10000,max_height=10000',
        ]);

        $image = $request->hidden_image;
        if ($request->image != '') {
            $image = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $image);
        }

        $song = Song::find($request->hidden_id);

        $song->title = $request->title;
        $song->artist = $request->artist;
        $song->category_id = $request->category_id;
        $song->length = $request->length;
        $song->image = $image;

        $song->save();
        return redirect()->route('songs.index')->with('success', 'Song data has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        $song->delete();
        return redirect()->route('songs.index')->with('success', 'Song data deleted successfully.');
    }
}
