<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tweet;

class TweetsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store()
    {

        $attributes = request()->validate([
            'body' => 'required|max:255'
        ]);

        Tweet::create([
            'user_id' => auth()->user()->id,
            'body' => $attributes['body']
        ]);

        return redirect('/home');
    }

}
