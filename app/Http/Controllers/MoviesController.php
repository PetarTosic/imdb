<?php

namespace App\Http\Controllers;

use App\Mail\CreateGenreMail;
use App\Mail\CreateMovieMail;
use App\Models\Comment;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MoviesController extends Controller
{
    public function index() {
        $movies = Movie::latest()->paginate(12);
        $popMovies = Movie::inRandomOrder()->take(10)->get();
        
        $genres = Genre::all();

        return view('welcome', compact('movies', 'genres', 'popMovies'));
    }

    public function index2($genre) {
        
        $genre = Genre::where('name', $genre)->first();
        $movies = $genre->movies()->paginate(12);
        
        $genres = Genre::all();

        return view('welcome', compact('movies', 'genres'));
    }

    public function show($title) {
        $movie = Movie::with('genres')->where('title', $title)->first();
        // dd($movie->genres[0]->name);
        $genre = $movie->genres[0];
        $movies = $genre->movies()->take(5)->get();

        $comments = $movie->comments()->latest()->paginate(5);


        return view('singlemovie', compact('movie', 'movies', 'comments'));
    }

    public function updateMovie(Request $request) {
        $request->validate([
            'title' => 'min:2|max:255|string|required',
            'year' => 'required|integer',
            'duration' => 'required|integer',
            'user_score' => 'required',
            'pegi' => 'required|integer',
            'image_url' => 'required',
            'description' => 'required|min:10|max:5000|string',
            'genres' => 'required'
        ]);
        $movie = Movie::find($request->movie_id);

        $movie->title = $request->title;
        $movie->year = $request->year;
        $movie->duration = $request->duration;
        $movie->user_score = $request->user_score;
        $movie->pegi = $request->pegi;
        $movie->image_url = $request->image_url;
        $movie->description = $request->description;
        $movie->save();

        return redirect('/movies/' . $movie->title)->with('status', 'Movie successfully updated!');
    }

    public function deleteMovie($id) {
        $movie = Movie::find($id);

        $movie->delete();

        return redirect('/managemovies')->with('status', 'Movie deleted successfully!');
    }

    public function getUpdate($id) {
        $movie = Movie::find($id);
        $genres = Genre::all();

        return view('/updatemovie', compact('movie', 'genres'));
    }

    public function getCreate() {
        $genres = Genre::all();
        return view('/createmovie', compact('genres'));
    }

    public function getGenre() {
        return view('/creategenre');
    }

    public function getManage() {
        $movies = Movie::latest()->paginate(10);

        return view('/managemovies', compact('movies'));
    }

    public function createGenre(Request $request) {
        $request->validate([
            'name' => 'min:2|max:20|string|required'
        ]);

        $genre = new Genre();

        $genre->name = $request->name;
        $genre->user_id = Auth::user()->id;
        $genre->save();
        
        // $mailData = $genre->name;
        // Mail::to(Auth::user()->email)->send(new CreateGenreMail($mailData));

        return redirect('/')->with('status', 'Genre created successfully!');
    }

    public function createMovie(Request $request) {
        $request->validate([
            'title' => 'min:2|max:255|string|required',
            'year' => 'required|integer',
            'duration' => 'required|integer',
            'user_score' => 'required',
            'pegi' => 'required|integer',
            'image_url' => 'required',
            'description' => 'required|min:10|max:5000|string',
            'genres' => 'required'
        ]);

        $movie = new Movie();

        $movie->title = $request->title;
        $movie->year = $request->year;
        $movie->duration = $request->duration;
        $movie->user_score = $request->user_score;
        $movie->pegi = $request->pegi;
        $movie->image_url = $request->image_url;
        $movie->description = $request->description;
        $movie->published_at = date("Y-m-d");
        $movie->user_id = Auth::user()->id;
        $movie->save();
        
        foreach($request->genres as $genreId) {
            $movie->genres()->attach($genreId);
        }

        $mailData = $movie->only('title');
        Mail::to(Auth::user()->email)->send(new CreateMovieMail($mailData));

        return redirect('/')->with('status', 'Movie created successfully!');
    }

    public function byGenre($name) {
        $genre = Genre::with('movies')->where('name', $name)->get()[0];
        $movies = $genre->movies()->paginate(8);

        return view('genre', compact('movies', 'genre'));
    }

    public function createComment(Request $request) {
        $request->validate([
            'body' => 'required|min:2|max:2000|string',
            'movie_id' => 'required|exists:movies,id'
        ]);

        $movie = Movie::find($request->movie_id);
        $user = User::find(Auth::user()->id);
        
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user()->associate($user);
        $comment->movie()->associate($movie);
        $comment->save();

        return redirect('/movies/' . $movie->title)->with('status', 'Comment successfully created.');
    }
}
