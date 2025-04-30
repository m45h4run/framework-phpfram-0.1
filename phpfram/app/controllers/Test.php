<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends BaseController {
    public function __construct() {
        parent::__construct();
        $this->modelTest = new ModelTest();
        start_session();
    }

    public function index() {
        $data['title'] = 'Ini Test';

        $id = input_get('id');

        $data['users_update'] = $this->modelTest->getById($id);

        $data['users'] = $this->modelTest->getAll();

        $this->view('test', $data);
    }

    public function create() {
        $data = [
            'nama' => input_post('nama'),
            'email' => input_post('email'),
        ];

        $userId = $this->modelTest->create($data);
        if ($userId) {
            set_flashdata('alert', '<p style="color: green;">User telah di tambahkan.</p>');
        }else{
            set_flashdata('alert', '<p style="color: red;">User gagal di tambahkan.</p>');
        }
        redirect('test');
    }

    public function update() {
        $data = [
            'id' => input_post('id'),
            'nama' => input_post('nama'),
            'email' => input_post('email'),
        ];
        $user = $this->modelTest->update('id',$data);

        if ($user) {
            set_flashdata('alert', '<p style="color: green;">User telah di ubah.</p>');
        }else{
            set_flashdata('alert', '<p style="color: red;">User gagal di ubah.</p>');
        }
        redirect('test');
    }

    public function delete() {

        $id = input_get('id');
        $userId = $this->modelTest->delete('id',$id);

        redirect('test');
    }




}