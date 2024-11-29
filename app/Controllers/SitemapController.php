<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel;
use App\Models\PagesModel;

class SitemapController extends Controller
{
    public function index()
    {
        // Initialize cache service
        $cache = \Config\Services::cache();

        // Check if sitemap is cached
        if ($cachedSitemap = $cache->get('sitemap')) {
            return $this->response
                        ->setContentType('application/xml')
                        ->setBody($cachedSitemap);
        }

        // Clear output buffer to avoid unexpected output
        ob_clean();

        // Initialize models
        $productModel = new ProductModel();
        $pageModel = new PagesModel();

        // Fetch data
        $products = $productModel->findAll();
        $pages = $pageModel->findAll();

        // Start XML generation
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Add pages to sitemap
        foreach ($pages as $page) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . base_url($page['slug']) . '</loc>';
            $sitemap .= '<lastmod>' . date('Y-m-d', strtotime($page['updated_at'])) . '</lastmod>';
            $sitemap .= '<changefreq>monthly</changefreq>';
            $sitemap .= '<priority>0.8</priority>';
            $sitemap .= '</url>';
        }

        // Add products to sitemap
        foreach ($products as $product) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . base_url('product/' . $product['slug']) . '</loc>';
            $sitemap .= '<lastmod>' . date('Y-m-d', strtotime($product['updated_at'])) . '</lastmod>';
            $sitemap .= '<changefreq>weekly</changefreq>';
            $sitemap .= '<priority>0.7</priority>';
            $sitemap .= '</url>';
        }

        $sitemap .= '</urlset>';

        // Cache the sitemap for 24 hours
        $cache->save('sitemap', $sitemap, 86400);

        // Return the sitemap response
        return $this->response
                    ->setContentType('application/xml')
                    ->setBody($sitemap);
    }
}
