<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContentBlockModel;

class ContentBlocksController extends BaseController
{
    protected $contentBlockModel;

    public function __construct()
    {
        $this->contentBlockModel = new ContentBlockModel();
    }

    // Display all content blocks
    public function index()
    {
        $title = 'Content Blocks';
        $page_title = 'Manage Content Blocks';
        $menu = 'cms';

        return view('backend/cms/content_blocks/index', compact('title', 'page_title', 'menu'));
    }

    // DataTable AJAX method
    public function getData()
    {
        $request = service('request');
        $contentBlockModel = $this->contentBlockModel;

        // DataTables parameters
        $draw = $request->getPost('draw');
        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $searchValue = $request->getPost('search')['value'];

        // Base query
        $query = $contentBlockModel;

        // Total records
        $totalRecords = $query->countAllResults(false);

        // Apply search filter
        if (!empty($searchValue)) {
            $query->like('title', $searchValue)
                  ->orLike('identifier', $searchValue)
                  ->orLike('status', $searchValue);
        }

        // Total filtered records
        $totalFiltered = $query->countAllResults(false);

        // Fetch paginated data
        $contentBlocks = $query->orderBy('id', 'DESC')
                               ->findAll($length, $start);

        // Format data for DataTable
        $data = [];
        foreach ($contentBlocks as $block) {
            $data[] = [
                'id' => $block['id'],
                'title' => $block['title'],
                'identifier' => $block['identifier'],
                'status' => $block['status'],
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

    // Create a new content block
    public function create()
    {
        $title = 'Create Content Block';
        $page_title = 'Add New Content Block';
        $menu = 'cms';

        return view('backend/cms/content_blocks/create', compact('title', 'page_title', 'menu'));
    }

    // Store the new content block
    public function store()
    {
        if (!$this->validate([
            'title' => 'required',
            'identifier' => 'required|is_unique[content_blocks.identifier]',
            'content' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'identifier' => $this->request->getPost('identifier'),
            'content' => $this->request->getPost('content'),
            'status' => $this->request->getPost('status'),
        ];

        $this->contentBlockModel->insert($data);

        return redirect()->to('cms/content-blocks')->with('success', 'Content block created successfully.');
    }

    // Edit content block
    public function edit($id)
    {
        $contentBlock = $this->contentBlockModel->find($id);

        if (!$contentBlock) {
            return redirect()->to('cms/content-blocks')->with('error', 'Content block not found.');
        }

        $title = 'Edit Content Block';
        $page_title = 'Edit Content Block: ' . $contentBlock['title'];
        $menu = 'cms';

        return view('backend/cms/content_blocks/edit', compact('title', 'page_title', 'menu', 'contentBlock'));
    }

    // Update content block
    public function update($id)
    {
        $contentBlock = $this->contentBlockModel->find($id);

        if (!$contentBlock) {
            return redirect()->to('cms/content-blocks')->with('error', 'Content block not found.');
        }

        if (!$this->validate([
            'title' => 'required',
            'identifier' => "required|is_unique[content_blocks.identifier,id,{$id}]",
            'content' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'identifier' => $this->request->getPost('identifier'),
            'content' => $this->request->getPost('content'),
            'status' => $this->request->getPost('status'),
        ];

        $this->contentBlockModel->update($id, $data);

        return redirect()->to('cms/content-blocks')->with('success', 'Content block updated successfully.');
    }

    // Delete content block
    public function delete($id)
    {
        if (!$this->contentBlockModel->find($id)) {
            return redirect()->to('cms/content-blocks')->with('error', 'Content block not found.');
        }

        $this->contentBlockModel->delete($id);

        return redirect()->to('cms/content-blocks')->with('success', 'Content block deleted successfully.');
    }
}
