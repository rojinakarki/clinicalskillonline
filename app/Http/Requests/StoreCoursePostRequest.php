<?php

namespace ClinicalSkillOnline\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use ClinicalSkillOnline\Model\Course;


class StoreCoursePostRequest extends FormRequest
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
        $course = Course::find($this->course);
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
                    'course_title'=> 'required |unique:course|max:255 ',
                    'course_price' =>'required |string',
                    'course_coverimage' =>'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'course_title'=> 'required|max:255|unique:course'.$course->course_id,
                    'course_price' =>'required|string',
                    'course_coverimage' =>'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ];
            }
            default:break;
        }

    }
}
