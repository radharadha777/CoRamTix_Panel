<?php

namespace Pterodactyl\Http\ViewComposers;

use Illuminate\View\View;
use Pterodactyl\Services\Helpers\AssetHashService;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class AssetComposer
{
    /**
     * AssetComposer constructor.
     */
    private array $coramtixDefaults;
    
    private array $Theme1 = [
        "name" => "Petrascia",
        "colorPrimary" => "#3b82f6",
        "color50" => "#f8f9fa",
        "color100" => "#e1e4e8",
        "color200" => "#c5cbd3",
        "color300" => "#9aa5b1",
        "color400" => "#6c7885",
        "color500" => "#55606d",
        "color600" => "#47505c",
        "color700" => "#38414d",
        "color800" => "#2f3741",
        "color900" => "#1d232b",
    ];

    private array $Theme2 = [
        "name" => "Pink",
        "colorPrimary" => "#D11EB2",
        "color50" => "#f8f9fa",
        "color100" => "#D7CFD6",
        "color200" => "#BEAABB",
        "color300" => "#A2739B",
        "color400" => "#7C5978",
        "color500" => "#765E78",
        "color600" => "#5A4256",
        "color700" => "#361F32",
        "color800" => "#280D25",
        "color900" => "#160613",
    ];

    private array $Theme3 = [
        "name" => "Purple",
        "colorPrimary" => "#8423C0",
        "color50" => "#f8f9fa",
        "color100" => "#D3D0D7",
        "color200" => "#B4ABB8",
        "color300" => "#8F7A9E",
        "color400" => "#6D5A79",
        "color500" => "#695C74",
        "color600" => "#4D3F56",
        "color700" => "#291F34",
        "color800" => "#1B0E27",
        "color900" => "#0E0615",
    ];

    private array $Theme4 = [
        "name" => "Orange",
        "colorPrimary" => "#CF721B",
        "color50" => "#f8f9fa",
        "color100" => "#CBC2C0",
        "color200" => "#B6A3A0",
        "color300" => "#9E766F",
        "color400" => "#765954",
        "color500" => "#77584F",
        "color600" => "#553E3B",
        "color700" => "#341E1A",
        "color800" => "#270F0A",
        "color900" => "#150704",
    ];

    private array $Theme5 = [
        "name" => "Red",
        "colorPrimary" => "#C81B1B",
        "color50" => "#f8f9fa",
        "color100" => "#C0B5B2",
        "color200" => "#AD9693",
        "color300" => "#966A68",
        "color400" => "#71524D",
        "color500" => "#6C554E",
        "color600" => "#503B36",
        "color700" => "#331C17",
        "color800" => "#270F08",
        "color900" => "#150603",
    ];

    private array $Theme6 = [
        "name" => "Midnight",
        "colorPrimary" => "#6366f1",
        "color50" => "#f8fafc",
        "color100" => "#f1f5f9",
        "color200" => "#e2e8f0",
        "color300" => "#cbd5e1",
        "color400" => "#94a3b8",
        "color500" => "#64748b",
        "color600" => "#475569",
        "color700" => "#334155",
        "color800" => "#1e293b",
        "color900" => "#0f172a",
    ];

    private array $Theme7 = [
        "name" => "Monochrome",
        "colorPrimary" => "#000000",
        "color50" => "#ffffff",
        "color100" => "#f5f5f5",
        "color200" => "#e5e5e5",
        "color300" => "#d4d4d4",
        "color400" => "#a3a3a3",
        "color500" => "#737373",
        "color600" => "#525252",
        "color700" => "#404040",
        "color800" => "#262626",
        "color900" => "#171717",
    ];

    public function __construct(
        private AssetHashService $assetHashService,
        private SettingsRepositoryInterface $settings
    ) {
        $this->coramtixDefaults = [
            'logo' => '/coramtix/logo.png',
            'customCopyright' => true,
            'copyright' => 'Powered by [CoRamTix](https://revix.cc)',
            'isUnderMaintenance' => false,
            'maintenance' => 'We are currently under maintenance. Kindly check back later!',
            'colorPrimary' => '#EF5C29',
            'colorSuccess' => '#3D8F1F',
            'colorDanger' => '#8F1F20',
            'colorSecondary' => '#2B2B40',
            'color50' => '#F4F4F5',
            'color100' => '#DEDEE2',
            'color200' => '#D2D2DB',
            'color300' => '#8282A4',
            'color400' => '#5E5E7F',
            'color500' => '#42425B',
            'color600' => '#1B1B21',
            'color700' => '#141416',
            'color800' => '#070709',
            'color900' => '#07070C',
            'theme1' => $this->Theme1,
            'theme2' => $this->Theme2,
            'theme3' => $this->Theme3,
            'theme4' => $this->Theme4,
            'theme5' => $this->Theme5,
            'theme6' => $this->Theme6,
            'theme7' => $this->Theme7,
            'themeSelector' => true,
            'background' => 'none',
            'radius' => '15px',
            'allocationBlur' => true,
            'alertType' => 'info',
            'alertMessage' => '**Welcome to CoRamTix!** You can modify Theme Look & Feel using [Designify](/admin/designify) at the administration area.',
            'site_color' => '#EF5C29',
            'site_title' => 'CoRamTix',
            'site_description' => 'Our official control panel made better with CoRamTix.',
            'site_image' => '/coramtix/logo.png',
            'site_favicon' => '/coramtix/icon.png',
        ];
    }

    /**
     * Provide access to the asset service in the views.
     */
    public function compose(View $view): void
    {
        $view->with('asset', $this->assetHashService);
        $view->with('siteConfiguration', [
            'name' => config('app.name') ?? 'Pterodactyl',
            'locale' => config('app.locale') ?? 'en',
            'recaptcha' => [
                'enabled' => config('recaptcha.enabled', false),
                'siteKey' => config('recaptcha.website_key') ?? '',
            ],
        ]);
        $view->with('coramtixConfiguration', 
            $this->getCoRamTixSettings(),
        );
    }

    private function getCoRamTixSettings(): array
    {
        $settings = [];

        foreach ($this->coramtixDefaults as $key => $default) {
            if (preg_match('/^theme[1-7]$/', $key) && is_array($default)) {
                $theme = [];

                foreach ($default as $subkey => $subdefault) {
                    $val = $this->settings->get("coramtix:{$key}:{$subkey}", $subdefault);

                    if (!is_scalar($val)) {
                        $val = $subdefault;
                    }

                    $theme[$subkey] = $val;
                }

                $settings[$key] = $theme;
            } else {
                $val = $this->settings->get("coramtix:{$key}", $default);

                if (!is_scalar($val) && !is_array($val)) {
                    $val = $default;
                }

                $settings[$key] = $val;
            }
        }

        return $settings;
    }

    public function resetCoRamTixDefaults(): void
    {
        foreach ($this->coramtixDefaults as $key => $value) {
            if (preg_match('/^theme[1-7]$/', $key) && is_array($value)) {
                foreach ($value as $subkey => $subvalue) {
                    $this->settings->set("coramtix:{$key}:{$subkey}", $subvalue);
                }
            } else {
                $this->settings->set("coramtix:{$key}", $value);
            }
        }
    }
}