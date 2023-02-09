<?php

namespace App\Http\Controllers\Admin\Fe;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class AdminFePolicyController extends Controller
{
    protected $pathView = 'admin.fe.policy.';
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id, $name_link)
    {
        $policy = Policy::find($id);
        return view($this->pathView.'index', compact('policy'));
    }
}
