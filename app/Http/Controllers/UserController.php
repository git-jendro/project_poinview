<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::get()->json(JSON_PRETTY_PRINT);
        return response($user,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->uuid = Uuid::uuid4()->toString();
        $user->name = $request->name;
        $user->label = $request->label;
        $user->photo = $request->photo;
        $user->description = $request->description;
        $user->save();

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
    public function show($uuid)
    {
        if (User::where('uuid', $uuid)->exists()) {
            $user = User::where('uuid', $uuid)->get()->toJson(JSON_PRETTY_PRINT);
            return response($user, 200);
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
    public function update(Request $request, $uuid)
    {
        if (User::where('uuid', $uuid)->exists()) {
            $user = User::find($uuid);

            $user->uuid = is_null($request->uuid) ? $user->uuid : $request->uuid;
            $user->name = is_null($request->name) ? $user->name : $request->name;
            $user->label = is_null($request->label) ? $user->label : $request->label;
            $user->photo = is_null($request->photo) ? $user->photo : $request->photo;
            $user->description = is_null($request->description) ? $user->description : $request->description;
            $user->save();
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
    public function destroy($uuid)
    {
        if (User::where('uuid', $uuid)->exists()) {
            $user = User::find($uuid);
            $user->delete();

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
