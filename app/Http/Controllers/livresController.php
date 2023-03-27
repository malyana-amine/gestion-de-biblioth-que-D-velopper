<?php

namespace App\Http\Controllers;

use App\Models\genre;
use App\Models\livres;
use App\Models\collection;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class livresController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }
    public function index()
    {
        $livres=livres::with(['genre','Collection'])->get();
        return response()->json([
            "livres"=>$livres
        ],200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'isbn'=>'required',
            'pages_number'=>'required|integer',
            'emplacement' =>'required|in:placeA,palceB,placeC',
            'status'=>'required|in:disponible,indisponible,emprunté',
            'contenu'=>'required',
            'collectionId' => 'required|integer',
            'genreId' => 'required|integer',
        ]);
        $livres=new livres($request->all());
       
        

            $livres->collection()->associate($request->collectionId);
           


            $livres->genre()->associate($request->genreId);
            $livres->save();

        return response()->json([
            "message"=>'livres is succesfuly stored'
        ],201);
    }



    // public function show($id)
    // {
    //     $livres=livres::findOrFail($id)->with(['genre','Collection'])->get();
    //     return response()->json([
    //         "livres"=>$livres
    //     ],200);
    // }



    public function show($id){
        $livres = livres::find($id);

        if($livres){

            
            return response()->json([
                'status'=>200,
                'message'=>$livres
            ], 200);

        }else {
                return response()->json([
                    'status'=>404,
                    'message'=>"livres not found"
                ], 404);
            }

    }




    public function update(Request $request,$id)
    {
        // $request->validate([
        //     'title'=>'max:255',
        //     'isbn'=>'max:255',
        //     'pages_number'=>'integer',
        //     'emplacement' =>'in:placeA,palceB,placeC',
        //     'status'=>'in:disponible,indisponible,emprunté',
        //     'contenu'=>'max:255',
        //     'collectionId' => 'integer',
        //     'genreId' => 'integer',
        // ]);

        $validator = Validator::make($request->all(),[
            'title'=>'max:255',
            'isbn'=>'max:255',
            'pages_number'=>'integer',
            'emplacement' =>'in:placeA,palceB,placeC',
            'status'=>'in:disponible,indisponible,emprunté',
            'contenu'=>'max:255',
            'collectionId' => 'integer',
            'genreId' => 'integer',
        ]);
        // $livres=livres::findOrFail($id);
        // $livres->update($request->except('_method'));
      
        // return response()->json([
        //     "message"=> "data is succesfuly updated",
        //     "livres"=>$livres
        // ],200);


        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'errors' => $validator->errors()
            ], 422);
        } else {
    
            $livres = livres::find($id);
    
            if($livres){
    
                $livres->update($request->all());
    
                return response()->json([
                    'status'=>200,
                    'message'=>"update successfully"
                ], 200);
            } else {
                return response()->json([
                    'status'=>404,
                    'message'=>"livres not found"
                ], 404);
            }
        }
    

    }


    public function delete($id)
    {
        $livres = livres::find($id);
        if (!$livres) {
            return response()->json([
                'status' => 404,
                'message' => 'livres not found',
            ], 404);
        }
        
        $livres->delete();
    
        return response()->json([
            'status' => 200,
            'message' => 'livres deleted successfully',
        ], 200);
    }
}
