<?php

namespace App\Http\Controllers\Admin\Fe;

use App\Http\Controllers\Controller;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class AdminFeThankYouController extends Controller
{
    protected $pathView = 'admin.fe.thankyou.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $name_link)
    {
        $service_type = ServiceType::query()
            ->leftJoin('services', 'services.id', 'service_types.service_id')
            ->leftJoin('service_groups', 'service_groups.id', 'services.service_group_id')
            ->select(
                'service_types.*',
                'services.name as service_name',
                'services.image as service_image',
                'services.name_link as service_name_link',
                'service_groups.description as service_group_description',
                'service_groups.name as service_group_name',
            )
            ->where('service_types.id', $id)
            ->first();
        return view($this->pathView.'index', compact('service_type'));
    }
}
