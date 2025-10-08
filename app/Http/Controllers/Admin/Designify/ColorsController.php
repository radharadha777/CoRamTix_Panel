<?php

namespace Pterodactyl\Http\Controllers\Admin\Designify;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Http\Requests\Admin\Designify\ColorSettingsFormRequest;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class ColorsController extends Controller
{
    public function __construct(
        private AlertsMessageBag $alert,
        private ViewFactory $view,
        private SettingsRepositoryInterface $settings
    ) {
    }

    /**
     * Show the colors settings form.
     */
    public function index(): View
    {
        return $this->view->make('admin.designify.colors', [
            'colorPrimary' => $this->settings->get('coramtix:colorPrimary', '#EF5C29'),
            'colorSuccess' => $this->settings->get('coramtix:colorSuccess', '#3D8F1F'),
            'colorDanger' => $this->settings->get('coramtix:colorDanger', '#8F1F20'),
            'colorSecondary' => $this->settings->get('coramtix:colorSecondary', '#2B2B40'),
            'color50' => $this->settings->get('coramtix:color50', '#F4F4F5'),
            'color100' => $this->settings->get('coramtix:color100', '#DEDEE2'),
            'color200' => $this->settings->get('coramtix:color200', '#D2D2DB'),
            'color300' => $this->settings->get('coramtix:color300', '#8282A4'),
            'color400' => $this->settings->get('coramtix:color400', '#5E5E7F'),
            'color500' => $this->settings->get('coramtix:color500', '#42425B'),
            'color600' => $this->settings->get('coramtix:color600', '#1B1B21'),
            'color700' => $this->settings->get('coramtix:color700', '#141416'),
            'color800' => $this->settings->get('coramtix:color800', '#070709'),
            'color900' => $this->settings->get('coramtix:color900', '#07070C'),
            'theme1' => [
                'name'      => $this->settings->get('coramtix:theme1:name', 'Petrascia'),
                'colorPrimary'   => $this->settings->get('coramtix:theme1:colorPrimary', '#3b82f6'),
                'color50'   => $this->settings->get('coramtix:theme1:color50', '#f8f9fa'),
                'color100'  => $this->settings->get('coramtix:theme1:color100', '#e1e4e8'),
                'color200'  => $this->settings->get('coramtix:theme1:color200', '#c5cbd3'),
                'color300'  => $this->settings->get('coramtix:theme1:color300', '#9aa5b1'),
                'color400'  => $this->settings->get('coramtix:theme1:color400', '#6c7885'),
                'color500'  => $this->settings->get('coramtix:theme1:color500', '#55606d'),
                'color600'  => $this->settings->get('coramtix:theme1:color600', '#47505c'),
                'color700'  => $this->settings->get('coramtix:theme1:color700', '#38414d'),
                'color800'  => $this->settings->get('coramtix:theme1:color800', '#2f3741'),
                'color900'  => $this->settings->get('coramtix:theme1:color900', '#1d232b'),
            ],
            'theme2' => [
                'name'      => $this->settings->get('coramtix:theme2:name', 'Pink'),
                'colorPrimary'   => $this->settings->get('coramtix:theme2:colorPrimary', '#D11EB2'),
                'color50'   => $this->settings->get('coramtix:theme2:color50', '#f8f9fa'),
                'color100'  => $this->settings->get('coramtix:theme2:color100', '#D7CFD6'),
                'color200'  => $this->settings->get('coramtix:theme2:color200', '#BEAABB'),
                'color300'  => $this->settings->get('coramtix:theme2:color300', '#A2739B'),
                'color400'  => $this->settings->get('coramtix:theme2:color400', '#7C5978'),
                'color500'  => $this->settings->get('coramtix:theme2:color500', '#765E78'),
                'color600'  => $this->settings->get('coramtix:theme2:color600', '#5A4256'),
                'color700'  => $this->settings->get('coramtix:theme2:color700', '#361F32'),
                'color800'  => $this->settings->get('coramtix:theme2:color800', '#280D25'),
                'color900'  => $this->settings->get('coramtix:theme2:color900', '#160613'),
            ],
            'theme3' => [
                'name'      => $this->settings->get('coramtix:theme3:name', 'Purple'),
                'colorPrimary'   => $this->settings->get('coramtix:theme3:colorPrimary', '#8423C0'),
                'color50'   => $this->settings->get('coramtix:theme3:color50', '#f8f9fa'),
                'color100'  => $this->settings->get('coramtix:theme3:color100', '#D3D0D7'),
                'color200'  => $this->settings->get('coramtix:theme3:color200', '#B4ABB8'),
                'color300'  => $this->settings->get('coramtix:theme3:color300', '#8F7A9E'),
                'color400'  => $this->settings->get('coramtix:theme3:color400', '#6D5A79'),
                'color500'  => $this->settings->get('coramtix:theme3:color500', '#695C74'),
                'color600'  => $this->settings->get('coramtix:theme3:color600', '#4D3F56'),
                'color700'  => $this->settings->get('coramtix:theme3:color700', '#291F34'),
                'color800'  => $this->settings->get('coramtix:theme3:color800', '#1B0E27'),
                'color900'  => $this->settings->get('coramtix:theme3:color900', '#0E0615'),
            ],
            'theme4' => [
                'name'      => $this->settings->get('coramtix:theme4:name', 'Orange'),
                'colorPrimary'   => $this->settings->get('coramtix:theme4:colorPrimary', '#CF721B'),
                'color50'   => $this->settings->get('coramtix:theme4:color50', '#f8f9fa'),
                'color100'  => $this->settings->get('coramtix:theme4:color100', '#CBC2C0'),
                'color200'  => $this->settings->get('coramtix:theme4:color200', '#B6A3A0'),
                'color300'  => $this->settings->get('coramtix:theme4:color300', '#9E766F'),
                'color400'  => $this->settings->get('coramtix:theme4:color400', '#765954'),
                'color500'  => $this->settings->get('coramtix:theme4:color500', '#77584F'),
                'color600'  => $this->settings->get('coramtix:theme4:color600', '#553E3B'),
                'color700'  => $this->settings->get('coramtix:theme4:color700', '#341E1A'),
                'color800'  => $this->settings->get('coramtix:theme4:color800', '#270F0A'),
                'color900'  => $this->settings->get('coramtix:theme4:color900', '#150704'),
            ],
            'theme5' => [
                'name'      => $this->settings->get('coramtix:theme5:name', 'Red'),
                'colorPrimary'   => $this->settings->get('coramtix:theme5:colorPrimary', '#C81B1B'),
                'color50'   => $this->settings->get('coramtix:theme5:color50', '#f8f9fa'),
                'color100'  => $this->settings->get('coramtix:theme5:color100', '#C0B5B2'),
                'color200'  => $this->settings->get('coramtix:theme5:color200', '#AD9693'),
                'color300'  => $this->settings->get('coramtix:theme5:color300', '#966A68'),
                'color400'  => $this->settings->get('coramtix:theme5:color400', '#71524D'),
                'color500'  => $this->settings->get('coramtix:theme5:color500', '#6C554E'),
                'color600'  => $this->settings->get('coramtix:theme5:color600', '#503B36'),
                'color700'  => $this->settings->get('coramtix:theme5:color700', '#331C17'),
                'color800'  => $this->settings->get('coramtix:theme5:color800', '#270F08'),
                'color900'  => $this->settings->get('coramtix:theme5:color900', '#150603'),
            ],
            'theme6' => [
                'name'      => $this->settings->get('coramtix:theme6:name', 'Midnight'),
                'colorPrimary'   => $this->settings->get('coramtix:theme6:colorPrimary', '#6366f1'),
                'color50'   => $this->settings->get('coramtix:theme6:color50', '#f8fafc'),
                'color100'  => $this->settings->get('coramtix:theme6:color100', '#f1f5f9'),
                'color200'  => $this->settings->get('coramtix:theme6:color200', '#e2e8f0'),
                'color300'  => $this->settings->get('coramtix:theme6:color300', '#cbd5e1'),
                'color400'  => $this->settings->get('coramtix:theme6:color400', '#94a3b8'),
                'color500'  => $this->settings->get('coramtix:theme6:color500', '#64748b'),
                'color600'  => $this->settings->get('coramtix:theme6:color600', '#475569'),
                'color700'  => $this->settings->get('coramtix:theme6:color700', '#334155'),
                'color800'  => $this->settings->get('coramtix:theme6:color800', '#1e293b'),
                'color900'  => $this->settings->get('coramtix:theme6:color900', '#0f172a'),
            ],
            'theme7' => [
                'name'      => $this->settings->get('coramtix:theme7:name', 'Monochrome'),
                'colorPrimary'   => $this->settings->get('coramtix:theme7:colorPrimary', '#000000'),
                'color50'   => $this->settings->get('coramtix:theme7:color50', '#ffffff'),
                'color100'  => $this->settings->get('coramtix:theme7:color100', '#f5f5f5'),
                'color200'  => $this->settings->get('coramtix:theme7:color200', '#e5e5e5'),
                'color300'  => $this->settings->get('coramtix:theme7:color300', '#d4d4d4'),
                'color400'  => $this->settings->get('coramtix:theme7:color400', '#a3a3a3'),
                'color500'  => $this->settings->get('coramtix:theme7:color500', '#737373'),
                'color600'  => $this->settings->get('coramtix:theme7:color600', '#525252'),
                'color700'  => $this->settings->get('coramtix:theme7:color700', '#404040'),
                'color800'  => $this->settings->get('coramtix:theme7:color800', '#262626'),
                'color900'  => $this->settings->get('coramtix:theme7:color900', '#171717'),
            ],
        ]);
    }

    /**
     * Save the colors settings.
     */
    public function store(ColorSettingsFormRequest $request): RedirectResponse
    {
        $this->settings->set('coramtix:colorPrimary', $request->input('coramtix:colorPrimary'));
        $this->settings->set('coramtix:colorSuccess', $request->input('coramtix:colorSuccess'));
        $this->settings->set('coramtix:colorDanger', $request->input('coramtix:colorDanger'));
        $this->settings->set('coramtix:colorSecondary', $request->input('coramtix:colorSecondary'));
        $this->settings->set('coramtix:color50', $request->input('coramtix:color50'));
        $this->settings->set('coramtix:color100', $request->input('coramtix:color100'));
        $this->settings->set('coramtix:color200', $request->input('coramtix:color200'));
        $this->settings->set('coramtix:color300', $request->input('coramtix:color300'));
        $this->settings->set('coramtix:color400', $request->input('coramtix:color400'));
        $this->settings->set('coramtix:color500', $request->input('coramtix:color500'));
        $this->settings->set('coramtix:color600', $request->input('coramtix:color600'));
        $this->settings->set('coramtix:color700', $request->input('coramtix:color700'));
        $this->settings->set('coramtix:color800', $request->input('coramtix:color800'));
        $this->settings->set('coramtix:color900', $request->input('coramtix:color900'));

        $this->settings->set('coramtix:theme1:name',     $request->input('coramtix:theme1:name'));
        $this->settings->set('coramtix:theme1:colorPrimary',  $request->input('coramtix:theme1:colorPrimary'));
        $this->settings->set('coramtix:theme1:color50',  $request->input('coramtix:theme1:color50'));
        $this->settings->set('coramtix:theme1:color100', $request->input('coramtix:theme1:color100'));
        $this->settings->set('coramtix:theme1:color200', $request->input('coramtix:theme1:color200'));
        $this->settings->set('coramtix:theme1:color300', $request->input('coramtix:theme1:color300'));
        $this->settings->set('coramtix:theme1:color400', $request->input('coramtix:theme1:color400'));
        $this->settings->set('coramtix:theme1:color500', $request->input('coramtix:theme1:color500'));
        $this->settings->set('coramtix:theme1:color600', $request->input('coramtix:theme1:color600'));
        $this->settings->set('coramtix:theme1:color700', $request->input('coramtix:theme1:color700'));
        $this->settings->set('coramtix:theme1:color800', $request->input('coramtix:theme1:color800'));
        $this->settings->set('coramtix:theme1:color900', $request->input('coramtix:theme1:color900'));

        $this->settings->set('coramtix:theme2:name',     $request->input('coramtix:theme2:name'));
        $this->settings->set('coramtix:theme2:colorPrimary',  $request->input('coramtix:theme2:colorPrimary'));
        $this->settings->set('coramtix:theme2:color50',  $request->input('coramtix:theme2:color50'));
        $this->settings->set('coramtix:theme2:color100', $request->input('coramtix:theme2:color100'));
        $this->settings->set('coramtix:theme2:color200', $request->input('coramtix:theme2:color200'));
        $this->settings->set('coramtix:theme2:color300', $request->input('coramtix:theme2:color300'));
        $this->settings->set('coramtix:theme2:color400', $request->input('coramtix:theme2:color400'));
        $this->settings->set('coramtix:theme2:color500', $request->input('coramtix:theme2:color500'));
        $this->settings->set('coramtix:theme2:color600', $request->input('coramtix:theme2:color600'));
        $this->settings->set('coramtix:theme2:color700', $request->input('coramtix:theme2:color700'));
        $this->settings->set('coramtix:theme2:color800', $request->input('coramtix:theme2:color800'));
        $this->settings->set('coramtix:theme2:color900', $request->input('coramtix:theme2:color900'));

        $this->settings->set('coramtix:theme3:name',     $request->input('coramtix:theme3:name'));
        $this->settings->set('coramtix:theme3:colorPrimary',  $request->input('coramtix:theme3:colorPrimary'));
        $this->settings->set('coramtix:theme3:color50',  $request->input('coramtix:theme3:color50'));
        $this->settings->set('coramtix:theme3:color100', $request->input('coramtix:theme3:color100'));
        $this->settings->set('coramtix:theme3:color200', $request->input('coramtix:theme3:color200'));
        $this->settings->set('coramtix:theme3:color300', $request->input('coramtix:theme3:color300'));
        $this->settings->set('coramtix:theme3:color400', $request->input('coramtix:theme3:color400'));
        $this->settings->set('coramtix:theme3:color500', $request->input('coramtix:theme3:color500'));
        $this->settings->set('coramtix:theme3:color600', $request->input('coramtix:theme3:color600'));
        $this->settings->set('coramtix:theme3:color700', $request->input('coramtix:theme3:color700'));
        $this->settings->set('coramtix:theme3:color800', $request->input('coramtix:theme3:color800'));
        $this->settings->set('coramtix:theme3:color900', $request->input('coramtix:theme3:color900'));

        $this->settings->set('coramtix:theme4:name',     $request->input('coramtix:theme4:name'));
        $this->settings->set('coramtix:theme4:colorPrimary',  $request->input('coramtix:theme4:colorPrimary'));
        $this->settings->set('coramtix:theme4:color50',  $request->input('coramtix:theme4:color50'));
        $this->settings->set('coramtix:theme4:color100', $request->input('coramtix:theme4:color100'));
        $this->settings->set('coramtix:theme4:color200', $request->input('coramtix:theme4:color200'));
        $this->settings->set('coramtix:theme4:color300', $request->input('coramtix:theme4:color300'));
        $this->settings->set('coramtix:theme4:color400', $request->input('coramtix:theme4:color400'));
        $this->settings->set('coramtix:theme4:color500', $request->input('coramtix:theme4:color500'));
        $this->settings->set('coramtix:theme4:color600', $request->input('coramtix:theme4:color600'));
        $this->settings->set('coramtix:theme4:color700', $request->input('coramtix:theme4:color700'));
        $this->settings->set('coramtix:theme4:color800', $request->input('coramtix:theme4:color800'));
        $this->settings->set('coramtix:theme4:color900', $request->input('coramtix:theme4:color900'));

        $this->settings->set('coramtix:theme5:name',     $request->input('coramtix:theme5:name'));
        $this->settings->set('coramtix:theme5:colorPrimary',  $request->input('coramtix:theme5:colorPrimary'));
        $this->settings->set('coramtix:theme5:color50',  $request->input('coramtix:theme5:color50'));
        $this->settings->set('coramtix:theme5:color100', $request->input('coramtix:theme5:color100'));
        $this->settings->set('coramtix:theme5:color200', $request->input('coramtix:theme5:color200'));
        $this->settings->set('coramtix:theme5:color300', $request->input('coramtix:theme5:color300'));
        $this->settings->set('coramtix:theme5:color400', $request->input('coramtix:theme5:color400'));
        $this->settings->set('coramtix:theme5:color500', $request->input('coramtix:theme5:color500'));
        $this->settings->set('coramtix:theme5:color600', $request->input('coramtix:theme5:color600'));
        $this->settings->set('coramtix:theme5:color700', $request->input('coramtix:theme5:color700'));
        $this->settings->set('coramtix:theme5:color800', $request->input('coramtix:theme5:color800'));
        $this->settings->set('coramtix:theme5:color900', $request->input('coramtix:theme5:color900'));

        $this->settings->set('coramtix:theme6:name',     $request->input('coramtix:theme6:name'));
        $this->settings->set('coramtix:theme6:colorPrimary',  $request->input('coramtix:theme6:colorPrimary'));
        $this->settings->set('coramtix:theme6:color50',  $request->input('coramtix:theme6:color50'));
        $this->settings->set('coramtix:theme6:color100', $request->input('coramtix:theme6:color100'));
        $this->settings->set('coramtix:theme6:color200', $request->input('coramtix:theme6:color200'));
        $this->settings->set('coramtix:theme6:color300', $request->input('coramtix:theme6:color300'));
        $this->settings->set('coramtix:theme6:color400', $request->input('coramtix:theme6:color400'));
        $this->settings->set('coramtix:theme6:color500', $request->input('coramtix:theme6:color500'));
        $this->settings->set('coramtix:theme6:color600', $request->input('coramtix:theme6:color600'));
        $this->settings->set('coramtix:theme6:color700', $request->input('coramtix:theme6:color700'));
        $this->settings->set('coramtix:theme6:color800', $request->input('coramtix:theme6:color800'));
        $this->settings->set('coramtix:theme6:color900', $request->input('coramtix:theme6:color900'));

        $this->settings->set('coramtix:theme7:name',     $request->input('coramtix:theme7:name'));
        $this->settings->set('coramtix:theme7:colorPrimary',  $request->input('coramtix:theme7:colorPrimary'));
        $this->settings->set('coramtix:theme7:color50',  $request->input('coramtix:theme7:color50'));
        $this->settings->set('coramtix:theme7:color100', $request->input('coramtix:theme7:color100'));
        $this->settings->set('coramtix:theme7:color200', $request->input('coramtix:theme7:color200'));
        $this->settings->set('coramtix:theme7:color300', $request->input('coramtix:theme7:color300'));
        $this->settings->set('coramtix:theme7:color400', $request->input('coramtix:theme7:color400'));
        $this->settings->set('coramtix:theme7:color500', $request->input('coramtix:theme7:color500'));
        $this->settings->set('coramtix:theme7:color600', $request->input('coramtix:theme7:color600'));
        $this->settings->set('coramtix:theme7:color700', $request->input('coramtix:theme7:color700'));
        $this->settings->set('coramtix:theme7:color800', $request->input('coramtix:theme7:color800'));
        $this->settings->set('coramtix:theme7:color900', $request->input('coramtix:theme7:color900'));

        $this->alert->success('Color settings have been updated successfully.')->flash();

        return redirect()->route('admin.designify.colors');
    }
}