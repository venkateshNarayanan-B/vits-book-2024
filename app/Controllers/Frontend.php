<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WidgetPlacementModel;
use App\Models\ThemeModel;
use App\Models\ProductCategoryModel;
use App\Models\ProductModel;
use App\Models\ProductImageModel;
use App\Models\PagesModel;
use App\Models\MenuModel;
use App\Models\SlideModel;
use App\Models\SliderModel;

class Frontend extends BaseController
{
    protected $theme;
    protected $themePath;
    protected $menuModel;
    protected $topNav;
    protected $slideModel;
    protected $sliderModel;

    public function __construct()
    {
        // Load the active theme
        $themeModel = new ThemeModel();
        $this->theme = $themeModel->where('is_active', 1)->first();

        if (!$this->theme) {
            throw new \Exception('No active theme found. Please activate a theme in the admin panel.');
        }

        // Set the theme path
        $this->themePath = "theme/{$this->theme['directory']}";

        //initiating menu
        $this->menuModel = new MenuModel();
        $this->topNav = $this->menuModel->getHierarchicalMenu('header');
        //$footerMenu = $this->menuModel->getHierarchicalMenu('footer');
        //$sidebarMenu = $this->menuModel->getHierarchicalMenu('sidebar');

        $this->slideModel = new SlideModel();
        $this->sliderModel = new SliderModel();
    }

    /**
     * Homepage
     */
    public function index($slug = null)
    {
        if (is_null($slug)) {
            $slug = 'home'; // Default to homepage slug
        }
        // Example: Fetch dynamic homepage widgets (adjust as needed)
        $widgetModel = new WidgetPlacementModel();
        $widgets = $widgetModel->where('id', $this->theme['id'])->findAll();
        
        $pagesModel = new PagesModel();
        $page = $pagesModel->where('slug', $slug)->first();
        //var_dump($page);
        if (!$page) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Page not found: $slug");
        }

        // Pass widgets to the homepage view
        return view("{$this->themePath}/index", [
            'title' => $page['title'],
            'widgets' => $widgets,
            'content' => $page['content'],
            'topNav'=> $this->topNav
        ]);
    }

    /**
     * Products Listing
     */
    public function products()
    {
        $productModel = new ProductModel();
        $categoryModel = new ProductCategoryModel();

        // Fetch all products and categories
       
        $categories = $categoryModel->findAll();
        $products = $productModel->select('products.*, product_images.image_path AS featured_image')
                         ->join('product_images', 'product_images.product_id = products.id AND product_images.is_featured = 1', 'left')
                         ->findAll();
        // Pass data to the products view
        return view("{$this->themePath}/products", [
            'title' => 'Our Products',
            'products' => $products,
            'categories' => $categories,
            'topNav'=> $this->topNav
        ]);
    }

    /**
     * Product Details
     */
    public function productDetails($id)
    {
        $productModel = new ProductModel();
        $productImageModel = new ProductImageModel();

        // Fetch product details
        $product = $productModel->find($id);

        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Product not found.");
        }

        // Fetch related images and specifications
        $images = $productImageModel->where('product_id', $id)->findAll();
        //$images = $productModel->getImages($id);
        $specifications = $productModel->getSpecifications($id);

        // Pass data to the product details view
        return view("{$this->themePath}/product_details", [
            'title' => $product['name'],
            'product' => $product,
            'images' => $images,
            'specifications' => $specifications,
            'topNav'=> $this->topNav
        ]);
    }

    public function submitEnquiry()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'product_id' => 'required|integer',
            'name' => 'required|max_length[255]',
            'email' => 'required|valid_email|max_length[255]',
            'phone' => 'permit_empty|max_length[15]',
            'message' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('swal_error', $validation->getErrors());
        }

        $enquiryModel = new \App\Models\ProductEnquiryModel();
        $enquiryModel->insert([
            'product_id' => $this->request->getPost('product_id'),
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'message' => $this->request->getPost('message'),
        ]);

        return redirect()->back()->with('swal_success', 'Your enquiry has been submitted successfully.');
    }

    public function test()
    {   
        $sliderId = 2; // Assuming slider ID 1 is for the homepage slider
        $slides = $this->getSlidesForFrontend($sliderId);
        $data = [
            'topNav' => $this->topNav,
            'slides' => $slides
        ];
        //var_dump($slides);
        return view('theme/farmix/home', $data);
    }

    public function getSlidesForFrontend($sliderId)
    {
        // Fetch slider
        $slider = $this->sliderModel->find($sliderId);

        if (!$slider) {
            return $this->response->setStatusCode(404, 'Slider not found');
        }

        // Fetch slides for the slider
        $slides = $this->slideModel
            ->select('title, description, image, button_text, button_link')
            ->where('slider_id', $sliderId)
            ->orderBy('position', 'ASC')
            ->findAll();

        // Return JSON response for API usage
        return $slides;
    }
    
}
