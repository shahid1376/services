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
          $this->clear_cache(); 
        //this condition checks the existence of session if user is not accessing  
        //login method as it can be accessed without user session
        $this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
            redirect('login');
        }
    }
      function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
    public function index()
    {
        $this->load->helper('url');
       
       
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->model('Dashboard_model');

       $data = array(
            'isselected' => '1',
        );
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('dashboard/dashboard.php');
        $this->load->view('common/footer.php');
    }
    public function getstats()
    {

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->model('Dashboard_model');
        $data = $this->Dashboard_model->getInstInfo($userinfo['Inst_Id']);
        $grading_data = $this->Dashboard_model->getInstgrading($userinfo['Inst_Id']);
        $stats =  array();
        $crntyear = date('Y')-1; 
        $stats['iyear'][]  = $crntyear;
        $stats['iyear'][]  = $crntyear-1;
        $stats['iyear'][]  = $crntyear-2;
        $stats['iyear'][]  = $crntyear-3;
        $stats['iyear'][]  = $crntyear-4;
        $regs = '';
        $readm = '';
        $adm2 = '';
        $adm1 = '';
        $supplyadm = '';
        $grading = array();
        $isexist = 0;
         
        $isgradingexist = 0;
        //DebugBreak();
        $crntyear = date('Y')-5;
        for($i = 0 ; $i<2;  $i++)
        {
            $isexist = 0;
            for($j =0 ; $j<count( $data) ;  $j++)
            {

                if( $stats['iyear'][$i] == $data[$j]['iyear'])
                {
                    $regs[]   =  $data[$j]['RegCount'];
                    $readm[]  =  $data[$j]['ReAdm'];
                    $adm2[]   =  $data[$j]['Adm2'];
                    $adm1[]   =  $data[$j]['Adm1'];
                    $supplyadm[] =  $data[$j]['Adms2'];
                    $isexist =  1;
                } 
            }
            if($isexist ==  0)
            {
                $regs[]   =  0;
                $readm[]  =  0;
                $adm2[]   =  0;
                $adm1[]   =  0;
                $supplyadm[] =  0; 
            }
          
        }
        
        for($i = 0 ; $i<count($stats['iyear']);  $i++)
        {
            $isgradingexist = 0;
            
            for($j =0 ; $j<count( $grading_data) ;  $j++)
            {
                if($crntyear == $grading_data[$j]['iyear'])
                {
                   
                    $stats['grading'][] =  floatval($grading_data[$j]['Ranking_Score']);
                    $isgradingexist =  1;
                } 
            }
            if($isgradingexist ==  0)
            {
                $stats['grading'][] =  floatval(0); 
            }
             $crntyear++;
        }
        
        
        $stats['states'][] = array('name'=>'Regsitration', "data"=> $regs);
        $stats['states'][] = array('name'=>'Re-Admission', "data"=> $readm);
        $stats['states'][] = array('name'=>'9th Admission', "data"=> $adm1);
        $stats['states'][] = array('name'=>'10th Admission', "data"=> $adm2);
        $stats['states'][] = array('name'=>'Supply Admission', "data"=>$supplyadm);
       // $stats['grading'] = $grading;
      
       // DebugBreak();
        
        
        echo json_encode($stats) ;
    }  
}