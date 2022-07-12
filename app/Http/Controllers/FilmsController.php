<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Films;
use App\Models\Genres;
use Illuminate\Support\Facades\DB;

class FilmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = DB::table('films')
            ->join('genres', 'films.genres_id', '=', 'genres.id')
            ->select('films.*', 'genres.name_of_genre')
            ->where('films.published', '1')
            ->get();
        return view('indexfilm', compact('films'));
    }

    public function apiIndex()
    {
        $films = DB::table('films')
            ->join('genres', 'films.genres_id', '=', 'genres.id')
            ->select('films.*', 'genres.name_of_genre')
            ->where('films.published', '1')
            ->paginate(3);
        return response()->json($films);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genres::all();
        return view('createfilm', compact('genres'));
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
            'name_of_film' => 'required',
            'genres_id' => 'required',
        ]);
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);
            $validatedData['link_to_poster'] = $filename;
        } else {
            $validatedData['link_to_poster'] = 'default-img-for-films.png';
        }
        $validatedData['published'] = FALSE;

        $show = Films::create($validatedData);
        return redirect('/films')->with('success', 'Film is successfully saved!');
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
        $film = Films::findOrFail($id);
        return response()->json($film);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $film = Films::findOrFail($id);
        $genre = Genres::findOrFail($film->genres_id);
        $genres = Genres::all();

        return view('editfilm', compact('film', 'genre', 'genres'));
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
            'name_of_film' => 'required',
            'genres_id' => 'required',
        ]);
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);
            $validatedData['link_to_poster'] = $filename;
        } else {
            $validatedData['link_to_poster'] = 'default-img-for-films.png';
        };

        Films::whereId($id)->update($validatedData);
        return redirect('/films')->with('success', 'Film Data is successfully updated');
    }

    public function publish($id)
    {
        $validatedData['published'] = TRUE;
        Films::whereId($id)->update($validatedData);
        return redirect('/films')->with('success', 'Film published is successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $film = Films::findOrFail($id);
        $film->delete();
        return redirect('/films')->with('success', 'Film Data is successfully deleted');
    }
}
