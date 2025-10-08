<?php

namespace Pterodactyl\Http\Controllers\Admin\Designify;

use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\ViewComposers\AssetComposer;

class DesignifyController extends Controller
{
    public function __construct(
        private AssetComposer $assetComposer,
        private AlertsMessageBag $alert,
    ) {}

    /**
     * Reset CoRamTix theme settings to default.
     */
    public function resetToDefaults(): RedirectResponse
    {
        $this->assetComposer->resetCoRamTixDefaults();

        $this->alert->success('All settings have been reset to defaults.')->flash();

        return redirect()->route('admin.designify');
    }
}