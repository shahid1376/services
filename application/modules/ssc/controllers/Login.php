<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
        parent:: __construct();

        $this->clear_cache();
    }
    function is_logged_in() 
    {

        $this->load->library('session');
        if ($this->session->userdata('logged_in'))
        {
            redirect('dashboard/');
        }
    }
    public function index()
    {
        $this->load->helper('url');
        $data = array(
            'user_status' => ''                     

        );
//DebugBreak();
        //$this->is_logged_in();
        
        
        
        if(@$_POST['username'] != '' && @$_POST['password'] != '')
        {   
            /*$blockinst[] = 362014;
            for($i = 0; $i<count($blockinst); $i++)
            {
            if($blockinst[$i] == $_POST['username'])
            {
            $data = array(
            'user_status' => 4                     
            );
            $this->load->view('login/login.php',$data); 
            return false; 
            }

            }*/
            //DebugBreak();
            $this->load->model('login_model'); 
            $isdefualter = $this->login_model->chekdefultar($_POST['username']);
            if( $isdefualter != -1)
            {
               // echo '<pre>'; print_r($isdefualter);
             //   exit();
                $data = array(
                    'user_status' => 4,                     
                    'remarks' => $isdefualter['Remarks']                     
                );


                $this->load->view('login/login.php',$data);
                return ;
            }
            
            
            $logedIn = $this->login_model->auth($_POST['username'],$_POST['password']);
            $appConfig = $this->login_model->getappconfig();

            
          /*  if($logedIn['tbl_inst']['feedingDate'] != null || $logedIn['SpecPermission']==1)
            {
                $lastdate  = date('Y-m-d',strtotime($logedIn['tbl_inst']['feedingDate'])) ;
                $spec_lastdate = date('Y-m-d',strtotime($logedIn['spec_info']['FeedingDate']));

                if(date('Y-m-d')<=$lastdate || date('Y-m-d')<=$spec_lastdate)
                {

                    $appConfig['isadmP1'] = 1;
                }

            }*/
            
            
          
            if($logedIn != false)
            {  
                $grp =  $logedIn['tbl_inst']['allowed_mGrp'];
                if($logedIn['tbl_inst']['edu_lvl'] == 2)
                {
                    $data = array(
                        'user_status' => 2                     
                    );
                    $this->load->view('login/login.php',$data);
                }
                else if($logedIn['tbl_inst']['IsActive'] == 0)
                {
                    $data = array(
                        'user_status' => 4,                     
                        'remarks' => $logedIn['tbl_inst']['Remarks']               
                    );


                    $this->load->view('login/login.php',$data);
                    return ;
                }
                else if(($logedIn['tbl_inst']['allowed_mGrp'] == NULL || $logedIn['tbl_inst']['allowed_mGrp'] == 0 || $logedIn['tbl_inst']['allowed_mGrp'] == '') && $logedIn['tbl_inst']['IsGovernment'] ==2 )
                {
                    $data = array(
                        'user_status' => 7                     
                    );
                    $this->load->view('login/login.php',$data);
                }
                else
                {
                    $this->load->model('RollNoSlip_model');

                    if(@$_POST['username'] == 111285 || @$_POST['username'] == 112384 || @$_POST['username'] == 121271 || @$_POST['username'] == 161208 || @$_POST['username'] == 162283)
                    {

                        $isdeaf = 1;
                   
                    }
                   
                    else
                    {
                        $isdeaf = 0;
                    }

                    if($logedIn['tbl_inst']['IsGovernment'] ==1)
                    {
                        $logedIn['tbl_inst']['allowed_mGrp'] = '1,2,5,7,8';
                    }

                     $isfeeding = -1;
                    $lastdate = SINGLE_LAST_DATE;
                    if($logedIn['SpecPermission']==1)
                    {
                        $lastdate=  $logedIn['spec_info']['FeedingDate'];
                        if(date('Y-m-d',strtotime($lastdate))>=date('Y-m-d'))
                        {
                            $isfeeding = 1;
                        }
                        else {
                            if(date('Y-m-d',strtotime(SINGLE_LAST_DATE))>=date('Y-m-d') || date('Y-m-d',strtotime(DOUBLE_LAST_DATE))>=date('Y-m-d'))
                            {
                                $isfeeding = 1    ;
                                $lastdate = SINGLE_LAST_DATE;
                                $logedIn['SpecPermission'] = 0;
                            }
                            else
                            {
                                $isfeeding = 0;   
                            }

                        }

                    }
                    else
                    {
                        if(date('Y-m-d',strtotime(SINGLE_LAST_DATE))>=date('Y-m-d') || date('Y-m-d',strtotime(DOUBLE_LAST_DATE))>=date('Y-m-d'))
                        {
                            $isfeeding = 1    ;
                        }
                        else if($logedIn['tbl_inst']['feedingDate'] != null)
                        {
                            $lastdate  = date('Y-m-d',strtotime($logedIn['tbl_inst']['feedingDate'])) ;
                            if(date('Y-m-d')<=$lastdate)
                            {

                                $isfeeding = 1; 
                            }
                            else 
                            {    $lastdate = SINGLE_LAST_DATE;
                                $isfeeding = -1;
                            }
                        }
                    }
                  
                    
                   // $isfeeding = 1;
                    
                    //DebugBreak();
                    $sess_array = array(
                        'Inst_Id' => $logedIn['tbl_inst']['Inst_cd'] ,
                        'pass' => $logedIn['flusers']['pass'] ,
                        'edu_lvl' => $logedIn['tbl_inst']['edu_lvl'],
                        'inst_Name' => $logedIn['tbl_inst']['Name'],
                        'gender' => $logedIn['tbl_inst']['Gender'],
                        'isrural' => $logedIn['tbl_inst']['IsRural'],
                        'grp_cd' => $logedIn['tbl_inst']['allowed_mGrp'],
                        'isgovt' => $logedIn['tbl_inst']['IsGovernment'],
                        'email' => $logedIn['tbl_inst']['email'],
                        'phone' => $logedIn['tbl_inst']['LandLine'],
                        'cell' => $logedIn['tbl_inst']['MobNo'],
                        'dist' => $logedIn['tbl_inst']['dist_cd'],
                        'teh' => $logedIn['tbl_inst']['teh_cd'],
                        'zone' => $logedIn['tbl_inst']['zone_cd'],
                        'emis' => $logedIn['tbl_inst']['emis_code'],
                        'isInserted' => $logedIn['isInserted'],
                        'isdeaf' => $isdeaf,
                        'isboardoperator' => 0,
                        'appconfig' => $appConfig,
                        'isfeedingallow' => $isfeeding,
                        'lastdate' => $lastdate ,  
                        'isSpecial' => $logedIn['SpecPermission'],   
                        'isSpecial_Fee' => $logedIn['spec_info']   
                    );
                    $this->load->library('session');

                    $this->session->set_userdata('logged_in', $sess_array); 
                    redirect('dashboard/');


                }




            }
            else
            {  
                $data = array(
                    'user_status' => 1                     
                );
                $this->load->view('login/login.php',$data);

            }
        }
        else
        {
            $this->load->view('login/login.php',$data);
        }

    }
    public function biselogin()
    {
        // DebugBreak();
        $this->load->helper('url');
        $data = array(
            'user_status' => ''                     

        );


        if(@$_POST['username'] != '' && @$_POST['password'] != '')
        {   
            if(@$_POST['username'] == 2222 || @$_POST['username'] == 2303)
            {



                $this->load->model('login_model'); 
                $logedIn = $this->login_model->biseauth($_POST['username'],$_POST['password']);
                if($logedIn != false)
                {  
                    $sess_array = array(
                        'Inst_Id' => $logedIn['Emp_cd'] ,
                        'edu_lvl' => $logedIn['BS'],
                        'inst_Name' => $logedIn['Name'],
                        'isdeaf' => 0,
                        'isboardoperator' => 1,
                    );
                    $this->load->library('session');
                    $this->session->set_userdata('logged_in', $sess_array); 
                    redirect('BiseCorrection/BatchRelease', 'refresh'); 
                }
                else
                {  
                    $data = array(
                        'user_status' => 1                     
                    );
                    $this->load->view('login/biselogin.php',$data);

                }
            }
            else
            {
                $data = array(
                    'user_status' => '7'                     

                );
                $this->load->view('login/biselogin.php',$data);
            }

        }
        else
        {

            $this->load->view('login/biselogin.php',$data);
        }

    }
    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
    function logout()
    {
        $this->load->helper('url');
        // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $this->session->set_userdata('logged_in', ''); 
        $this->session->sess_destroy();
        redirect('login','refresh');




    }
     function log_out()
    {
        $this->load->helper('url');
       // DebugBreak();
       $this->load->library('session');
       $Logged_In_Array = $this->session->all_userdata();
       $this->session->set_userdata('logged_in', ''); 
       $this->session->sess_destroy();

        //redirect('/admin/admin');
    }
}
/*'Inst_Id' => $logedIn->Inst_cd,
'edu_lvl' => $logedIn->edu_lvl,
'Name' => $logedIn->name,*/