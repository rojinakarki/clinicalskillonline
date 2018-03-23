<?php

namespace ClinicalSkillOnline\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use ClinicalSkillOnline\Model\Lesson;

class StoreLessonPostRequest extends FormRequest
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
       // $lesson = Lesson::find($this->lesson);
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
                    'order' => 'required|integer',
                    'lesson_title' => 'required|string|max:255',
                    //Other validation rule is causing a problem
                    'lesson_description' => 'required_without_all:lesson_image,lesson_video',
                    'lesson_image' => 'required_without_all:lesson_description,lesson_video|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'lesson_video' => 'required_without_all:lesson_description,lesson_image',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'order' => 'required|integer',
                    'lesson_title' => 'required|string|max:255',
                    //Other validation rule is causing a problem
                    'lesson_description' => 'required_without_all:lesson_image,lesson_video',
                    //other validation rule for image didnt work during update so could add any file type
                    'lesson_image' => 'required_without_all:lesson_description,lesson_video',
                    'lesson_video' => 'required_without_all:lesson_description,lesson_image',

                ];
            }
            default:break;
        }

    }
}
