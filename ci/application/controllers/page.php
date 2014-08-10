<?php
class Page extends CI_Controller {

    public function index()
    {

        $this->load->view('templates/header');
        $this->load->view('main');
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }

    public function member()
    {

        $this->load->view('templates/header');
        $this->load->view('member');
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }

    public function course()
    {

        $this->load->view('templates/header');
        $this->load->view('course');
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }

    public function forum()
    {

        $this->load->view('templates/header');
        $this->load->view('forum');
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }

    public function links()
    {

        $this->load->view('templates/header');
        $this->load->view('links');
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }

    public function download()
    {

        $this->load->view('templates/header');
        $this->load->view('download');
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }

    public function how_to_login()
    {

        $this->load->view('templates/header');
        $this->load->view('how_to_login');
        $this->load->view('templates/main_menu');
        $this->load->view('templates/user_login');
        $this->load->view('templates/footer');

    }
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
