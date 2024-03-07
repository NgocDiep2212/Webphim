<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\GoiVip;
use Carbon\Carbon;
use DB;

class GoiVipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //asc: số 0 đi đầu, desc: cuối đi đầu
        $list = GoiVip::get();
        return view('admincp.admin.goivip.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.admin.goivip.form');
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
        $goivip = new GoiVip();
        $goivip->name = $data['name'];
        $goivip->price = $data['price'];
        $goivip->duration = $data['duration'];
        $goivip->status = $data['status'];
        $goivip->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $goivip->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $goivip->save();
        return redirect()->route('goivip.index');
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
        $goivip = GoiVip::find($id);
        $list = GoiVip::get();
        return view('admincp.admin.goivip.form',compact('list','goivip'));
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
        $goivip = GoiVip::find($id);
        $goivip->name = $data['name'];
        $goivip->price = $data['price'];
        $goivip->duration = $data['duration'];
        $goivip->status = $data['status'];
        $goivip->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $goivip->update();
        return redirect()->route('goivip.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //GoiVip::find($id)->delete();
        $cate = GoiVip::find($id);
        $cate->status = 0;
        $cate->update();
        return redirect()->back();
    }

}
