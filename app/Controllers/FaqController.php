<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FaqModel;

class FaqController extends BaseController
{
    protected $faqModel;

    public function __construct()
    {
        $this->faqModel = new FaqModel();
    }

    public function index()
    {
        $title = 'FAQs';
        $page_title = 'FAQs';
        $menu = 'cms';

        return view('backend/cms/faqs/index', compact('title', 'page_title', 'menu'));
    }

    public function getData()
    {
        $request = service('request');
        $draw = $request->getPost('draw');
        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $searchValue = $request->getPost('search')['value'];

        $query = $this->faqModel;
        if (!empty($searchValue)) {
            $query = $query->like('question', $searchValue)
                           ->orLike('answer', $searchValue);
        }

        $totalFiltered = $query->countAllResults(false);
        $faqs = $query->orderBy('id', 'DESC')->findAll($length, $start);
        $totalRecords = $this->faqModel->countAll();

        $data = [];
        foreach ($faqs as $faq) {
            $data[] = [
                'id' => $faq['id'],
                'question' => esc($faq['question']),
                'answer' => esc(substr($faq['answer'], 0, 50)) . '...',
                'status' => $faq['status'] ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>',
                'actions' => '
                    <a href="' . base_url('cms/faq/edit/' . $faq['id']) . '" class="btn btn-info btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="' . $faq['id'] . '">
                        <i class="fas fa-trash"></i> Delete
                    </button>',
            ];
        }

        return $this->response->setJSON([
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ]);
    }

    public function create()
    {
        $title = 'Add FAQ';
        $page_title = 'Add FAQ';
        $menu = 'cms';

        return view('backend/cms/faqs/create', compact('title', 'page_title', 'menu'));
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        if (!$this->validate($this->faqModel->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->faqModel->insert([
            'question' => $this->request->getPost('question'),
            'answer'   => $this->request->getPost('answer'),
            'status'   => $this->request->getPost('status'),
        ]);

        return redirect()->to('/cms/faq')->with('swal_success', 'FAQ created successfully.');
    }

    public function edit($id)
    {
        $faq = $this->faqModel->find($id);
        if (!$faq) {
            return redirect()->to('/cms/faq')->with('swal_error', 'FAQ not found.');
        }

        $title = 'Edit FAQ';
        $page_title = 'Edit FAQ';
        $menu = 'cms';

        return view('backend/cms/faqs/edit', compact('title', 'page_title', 'menu', 'faq'));
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        if (!$this->validate($this->faqModel->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->faqModel->update($id, [
            'question' => $this->request->getPost('question'),
            'answer'   => $this->request->getPost('answer'),
            'status'   => $this->request->getPost('status'),
        ]);

        return redirect()->to('/cms/faq')->with('swal_success', 'FAQ updated successfully.');
    }

    public function delete($id)
    {
        $this->faqModel->delete($id);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'FAQ deleted successfully.',
        ]);
    }
}
