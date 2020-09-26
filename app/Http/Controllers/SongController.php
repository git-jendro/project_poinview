<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

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
        $song->slug = Str::slug($request->name);
        $song->genre = $request->genre;
        $song->lyric = $request->lyric;
        $song->description = $request->description;
        $song->song = Storage::put('Song', $request->song);
        $song->thumbnail = Storage::put('Thumbnail', $request->thumbnail);
        $song->save();

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
    public function show($slug)
    {

        if (Song::where('slug', $slug)->exists()) {
            $song = Song::where('slug', $slug)->get()->toJson(JSON_PRETTY_PRINT);
            return response($song, 200);
          } else {
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
        // if (Student::where('id', $id)->exists()) {
        //     $student = Student::find($id);
        //     $student->name = is_null($request->name) ? $student->name : $request->name;
        //     $student->course = is_null($request->course) ? $student->course : $request->course;
        //     $song->album_id = is_null($request->album_id) ? $song->album_id : $request->album_id;
        //     $student->save();
    
        //     return response()->json([
        //         "message" => "records updated successfully"
        //     ], 200);
        //     } else {
        //     return response()->json([
        //         "message" => "Student not found"
        //     ], 404);
            
        // }

        if (Song::where('id',$id)->exists()) {
            $song = Song::find($id);

            $song->uuid = is_null($request->uuid) ? $song->uuid : $request->uuid ;
            $song->album_id = is_null($request->album_id) ? $song->album_id : $request->album_id;
            $song->name = is_null($request->name) ? $song->name : $request->name;
            $song->slug = is_null($request->slug) ? $song->slug : Str::slug($request->name);
            $song->genre = is_null($request->genre) ? $song->genre : $request->genre;
            $song->lyric = is_null($request->lyric) ? $song->lyric : $request->lyric;
            $song->description = is_null($request->description) ? $song->description : $request->decription;
            // $song->thumbnail = is_null($request->file('thumbnail')->store('thumbnail')) ? $song->thumbnail : $request->file('thumbnail')->store('thumbnail');
            $song->thumbnail = Storage::putFile('thumbnail', $request->file('thumbnail'));
            $song->save();

            return response()->json([
                "message" => "Record updated"
            ], 200);
        }else {
            return response()->json([
                "message" => "Record not found"
            ], 404);
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
