<?php

class Home extends BaseController {
    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $data['title'] = 'Projek awal';
        $this->view('dashboard', $data);
    }
}