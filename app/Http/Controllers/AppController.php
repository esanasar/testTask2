<?php

namespace App\Http\Controllers;

use App\App;
use App\Http\Resources\AppResource;
use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AppResource::collection(App::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50' ,
            'description'=> 'required' ,
            'icon' => 'required|url',
            'creator' => 'required|max:50'
        ]);

        $app = App::create($request->all());

        return new AppResource($app);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(App $app)
    {
        return new AppResource($app);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, App $app)
    {
        $request->validate([
            'name' => 'required|max:50' ,
            'description'=> 'required' ,
            'icon' => 'required|url',
            'creator' => 'required|max:50'
        ]);

        $app->update($request->all());

        return new AppResource($app);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(App $app)
    {
        $app->delete();

        return response('massege' , 'deleted');
    }
}
