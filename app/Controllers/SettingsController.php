<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SettingsModel;

class SettingsController extends BaseController
{
    protected $settingsModel;

    public function __construct()
    {
        $this->settingsModel = new SettingsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Company Settings',
            'page_title' => 'Settings',
            'menu' => 'cms',
            'settings' => [
                'company_name' => $this->settingsModel->getSetting('company_name')['value'] ?? '',
                'address' => $this->settingsModel->getSetting('address')['value'] ?? '',
                'phone' => $this->settingsModel->getSetting('phone')['value'] ?? '',
                'cell' => $this->settingsModel->getSetting('cell')['value'] ?? '',
                'email' => $this->settingsModel->getSetting('email')['value'] ?? '',
                'gst_no' => $this->settingsModel->getSetting('gst_no')['value'] ?? '',
            ],
        ];

        return view('backend/cms/settings/index', $data);
    }

    public function save()
    {
        $this->settingsModel->updateSetting('company_name', $this->request->getPost('company_name'));
        $this->settingsModel->updateSetting('address', $this->request->getPost('address'));
        $this->settingsModel->updateSetting('phone', $this->request->getPost('phone'));
        $this->settingsModel->updateSetting('cell', $this->request->getPost('cell'));
        $this->settingsModel->updateSetting('email', $this->request->getPost('email'));
        $this->settingsModel->updateSetting('gst_no', $this->request->getPost('gst_no'));

        return redirect()->to('/cms/settings')->with('swal_success', 'Settings updated successfully.');
    }
}
