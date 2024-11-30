<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductEnquiryModel;

class EnquiryController extends BaseController
{
    protected $enquiryModel;

    public function __construct()
    {
        $this->enquiryModel = new ProductEnquiryModel();
    }

    // List Enquiries
    public function index()
    {
        $title = 'Enquiry Management';
        $page_title = 'Manage Enquiries';
        $menu = 'cms';

        return view('backend/cms/enquiries/index', compact('title', 'page_title', 'menu'));
    }

    // Get Data for DataTable
    public function getEnquiriesData()
    {
        $request = service('request');

        // Safely fetch DataTable parameters
        $draw = $request->getPost('draw') ?? 0;
        $start = $request->getPost('start') ?? 0;
        $length = $request->getPost('length') ?? 10;
        $search = $request->getPost('search') ?? [];
        $searchValue = $search['value'] ?? '';

        // Base query
        $query = $this->enquiryModel
            ->select('product_enquiries.id, product_enquiries.name, product_enquiries.email, product_enquiries.phone, product_enquiries.responded, product_enquiries.created_at, products.name as product_name')
            ->join('products', 'product_enquiries.product_id = products.id', 'left');

        // Total records
        $totalRecords = $query->countAllResults(false);

        // Apply search filter
        if (!empty($searchValue)) {
            $query->groupStart()
                ->like('product_enquiries.name', $searchValue)
                ->orLike('product_enquiries.email', $searchValue)
                ->orLike('products.name', $searchValue)
                ->groupEnd();
        }

        // Total filtered records
        $totalFiltered = $query->countAllResults(false);

        // Fetch paginated data
        $enquiries = $query->orderBy('product_enquiries.created_at', 'DESC')
            ->findAll($length, $start);

        // Format data for DataTable
        $data = [];
        foreach ($enquiries as $enquiry) {
            $data[] = [
                'id' => $enquiry['id'],
                'name' => $enquiry['name'],
                'email' => $enquiry['email'],
                'phone' => $enquiry['phone'],
                'responded' => $enquiry['responded'] ? 'Yes' : 'No',
                'product_name' => $enquiry['product_name'] ?? '<em>Unknown Product</em>',
                'created_at' => $enquiry['created_at'],
            ];
        }

        // Return JSON response
        return $this->response->setJSON([
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
        ]);
    }


    // View Enquiry Details
    public function view($id)
    {
        $enquiry = $this->enquiryModel
            ->select('product_enquiries.*, products.name as product_name')
            ->join('products', 'product_enquiries.product_id = products.id', 'left')
            ->find($id);

        if (!$enquiry) {
            return $this->response->setStatusCode(404, 'Enquiry not found');
        }

        // Prepare HTML response
        return view('backend/cms/enquiries/view_modal', compact('enquiry'));
    }


    // Mark Enquiry as Responded
    public function respond($id)
    {
        if (!$this->enquiryModel->find($id)) {
            return redirect()->to('/cms/enquiries')->with('swal_error', 'Enquiry not found.');
        }

        $this->enquiryModel->update($id, ['responded' => 1]);

        return redirect()->to('/cms/enquiries')->with('swal_success', 'Enquiry marked as responded.');
    }

    // Delete Enquiry
    public function delete($id)
    {
        if (!$this->enquiryModel->find($id)) {
            return redirect()->to('/cms/enquiries')->with('swal_error', 'Enquiry not found.');
        }

        $this->enquiryModel->delete($id);

        return redirect()->to('/cms/enquiries')->with('swal_success', 'Enquiry deleted successfully.');
    }
}
