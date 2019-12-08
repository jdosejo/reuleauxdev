<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Http\Resources\Branch as BranchResource;
use Session;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::paginate(15);
        return BranchResource::collection($branches);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $branch = $request->isMethod('put') ? 
            Branch::findOrFail($request->id) : new Branch;

        $branch->code = $request->input('code');
        $branch->name = $request->input('name');
        $branch->description = $request->input('description');
        $branch->address = $request->input('address');
        $branch->contact = $request->input('contact');
        $branch->status = $request->input('status');

        //Session::flash('success', 'Successfully created ' . $branch->name . ' branch.');
        //session(['success' => 'Successfully created ' . $branch->name . ' branch.']);
        
        if ($branch->save()) {
            
            return new BranchResource($branch);
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
        $branch = Branch::findOrFail($id);
        return new BranchResource($branch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);

        if ($branch->delete()) {
            return new BranchResource($branch);
        }
    }
}
