<?php

namespace Pterodactyl\Http\Controllers\Admin\Designify;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Designify\AlertSettingsFormRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class AlertController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private ViewFactory $view,
        private SettingsRepositoryInterface $settings
    ) {
    }

    /**
     * Show the alert settings form.
     */
    public function index(): View
    {
        return $this->view->make('admin.designify.alerts', [
            'alertType' => $this->settings->get('coramtix:alertType', 'info'),
            'alertMessage' => $this->settings->get('coramtix:alertMessage', '**Welcome to CoRamTix!** You can modify Theme Look & Feel using [Designify](/admin/designify) at the administration area.'),
        ]);
    }

    /**
     * Save the alert settings.
     */
    public function store(AlertSettingsFormRequest $request): RedirectResponse
    {
        $this->settings->set('coramtix:alertType', $request->input('coramtix:alertType'));
        $this->settings->set('coramtix:alertMessage', $request->input('coramtix:alertMessage'));

        $this->alert->success('Alert settings have been updated successfully.')->flash();

        return redirect()->route('admin.designify.alerts');
    }
}