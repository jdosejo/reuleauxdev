<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classification;
use App\Http\Resources\Classification as ClassificationResource;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use App\Helpers\Helper;

class ClassificationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classifications = Classification::paginate(10);
        return ClassificationResource::collection($classifications);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $classification = $request->isMethod('put') ? 
            Classification::findOrFail($request->id) : new Classification;

        $classification->name = $request->input('name');
        $classification->description = $request->input('description');
        $classification->access_level = $request->input('access_level');

        if ($classification->save()) {
            return new ClassificationResource($classification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classification = Classification::findOrFail($id);
        return new ClassificationResource($classification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classification = Classification::findOrFail($id);

        if ($classification->delete()) {
            return new ClassificationResource($classification);
        }
    }
}
