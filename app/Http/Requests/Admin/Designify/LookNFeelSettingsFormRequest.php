<?php

namespace Pterodactyl\Http\Requests\Admin\Designify;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class LookNFeelSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'coramtix:themeSelector' => 'required|in:true,false',
            'coramtix:background' => 'required|string',
            'coramtix:allocationBlur' => 'required|in:true,false',
            'coramtix:radius' => 'required|string',
        ];
    }
}
