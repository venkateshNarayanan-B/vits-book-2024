<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ThemeModel;
use App\Models\ThemeLayoutModel;

class LayoutController extends BaseController
{
    protected $themeModel;
    protected $themeLayoutModel;

    public function __construct()
    {
        $this->themeModel = new ThemeModel();
        $this->themeLayoutModel = new ThemeLayoutModel();
    }

    // List Layouts for a Specific Theme
    public function index($themeId)
    {
        try {
            $menu = "cms";
            $theme = $this->themeModel->find($themeId);
            if (!$theme) {
                throw new \Exception("Theme not found.");
            }

            $title = "Layouts Management for Theme: " . $theme['theme_name'];
            $page_title = "Layouts";

            return view('backend/cms/layouts/index', compact('menu', 'theme', 'title', 'page_title'));
        } catch (\Exception $e) {
            return redirect()->to('/cms/themes')->with('swal_error', $e->getMessage());
        }
    }

    // Fetch Layouts for DataTable
    public function fetchLayouts($themeId)
    {
        try {
            $layouts = $this->themeLayoutModel->where('theme_id', $themeId)->findAll();
            $data = [];

            foreach ($layouts as $layout) {
                $data[] = [
                    'id' => $layout['id'],
                    'layout_name' => $layout['layout_name'],
                    'layout_file' => $layout['layout_file'],
                    'actions' => '<a href="/cms/layouts/edit/' . $layout['id'] . '/' . $themeId . '" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="/cms/layouts/delete/' . $layout['id'] . '/' . $themeId . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">
                                    <i class="fas fa-trash"></i> Delete
                                </a>'
                ];
            }

            return $this->response->setJSON(['data' => $data]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['swal_error' => $e->getMessage()]);
        }
    }

    // Add Layout Form
    public function create($themeId)
    {
        try {
            $menu = "cms";
            $theme = $this->themeModel->find($themeId);
            if (!$theme) {
                throw new \Exception("Theme not found.");
            }

            $title = "Add Layout to Theme: " . $theme['theme_name'];
            $page_title = "Add Layout";

            return view('backend/cms/layouts/create', compact('menu', 'theme', 'title', 'page_title'));
        } catch (\Exception $e) {
            return redirect()->to('/cms/themes')->with('swal_error', $e->getMessage());
        }
    }

    // Save Layout to Database
    public function store($themeId)
    {
        try {
            if (!$this->validate([
                'layout_name' => 'required',
                'layout_file' => 'required|alpha_dash',
            ])) {
                return redirect()->back()->withInput()->with('swal_error', 'Validation errors occurred. Please check your input.');
            }

            $this->themeLayoutModel->save([
                'theme_id' => $themeId,
                'layout_name' => $this->request->getPost('layout_name'),
                'layout_file' => $this->request->getPost('layout_file'),
            ]);

            return redirect()->to('/cms/layouts/' . $themeId)->with('swal_success', 'Layout added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('swal_error', $e->getMessage());
        }
    }

    // Edit Layout Form
    public function edit($id, $themeId)
    {
        try {
            $menu = "cms";
            $layout = $this->themeLayoutModel->find($id);
            if (!$layout) {
                throw new \Exception("Layout not found.");
            }

            $theme = $this->themeModel->find($themeId);
            if (!$theme) {
                throw new \Exception("Theme not found.");
            }

            $title = "Edit Layout for Theme: " . $theme['theme_name'];
            $page_title = "Edit Layout";

            return view('backend/cms/layouts/edit', compact('menu', 'layout', 'theme', 'title', 'page_title'));
        } catch (\Exception $e) {
            return redirect()->to('/cms/layouts/' . $themeId)->with('swal_error', $e->getMessage());
        }
    }

    // Update Layout
    public function update($id, $themeId)
    {
        try {
            $layout = $this->themeLayoutModel->find($id);
            if (!$layout) {
                throw new \Exception("Layout not found.");
            }

            if (!$this->validate([
                'layout_name' => 'required',
                'layout_file' => 'required|alpha_dash',
            ])) {
                return redirect()->back()->withInput()->with('swal_error', 'Validation errors occurred. Please check your input.');
            }

            $this->themeLayoutModel->update($id, [
                'layout_name' => $this->request->getPost('layout_name'),
                'layout_file' => $this->request->getPost('layout_file'),
            ]);

            return redirect()->to('/cms/layouts/' . $themeId)->with('swal_success', 'Layout updated successfully.');
        } catch (\Exception $e) {
            return redirect()->to('/cms/layouts/' . $themeId)->with('swal_error', $e->getMessage());
        }
    }

    // Delete Layout
    public function delete($id, $themeId)
    {
        try {
            if (!$this->themeLayoutModel->find($id)) {
                throw new \Exception("Layout not found.");
            }

            $this->themeLayoutModel->delete($id);
            return redirect()->to('/cms/layouts/' . $themeId)->with('swal_success', 'Layout deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->to('/cms/layouts/' . $themeId)->with('swal_error', $e->getMessage());
        }
    }
}
