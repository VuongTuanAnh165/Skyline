<?php

namespace App\Http\Controllers\Api;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use \Illuminate\Http\Response as Res;
use Illuminate\Support\Facades\Auth;

class AbstractApiController extends Controller
{
    protected $guard = 'api';
    /**
     * @var int
     */
    protected $statusCode = Res::HTTP_OK;

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard($this->guard);
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $message
     * @return json response
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Base Response Api
     * @param Object: $data
     * @param $Respond Json
     * @return json response
     */
    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * Base Response Api Create Record
     * @param String: $msg
     * @param Object: $data
     * @return Respond Json
     */
    public function respondCreated($data = null, $msg = null)
    {
        $statusCode = Res::HTTP_CREATED;
        $this->setStatusCode($statusCode);
        $response = [];
        $response['code'] = $statusCode;
        $response['msg'] = __('messages.api.common.success');
        if ($msg) $response['msg'] = $msg;
        if ($data) $response['data'] = $data;
        return $this->respond($response);
    }

    /**
     * Base Response Api Update Record
     * @param String: $msg
     * @param Object: $data
     * @return Respond Json
     */
    public function respondUpdated($data = null, $msg = null)
    {
        $response = [];
        $response['code'] = $this->getStatusCode();
        $response['msg'] = __('messages.api.common.success');
        if ($msg) $response['msg'] = $msg;
        if ($data) $response['data'] = $data;
        return $this->respond($response);
    }

    /**
     * Base Response Api Delete Record
     * @param String: $msg
     * @return Respond Json
     */
    public function respondDeleted($msg = null)
    {
        $response = [];
        $statusCode = Res::HTTP_NO_CONTENT;
        $this->setStatusCode($statusCode);
        $response['code'] = $statusCode;
        $response['msg'] = __('messages.api.common.success');
        if ($msg) $response['msg'] = $msg;
        return $this->respond($response);
    }

    /**
     * Base Response Api Not Found
     * @param String: $msg
     * @param Object: $data
     * @return Respond Json
     */
    public function respondNotFound()
    {
        $response = [];
        $statusCode = Res::HTTP_NOT_FOUND;
        $this->setStatusCode($statusCode);
        $response['code'] = $statusCode;
        $response['msg'] = __('messages.api.common.notFound');
        return $this->respond($response);
    }

    /**
     * Base Response Api Forbidden
     * @param String: $msg
     * @param Object: $data
     * @return Respond Json
     */
    public function respondForbidden()
    {
        $response = [];
        $statusCode = Res::HTTP_FORBIDDEN;
        $this->setStatusCode($statusCode);
        $response['code'] = $statusCode;
        $response['msg'] = __('messages.api.common.success');
        return $this->respond($response);
    }

    /**
     * Base Response Api Validation Error
     * @param $message
     * @param $errors
     * @return json response
     */
    public function respondValidationError($msg, $errors)
    {
        $response = [];
        $statusCode = Res::HTTP_UNPROCESSABLE_ENTITY;
        $this->setStatusCode($statusCode);
        $response['code'] = $statusCode;
        $response['msg'] = __('messages.api.common.success');
        $response['data'] = $errors;
        return $this->respond($response);
    }

    /**
     * Return Response Data Api
     * @param $msg
     * @param $errors
     * @param $status
     * @return json response
     */
    public function renderJsonResponse($data = [], $msg = '', $status = Res::HTTP_OK)
    {
        $response = [];
        $this->setStatusCode($status);
        $response['code'] = $status;
        if (!$msg) {
            $response['msg'] = __('messages.api.common.success');
        } else {
            $response['msg'] = $msg;
        }
        $response['data'] = $data;
        return $this->respond($response);
    }

    /**
     * Base Api Respond With Pagination
     * @param Array $data
     * @param String $msg
     * @param Int $status
     * @return mixed
     */
    public function respondWithPagination($data = [], $msg = '', $status = Res::HTTP_OK)
    {
        $response = [];
        $this->setStatusCode($status);
        $response['code'] = $status;
        if (!$msg) {
            $response['msg'] = __('messages.api.common.success');
        } else {
            $response['msg'] = $msg;
        }
        $response['current_page'] = $data->currentPage();
        $response['total_page'] = $data->lastPage();
        $response['per_page'] = $data->perPage();
        $response['total'] = $data->total();
        $response['data'] = $data->items();
        return $this->respond($response);
    }

    /**
     * Return Response With Error
     * @param $message
     * @return json response
     */
    public function respondWithError($msg)
    {
        $response = [];
        $statusCode = Res::HTTP_PRECONDITION_FAILED;
        $this->setStatusCode($statusCode);
        $response['code'] = $statusCode;
        $response['msg'] = $msg;
        return $this->respond($response);
    }

    /**
     * Return Response With Internal Error
     * @param $message
     * @return json response
     */
    public function respondInternalError($msg = '')
    {
        $response = [];
        $statusCode = Res::HTTP_INTERNAL_SERVER_ERROR;
        $this->setStatusCode($statusCode);
        $response['code'] = $statusCode;
        $response['msg'] = $msg;
        return $this->respond($response);
    }

    /**
     * Return Response With Bad Request
     * @param $message
     * @return json response
     */
    public function respondBadRequest($msg = '')
    {
        $response = [];
        $statusCode = Res::HTTP_BAD_REQUEST;
        $this->setStatusCode($statusCode);
        $response['code'] = $statusCode;
        $response['msg'] = $msg;
        return $this->respond($response);
    }

    /**
     * Return Response With Authentication
     * @return json response
     */
    public function respondUnauthorized()
    {
        $response = [];
        $statusCode = Res::HTTP_UNAUTHORIZED;
        $this->setStatusCode($statusCode);
        $response['code'] = $statusCode;
        $response['msg'] = __('messages.api.common.unauthenticated');
        return $this->respond($response);
    }

    /**
     * Return Response With  service unavailable
     * @param string $msg
     * @return json response
     */
    public function respondServiceUnavailable($msg = '')
    {
        $response = [];
        $statusCode = Res::HTTP_SERVICE_UNAVAILABLE;
        $this->setStatusCode($statusCode);
        $response['code'] = $statusCode;
        $response['msg'] = __('messages.api.common.new_version');
        if ($msg) {
            $response['msg'] = $msg;
        }
        return $this->respond($response);
    }
}
