<?php

namespace App\Controllers;

use App\Models\ServiceModel;

class ServiceController extends BaseController
{
    protected $serviceModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
    }

    /**
     * Display the list of services using DataTables.
     */
    public function index()
    {
        $data = [
            'page_title' => 'Manage Services',
            'title' => 'Manage Services',
            'menu'       => 'accounts',
        ];

        return view('backend/accounts/services/index', $data);
    }

    /**
     * Fetch data for DataTables (AJAX).
     */
    public function getServicesData()
    {
        $services = $this->serviceModel->findAll();
        $data = [];

        foreach ($services as $service) {
            $data[] = [
                esc($service['service_name']),
                number_format($service['rate'], 2),
                '<a href="' . site_url('services/edit/' . $service['id']) . '" class="btn btn-sm btn-warning">Edit</a>
                 <a href="' . site_url('services/delete/' . $service['id']) . '" class="btn btn-sm btn-danger" 
                 onclick="return confirm(\'Are you sure you want to delete this service?\')">Delete</a>'
            ];
        }

        return $this->response->setJSON([
            'data' => $data,
        ]);
    }

    /**
     * Show the form to create a new service.
     */
    public function create()
    {
        $data = [
            'page_title' => 'Add New Service',
            'title' => 'Add New Service',
            'menu'       => 'accounts',
        ];

        return view('backend/accounts/services/create', $data);
    }

    /**
     * Save a new service.
     */
    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'service_name' => 'required|max_length[255]',
            'rate' => 'required|decimal',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->serviceModel->save([
            'service_name' => $this->request->getPost('service_name'),
            'rate'         => $this->request->getPost('rate'),
        ]);

        return redirect()->to('/services')->with('swal_success', 'Service added successfully.');
    }

    /**
     * Show the form to edit an existing service.
     */
    public function edit($id)
    {
        $service = $this->serviceModel->find($id);

        if (!$service) {
            return redirect()->to('/services')->with('swal_error', 'Service not found.');
        }

        $data = [
            'page_title' => 'Edit Service',
            'title' => 'Edit Service',
            'menu'       => 'accounts',
            'service'    => $service,
        ];

        return view('backend/accounts/services/edit', $data);
    }

    /**
     * Update an existing service.
     */
    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'service_name' => 'required|max_length[255]',
            'rate' => 'required|decimal',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $service = $this->serviceModel->find($id);
        if (!$service) {
            return redirect()->to('/services')->with('swal_error', 'Service not found.');
        }

        $this->serviceModel->update($id, [
            'service_name' => $this->request->getPost('service_name'),
            'rate'         => $this->request->getPost('rate'),
        ]);

        return redirect()->to('/services')->with('swal_success', 'Service updated successfully.');
    }

    /**
     * Delete a service.
     */
    public function delete($id)
    {
        $service = $this->serviceModel->find($id);

        if (!$service) {
            return redirect()->to('/services')->with('swal_error', 'Service not found.');
        }

        $this->serviceModel->delete($id);
        return redirect()->to('/services')->with('swal_success', 'Service deleted successfully.');
    }
}

