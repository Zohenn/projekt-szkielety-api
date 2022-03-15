<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends SaveCategoryRequest
{
    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();

        return $url->route('category.index', ['edit' => $this->route('id')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $parentRules = parent::rules();
        $rules = [];
        foreach($parentRules as $key => $value){
            $rules["edit-$key"] = $value;
        }
        return $rules;
    }
}
