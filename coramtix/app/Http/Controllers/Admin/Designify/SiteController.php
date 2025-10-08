<?php

namespace Pterodactyl\Http\Controllers\Admin\Designify;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Designify\SiteSettingsFormRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class SiteController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private ViewFactory $view,
        private SettingsRepositoryInterface $settings
    ) {
    }

    /**
     * Show the site settings form.
     */
    public function index(): View
    {
        return $this->view->make('admin.designify.site', [
            'site_color' => $this->settings->get('coramtix:site_color', '#EF5C29'),
            'site_title' => $this->settings->get('coramtix:site_title', 'CoRamTix'),
            'site_description' => $this->settings->get('coramtix:site_description', 'Our official control panel made better with CoRamTix.'),
            'site_image' => $this->settings->get('coramtix:site_image', '/coramtix/logo.png'),
            'site_favicon' => $this->settings->get('coramtix:site_favicon', '/coramtix/icon.png'),
        ]);
    }

    /**
     * Save the site settings.
     */
    public function store(SiteSettingsFormRequest $request): RedirectResponse
    {
        $this->settings->set('coramtix:site_color', $request->input('coramtix:site_color'));
        $this->settings->set('coramtix:site_title', $request->input('coramtix:site_title'));
        $this->settings->set('coramtix:site_description', $request->input('coramtix:site_description'));
        $this->settings->set('coramtix:site_image', $request->input('coramtix:site_image'));
        $this->settings->set('coramtix:site_favicon', $request->input('coramtix:site_favicon'));

        $this->alert->success('Site settings have been updated successfully.')->flash();

        return redirect()->route('admin.designify.site');
    }
}