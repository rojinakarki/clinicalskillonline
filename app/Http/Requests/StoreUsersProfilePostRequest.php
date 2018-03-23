<?php

namespace ClinicalSkillOnline\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use ClinicalSkillOnline\User;

class StoreUsersProfilePostRequest extends FormRequest
{
//    private $users;
//    public function _construct(User $users){
//
//        $this->users=$users;
//
//    }

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $user = User::find($this->user);

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
                    'name' => 'required|string|max:255|unique:users',
                    'email' => 'required|string|email|max:255|unique:users',
                    'role'=>'required|string',
                    'profile_firstname'=>'required|string|max:255',
                    'profile_lastname'=>'required|string|max:255',
                    'profile_phonenumber'=>'required|string|max:255',
                    'usergroup_id'=>'required|integer',
                    'org_id'=>'required|integer',
                    'profile_paypalclient_id'=>'required|string|max:255',
                    'profile_paypalclientsecret'=>'required|string|max:60',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|string|max:255|unique:users'.$user->id,
                    'email' => 'required|string|email|max:255|unique:users'.$user->id,
                    'role'=>'required|string',
                    'profile_firstname'=>'required|string|max:255',
                    'profile_lastname'=>'required|string|max:255',
                    'profile_phonenumber'=>'required|string|max:255',
                    'usergroup_id'=>'required|integer',
                    'org_id'=>'required|integer',
                    'profile_paypalclient_id'=>'required|string|max:255',
                    'profile_paypalclientsecret'=>'required|string|max:60',
                ];
            }
            default:break;
        }

    }
}
