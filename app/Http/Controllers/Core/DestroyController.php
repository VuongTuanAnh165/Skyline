<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Category;
use App\Models\CategoryHome;
use App\Models\Dish;
use App\Models\Help;
use App\Models\Image;
use App\Models\MenuItem;
use App\Models\Personnel;
use App\Models\Policy;
use App\Models\Position;
use App\Models\Post;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\ServiceGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DestroyController extends Controller
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
    * Destroy Record Model
    * @param Request $request
    * @return Return \Illuminate\Support\Facades\View
    *--------------------------------------------------------------------------
    */
    public function destroy(Request $request)
    {
        $id = $this->request->get('id');
        $model = $this->request->get('model');
        switch ($model) {
            case 'branch':
                $model = Branch::class;
                break;
            case 'position':
                $model = Position::class;
                break;
            case 'personnel':
                $model = Personnel::class;
                break;
            case 'dish':
                $model = Dish::class;
                break;
            case 'category':
                $model = Category::class;
                break;
            case 'post':
                $model = Post::class;
                break;
            case 'policy':
                $model = Policy::class;
                break;
            case 'promotion':
                $model = Promotion::class;
                break;
            case 'service_group':
                $model = ServiceGroup::class;
                break;
            case 'service':
                $model = Service::class;
                break;
            case 'help':
                $model = Help::class;
                break;
            case 'category_home':
                $model = CategoryHome::class;
                break;
            case 'image':
                $model = Image::class;
                break;
            case 'menu_item':
                $model = MenuItem::class;
                break;
            default:
                # code...
                break;
        }
        if ($this->request->has('checkAll')) {
            return $this->destroyModel($id, $model, true);
        }
        return $this->destroyModel($id, $model);
    }

    /*
    *--------------------------------------------------------------------------
    * Function Excuse Destroy Model
    * @param Request $request
    * @return Return \Illuminate\Support\Facades\View
    *--------------------------------------------------------------------------
    */
    public function destroyModel($id, $model, $checkAll = false)
    {
        $model = ucfirst($model);
        try {
            if ($checkAll) {
                $arr_id = explode(',', $id);
            } else {
                $arr_id = [$id];
            }
            $datas = $model::whereIn('id', $arr_id)->delete();
            $msg = __('messages.common.success');
            return response()->json(array('status' => true, 'msg' => $msg));
        } catch (\Exception $e) {
            return $this->renderJsonResponse($e->getMessage());
        }
    }
}
