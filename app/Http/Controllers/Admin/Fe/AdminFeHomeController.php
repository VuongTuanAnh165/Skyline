<?php

namespace App\Http\Controllers\Admin\Fe;

use App\Http\Controllers\Controller;
use App\Models\Ceo;
use App\Models\Help;
use App\Models\Promotion;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminFeHomeController extends Controller
{
    protected $pathView = 'admin.fe.home.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service_first = Service::first();
        $service_show_home = Service::where('show_home', 1)->first();
        $helps = Help::where('show_home', 1)->limit(6)->get();
        return view($this->pathView.'index', compact('service_first', 'service_show_home', 'helps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
