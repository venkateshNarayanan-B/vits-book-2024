<?php
header('Content-Type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
echo '<url><loc>https://example.com</loc><lastmod>2024-01-01</lastmod><changefreq>daily</changefreq><priority>1.0</priority></url>';
echo '</urlset>';