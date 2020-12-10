<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Tweet;

class TweetsController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        return view('tweets.index', [
            'tweets' => auth()->user()->timeline()
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'body' => 'required|max:255',
            'image' => 'file'
        ]);

        if ( request('image') ) {
            $attributes['image'] = request('image')->store('tweets_images');
        }

        $attributes['user_id'] = auth()->user()->id; 

        Tweet::create($attributes);

        return redirect()->route('home')->with('success', 'Tweet published successfully!');
    }

    public function destroy(Tweet $tweet)
    {
        if (Storage::exists($tweet->image)) Storage::delete($tweet->image);

        $tweet->delete();

        return back();
    }

}
