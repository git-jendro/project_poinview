<?php

namespace App\Http\Controllers;

use App\Album;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $album = Album::get()->toJson(JSON_PRETTY_PRINT);
        return response($album, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $album  = new Album;
        $album->uuid = Uuid::uuid4()->toString();
        $album->user_id = User::where('id', auth()->user()->id)->firstOrFail();
        $album->name = $request->name;
        $album->description = $request->description;
        $album->thumbnail = $request->thumbnail;

        $album->save();

        return response()->json([
            "message" => "record stored"
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       if(Album::where('id',$id)->exists()){
           $album = Album::where('id',$id)->get()->toJson(JSON_PRETTY_PRINT);
           return response($album, 200);
       }else {
           return response()->json([
               "messsage" => "Record not found"
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
        if (Album::where('id', $id)->exists()) {
            $album = Album::find($id);
            
            $album->uuid = Uuid::uuid4()->toString();
            $album->user_id = Auth::user()->id;
            $album->name = is_null($request->name) ? $album->name : $request->name;
            $album->description = is_null($request->description) ? $album->description : $request->description;
            $album->thumbnail = is_null($request->thumbnail) ? $album->thumbnail : $request->thumbnail;
            $album->save();

            return response()->json([
                "message" => "Record updated"
            ],200);
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
        if (Album::where('id', $id)->exists()) {
            $album = Album::find($id);
            $album->delete();

            return response()->json([
                "message" => "Record deleted"
            ], 202);
        }else{
            return response()->json([
                "message" => "Record not found"
            ], 404);
        }
    }
}
