<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Backend::login');
$routes->get('/admin', 'Backend::index', ['filter' => 'auth']);
$routes->get('/dashboard', 'Backend::index', ['filter' => 'auth']);
$routes->get('/chart', 'Backend::chart');




//check sessions
$routes->get('/sessions', 'Backend::debugSession');
//Auth, login and logout routes
$routes->get('/login', 'Backend::login');
$routes->post('/auth/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/forget-password', 'AuthController::forgetPassword');
$routes->post('/forget-password', 'AuthController::forgetPassword');
$routes->get('reset-password/(:any)', 'AuthController::resetPassword/$1');
$routes->post('reset-password/(:any)', 'AuthController::resetPassword/$1');
$routes->get('/unauthorized', 'Backend::unauthorized');

$routes->get('/alert', 'Backend::alert');
$routes->get('/form', 'Backend::form');
$routes->get('/table', 'Datatable::index');
$routes->get('/table-with-features', 'Datatable::tableWithFeatures');
$routes->post('/datatable-data', 'Datatable::getData');

//roles routes
$routes->group('roles', ['filter' => 'auth'], function($routes){
    $routes->get('', 'RoleController::index');
    $routes->post('', 'RoleController::getData');
    $routes->get('create', 'RoleController::create');
    $routes->post('create', 'RoleController::create');
    $routes->get('edit/(:num)', 'RoleController::edit/$1');
    $routes->post('edit/(:num)', 'RoleController::edit/$1');
    $routes->post('delete/(:num)', 'RoleController::delete/$1');
});


//user routes
$routes->group('user', ['filter' => 'auth'], function ($routes){
    $routes->get('', 'UserController::index', ['filter' => 'permission:user list']);
    $routes->post('', 'UserController::getData', ['filter' => 'permission:user list']);
    $routes->get('create', 'UserController::create', ['filter' => 'permission:user create']);
    $routes->post('create', 'UserController::create', ['filter' => 'permission:user create']);
    $routes->get('edit/(:num)', 'UserController::edit/$1', ['filter' => 'permission:user update']);
    $routes->post('edit/(:num)', 'UserController::edit/$1', ['filter' => 'permission:user update']);
    $routes->post('delete/(:num)', 'UserController::delete/$1', ['filter' => 'permission:user delete']);
});

//permission routes
$routes->group('permissions', ['filter' => 'auth'], function($routes) {
    $routes->get('', 'PermissionController::index');
    $routes->post('', 'PermissionController::getData');
    $routes->get('create', 'PermissionController::create');
    $routes->post('create', 'PermissionController::create');
    $routes->get('edit/(:num)', 'PermissionController::edit/$1');
    $routes->post('edit/(:num)', 'PermissionController::edit/$1');
    $routes->post('delete/(:num)', 'PermissionController::delete/$1');
    $routes->get('assign/(:num)', 'RoleController::assignPermissions/$1');
    $routes->post('assign/(:num)', 'RoleController::assignPermissions/$1');
});

// Account routes with group filtering
$routes->group('accounts', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'AccountController::index');
    $routes->post('getData', 'AccountController::getData');
    $routes->get('create-group', 'AccountController::createGroup');
    $routes->post('create-group', 'AccountController::createGroup');
    $routes->get('edit-group/(:num)', 'AccountController::editGroup/$1');
    $routes->post('edit-group/(:num)', 'AccountController::editGroup/$1');
    $routes->post('delete-group/(:num)', 'AccountController::deleteGroup/$1');

    $routes->get('create-ledger', 'AccountController::createLedger');
    $routes->post('create-ledger', 'AccountController::createLedger');
    $routes->get('edit-ledger/(:num)', 'AccountController::editLedger/$1');
    $routes->post('edit-ledger/(:num)', 'AccountController::editLedger/$1');
    $routes->post('delete-ledger/(:num)', 'AccountController::deleteLedger/$1');
    $routes->get('groups', 'AccountController::index'); // For account groups
    $routes->get('ledgers', 'AccountController::ledgers');
});

$routes->group('vouchers', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'VoucherController::index');                      // List all vouchers
    $routes->get('create', 'VoucherController::create');                // Show form to create a new voucher
    $routes->post('store', 'VoucherController::store');                 // Save a new voucher
    $routes->get('edit/(:num)', 'VoucherController::edit/$1');          // Show form to edit an existing voucher
    $routes->post('update/(:num)', 'VoucherController::update/$1');     // Update an existing voucher
    $routes->get('delete/(:num)', 'VoucherController::delete/$1');     // Delete an existing voucher

    $routes->get('entry/(:num)', 'VoucherController::entries_list/$1');     // entries an existing voucher
    $routes->get('add-entry/(:num)', 'VoucherController::add_entry/$1');     // Show form to create a new entries to an existing voucher
    $routes->post('add-entry/(:num)', 'VoucherController::add_entry/$1');    // Save a new entry to an existing voucher
    $routes->get('edit-entry/(:num)', 'VoucherController::edit_entry/$1');     // Show form to edit an existing entries to an existing voucher
    $routes->post('edit-entry/(:num)', 'VoucherController::edit_entry/$1');    // updates a exixting entry to an existing voucher
    $routes->get('delete-entry/(:num)', 'VoucherController::delete_entry/$1');
});

$routes->group('payment-vouchers', function ($routes) {
    $routes->get('/', 'PaymentVoucherController::index'); // DataTables and list page
    $routes->get('create', 'PaymentVoucherController::create'); // Create form
    $routes->post('store', 'PaymentVoucherController::store'); // Store new voucher
    $routes->get('edit/(:num)', 'PaymentVoucherController::edit/$1'); // Edit form
    $routes->post('update/(:num)', 'PaymentVoucherController::update/$1'); // Update voucher
    $routes->get('delete/(:num)', 'PaymentVoucherController::delete/$1'); // Delete voucher
});

// Routes for Receipt Vouchers
$routes->group('receipt-vouchers', function ($routes) {
    $routes->get('/', 'ReceiptVoucherController::index'); // List all receipt vouchers (DataTable)
    $routes->get('create', 'ReceiptVoucherController::create'); // Show create form
    $routes->post('store', 'ReceiptVoucherController::store'); // Handle create form submission
    $routes->get('edit/(:num)', 'ReceiptVoucherController::edit/$1'); // Show edit form (ID-based)
    $routes->post('update/(:num)', 'ReceiptVoucherController::update/$1'); // Handle edit form submission (ID-based)
    $routes->get('delete/(:num)', 'ReceiptVoucherController::delete/$1'); // Handle deletion (ID-based)
});

// Journal Voucher Routes
$routes->group('journal-vouchers', function ($routes) {
    $routes->get('/', 'JournalVoucherController::index'); // List all journal vouchers
    $routes->get('create', 'JournalVoucherController::create'); // Show create form
    $routes->post('store', 'JournalVoucherController::store'); // Store new journal voucher
    $routes->get('edit/(:num)', 'JournalVoucherController::edit/$1'); // Edit journal voucher
    $routes->post('update/(:num)', 'JournalVoucherController::update/$1'); // Update journal voucher
    $routes->get('delete/(:num)', 'JournalVoucherController::delete/$1'); // Delete journal voucher
});

$routes->group('contra-vouchers', function ($routes) {
    $routes->get('/', 'ContraVoucherController::index'); // List all Contra Vouchers
    $routes->get('create', 'ContraVoucherController::create'); // Show create form
    $routes->post('store', 'ContraVoucherController::store'); // Store a new Contra Voucher
    $routes->get('edit/(:num)', 'ContraVoucherController::edit/$1'); // Show edit form for a specific Contra Voucher
    $routes->post('update/(:num)', 'ContraVoucherController::update/$1'); // Update a specific Contra Voucher
    $routes->get('delete/(:num)', 'ContraVoucherController::delete/$1'); // Delete a specific Contra Voucher
});




$routes->group('categories', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'CategoryController::index');
    $routes->get('fetch', 'CategoryController::fetchCategories');
    $routes->get('create', 'CategoryController::create');
    $routes->post('store', 'CategoryController::store');
    $routes->get('edit/(:num)', 'CategoryController::edit/$1');
    $routes->post('update/(:num)', 'CategoryController::update/$1');
    $routes->get('delete/(:num)', 'CategoryController::delete/$1');
});

$routes->group('inventory', ['filter' => 'auth'], function($routes) {
    // Inventory Items Routes
    $routes->get('items', 'ItemController::index');
    $routes->get('items/fetch', 'ItemController::fetchItems');
    $routes->get('item/create', 'ItemController::create');
    $routes->post('item/store', 'ItemController::store');
    $routes->get('item/edit/(:num)', 'ItemController::edit/$1');
    $routes->post('item/update/(:num)', 'ItemController::update/$1');
    $routes->get('item/delete/(:num)', 'ItemController::delete/$1');
});

$routes->group('inventory', ['filter' => 'auth'], function ($routes) {
    // Inventory Transactions
    $routes->get('transactions', 'InventoryTransactionController::index'); // View list of transactions
    $routes->get('transactions/fetch', 'InventoryTransactionController::fetchTransactions'); // DataTable fetch

    $routes->get('transactions/create', 'InventoryTransactionController::create'); // Form to add a new transaction
    $routes->post('transactions/store', 'InventoryTransactionController::store'); // Store new transaction

    $routes->get('transactions/edit/(:num)', 'InventoryTransactionController::edit/$1'); // Edit an existing transaction
    $routes->post('transactions/update/(:num)', 'InventoryTransactionController::update/$1'); // Update an existing transaction

    $routes->get('transactions/delete/(:num)', 'InventoryTransactionController::delete/$1'); // Delete a transaction
});

$routes->group('services', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'ServiceController::index');
    $routes->get('get-data', 'ServiceController::getServicesData'); // For DataTables AJAX
    $routes->get('create', 'ServiceController::create');
    $routes->post('store', 'ServiceController::store');
    $routes->get('edit/(:num)', 'ServiceController::edit/$1');
    $routes->post('update/(:num)', 'ServiceController::update/$1');
    $routes->get('delete/(:num)', 'ServiceController::delete/$1');
});

//CMS route section
$routes->group('cms', ['filter' => 'auth'], function ($routes) {
    $routes->get('pages', 'PagesController::index'); // List pages
    $routes->get('pages/create', 'PagesController::create'); // Form to add a new page
    $routes->post('pages/store', 'PagesController::store'); // Save a new page
    $routes->get('pages/edit/(:num)', 'PagesController::edit/$1'); // Form to edit a page
    $routes->post('pages/update/(:num)', 'PagesController::update/$1'); // Update a page
    $routes->get('pages/delete/(:num)', 'PagesController::delete/$1'); // Delete a page

    $routes->post('pages/datatable-data', 'PagesController::getPagesData');
    //$routes->get('pages/datatable-data', 'PagesController::getPagesData');
});
//CMS menus route section
$routes->group('cms/menus', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'MenusController::index'); // List all menus
    $routes->post('get-data', 'MenusController::getMenusData'); // Data for DataTables
    $routes->get('create', 'MenusController::create'); // Form to create a new menu
    $routes->post('store', 'MenusController::store'); // Store a new menu
    $routes->get('edit/(:num)', 'MenusController::edit/$1'); // Form to edit a menu
    $routes->post('update/(:num)', 'MenusController::update/$1'); // Update a menu
    $routes->get('delete/(:num)', 'MenusController::delete/$1'); // Delete a menu
});


//CMS settings route section
$routes->group('cms/settings', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'SettingsController::index'); // View settings form
    $routes->post('save', 'SettingsController::save'); // Save settings
});

//CMS products route section
$routes->group('cms/products', ['filter' => 'auth'], function ($routes) {
    // Products
    $routes->get('/', 'ProductController::index');
    $routes->get('create', 'ProductController::create');
    $routes->post('store', 'ProductController::store');
    $routes->get('edit/(:num)', 'ProductController::edit/$1');
    $routes->post('update/(:num)', 'ProductController::update/$1');
    $routes->get('delete/(:num)', 'ProductController::delete/$1');

    $routes->post('datatable-data', 'ProductController::getData');
    $routes->post('set-featured-image/(:num)/(:num)', 'ProductController::setFeaturedImage/$1/$2');
    $routes->post('delete-image/(:num)', 'ProductController::deleteImage/$1');

});

$routes->group('cms/products/categories', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'ProductCategoryController::index');
    $routes->get('create', 'ProductCategoryController::create');
    $routes->post('store', 'ProductCategoryController::store');
    $routes->get('edit/(:num)', 'ProductCategoryController::edit/$1');
    $routes->post('update/(:num)', 'ProductCategoryController::update/$1');
    $routes->get('delete/(:num)', 'ProductCategoryController::delete/$1');
    $routes->post('getData', 'ProductCategoryController::getData');

});

// CMS FAQ route section
$routes->group('cms/faq', ['filter' => 'auth'], function ($routes) {
    // FAQs
    $routes->get('/', 'FaqController::index'); // List all FAQs
    $routes->get('create', 'FaqController::create'); // Show form to create a new FAQ
    $routes->post('store', 'FaqController::store'); // Store a new FAQ
    $routes->get('edit/(:num)', 'FaqController::edit/$1'); // Edit an existing FAQ
    $routes->post('update/(:num)', 'FaqController::update/$1'); // Update an existing FAQ
    $routes->post('delete/(:num)', 'FaqController::delete/$1'); // Delete an FAQ

    $routes->post('datatable-data', 'FaqController::getData'); // Fetch data for DataTable
});

// Testimonials Routes
$routes->group('cms/testimonials', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'TestimonialController::index'); // List all testimonials
    $routes->post('getData', 'TestimonialController::getData'); // DataTable AJAX endpoint
    $routes->get('create', 'TestimonialController::create'); // Show the create form
    $routes->post('store', 'TestimonialController::store'); // Handle form submission for creation
    $routes->get('edit/(:num)', 'TestimonialController::edit/$1'); // Show the edit form
    $routes->post('update/(:num)', 'TestimonialController::update/$1'); // Handle form submission for update
    $routes->get('delete/(:num)', 'TestimonialController::delete/$1'); // Delete a testimonial
    $routes->get('test', 'TestimonialController::test'); // Delete a testimonial
});


//CMS content_block section
$routes->group('cms/content-blocks', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'ContentBlocksController::index'); // List all content blocks
    $routes->post('get-data', 'ContentBlocksController::getData'); // Data for DataTables
    $routes->get('create', 'ContentBlocksController::create'); // Form to create a new content block
    $routes->post('store', 'ContentBlocksController::store'); // Store a new content block
    $routes->get('edit/(:num)', 'ContentBlocksController::edit/$1'); // Form to edit a content block
    $routes->post('update/(:num)', 'ContentBlocksController::update/$1'); // Update a content block
    $routes->get('delete/(:num)', 'ContentBlocksController::delete/$1'); // Delete a content block
});

//CMS media routes
$routes->group('cms/media-manager', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'MediaManagerController::index'); // List all media files
    $routes->post('get-files', 'MediaManagerController::getMediaFiles'); // DataTable for media files
    $routes->post('upload', 'MediaManagerController::upload'); // File upload
    $routes->get('delete/(:num)', 'MediaManagerController::delete/$1'); // Delete a media file
    $routes->get('test', 'MediaManagerController::testInsert'); // test a media file
});

//CMS theme routes
$routes->group('cms/themes', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'ThemeController::index'); // List all themes
    $routes->post('fetch', 'ThemeController::fetchThemes'); // Fetch themes for DataTable
    $routes->get('create', 'ThemeController::create'); // Add theme form
    $routes->post('store', 'ThemeController::store'); // Save theme
    $routes->get('edit/(:num)', 'ThemeController::edit/$1'); // Edit theme (future implementation)
    $routes->post('update/(:num)', 'ThemeController::update/$1'); // Update theme (future implementation)
    $routes->get('delete/(:num)', 'ThemeController::delete/$1'); // Delete theme
    $routes->get('activate/(:num)', 'ThemeController::activate/$1'); // activate theme
});

//CMS layout routes
$routes->group('cms/layouts', ['filter' => 'auth'], function ($routes) {
    $routes->get('(:num)', 'LayoutController::index/$1'); // List layouts for a theme
    $routes->post('fetch/(:num)', 'LayoutController::fetchLayouts/$1'); // Fetch layouts for DataTable
    $routes->get('create/(:num)', 'LayoutController::create/$1'); // Add layout form
    $routes->post('store/(:num)', 'LayoutController::store/$1'); // Save layout
    $routes->get('edit/(:num)/(:num)', 'LayoutController::edit/$1/$2'); // Edit layout
    $routes->post('update/(:num)/(:num)', 'LayoutController::update/$1/$2'); // Update layout
    $routes->get('delete/(:num)/(:num)', 'LayoutController::delete/$1/$2'); // Delete layout
});

//CMS widget routes
$routes->group('cms/widgets', ['filter' => 'auth'], function ($routes) {
    $routes->get('(:num)', 'WidgetPlacementController::index/$1');
    $routes->post('fetch/(:num)', 'WidgetPlacementController::fetch/$1');
    $routes->get('create/(:num)', 'WidgetPlacementController::create/$1');
    $routes->post('store/(:num)', 'WidgetPlacementController::store/$1');
    $routes->get('edit/(:num)/(:num)', 'WidgetPlacementController::edit/$1/$2');
    $routes->post('update/(:num)/(:num)', 'WidgetPlacementController::update/$1/$2');
    $routes->get('delete/(:num)/(:num)', 'WidgetPlacementController::delete/$1/$2');
});

//CMS slider routes
$routes->group('cms/sliders', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'SlidersController::index'); // List all sliders
    $routes->post('getSlidersData', 'SlidersController::getSlidersData'); // Fetch slider data for DataTable
    $routes->get('create', 'SlidersController::create'); // Show the create slider form
    $routes->post('store', 'SlidersController::store'); // Store a new slider
    $routes->get('edit/(:num)', 'SlidersController::edit/$1'); // Show the edit form for a slider
    $routes->post('update/(:num)', 'SlidersController::update/$1'); // Update a slider
    $routes->get('delete/(:num)', 'SlidersController::delete/$1'); // Delete a slider

    // Slide Management
    $routes->get('slides/(:num)', 'SlidersController::slides/$1'); // List slides for a slider
    $routes->get('slides/create/(:num)', 'SlidersController::createSlide/$1'); // Create slide form
    $routes->post('slides/store/(:num)', 'SlidersController::storeSlide/$1'); // Store slide
    $routes->get('slides/edit/(:num)', 'SlidersController::editSlide/$1'); // Edit slide form
    $routes->post('slides/update/(:num)', 'SlidersController::updateSlide/$1'); // Update slide
    $routes->get('slides/delete/(:num)', 'SlidersController::deleteSlide/$1'); // Delete slide
});

$routes->group('cms',  function ($routes) {
    // Enquiries Management
    $routes->get('enquiries', 'EnquiryController::index'); // List all enquiries
    $routes->post('enquiries/get-data', 'EnquiryController::getEnquiriesData'); // DataTable AJAX data
    $routes->get('enquiries/view/(:num)', 'EnquiryController::view/$1'); // View specific enquiry
    $routes->post('enquiries/respond/(:num)', 'EnquiryController::respond/$1'); // Mark as responded
    $routes->post('enquiries/delete/(:num)', 'EnquiryController::delete/$1'); // Delete enquiry
});


//website sitemap routes
$routes->get('sitemap.xml', 'SitemapController::index');

//Routes for frontend website
$routes->group('/', function ($routes) {
    
    $routes->get('test', 'Frontend::test'); // Product listing page
    // Products
    $routes->get('products', 'Frontend::products'); // Product listing page
    $routes->get('products/category/(:any)', 'Frontend::category/$1'); // Products filtered by category
    $routes->get('products/(:any)', 'Frontend::productDetails/$1'); // Product details
    $routes->post('submit-enquiry', 'Frontend::submitEnquiry');

    // Homepage
    $routes->get('', 'Frontend::index'); // Default homepage
    $routes->get('(:any)', 'Frontend::index/$1'); // CMS dynamic pages by slug
    // Dynamic Pages
    //$routes->get('page/(:any)', 'Frontend::page/$1'); // CMS dynamic pages by slug
});
















