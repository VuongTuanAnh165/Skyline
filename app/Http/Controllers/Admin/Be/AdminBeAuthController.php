<?php

namespace App\Http\Controllers\Admin\Be;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminBe\AdminBeAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBeAuthController extends Controller
{
    /**
     * @var string
     */
    protected $pathView = 'admin.be.auth.';

    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.home.index');
        }
        return view($this->pathView.'login');
    }

    public function authenticate(AdminBeAuthRequest $request)
    {
        $credentials = $request->only([
            'email',
            'password'
        ]);
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.home.index');
        }
        return redirect()->back()->with([
            'error' => __('messages.admin.login.fail'),
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
