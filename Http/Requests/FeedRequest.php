<?php namespace Modules\Feeds\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedRequest extends FormRequest {



    public function rules()
    {
        return [
            'name'			=>		'required',
            'url'           =>      'required|url|unique:feeds,url'
        ];
    }



    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
              'name.required' => trans('feeds::feeds.validation.messages.name is required'),
              'url.required' => trans('feeds::feeds.validation.messages.url is required'),
              'url.url' => trans('feeds::feeds.validation.messages.url is not valid'),
              'url.unique' => trans('feeds::feeds.validation.messages.url is not unique'),

        ];
    }



}