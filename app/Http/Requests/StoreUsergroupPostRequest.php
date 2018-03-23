<?php

namespace ClinicalSkillOnline\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use ClinicalSkillOnline\Model\Usergroup;


class StoreUsergroupPostRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $ug = Usergroup::find($this->usergroup);
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
                    'usergroup_name' => 'required|max:255|unique:usergroup',
                    'usergroup_tag' => 'required|max:100|unique:usergroup',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'usergroup_name' => 'required|max:255|unique:usergroup'.$ug->usergroup_id,
                    'usergroup_tag' => 'required|max:100|unique:usergroup'.$ug->usergroup_id,
                ];
            }
            default:break;
        }

    }
}