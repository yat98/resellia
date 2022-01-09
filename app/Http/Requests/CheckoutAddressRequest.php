<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutAddressRequest extends FormRequest
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
		$newAddressRules = [
			'name' => 'required',
			'detail' => 'required',
			'province_id' => 'required|exists:ro_province,province_id',
			'city_id' => 'required|exists:ro_city,city_id',
			'phone' => 'required|digits_between:9,15',
		];

		if (auth()->check()) {
			$addressLimit = implode(',', auth()->user()->addresses->pluck('id')->toArray()) . ',new-address';
			$rules = ['address_id' => 'required|in:' . $addressLimit];
			if ('new-address' == $this->get('address_id')) {
				return $rules += $newAddressRules;
			}

			return $rules;
		}

		return $newAddressRules;
	}
}
