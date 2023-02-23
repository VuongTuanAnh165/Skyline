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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hire($id, $name_link)
    {
        $service_type = ServiceType::query()
            ->leftJoin('services', 'services.id', 'service_types.service_id')
            ->leftJoin('service_groups', 'service_groups.id', 'services.service_group_id')
            ->select(
                'service_types.*',
                'services.name as service_name',
                'services.image as service_image',
                'service_groups.description as service_group_description',
                'service_groups.name as service_group_name',
            )
            ->where('service_types.id', $id)
            ->first();
        $service_charges = ServiceCharge::where('service_type_id', $id)->get();
        $helps = Help::where('service_id', $id)->limit(6)->get();
        return view($this->pathView.'hire', compact('service_type', 'helps', 'service_charges'));
    }
}
