<?php

namespace App\Http\Controllers;

use App\App;
use App\Http\Resources\AppResource;
use Illuminate\Http\Request;
use http\Env\Response;

class AppController extends Controller
{
    /**
     *
     * @param Request $request
     * @return Response|string
     */


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    /**
     * @SWG\Get(
     *     path="api/apps",
     *     description="Return all apps",
     *     @SWG\Parameter(
     *         name="name",
     *         in="query",
     *         type="string",
     *         description="app name",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="description",
     *         in="query",
     *         type="string",
     *         description="app description",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="icon",
     *         in="query",
     *         type="string",
     *         description="app icon",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="creator",
     *         in="query",
     *         type="string",
     *         description="app creator",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @SWG\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *
     * )
     */
    public function index()
    {
        abort_if(Gate::denies('project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return AppResource::collection(App::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Post(
     *     path="api/apps",
     *     description="add new record to app table",
     *     @SWG\Parameter(
     *         name="name",
     *         in="query",
     *         type="string",
     *         description="app name",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="description",
     *         in="query",
     *         type="string",
     *         description="app description",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="icon",
     *         in="query",
     *         type="string",
     *         description="app icon",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="creator",
     *         in="query",
     *         type="string",
     *         description="app creator",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=201,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Bad request",
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Forbidden",
     *     )
     * )
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50' ,
            'description'=> 'required' ,
            'icon' => 'required|url',
            'creator' => 'required|max:50'
        ]);
//        $appData = $request->all();

//        if (empty($appData['name']) && empty($appData['description']) && empty($appData['icon']) && empty($appData['creator'])) {
//            return new \Exception('Missing data', 404);
//        }

        $app = App::create($request->all());

        return (new AppResource($app))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $app
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Get(
     *     path="api/apps/{app}",
     *     description="show one record in app table",
     *     @SWG\Parameter(
     *         name="name",
     *         in="query",
     *         type="string",
     *         description="app name",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="description",
     *         in="query",
     *         type="string",
     *         description="app description",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="icon",
     *         in="query",
     *         type="string",
     *         description="app icon",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="creator",
     *         in="query",
     *         type="string",
     *         description="app creator",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Bad request",
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Forbidden",
     *     )
     * )
     */
    public function show(App $app)
    {
        abort_if(Gate::denies('project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new AppResource($app);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $app
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Put(
     *     path="api/apps/{app}",
     *     description="update record in app table",
     *     @SWG\Parameter(
     *         name="name",
     *         in="query",
     *         type="string",
     *         description="app name",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="description",
     *         in="query",
     *         type="string",
     *         description="app description",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="icon",
     *         in="query",
     *         type="string",
     *         description="app icon",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="creator",
     *         in="query",
     *         type="string",
     *         description="app creator",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=202,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Bad request",
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Forbidden",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Not found",
     *     )
     * )
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

        return (new AppResource($app))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $app
     * @return \Illuminate\Http\Response
     */

    /**
     * @SWG\Delete(
     *     path="api/apps/{app}",
     *     description="delete record from app table",
     *     @SWG\Parameter(
     *         name="name",
     *         in="query",
     *         type="string",
     *         description="app name",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="description",
     *         in="query",
     *         type="string",
     *         description="app description",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="icon",
     *         in="query",
     *         type="string",
     *         description="app icon",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="creator",
     *         in="query",
     *         type="string",
     *         description="app creator",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=204,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Forbidden",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Not found",
     *     )
     * )
     */
    public function destroy(App $app)
    {
        abort_if(Gate::denies('project_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $app->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
