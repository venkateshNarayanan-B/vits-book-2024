<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PagesModel;

class PagesController extends BaseController
{
    protected $pagesModel;

    public function __construct()
    {
        $this->pagesModel = new PagesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manage Pages',
            'page_title' => 'Pages',
            'menu' => 'cms',
            'pages' => $this->pagesModel->getPagesHierarchy(), // Fetch hierarchical structure
           //'dump' => $this->getPagesData()
        ];
        return view('backend/cms/pages/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Page',
            'page_title' => 'Create Page',
            'menu' => 'cms',
            'parentPages' => $this->pagesModel->where('status', 'active')->findAll() // Fetch active pages for dropdown
        ];
        return view('backend/cms/pages/create', $data);
    }

    public function store()
    {
        // Validate the input
        if (!$this->validate([
            'title' => 'required|max_length[255]',
            'content' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the page
        $this->pagesModel->save([
            'title' => $this->request->getPost('title'),
            'slug' => url_title($this->request->getPost('title'), '-', true),
            'content' => $this->request->getPost('content'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'meta_description' => $this->request->getPost('meta_description'),
            'status' => $this->request->getPost('status'),
            'parent_id' => $this->request->getPost('parent_id') ?? null, // Parent page ID
        ]);

        return redirect()->to('/cms/pages')->with('swal_success', 'Page created successfully.');
    }

    public function edit($id)
    {
        $page = $this->pagesModel->find($id);

        if (!$page) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Page with ID $id not found.");
        }

        $data = [
            'title' => 'Edit Page',
            'page_title' => 'Edit Page',
            'menu' => 'cms',
            'page' => $page,
            'parentPages' => $this->pagesModel
                ->where('status', 'active')
                ->where('id !=', $id) // Exclude the current page
                ->findAll(),
        ];
        return view('backend/cms/pages/edit', $data);
    }

    public function update($id)
    {
        // Validate the input
        if (!$this->validate([
            'title' => 'required|max_length[255]',
            'content' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update the page
        $this->pagesModel->update($id, [
            'title' => $this->request->getPost('title'),
            'slug' => url_title($this->request->getPost('title'), '-', true),
            'content' => $this->request->getPost('content'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
            'meta_description' => $this->request->getPost('meta_description'),
            'status' => $this->request->getPost('status'),
            'parent_id' => $this->request->getPost('parent_id') ?? null, // Parent page ID
        ]);

        return redirect()->to('/cms/pages')->with('swal_success', 'Page updated successfully.');
    }

    public function delete($id)
    {
        $this->pagesModel->delete($id);
        return redirect()->to('/cms/pages')->with('swal_success', 'Page deleted successfully.');
    }

    public function getPagesData()
    {
        $request = service('request'); // Get the request object
        $pagesModel = $this->pagesModel;

        // DataTables parameters
        $draw = $request->getPost('draw');
        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $searchValue = $request->getPost('search')['value'];

        // Base query with join for parent title
        $query = $pagesModel->select('pages.id, pages.title, pages.slug, pages.status, parent.title as parent_title')
                            ->join('pages as parent', 'pages.parent_id = parent.id', 'left');

        // Total records
        $totalRecords = $query->countAllResults(false);

        // Apply search filter if needed
        if (!empty($searchValue)) {
            $query->groupStart()
                ->like('pages.title', $searchValue)
                ->orLike('pages.slug', $searchValue)
                ->orLike('pages.status', $searchValue)
                ->orLike('parent.title', $searchValue) // Search in parent title
                ->groupEnd();
        }

        // Total filtered records
        $totalFiltered = $query->countAllResults(false);

        // Fetch paginated data
        $pages = $query->orderBy('pages.id', 'DESC')
                    ->findAll($length, $start);

        // Format data for DataTable
        $data = [];
        foreach ($pages as $page) {
            $data[] = [
                'id' => $page['id'],
                'title' => $page['title'],
                'slug' => $page['slug'],
                'parent_title' => $page['parent_title'] ?? '<em>No Parent</em>', // Handle no parent case
                'status' => $page['status'],
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


}
