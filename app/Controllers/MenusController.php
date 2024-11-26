<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MenuModel;

class MenusController extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }

    // List Menus
    public function index()
    {
        $title = 'Menu Management';
        $page_title = 'Manage Menus';
        $menu = 'cms';

        return view('backend/cms/menus/index', compact('title', 'page_title', 'menu'));
    }

    // Get data for DataTable
    public function getMenusData()
    {
        $request = service('request');
        $menusModel = $this->menuModel;

        // DataTables parameters
        $draw = $request->getPost('draw');
        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $searchValue = $request->getPost('search')['value'];

        // Base query with join for parent menu name
        $query = $menusModel->select('menus.id, menus.menu_name, menus.url, menus.position, menus.status, parent.menu_name as parent_name')
                            ->join('menus as parent', 'menus.parent_id = parent.id', 'left');

        // Total records
        $totalRecords = $query->countAllResults(false);

        // Apply search filter if needed
        if (!empty($searchValue)) {
            $query->groupStart()
                ->like('menus.menu_name', $searchValue)
                ->orLike('menus.url', $searchValue)
                ->orLike('menus.status', $searchValue)
                ->orLike('parent.menu_name', $searchValue) // Search in parent menu name
                ->groupEnd();
        }

        // Total filtered records
        $totalFiltered = $query->countAllResults(false);

        // Fetch paginated data
        $menus = $query->orderBy('menus.position', 'ASC')
                       ->findAll($length, $start);

        // Format data for DataTable
        $data = [];
        foreach ($menus as $menu) {
            $data[] = [
                'id' => $menu['id'],
                'menu_name' => $menu['menu_name'],
                'url' => $menu['url'] ?: '<em>No URL</em>',
                'parent_name' => $menu['parent_name'] ?? '<em>No Parent</em>',
                'position' => $menu['position'],
                'status' => $menu['status'],
            ];
        }

        // Response for DataTable
        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
        ];

        return $this->response->setJSON($response);
    }

    // Create Menu
    public function create()
    {
        $title = 'Create Menu';
        $page_title = 'Add New Menu';
        $menu = 'cms';

        // Fetch parent menus for dropdown
        $parentMenus = $this->menuModel->where('parent_id', null)->findAll();

        return view('backend/cms/menus/create', compact('title', 'page_title', 'menu', 'parentMenus'));
    }

    // Store Menu
    public function store()
    {
        if (!$this->validate([
            'menu_name' => 'required',
            'position'  => 'required|integer',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'menu_name' => $this->request->getPost('menu_name'),
            'parent_id' => $this->request->getPost('parent_id') ?: null,
            'page_id'   => $this->request->getPost('page_id') ?: null,
            'url'       => $this->request->getPost('url'),
            'position'  => $this->request->getPost('position'),
            'status'    => $this->request->getPost('status'),
        ];

        $this->menuModel->insert($data);

        return redirect()->to('cms/menus')->with('success', 'Menu created successfully.');
    }

    // Edit Menu
    public function edit($id)
    {
        $menuVar = $this->menuModel->find($id);

        if (!$menuVar) {
            return redirect()->to('cms/menus')->with('error', 'Menu not found.');
        }

        $title = 'Edit Menu';
        $page_title = 'Edit Menu: ' . $menuVar['menu_name'];
        $menu = 'cms'; // Avoid conflict with the $menu variable

        // Fetch parent menus for dropdown
        $parentMenus = $this->menuModel->where('id !=', $id)->findAll();

        return view('backend/cms/menus/edit', compact('title', 'page_title', 'menuVar', 'menu', 'parentMenus'));
    }

    // Update Menu
    public function update($id)
    {
        if (!$this->validate([
            'menu_name' => 'required',
            'position'  => 'required|integer',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'menu_name' => $this->request->getPost('menu_name'),
            'parent_id' => $this->request->getPost('parent_id') ?: null,
            'page_id'   => $this->request->getPost('page_id') ?: null,
            'url'       => $this->request->getPost('url'),
            'position'  => $this->request->getPost('position'),
            'status'    => $this->request->getPost('status'),
        ];

        $this->menuModel->update($id, $data);

        return redirect()->to('cms/menus')->with('success', 'Menu updated successfully.');
    }

    // Delete Menu
    public function delete($id)
    {
        if (!$this->menuModel->find($id)) {
            return redirect()->to('cms/menus')->with('error', 'Menu not found.');
        }

        $this->menuModel->delete($id);

        return redirect()->to('cms/menus')->with('success', 'Menu deleted successfully.');
    }
}
