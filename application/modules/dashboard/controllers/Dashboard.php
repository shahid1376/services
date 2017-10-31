<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    /**
    * Index Page for this controller.
    *
    * Maps to the following URL
    *         http://example.com/index.php/welcome
    *    - or -
    *         http://example.com/index.php/welcome/index
    *    - or -
    * Since this controller is set as the default controller in
    * config/routes.php, it's displayed at http://example.com/
    *
    * So any other public methods not prefixed with an underscore will
    * map to /index.php/welcome/<method_name>
    * @see http://codeigniter.com/user_guide/general/urls.html
    */
    function __construct()
    {
        ////DebugBreak();
        
        parent::__construct();
        $this->load->helper('url');
      
        $this->load->library('session');
      
    }
    public function index()
    {
        $this->load->helper('url');
       
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
       //DebugBreak();
        $this->load->model('Dashboard_model');
        $data['info'] = $this->Dashboard_model->getActiveApplication();
        
        $this->load->view('common/header.php',$data);
        $this->load->view('main/dashboard.php',$data);
        $this->load->view('common/footer.php');
    }
}