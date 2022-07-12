<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Genres;
use Illuminate\Support\Facades\DB;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genres::all();
        return view('index', compact('genres'));
    }

    public function apiIndex()
    {
        $genres = Genres::all();
        return response()->json($genres);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_of_genre' => 'required',
        ]);
        $show = Genres::create($validatedData);
        return redirect('/genres')->with('success', 'Genre is successfully saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function apiShow($id)
    {
        $filmsByGenre = DB::table('films')
            ->select('films.*')
            ->where('films.genres_id', $id)
            ->paginate(3);
        return response()->json($filmsByGenre);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genres = Genres::findOrFail($id);
        return view('edit', compact('genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name_of_genre' => 'required',
        ]);
        Genres::whereId($id)->update($validatedData);
        return redirect('/genres')->with('success', 'Genre Data is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Genres::findOrFail($id);
        $genre->delete();
        return redirect('/genres')->with('success', 'Genre Data is successfully deleted');
    }
}
