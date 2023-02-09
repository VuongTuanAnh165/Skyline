<?php

namespace App\Http\Controllers\Admin\Be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBeHomeController extends Controller
{
    protected $pathView = 'admin.be.home.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->pathView.'index');
    }
}
