<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    protected $pathView = 'user.auth.';

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prev = $request->prev;
        return view($this->pathView.'index', compact('prev'));
    }
}
