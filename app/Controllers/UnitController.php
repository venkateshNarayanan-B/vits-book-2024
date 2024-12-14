<?php

namespace App\Controllers;

use App\Models\UnitModel;

class UnitController extends BaseController
{
    protected $unitModel;

    public function __construct()
    {
        $this->unitModel = new UnitModel();
    }

    public function index()
    {
        if ($this->request->isAJAX()) {
            $units = $this->unitModel->findAll();
            
            $data = [];
            foreach ($units as $unit) {
                $data[] = [
                    esc($unit['id']),
                    esc($unit['unit_name']),
                    esc(number_format($unit['conversion_rate'], 4)),
                    '<a href="' . site_url('inventory/units/edit/' . $unit['id']) . '" class="btn btn-sm btn-primary">Edit</a>
                    <a href="' . site_url('inventory/units/delete/' . $unit['id']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>',
                ];
            }

            return $this->response->setJSON(['data' => $data]);
        }

        

        $data = [
            'menu' => 'accounts',
            'page_title' => 'Manage Units',
            'title' => 'Unit List',
        ];

        return view('backend/accounts/inventory/units/index', $data);
    }


    public function create()
    {
        $page_title = "Add Unit";
        $menu = "accounts";
        $title = "Add New Unit";

        return view('backend/accounts/inventory/units/create', compact('page_title', 'menu', 'title'));
    }

    public function store()
    {
        if (!$this->validate([
            'unit_name' => 'required',
            'conversion_rate' => 'decimal',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $this->unitModel->save([
            'unit_name' => $this->request->getPost('unit_name'),
            'conversion_rate' => $this->request->getPost('conversion_rate') ?? 1.0000,
        ]);

        return redirect()->to('inventory/units')->with('swal_success', 'Unit added successfully.');
    }

    public function edit($id)
    {
        $page_title = "Edit Unit";
        $menu = "accounts";
        $title = "Edit Unit Details";
        $unit = $this->unitModel->find($id);

        return view('backend/accounts/inventory/units/edit', compact('page_title', 'menu', 'title', 'unit'));
    }

    public function update($id)
    {
        if (!$this->validate([
            'unit_name' => 'required',
            'conversion_rate' => 'decimal',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $this->unitModel->update($id, [
            'unit_name' => $this->request->getPost('unit_name'),
            'conversion_rate' => $this->request->getPost('conversion_rate') ?? 1.0000,
        ]);

        return redirect()->to('inventory/units')->with('swal_success', 'Unit updated successfully.');
    }

    public function delete($id)
    {
        $this->unitModel->delete($id);

        return redirect()->to('inventory/units')->with('swal_success', 'Unit deleted successfully.');
    }
}
