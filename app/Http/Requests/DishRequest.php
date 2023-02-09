<?php

namespace App\Http\Requests;

use App\Models\Dish;
use App\Models\ServiceType;
use App\Rules\UniqueRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        $service_type = ServiceType::query()
            ->leftJoin('service_charges', 'service_charges.service_type_id', 'service_types.id')
            ->leftJoin('order_ceos', 'order_ceos.service_charge_id', 'service_charges.id')
            ->select('service_types.service_id')
            ->where('order_ceos.restaurant_id', $restaurant_id)
            ->first();
        if($service_type->service_id == 1) {
            $messages = Dish::MESS_RESTAURANT;
        } else {
            $messages = Dish::MESS_SHOP;
        }
        $input_unique = trans('validation.form.input_unique', ['attribute' => $messages['dish']['table']['name'] ]);
        $rules = [
            'name' => ['required', new UniqueRule($this->route('id'), Dish::class, $this->name, $input_unique)],
            'category_id' => 'required',
            'price' => 'required|regex:/^[0-9]*$/|integer|min:1',
        ];
        return $rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        $service_type = ServiceType::query()
            ->leftJoin('service_charges', 'service_charges.service_type_id', 'service_types.id')
            ->leftJoin('order_ceos', 'order_ceos.service_charge_id', 'service_charges.id')
            ->select('service_types.service_id')
            ->where('order_ceos.restaurant_id', $restaurant_id)
            ->first();
        if($service_type->service_id == 1) {
            $messages = Dish::MESS_RESTAURANT;
        } else {
            $messages = Dish::MESS_SHOP;
        }
        $messages = array(
            'name.required' => trans('validation.form.input_required', ['attribute' => $messages['dish']['table']['name'] ]),
            'category_id.required' => trans('validation.form.input_required', ['attribute' => $messages['dish']['table']['category'] ]),
            'price.required' => trans('validation.form.input_required', ['attribute' => $messages['dish']['table']['price'] ]),
            'price.regex' => trans('validation.form.ip_regex', ['attribute' => $messages['dish']['table']['price'] ]),
            'price.min' => trans('validation.form.input_min_value', ['attribute' => $messages['dish']['table']['price'] , 'min_value' => "1"]),
        );
        return $messages;
    }
}
