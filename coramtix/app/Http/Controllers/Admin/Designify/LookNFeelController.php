<?php

namespace Pterodactyl\Http\Controllers\Admin\Designify;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Designify\LookNFeelSettingsFormRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class LookNFeelController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private ViewFactory $view,
        private SettingsRepositoryInterface $settings
    ) {
    }

    /**
     * Show the Looks settings form.
     */
    public function index(): View
    {
        return $this->view->make('admin.designify.looks', [
            'themeSelector' => $this->settings->get('coramtix:themeSelector', true) ? 'true' : 'false',
            'background' => $this->settings->get('coramtix:background', 'none'),
            'allocationBlur' => $this->settings->get('coramtix:allocationBlur', true) ? 'true' : 'false',
            'radius' => $this->settings->get('coramtix:radius', '15px'),
        ]);
    }

    /**
     * Save the Looks settings.
     */
    public function store(LookNFeelSettingsFormRequest $request): RedirectResponse
    {
        $themeSelector = filter_var($request->input('coramtix:themeSelector'), FILTER_VALIDATE_BOOLEAN);
        $allocationBlur = filter_var($request->input('coramtix:allocationBlur'), FILTER_VALIDATE_BOOLEAN);

        $this->settings->set('coramtix:themeSelector', $themeSelector);
        $this->settings->set('coramtix:background', $request->input('coramtix:background'));
        $this->settings->set('coramtix:radius', $request->input('coramtix:radius'));
        $this->settings->set('coramtix:allocationBlur', $allocationBlur);

        $this->alert->success('Look & Feel settings have been updated successfully.')->flash();

        return redirect()->route('admin.designify.looks');
    }
}