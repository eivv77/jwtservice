<?php

namespace App\Http\Controllers;

use App\Http\Resources\RatingResource;
//use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        /** @noinspection PhpUndefinedFieldInspection */
        $rating = Rating::firstOrCreate(
            ['rating' => $request->rating],
            [
                'user_id' => $request->user()->id,
                'book_id' => $request->input("book_id"),

            ]
        );

        return new RatingResource($rating);
    }

    public function __construct()
    {
        $this->middleware('auth:api');
    }
}
