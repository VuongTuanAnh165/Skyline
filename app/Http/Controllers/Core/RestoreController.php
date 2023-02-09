<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class RestoreController extends Controller
{
    /**
     * @var request
     */
    protected $request;

    public function __construct(
        Request $request
    ) {
        $this->request = $request;
    }

    /*
    *--------------------------------------------------------------------------
    * Restore Record Model
    * @param Request $request
    * @return Return \Illuminate\Support\Facades\View
    *--------------------------------------------------------------------------
    */
    public function restore(Request $request)
    {
        $id = $this->request->get('id');
        $model = $this->request->get('model');
        switch ($model) {
            case 'branch':
                $model = Branch::class;
                break;
            default:
                # code...
                break;
        }
        if ($this->request->has('checkAll')) {
            return $this->restoreModel($id, $model, true);
        }
        return $this->restoreModel($id, $model);
    }

    /*
    *--------------------------------------------------------------------------
    * Function Excuse Restore Model
    * @param Request $request
    * @param String $model
    * @param Boolean $checkAll
    * @return Return \Illuminate\Support\Facades\View
    *--------------------------------------------------------------------------
    */
    public function restoreModel($id, $model, $checkAll = false)
    {
        $model = ucfirst($model);
        try {
            if ($checkAll) {
                $arr_id = explode(',', $id);
            } else {
                $arr_id = [$id];
            }
            $datas = $model::onlyTrashed()->whereIn('id', $arr_id)->restore();
            $msg = __('messages.common.success');
            return response()->json(array('status' => true, 'msg' => $msg));
        } catch (\Exception $e) {
            dd($e);
            return $this->renderJsonResponse($e->getMessage());
        }
    }
}
