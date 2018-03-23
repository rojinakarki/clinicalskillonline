<?php

namespace ClinicalSkillOnline\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use ClinicalSkillOnline\Model\Package;

class StorePackagePostRequest extends FormRequest
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
        $package = Package::find($this->package);
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {

                return [
                    'package_name'=> 'required|max:255|unique:package',
                    'package_price' =>'required | string',

                ];
            }
            case 'PUT':
            case 'PATCH':
            {

                return [
                    'package_name'=> 'required |max:255|unique:package'.$package->package_id,
                    'package_price' =>'required |string',

                ];
            }
            default:break;
        }

    }
}
