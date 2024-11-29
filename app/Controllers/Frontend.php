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

class Frontend extends BaseController
{
    protected $theme;
    protected $themePath;

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
            'slug'=> $slug
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
        ]);
    }

    
}
