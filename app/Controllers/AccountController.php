<?php

namespace App\Controllers;

use App\Models\AccountGroupModel;
use App\Models\LedgerModel;

class AccountController extends BaseController
{
    protected $accountGroupModel;
    protected $ledgerModel;

    public function __construct()
    {
        $this->accountGroupModel = new AccountGroupModel();
        $this->ledgerModel = new LedgerModel();
    }

    // Account Groups Index
    public function index()
    {
        $data = [
            'menu' => 'accounts',
            'page_title' => 'Account Groups',
            'title' => 'Account Groups'
        ];
        return view('backend/accounts/index', $data);
    }

    // Function to list ledgers
    public function ledgers()
    {
        $data = [
            'menu' => 'accounts',
            'page_title' => 'Ledgers',
            'title' => 'Account Ledgers',
            'groups' => $this->accountGroupModel->findAll()
        ];

        return view('backend/accounts/ledgers', $data);
    }

    // Create Account Group
    public function createGroup()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'group_name' => 'required|min_length[3]|max_length[255]',
                'parent_group_id' => 'permit_empty|integer',
            ];

            if (!$this->validate($rules)) {
                return view('backend/accounts/create_group', [
                    'validation' => $this->validator,
                    'groups' => $this->accountGroupModel->findAll(),
                    'page_title' => 'Create Group',
                    'title' => 'Create Group'
                ]);
            }

            $this->accountGroupModel->save($this->request->getPost());
            session()->setFlashdata('swal_success', 'Account Group created successfully!');
            return redirect()->to('/accounts');
        }

        return view('backend/accounts/create_group', ['groups' => $this->accountGroupModel->findAll(), 'page_title' => 'Create Group',
                    'title' => 'Create Group', 'menu' => 'accounts']);
    }

    // Edit Account Group
    public function editGroup($id)
    {
        $group = $this->accountGroupModel->find($id);

        if (!$group) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Account Group with ID $id not found.");
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'group_name' => 'required|min_length[3]|max_length[255]',
                'parent_group_id' => 'permit_empty|integer',
            ];

            if (!$this->validate($rules)) {
                return view('backend/accounts/create_group', [
                    'validation' => $this->validator,
                    'group' => $group,
                    'groups' => $this->accountGroupModel->findAll(),
                    'menu' => 'accounts',
                    'page_title' => 'Edit Group',
                    'title' => 'Edit Group'
                ]);
            }

            $this->accountGroupModel->update($id, $this->request->getPost());
            session()->setFlashdata('swal_success', 'Account Group updated successfully!');
            return redirect()->to('/accounts');
        }

        return view('backend/accounts/create_group', [
            'group' => $group,
            'groups' => $this->accountGroupModel->findAll(),
            'menu' => 'accounts',
            'page_title' => 'Edit Group',
            'title' => 'Edit Group'
        ]);
    }

    // Delete Account Group
    public function deleteGroup($id)
    {
        $this->accountGroupModel->delete($id);
        session()->setFlashdata('swal_success', 'Group deleted successfully!');
        return redirect()->to('/accounts');
    }

    // Create Ledger
    public function createLedger()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'ledger_name' => 'required|min_length[3]|max_length[255]',
                'group_id' => 'required|integer',
                'opening_balance' => 'required|decimal',
            ];

            if (!$this->validate($rules)) {
                return view('backend/accounts/create_ledger', [
                    'validation' => $this->validator,
                    'groups' => $this->accountGroupModel->findAll(),
                    'menu' => 'accounts',
                    'page_title' => 'Create Ledger',
                    'title' => 'Create Ledger'
                ]);
            }

            $postData = $this->request->getPost();
            $postData['balance'] = $postData['opening_balance']; // Set initial balance

            $this->ledgerModel->save($postData);
            session()->setFlashdata('swal_success', 'Ledger created successfully!');
            return redirect()->to('/accounts/ledgers');
        }

        return view('backend/accounts/create_ledger', ['groups' => $this->accountGroupModel->findAll(), 'page_title' => 'Create Ledger', 'title' => 'Create Ledger']);
    }

    // Edit Ledger
    public function editLedger($id)
    {
        $ledger = $this->ledgerModel->find($id);

        if (!$ledger) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Ledger with ID $id not found.");
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'ledger_name' => 'required|min_length[3]|max_length[255]',
                'group_id' => 'required|integer',
                'opening_balance' => 'required|decimal',
            ];

            if (!$this->validate($rules)) {
                return view('backend/accounts/create_ledger', [
                    'validation' => $this->validator,
                    'ledger' => $ledger,
                    'groups' => $this->accountGroupModel->findAll(),
                    'menu' => 'accounts',
                    'page_title' => 'Edit Ledger',
                    'title' => 'Edit Ledger'
                ]);
            }

            $postData = $this->request->getPost();

            // If opening balance changes, adjust the balance accordingly
            $postData['balance'] = $ledger['balance'] + ($postData['opening_balance'] - $ledger['opening_balance']);

            
            $this->ledgerModel->update($id, $postData);
            session()->setFlashdata('swal_success', 'Ledger updated successfully!');
            return redirect()->to('/accounts/ledgers');
        }

        return view('backend/accounts/create_ledger', [
            'ledger' => $ledger,
            'groups' => $this->accountGroupModel->findAll(),
            'menu' => 'accounts',
            'page_title' => 'Edit Ledger',
            'title' => 'Edit Ledger'
        ]);
    }

    // Delete Ledger
    public function deleteLedger($id)
    {
        $this->ledgerModel->delete($id);
        session()->setFlashdata('swal_success', 'Ledger deleted successfully!');
        return redirect()->to('/accounts');
    }

    public function getData()
    {
        $request = \Config\Services::request();
        $type = $request->getPost('type'); // 'group' or 'ledger'

        $model = $type === 'ledger' ? $this->ledgerModel : $this->accountGroupModel;

        $draw = $request->getPost('draw');
        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $searchValue = $request->getPost('search')['value'];

        $totalRecords = $model->countAll();
        
        if (!empty($searchValue)) {
            $model->like($type === 'ledger' ? 'ledger_name' : 'group_name', $searchValue);
        }

        $filteredRecords = $model->countAllResults();
        $data = $model->like($type === 'ledger' ? 'ledger_name' : 'group_name', $searchValue)->findAll($length, $start);

        foreach ($data as &$row) {
            if ($type === 'ledger') {
                $row['group_name'] = $this->accountGroupModel->find($row['group_id'])['group_name'];
            }
            $row['actions'] = '<button class="btn btn-info btn-sm edit-btn" data-id="' . $row['id'] . '">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="' . $row['id'] . '">Delete</button>';
        }

        return $this->response->setJSON([
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data,
        ]);
    }


}
