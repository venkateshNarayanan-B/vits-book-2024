<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ThemeModel;

class ThemeController extends BaseController
{
    protected $themeModel;

    public function __construct()
    {
        $this->themeModel = new ThemeModel();
    }

    // List Themes (Main Page)
    public function index()
    {
        $menu = "cms"; // Indicates the module in the sidebar
        $title = "Themes Management";
        $page_title = "Themes";

        return view('backend/cms/themes/index', compact('menu', 'title', 'page_title'));
    }

    // AJAX Fetch for DataTable
    public function fetchThemes()
    {
        try {
            $themes = $this->themeModel->findAll();
            $data = [];

            foreach ($themes as $theme) {
                $data[] = [
                    'id' => $theme['id'],
                    'theme_name' => $theme['theme_name'],
                    'directory' => $theme['directory'],
                    'actions' => '<a href="/cms/themes/edit/' . $theme['id'] . '" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="/cms/themes/delete/' . $theme['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">
                                    <i class="fas fa-trash"></i> Delete
                                </a>'
                ];
            }

            return $this->response->setJSON(['data' => $data]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['swal_error' => $e->getMessage()]);
        }
    }

    // Add Theme (Form Page)
    public function create()
    {
        $menu = "cms"; 
        $title = "Add Theme";
        $page_title = "Add Theme";

        return view('backend/cms/themes/create', compact('menu', 'title', 'page_title'));
    }

    // Save Theme to Database
    public function store()
    {
        try {
            if (!$this->validate([
                'theme_name' => 'required',
                'directory'  => 'required|alpha_dash',
            ])) {
                return redirect()->back()->withInput()->with('swal_error', 'Validation errors occurred. Please check your input.');
            }

            $this->themeModel->save([
                'theme_name' => $this->request->getPost('theme_name'),
                'directory'  => $this->request->getPost('directory'),
            ]);

            return redirect()->to('/cms/themes')->with('swal_success', 'Theme added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('swal_error', $e->getMessage());
        }
    }

    // Edit Theme
    public function edit($id)
    {
        try {
            $theme = $this->themeModel->find($id);
            if (!$theme) {
                throw new \Exception("Theme not found.");
            }

            $menu = "cms"; 
            $title = "Edit Theme";
            $page_title = "Edit Theme";

            return view('backend/cms/themes/edit', compact('menu', 'theme', 'title', 'page_title'));
        } catch (\Exception $e) {
            return redirect()->to('/cms/themes')->with('swal_error', $e->getMessage());
        }
    }

    // Update Theme
    public function update($id)
    {
        try {
            $theme = $this->themeModel->find($id);
            if (!$theme) {
                throw new \Exception("Theme not found.");
            }

            if (!$this->validate([
                'theme_name' => 'required',
                'directory'  => 'required|alpha_dash',
            ])) {
                return redirect()->back()->withInput()->with('swal_error', 'Validation errors occurred. Please check your input.');
            }

            $this->themeModel->update($id, [
                'theme_name' => $this->request->getPost('theme_name'),
                'directory'  => $this->request->getPost('directory'),
            ]);

            return redirect()->to('/cms/themes')->with('swal_success', 'Theme updated successfully.');
        } catch (\Exception $e) {
            return redirect()->to('/cms/themes')->with('swal_error', $e->getMessage());
        }
    }

    // Delete Theme
    public function delete($id)
    {
        try {
            if (!$this->themeModel->find($id)) {
                throw new \Exception("Theme not found.");
            }

            $this->themeModel->delete($id);
            return redirect()->to('/cms/themes')->with('swal_success', 'Theme deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->to('/cms/themes')->with('swal_error', $e->getMessage());
        }
    }
}
