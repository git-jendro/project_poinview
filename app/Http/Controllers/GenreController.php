<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genre = Genre::get()->toJson(JSON_PRETTY_PRINT);
        return response($genre,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $genre = new Genre;
        $genre->uuid = Uuid::uuid4()->toString();
        $genre->name = $request->name;
        $genre->description = $request->description;
        $genre->thumbnail = $request->file('thumbnail')->store('thumbnail');
        $genre->save();

        return response()->json([
            "message" => "Record stored"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Genre::where('id', $id)->exists()) {
            $genre = Genre::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($genre, 200);
        }else {
            
            return response()->json([
                "message" => "Record not found"
            ], 400);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
