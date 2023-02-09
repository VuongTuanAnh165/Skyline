<?php

namespace App\Http\Controllers\Admin\Fe;

use App\Http\Controllers\Controller;
use App\Models\Ceo;
use App\Models\Help;
use App\Models\Service;
use App\Models\ServiceCharge;
use App\Models\ServiceGroup;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class AdminFeServiceController extends Controller
{
    protected $pathView = 'admin.fe.service.';
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id, $name_link)
    {
        $service = Service::find($id);
        $service_types = ServiceType::where('service_id', $id)->get();
        $service_group = ServiceGroup::find($service->service_group_id);
        $helps = Help::where('service_id', $id)->limit(6)->get();
        return view($this->pathView.'index', compact('service', 'service_types', 'service_group', 'helps'));
    }
}
