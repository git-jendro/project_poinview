<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::get()->toJson(JSON_PRETTY_PRINT);
        return response($category,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->uuid = Uuid::uuid4()->toString();
        $category->name = $request->name;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Category::where('id', $id)->exists()) {
            $category = Category::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($category, 200);
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
        if (Category::where('id', $id)->exists()) {
            $category = Category::find($id);

            $category->uuid = Uuid::uuid4()->toString();
            $category->name = is_null($request->name) ? $category->name : $request->name;
            $category->status = is_null($request->status) ? $category->status : $request->status;
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
        if (Category::where('id', $id)->exists()) {
            $category = Category::find($id);
            $category->delete();

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
