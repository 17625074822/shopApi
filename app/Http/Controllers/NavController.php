<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNavRequest;
use App\Nav;
use Illuminate\Http\Request;

class NavController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNavRequest $request)
    {
        $nav = Nav::create([
            'position_id'=>$request->position_id,
            'title'=>$request->title,
            'picture'=>$request->picture,
            'link_type'=>$request->link_type,
            'linkable_id'=>$request->linkable_id,
            'status'=>$request->status,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Nav $nav
     * @return \Illuminate\Http\Response
     */
    public function show(Nav $nav)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Nav $nav
     * @return \Illuminate\Http\Response
     */
    public function edit(Nav $nav)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Nav $nav
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nav $nav)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Nav $nav
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nav $nav)
    {
        //
    }
}
