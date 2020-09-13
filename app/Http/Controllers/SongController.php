<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $song = Song::get()->toJson(JSON_PRETTY_PRINT);
        return response($song,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $song = new Song;
        $song->uuid = Uuid::uuid4()->toString();
        $song->album_id = $request->album_id;
        $song->name = $request->name;
        $song->genre = $request->genre;
        $song->lyric = $request->lyric;
        $song->description = $request->description;
        $song->thumbnail = $request->file('thumbnail')->store('thumbnail');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Song::wherer('id', $id)->exists()) {
            $song = Song::where('id',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response()->json($song,200);
        }else {
            return response()->json([
                "message" => "Record not found"
            ], 404);
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
        if (Song::where('id',$id)->exists()) {
            $song = Song::find($id);

            $song->uuid = Uuid::uuid4()->toString();
            $song->album_id = is_null($request->album_id) ? $song->album_id : $request->album_id;
            $song->name = is_null($request->name) ? $song->name : $request->name;
            $song->genre = is_null($request->genre) ? $song->genre : $request->genre;
            $song->lyric = is_null($request->lyric) ? $song->lyric : $request->lyric;
            $song->description = is_null($request->description) ? $song->description : $request->decription;
            $song->thumbnail = is_null($request->file('thumbnail')->store('thumbnail')) ? $song->thumbnail : $request->file('thumbnail')->store('thumbnail');
            $song->save();

            return response()->json([
                "message" => "Record updated"
            ], 200);
        }else {
            return response()->json([
                "message" => "Record not found"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Song::where('id', $id)->exists()) {
            $song = Song::find($id);
            $song->delete();

            return response()->json([
                "message" => "Record deleted"
            ], 202);
        }else {
            return response()->json([
                "message" => "Record not found"
            ], 404);
        }
    }
}
