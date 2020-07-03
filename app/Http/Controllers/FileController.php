<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $newFileName= str::random(45).'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->storeAs('files' , $newFileName);

        return  response()->json([
            'url' => storage_path('app\\files\\').$newFileName
        ]);
    }
}
