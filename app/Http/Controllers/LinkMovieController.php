<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LinkMovie;

class LinkMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //asc: số 0 đi đầu, desc: cuối đi đầu
        $list = LinkMovie::orderBy('id','ASC')->get();
        return view('admincp.linkmovie.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.linkmovie.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $linkmovie = new LinkMovie();
        $linkmovie->title = $data['title'];
        $linkmovie->description = $data['description'];
        $linkmovie->status = $data['status'];
        $linkmovie->save();
        return redirect()->route('linkmovie.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $linkmovie = LinkMovie::find($id);
        $list = LinkMovie::orderBy('id','ASC')->get();
        return view('admincp.linkmovie.form',compact('list','linkmovie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $linkmovie = LinkMovie::find($id);
        $linkmovie->title = $data['title'];
        $linkmovie->description = $data['description'];
        $linkmovie->status = $data['status'];
        $linkmovie->save();
        return redirect()->route('linkmovie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LinkMovie::find($id)->delete();
        return redirect()->back();
    }
}
