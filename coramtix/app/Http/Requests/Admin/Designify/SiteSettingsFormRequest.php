<?php

namespace Pterodactyl\Http\Requests\Admin\Designify;

use Pterodactyl\Http\Requests\Admin\AdminFormRequest;

class SiteSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'coramtix:site_color' => 'required|string',
            'coramtix:site_title' => 'required|string',
            'coramtix:site_description' => 'required|string',
            'coramtix:site_image' => 'required|string',
            'coramtix:site_favicon' => 'required|string',
        ];
    }
}
