<?php

namespace ClinicalSkillOnline\Http\Requests;

use ClinicalSkillOnline\Model\Organization;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationPostRequest extends FormRequest
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
        $org = Organization::find($this->organization);
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
                    'org_name' => 'required|string|max:255|unique:organization',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'org_name' => 'required|string|max:255|unique:organization'.$org->org_id,
                ];
            }
            default:break;
        }

    }
}