<?php

namespace App\Http\Controllers;

use App\Thread;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thread = Thread::get()->toJson(JSON_PRETTY_PRINT);
        return response($thread,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $thread = new Thread;
        $thread->uuid = Uuid::uuid4()->toString();
        $thread->user_id = Auth::user()->id;
        $thread->category_id = $request->category_id;
        $thread->heading = $request->heading;
        $thread->body = $request->body;
        $thread->slug = Str::slug($request->heading);
        $thread->save();

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
        
        if (Thread::where('slug', $slug)->exists()) {
            $thread = Thread::where('slug', $slug)->get()->toJson(JSON_PRETTY_PRINT);
            return response($thread, 200);
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
        if (Thread::where('id', $id)->exists()) {
            $thread = Thread::find($id);

            $thread->uui = $thread->uuid;
            $thread->category_id = is_null($request->category_id) ? $thread->category_id : $request->category_id;
            $thread->user_id = User::where('id', auth()->user()->id)->first();
            $thread->slug = is_null($request->slug) ? $thread->slug : $request->slug;
            $thread->heading = is_null($request->heading) ? $thread->heading : $request->heading;
            $thread->body = is_null($request->body) ? $thread->body : $request->body;
            $thread->status = is_null($request->status) ? $thread->status : $request->status;
            
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
        if (Thread::where('id', $id)->exists()) {
            $thread = Thread::find($id);
            $thread->delete();

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
