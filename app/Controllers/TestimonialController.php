<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TestimonialModel;

class TestimonialController extends BaseController
{
    protected $testimonialModel;
    protected $uploadPath = 'uploads/testimonials/';
    protected $defaultImage = 'default-client.png'; // Default image file name

    public function __construct()
    {
        $this->testimonialModel = new TestimonialModel();
    }

    public function index()
    {
        $title = 'Testimonials';
        $page_title = 'Testimonials';
        $menu = 'cms';

        return view('backend/cms/testimonials/index', compact('title', 'page_title', 'menu'));
    }

    public function getData()
    {
        $request = service('request');
        $draw = $request->getPost('draw');
        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $searchValue = $request->getPost('search')['value'];

        $query = $this->testimonialModel;
        if (!empty($searchValue)) {
            $query = $query->like('client_name', $searchValue)
                           ->orLike('testimonial_text', $searchValue);
        }

        $totalFiltered = $query->countAllResults(false);
        $totalData = $query->countAllResults();
        $data = $query->orderBy('id', 'DESC')->findAll($length, $start);

        $result = [];
        foreach ($data as $row) {
            $imagePath = base_url($this->uploadPath . ($row['client_image'] ?? $this->defaultImage));
            $result[] = [
                $row['client_name'],
                $row['testimonial_text'],
                '<img src="' . $imagePath . '" alt="Client Image" style="width:50px;height:50px;">',
                '<a href="' . base_url('cms/testimonials/edit/' . $row['id']) . '" class="btn btn-primary btn-sm">Edit</a>
                 <a href="' . base_url('cms/testimonials/delete/' . $row['id']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</a>',
            ];
        }

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            'data' => $result,
        ];

        return $this->response->setJSON($response);
    }

    public function create()
    {
        $title = 'Add Testimonial';
        $page_title = 'Add New Testimonial';
        $menu = 'cms';

        return view('backend/cms/testimonials/create', compact('title', 'page_title', 'menu'));
    }

    public function store()
    {
        $validation = $this->validate([
            'client_name' => 'required|min_length[3]|max_length[255]',
            'testimonial_text' => 'required|min_length[10]',
            'client_image' => 'is_image[client_image]|mime_in[client_image,image/jpg,image/jpeg,image/png]|max_size[client_image,2048]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('swal_error', $this->validator->listErrors());
        }

        $fileName = $this->handleImageUpload($this->request->getFile('client_image'));

        $this->testimonialModel->save([
            'client_name' => $this->request->getPost('client_name'),
            'testimonial_text' => $this->request->getPost('testimonial_text'),
            'client_image' => $fileName,
        ]);

        return redirect()->to('/cms/testimonials')->with('swal_success', 'Testimonial added successfully.');
    }

    public function edit($id)
    {
        $testimonial = $this->testimonialModel->find($id);

        if (!$testimonial) {
            return redirect()->to('/cms/testimonials')->with('swal_error', 'Testimonial not found.');
        }

        $title = 'Edit Testimonial';
        $page_title = 'Edit Testimonial';
        $menu = 'cms';

        return view('backend/cms/testimonials/edit', compact('title', 'page_title', 'menu', 'testimonial'));
    }

    public function update($id)
    {
        $testimonial = $this->testimonialModel->find($id);

        if (!$testimonial) {
            return redirect()->to('/cms/testimonials')->with('swal_error', 'Testimonial not found.');
        }

        $validation = $this->validate([
            'client_name' => 'required|min_length[3]|max_length[255]',
            'testimonial_text' => 'required|min_length[10]',
            'client_image' => 'is_image[client_image]|mime_in[client_image,image/jpg,image/jpeg,image/png]|max_size[client_image,2048]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('swal_error', $this->validator->listErrors());
        }

        $fileName = $testimonial['client_image'];
        if ($this->request->getFile('client_image')->isValid()) {
            $fileName = $this->handleImageUpload($this->request->getFile('client_image'));
        }

        $this->testimonialModel->update($id, [
            'client_name' => $this->request->getPost('client_name'),
            'testimonial_text' => $this->request->getPost('testimonial_text'),
            'client_image' => $fileName,
        ]);

        return redirect()->to('/cms/testimonials')->with('swal_success', 'Testimonial updated successfully.');
    }

    public function delete($id)
    {
        $testimonial = $this->testimonialModel->find($id);

        if (!$testimonial) {
            return redirect()->to('/cms/testimonials')->with('swal_error', 'Testimonial not found.');
        }

        // Only delete the file if it's not the default image
        if (!empty($testimonial['client_image']) && $testimonial['client_image'] !== $this->defaultImage) {
            $filePath = $this->uploadPath . $testimonial['client_image'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Delete the testimonial record from the database
        $this->testimonialModel->delete($id);

        return redirect()->to('/cms/testimonials')->with('swal_success', 'Testimonial deleted successfully.');
    }


    private function handleImageUpload($file)
    {
        $fileName = $this->defaultImage; // Default image

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileMimeType = $file->getMimeType();
            $filePath = $this->uploadPath;
            $randomName = $file->getRandomName();

            // Create directory if it doesn't exist
            if (!is_dir($filePath)) {
                mkdir($filePath, 0777, true);
            }

            // Move the file to the desired location
            if ($file->move($filePath, $randomName)) {
                $fileName = $randomName; // Update with the actual uploaded file name
            }
        }

        return $fileName;
    }
}
