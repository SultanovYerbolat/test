<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $films = DB::table('films')->join('genres', 'films.genres_id', '=', 'genres.id')->select('films.*', 'genres.name_of_genre')->where('films.published', '0')->get();
        return view('admin', compact('films'));
    }
}
