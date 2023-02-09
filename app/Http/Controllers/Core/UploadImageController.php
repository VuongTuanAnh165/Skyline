<?php

namespace App\Http\Controllers\Core;

use App\Helpers\UploadsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadImageController extends Controller
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
    * upload Record Model
    * @param Request $request
    * @return Return \Illuminate\Support\Facades\View
    *--------------------------------------------------------------------------
    */
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $filePath = UploadsHelper::handleUploadFile('img/summernote/', 'file', $request);
            return response()->json([
                'status' => 200,
                'url' => $filePath,
            ]);
        }
    }
}
