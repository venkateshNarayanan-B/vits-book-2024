<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WidgetPlacementModel;
use App\Models\ContentBlockModel;

class WidgetPlacementController extends BaseController
{
    protected $widgetPlacementModel;
    protected $contentBlockModel;

    public function __construct()
    {
        $this->widgetPlacementModel = new WidgetPlacementModel();
        $this->contentBlockModel = new ContentBlockModel();
    }

    // List all widget placements for a specific layout
    public function index($layoutId)
    {
        try {
            $menu = "cms";
            $title = "Manage Widget Placements";
            $page_title = "Widget Placements";

            return view('backend/cms/widgets/index', compact('menu', 'title', 'page_title', 'layoutId'));
        } catch (\Exception $e) {
            return redirect()->back()->with('swal_error', $e->getMessage());
        }
    }

    // Fetch data for DataTable
    public function fetch($layoutId)
    {
        try {
            $assignments = $this->widgetPlacementModel->where('layout_id', $layoutId)->findAll();
            $data = [];

            foreach ($assignments as $assignment) {
                $contentBlock = $this->contentBlockModel->find($assignment['widget_id']);
                $data[] = [
                    'id' => $assignment['id'],
                    'widget_name' => $contentBlock['title'] ?? 'Unknown Widget',
                    'position' => $assignment['position'],
                    'actions' => '<a href="' . base_url("cms/widgets/edit/{$assignment['id']}/{$layoutId}") . '" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                  </a>
                                  <a href="' . base_url("cms/widgets/delete/{$assignment['id']}/{$layoutId}") . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">
                                    <i class="fas fa-trash"></i> Delete
                                  </a>'
                ];
            }

            return $this->response->setJSON(['data' => $data]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['swal_error' => $e->getMessage()]);
        }
    }

    // Add widget placement form
    public function create($layoutId)
    {
        try {
            $menu = "cms";
            $title = "Add Widget Placement";
            $page_title = "Add Widget Placement";

            $contentBlocks = $this->contentBlockModel->findAll();

            return view('backend/cms/widgets/create', compact('menu', 'title', 'page_title', 'layoutId', 'contentBlocks'));
        } catch (\Exception $e) {
            return redirect()->back()->with('swal_error', $e->getMessage());
        }
    }

    // Store widget placement in database
    public function store($layoutId)
    {
        try {
            if (!$this->validate([
                'widget_id' => 'required|numeric',
                'position' => 'required|string'
            ])) {
                return redirect()->back()->withInput()->with('swal_error', 'Validation errors occurred.');
            }

            $this->widgetPlacementModel->save([
                'layout_id' => $layoutId,
                'widget_id' => $this->request->getPost('widget_id'),
                'position' => $this->request->getPost('position')
            ]);

            return redirect()->to(base_url("cms/widgets/{$layoutId}"))->with('swal_success', 'Widget placement added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('swal_error', $e->getMessage());
        }
    }

    // Edit widget placement form
    public function edit($id, $layoutId)
    {
        try {
            $menu = "cms";
            $placement = $this->widgetPlacementModel->find($id);

            if (!$placement) {
                throw new \Exception("Widget placement not found.");
            }

            $title = "Edit Widget Placement";
            $page_title = "Edit Widget Placement";

            $contentBlocks = $this->contentBlockModel->findAll();

            return view('backend/cms/widgets/edit', compact('menu', 'title', 'page_title', 'placement', 'contentBlocks', 'layoutId'));
        } catch (\Exception $e) {
            return redirect()->back()->with('swal_error', $e->getMessage());
        }
    }

    // Update widget placement in database
    public function update($id, $layoutId)
    {
        try {
            $placement = $this->widgetPlacementModel->find($id);

            if (!$placement) {
                throw new \Exception("Widget placement not found.");
            }

            if (!$this->validate([
                'widget_id' => 'required|numeric',
                'position' => 'required|string'
            ])) {
                return redirect()->back()->withInput()->with('swal_error', 'Validation errors occurred.');
            }

            $this->widgetPlacementModel->update($id, [
                'widget_id' => $this->request->getPost('widget_id'),
                'position' => $this->request->getPost('position')
            ]);

            return redirect()->to(base_url("cms/widgets/{$layoutId}"))->with('swal_success', 'Widget placement updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('swal_error', $e->getMessage());
        }
    }

    // Delete widget placement
    public function delete($id, $layoutId)
    {
        try {
            if (!$this->widgetPlacementModel->find($id)) {
                throw new \Exception("Widget placement not found.");
            }

            $this->widgetPlacementModel->delete($id);

            return redirect()->to(base_url("cms/widgets/{$layoutId}"))->with('swal_success', 'Widget placement deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('swal_error', $e->getMessage());
        }
    }
}
