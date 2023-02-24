<?php

namespace App\Http\Controllers\Admin\Fe;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminFe\AdminFeAuthRequest;
use App\Http\Requests\AdminFe\AdminFeStoreRequest;
use App\Models\Ceo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminFeAuthController extends Controller
{
    /**
     * @var string
     */
    protected $pathView = 'admin.fe.auth.';

    public function index()
    {
        if (Auth::guard('ceo')->check()) {
            return redirect()->route('admin.fe.home.index');
        }
        return view($this->pathView.'login');
    }

    public function authenticate(AdminFeAuthRequest $request)
    {
        $credentials = $request->only([
            'email',
            'password'
        ]);
        if (Auth::guard('ceo')->attempt($credentials)) {
            $request->session()->regenerate();
            if($request->route) {
                return redirect($request->route)->with(['success' => trans('messages.common.success_login')]);
            }
            return redirect()->route('admin.fe.home.index')->with(['success' => trans('messages.common.success_login')]);
        }
        return redirect()->back()->with([
            'error' => __('messages.admin.login.fail'),
        ]);
    }

    public function register()
    {
        if (Auth::guard('ceo')->check()) {
            return back()->withInput();
        }
        return view($this->pathView.'register');
    }

    /**
     * Create User
     * @param AdminFeStoreRequest $request
     * @return json|Respond
     * @throws Exception
     */
    public function store(AdminFeStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'cmnd' => $request->input('cmnd'),
                'password' => Hash::make($request->input('password')),
            ];
            $ceo = Ceo::create($data);
            DB::commit();
            if($request->route) {
                return redirect($request->route)->with(['success' => trans('messages.common.success_register')]);
            }
            return redirect()->route('admin.fe.login')->with(['success' => trans('messages.common.success_register')]);
        } catch (Exception $e) {
            Log::error('[AdminFeAuthController][store] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error_register')]);
        }
    }

    public function logout()
    {
        Auth::guard('ceo')->logout();
        return redirect()->route('admin.fe.home.index');
    }
}
