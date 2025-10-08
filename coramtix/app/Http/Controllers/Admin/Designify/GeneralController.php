<?php

namespace Pterodactyl\Http\Controllers\Admin\Designify;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Designify\GeneralSettingsFormRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class GeneralController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private ViewFactory $view,
        private SettingsRepositoryInterface $settings
    ) {
    }

    /**
     * Show the general settings form.
     */
    public function index(): View
    {
        return $this->view->make('admin.designify.general', [
            'logo' => $this->settings->get('coramtix:logo', '/coramtix/logo.png'),
            'customCopyright' => $this->settings->get('coramtix:customCopyright', true) ? 'true' : 'false',
            'copyright' => $this->settings->get('coramtix:copyright', 'Powered by [CoRamTix](https://revix.cc)'),
            'isUnderMaintenance' => $this->settings->get('coramtix:isUnderMaintenance', false) ? 'true' : 'false',
            'maintenance' => $this->settings->get('coramtix:maintenance', 'We are currently under maintenance. Kindly check back later!'),
        ]);
    }

    /**
     * Save the general settings.
     */
    public function store(GeneralSettingsFormRequest $request): RedirectResponse
    {   
        $customCopyright = filter_var($request->input('coramtix:customCopyright'), FILTER_VALIDATE_BOOLEAN);
        $isUnderMaintenance = filter_var($request->input('coramtix:isUnderMaintenance'), FILTER_VALIDATE_BOOLEAN);
        $this->settings->set('coramtix:logo', $request->input('coramtix:logo'));
        $this->settings->set('coramtix:customCopyright', $customCopyright);
        $this->settings->set('coramtix:copyright', $request->input('coramtix:copyright'));
        $this->settings->set('coramtix:isUnderMaintenance', $isUnderMaintenance);
        $this->settings->set('coramtix:maintenance', $request->input('coramtix:maintenance'));

        $this->alert->success('General settings have been updated successfully.')->flash();

        return redirect()->route('admin.designify.general');
    }
}