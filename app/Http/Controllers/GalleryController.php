<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;

class GalleryController extends Controller
{
    public function showAll(){
        $responseArr= Gallery::all();
        

        // if($responseArr){
        //     $responseArr['status']=0;
        //     $responseArr['data']=Gallery::all();
        // }
        return response($responseArr,200);

    }

    public function store(Request $request){

        $filepath='';
        if($request->imageUrl){
            $photoName=time().'.'.$request->imageUrl->getClientOriginalExtension();
            $uploadStatus=$request->imageUrl->move(public_path('avatar'),$photoName);
            if($uploadStatus){
                $filepath=public_path('avatar').'/'.$photoName;
            }   
        }
        $responseArr=$request->all();
        $responseArr['imageUrl']=env('APP_URL').'/avatar/'.$photoName;
        $result=Gallery::create($responseArr);


        if($result){
            $responseArr['status']=0;
            $responseArr['errorMessage']='Successful';
            $responseArr['data']=$result;
        
        }else{
            $responseArr['status']=1;
            $responseArr['errorMessage']='Unsuccessful';
            $responseArr['data']=$result;
        }

        return response($responseArr,200)->header('Content-Type','application/json');
        
    }
}
