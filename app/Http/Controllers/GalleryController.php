<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function store(Request $request){
        $request_all=$request->all();
        dd($request_all);
        return 'true';
    }
}
