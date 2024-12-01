<?php

use App\Models\ProductCategoryModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\SlideModel;
use App\Models\SliderModel;
use App\Models\ThemeModel;

function getActiveTheme()
{
    $themeModel = new ThemeModel();
    $activeTheme = $themeModel->where('is_active', 1)->first();

    return $activeTheme ? 'themes/' . $activeTheme['theme_name'] . '/' : 'themes/default/';
}

//loades slides to the home slider
function homeSlides($sliderId)
{
    $sliderModel = new SliderModel();
    $slideModel = new SlideModel();
    // Fetch slider
    $slider = $sliderModel->find($sliderId);

    // Get the response object
    $response = service('response');
    if (!$slider) {
        return $response->setStatusCode(404, 'Slider not found');
    }

    // Fetch slides for the slider
    $slides = $slideModel
        ->select('title, description, image, button_text, button_link')
        ->where('slider_id', $sliderId)
        ->orderBy('position', 'ASC')
        ->findAll();

    // Return slides object
    return $slides;
}

/**
 * Product Details
 */
function productDetails($id)
{
    $productModel = new ProductModel();
    $productImageModel = new ProductImageModel();
    $productCategoryModel = new ProductCategoryModel();

    // Fetch product details
    $product = $productModel->find($id);

    if (!$product) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Product not found.");
    }

    //Fetch related category of the product
    $category = $productCategoryModel->where('id', $product['category_id'])->first();
    // Fetch related images and specifications
    $images = $productImageModel->where('product_id', $id)->findAll();
    //$images = $productModel->getImages($id);
    $specifications = $productModel->getSpecifications($id);

    $data                   = $product;
    $data['title']          = $product['name'];
    $data['images']         = $images;
    $data['specifications'] = $specifications;
    $data['category'] = $category['name'];
    
    // Pass data to the product details view
    return $data;
}

if (!function_exists('get_product_list')) {
/**
 * Get a list of all products with id, name, price, and featured image
 *
 * @return array
 */
    function get_product_list(): array
    {
        $productModel = new ProductModel();
        $productImageModel = new ProductImageModel();

        // Fetch all products
        $products = $productModel->findAll();

        // Prepare the product list
        $productList = [];
        foreach ($products as $product) {
            $featuredImage = $productImageModel
                ->where('product_id', $product['id'])
                ->where('is_featured', true)
                ->first();

            $productList[] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'featured_image' => $featuredImage ? $featuredImage['image_path'] : null,
            ];
        }

        return $productList;
    }
}