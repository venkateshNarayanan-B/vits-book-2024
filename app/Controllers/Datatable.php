<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Browser;

class Datatable extends BaseController
{
    public function index()
    {
        $data   =   array("title" => "Simple Data Table");
        return view("backend/table", $data);
    }

    //datatable section
    

    public function tableWithFeatures()
    {
        $data   =   array("title" => "Featured Data Table");
        return view("backend/tableWithFeatures", $data);
    }

    //Delete section
    public function delete($id)
    {
        $model = new Browser();
        
        // Delete the record
        $model->delete($id);
        
        // Optionally, return a response if needed
        return $this->response->setJSON(['status' => 'success']);
    }

    //Data section for datatable
    public function getData()
    {
        $model = new Browser();
        $request = \Config\Services::request();

        // Get the DataTable parameters
        $draw = $request->getPost('draw');
        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $searchValue = $request->getPost('search')['value'];

        // Get the total count of records
        $totalRecords = $model->countAll();

        // Apply search filter if any
        if (!empty($searchValue)) {
            $model->like('engine', $searchValue)
                ->orLike('browser', $searchValue)
                ->orLike('platform', $searchValue);
        }

        // Get the filtered records
        $filteredRecords = $model->countAllResults();

        // Get the actual data
        $data = $model->like('engine', $searchValue)
                    ->orLike('browser', $searchValue)
                    ->orLike('platform', $searchValue)
                    ->findAll($length, $start);

        // Add action buttons for each row
        foreach ($data as &$row) {
            $row['actions'] = '<button class="btn btn-info btn-sm edit-btn" data-id="' . $row['id'] . '">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="' . $row['id'] . '">Delete</button>';
        }

        $response = [
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data,
        ];

        return $this->response->setJSON($response);
    }

}