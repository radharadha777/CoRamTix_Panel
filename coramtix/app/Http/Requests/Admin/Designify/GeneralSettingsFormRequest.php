<?php

namespace Pterodactyl\Http\Requests\Admin\Designify;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class GeneralSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'coramtix:logo' => 'required|string',
            'coramtix:customCopyright' => 'required|in:true,false',
            'coramtix:copyright' => 'required|string',
            'coramtix:isUnderMaintenance' => 'required|in:true,false',
            'coramtix:maintenance' => 'required|string',
        ];
    }
}
