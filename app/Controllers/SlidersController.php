<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SliderModel;
use App\Models\SlideModel;

class SlidersController extends BaseController
{
    protected $sliderModel;
    protected $slideModel;

    public function __construct()
    {
        $this->sliderModel = new SliderModel();
        $this->slideModel = new SlideModel();
    }

    // List all sliders
    public function index()
    {
        $title = 'Sliders';
        $page_title = 'Manage Sliders';
        $menu = 'cms';

        return view('backend/cms/sliders/index', compact('title', 'page_title', 'menu'));
    }

    // Get Data for DataTable
    public function getSlidersData()
    {
        $request = service('request');

        $draw = $request->getPost('draw');
        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $searchValue = $request->getPost('search')['value'];

        $query = $this->sliderModel->select('id, name, status, created_at, updated_at');

        $totalRecords = $query->countAllResults(false);

        if (!empty($searchValue)) {
            $query->groupStart()
                ->like('name', $searchValue)
                ->orLike('status', $searchValue)
                ->groupEnd();
        }

        $totalFiltered = $query->countAllResults(false);

        $sliders = $query->orderBy('created_at', 'DESC')
            ->findAll($length, $start);

        $data = [];
        foreach ($sliders as $slider) {
            $data[] = [
                'id' => $slider['id'],
                'name' => $slider['name'],
                'status' => $slider['status'],
                'created_at' => date('Y-m-d H:i:s', strtotime($slider['created_at'])),
                'updated_at' => date('Y-m-d H:i:s', strtotime($slider['updated_at'])),
            ];
        }

        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
        ];

        return $this->response->setJSON($response);
    }

    // Create slider
    public function create()
    {
        $title = 'Create Slider';
        $page_title = 'Add New Slider';
        $menu = 'cms';

        return view('backend/cms/sliders/create', compact('title', 'page_title', 'menu'));
    }

    // Store slider
    public function store()
    {
        if (!$this->validate(['name' => 'required|string|max_length[255]'])) {
            return redirect()->back()->withInput()->with('swal_error', 'Validation failed. Please check your input.');
        }

        $this->sliderModel->save([
            'name' => $this->request->getPost('name'),
            'status' => $this->request->getPost('status') ?: 'Active',
        ]);

        return redirect()->to('/cms/sliders')->with('swal_success', 'Slider created successfully.');
    }

    // Edit slider
    public function edit($id)
    {
        $slider = $this->sliderModel->find($id);

        if (!$slider) {
            return redirect()->to('/cms/sliders')->with('swal_error', 'Slider not found.');
        }

        $title = 'Edit Slider';
        $page_title = 'Edit Slider: ' . $slider['name'];
        $menu = 'cms';

        return view('backend/cms/sliders/edit', compact('title', 'page_title', 'menu', 'slider'));
    }

    // Update slider
    public function update($id)
    {
        if (!$this->validate(['name' => 'required|string|max_length[255]'])) {
            return redirect()->back()->withInput()->with('swal_error', 'Validation failed. Please check your input.');
        }

        $this->sliderModel->update($id, [
            'name' => $this->request->getPost('name'),
            'status' => $this->request->getPost('status') ?: 'Active',
        ]);

        return redirect()->to('/cms/sliders')->with('swal_success', 'Slider updated successfully.');
    }

    // Delete slider
    public function delete($id)
    {
        $slider = $this->sliderModel->find($id);

        if (!$slider) {
            return redirect()->to('/cms/sliders')->with('swal_error', 'Slider not found.');
        }

        $this->sliderModel->delete($id);

        return redirect()->to('/cms/sliders')->with('swal_success', 'Slider deleted successfully.');
    }

    // List slides for a slider
    public function slides($sliderId)
    {
        $slider = $this->sliderModel->find($sliderId);

        if (!$slider) {
            return redirect()->to('/cms/sliders')->with('swal_error', 'Slider not found.');
        }

        $title = 'Slides';
        $page_title = 'Manage Slides for Slider: ' . $slider['name'];
        $menu = 'cms';

        $slides = $this->slideModel->where('slider_id', $sliderId)
            ->orderBy('position', 'ASC')
            ->findAll();

        return view('backend/cms/sliders/slides', compact('title', 'page_title', 'menu', 'slider', 'slides'));
    }

    // Create slide
    public function createSlide($sliderId)
    {
        $slider = $this->sliderModel->find($sliderId);

        if (!$slider) {
            return redirect()->to('/cms/sliders')->with('swal_error', 'Slider not found.');
        }

        $title = 'Add Slide';
        $page_title = 'Add New Slide to Slider: ' . $slider['name'];
        $menu = 'cms';

        return view('backend/cms/sliders/create_slide', compact('title', 'page_title', 'menu', 'slider'));
    }

    // Store slide
    public function storeSlide($sliderId)
    {
        $slider = $this->sliderModel->find($sliderId);

        if (!$slider) {
            return redirect()->to('/cms/sliders')->with('swal_error', 'Slider not found.');
        }

        if (!$this->validate([
            'title' => 'required|string|max_length[255]',
            'image' => 'uploaded[image]|is_image[image]|max_size[image,2048]',
        ])) {
            return redirect()->back()->withInput()->with('swal_error', 'Validation failed. Please check your input.');
        }

        $image = $this->request->getFile('image');
        $imageName = $image->getRandomName();
        $image->move('uploads/slides', $imageName);

        $this->slideModel->save([
            'slider_id' => $sliderId,
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'image' => $imageName,
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
            'position' => $this->request->getPost('position') ?: 0,
        ]);

        return redirect()->to('/cms/sliders/slides/' . $sliderId)->with('swal_success', 'Slide added successfully.');
    }

    // Delete slide
    public function deleteSlide($id)
    {
        $slide = $this->slideModel->find($id);

        if (!$slide) {
            return redirect()->to('/cms/sliders')->with('swal_error', 'Slide not found.');
        }

        if (file_exists('uploads/slides/' . $slide['image'])) {
            unlink('uploads/slides/' . $slide['image']);
        }

        $this->slideModel->delete($id);

        return redirect()->to('/cms/sliders/slides/' . $slide['slider_id'])->with('swal_success', 'Slide deleted successfully.');
    }

    // Edit slide
    public function editSlide($id)
    {
        $slide = $this->slideModel->find($id);

        if (!$slide) {
            return redirect()->to('/cms/sliders')->with('swal_error', 'Slide not found.');
        }

        $slider = $this->sliderModel->find($slide['slider_id']);

        if (!$slider) {
            return redirect()->to('/cms/sliders')->with('swal_error', 'Slider not found.');
        }

        $title = 'Edit Slide';
        $page_title = 'Edit Slide for Slider: ' . $slider['name'];
        $menu = 'cms';

        return view('backend/cms/sliders/edit_slide', compact('title', 'page_title', 'menu', 'slider', 'slide'));
    }

    // Update slide
    public function updateSlide($id)
    {
        $slide = $this->slideModel->find($id);

        if (!$slide) {
            return redirect()->to('/cms/sliders')->with('swal_error', 'Slide not found.');
        }

        $slider = $this->sliderModel->find($slide['slider_id']);

        if (!$slider) {
            return redirect()->to('/cms/sliders')->with('swal_error', 'Slider not found.');
        }

        if (!$this->validate([
            'title' => 'required|string|max_length[255]',
            'image' => 'is_image[image]|max_size[image,2048]',
        ])) {
            return redirect()->back()->withInput()->with('swal_error', 'Validation failed. Please check your input.');
        }

        // Handle image upload
        $imageName = $slide['image']; // Keep existing image if no new image is uploaded
        if ($this->request->getFile('image')->isValid()) {
            $image = $this->request->getFile('image');
            $imageName = $image->getRandomName();
            $image->move('uploads/slides', $imageName);

            // Delete old image
            if (file_exists('uploads/slides/' . $slide['image'])) {
                unlink('uploads/slides/' . $slide['image']);
            }
        }

        $this->slideModel->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'image' => $imageName,
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
            'position' => $this->request->getPost('position') ?: 0,
        ]);

        return redirect()->to('/cms/sliders/slides/' . $slider['id'])->with('swal_success', 'Slide updated successfully.');
    }
}
