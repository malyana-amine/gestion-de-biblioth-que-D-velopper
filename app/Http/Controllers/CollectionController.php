<?php

namespace App\Http\Controllers;
use App\Models\collection;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index(){

        $collection = collection::all();

        if($collection->count()>0){

            return response()->json([
                'status' => 200,
                'collection' => $collection
            ], 200);
        }
        else{
            return response()->json([
                'status' => 404,
                'collection' => 'no data here'
            ], 404);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'collection' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'errors' => $validator->errors()
            ], 422);
        } else {
            $collection = collection::create([
                'collection'=>$request->collection,
            ]);
    
            if($collection){
                return response()->json([
                    'status'=>200,
                    'message'=>"add collection"
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
        $collection = collection::find($id);

        if($collection){

            
            return response()->json([
                'status'=>200,
                'message'=>$collection
            ], 200);

        }else {
                return response()->json([
                    'status'=>404,
                    'message'=>"collection not found"
                ], 404);
            }

    }

    public function update(Request $request, $id)
    {
    
    
        $validator = Validator::make($request->all(),[
            'collection' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'errors' => $validator->errors()
            ], 422);
        } else {
    
            $collection = collection::find($id);
    
            if($collection){
    
                $collection->update([
                    'collection'=>$request->collection,
                ]);
    
    
    
                return response()->json([
                    'status'=>200,
                    'message'=>"update successfully"
                ], 200);
            } else {
                return response()->json([
                    'status'=>404,
                    'message'=>"collection not found"
                ], 404);
            }
        }
    
    
    }

    public function delete($id)
    {
        $collection = collection::find($id);
        if (!$collection) {
            return response()->json([
                'status' => 404,
                'message' => 'collection not found',
            ], 404);
        }
        
        $collection->delete();
    
        return response()->json([
            'status' => 200,
            'message' => 'collection deleted successfully',
        ], 200);
    }
}
