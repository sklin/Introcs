<?php
class Page extends CI_Controller {

    public function index()
    {

        $this->load->view('templates/header');
        $this->load->view('main');
        $this->load->view('templates/main_menu');
        $this->load->view('templates/footer');

    }
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
