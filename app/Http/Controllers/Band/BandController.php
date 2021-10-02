<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Models\Band;
use App\Models\Genre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BandController extends Controller
{
    public function table()
    {
        return view('bands.table', [
            'bands' => Band::latest()->paginate(10),
        ]);
    }

    public function create()
    {

        return view('bands.create', [
            'genres' => Genre::get(),
        ]);
    }

    public function store()
    {
        //role 
        request()->validate([
            'name' => 'required|unique:bands,name',
            'thumbnail' => request('thumbnail') ? 'image|mimes:jpeg,jpg,png,gif' : '',
            'genres' => 'required|array',
        ]);

        //insert data base
        $band = Band::create([
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
            'thumbnail' => request('thumbnail') ? request()->file('thumbnail')->store('image/band') : null,
        ]);

        $band->genres()->sync(request('genres'));

        return back()->with('success', 'Band was created!');
    }

    public function edit(Band $band)
    {
        return view('bands.edit', [
            'band' => $band,
            'genres' => Genre::get(),
        ]);
    }
    //copy store
    public function update(Band $band)
    {
        //role 
        request()->validate([
            'name' => 'required|unique:bands,name,' . $band->id,
            'thumbnail' => request('thumbnail') ? 'image|mimes:jpeg,jpg,png,gif' : '',
            'genres' => 'required|array',
        ]);

        if (request('thumbnail')) {
            Storage::delete($band->thumbnail);
            $thumbnail = request()->file('thumbnail')->store('images/band');
        } elseif ($band->thumbnail) {
            $thumbnail = $band->thumbnail;
        } else {
            $thumbnail = null;
        }
        //insert data base
        $band->update([
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
            'thumbnail' => $thumbnail,
        ]);

        $band->genres()->sync(request('genres'));

        return back()->with('success', 'Band was created!');
    }
}
