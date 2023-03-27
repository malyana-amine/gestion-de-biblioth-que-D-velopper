<?php

namespace App\Http\Controllers;
use App\Models\genre;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class genreController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }
    public function index(){

        $genre = genre::all();

        if($genre->count()>0){

            return response()->json([
                'status' => 200,
                'genre' => $genre
            ], 200);
        }
        else{
            return response()->json([
                'status' => 404,
                'genre' => 'no data here'
            ], 404);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'genre' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'errors' => $validator->errors()
            ], 422);
        } else {
            $genre = genre::create([
                'genre'=>$request->genre,
            ]);
    
            if($genre){
                return response()->json([
                    'status'=>200,
                    'message'=>"add genre"
                ], 200);
            } else {
                return response()->json([
                    'status'=>500,
                    'message'=>"something wrong"
                ], 500);
            }
        }
    }

    public function edit($id){
        $genre = genre::find($id);

        if($genre){

            
            return response()->json([
                'status'=>200,
                'message'=>$genre
            ], 200);

        }else {
                return response()->json([
                    'status'=>404,
                    'message'=>"genre not found"
                ], 404);
            }

    }

    public function update(Request $request, $id)
    {
    
    
        $validator = Validator::make($request->all(),[
            'genre' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'errors' => $validator->errors()
            ], 422);
        } else {
    
            $genre = genre::find($id);
    
            if($genre){
    
                $genre->update([
                    'genre'=>$request->genre,
                ]);
    
    
    
                return response()->json([
                    'status'=>200,
                    'message'=>"update successfully"
                ], 200);
            } else {
                return response()->json([
                    'status'=>404,
                    'message'=>"genre not found"
                ], 404);
            }
        }
    
    
    }

    public function delete($id)
    {
        $genre = genre::find($id);
        if (!$genre) {
            return response()->json([
                'status' => 404,
                'message' => 'genre not found',
            ], 404);
        }
        
        $genre->delete();
    
        return response()->json([
            'status' => 200,
            'message' => 'genre deleted successfully',
        ], 200);
    }
}
