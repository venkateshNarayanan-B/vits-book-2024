<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\ThemeModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    // For CMS Themes
    protected $activeTheme;
    protected $themePath;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['form','cookie','permission','theme','widget'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        $this->loadActiveTheme(); // Load the active theme on every request
    }

    protected function loadActiveTheme()
    {
        $themeModel = new ThemeModel();
        $this->activeTheme = $themeModel->where('is_active', 1)->first();

        if ($this->activeTheme) {
            $this->themePath = 'theme/' . $this->activeTheme['directory'] . '/';
        } else {
            // Fallback to default theme
            $this->themePath = 'themes/default/';
        }

        // Use the view service to set variables globally
        \Config\Services::renderer()->setVar('themePath', $this->themePath);
    }
}
