<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BaseController {
    protected $base_url;
    protected $helpers = [];
    protected static $loadedHelpers = [];

    public function __construct() {
        require_once 'config/config.php';
        // parent::__construct();  
        $this->loadAutoload();
        $this->base_url = $this->getBaseUrl();

        $url = $this->parseUrl();
        if ($url) {
            if (file_exists(APPPATH.'/controllers/' . ucfirst($url[0]) . '.php')) {
                $this->controller = ucfirst($url[0]);
                unset($url[0]);
            }
        }

    }

    public function view($view, $data = []) {

        if (is_array($data)) {
            extract($data);
        }
        require_once APPPATH.'/views/' . $view . '.php';
    }

    public function getBaseUrl() {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        return $protocol . '://' . $host . $uri . '/';
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    public function loadAutoload() {
        require_once 'config/autoload.php';

        if (isset($autoload['helpers']) && is_array($autoload['helpers'])) {
            foreach ($autoload['helpers'] as $helper) {
                $helperFile = APPPATH.'/helpers/' . $helper . '_helper.php';
                $coreHelperFile = BASEPATH.'/helpers/' . $helper . '_helper.php';
                if(file_exists($helperFile)){
                    require_once $helperFile;
                }
                if (file_exists($coreHelperFile)){
                    require_once $coreHelperFile;
                }
            }
        }

        //Auto load Libraries and Models
        if (isset($autoload['libraries']) && is_array($autoload['libraries'])) {
            foreach ($autoload['libraries'] as $library) {
                $libraryFile = BASEPATH.'/libraries/' . $library . '.php';
                if (file_exists($libraryFile)) {
                    require_once $libraryFile;
                    $this->$library = new $library(); // Membuat instance library dan menyimpannya di properti $this
                }
            }
        }

        if (isset($autoload['models']) && is_array($autoload['models'])) {
            foreach ($autoload['models'] as $model) {
                $modelFile = APPPATH.'/models/' . $model . '.php';
                if (file_exists($modelFile)) {
                    require_once $modelFile;
                    $this->$model = new $model();
                }
            }
        }



    }


}