<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
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
        parent::__construct();
        $this->load->helper('url');
        //this condition checks the existence of session if user is not accessing  
        //login method as it can be accessed without user session
        $this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
            redirect('login');
        }
    }
    public function index()
    {
          
        $msg = $this->uri->segment(3);
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();  
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $userinfo['isdashbord'] = 1;
        $Inst_Id = $userinfo['Inst_Id'];
        $isInserted = $userinfo['isInserted'];
        $Inst_name = $userinfo['inst_Name'];
        $this->load->view('common/common_reg/header.php',$userinfo);
        $this->load->view('common/menu.php',$userinfo);
        $this->load->model('Registration_model');
        $count = $this->Registration_model->Dashboard($Inst_Id);
        $info = array('count'=>$count,'Inst_id'=>$Inst_Id,'Inst_name'=>$Inst_name);
        $this->load->view('Registration/Registration.php',$info);
        $this->load->view('common/common_reg/footer.php');    
    }

    public function isExist()
    {

        //DebugBreak();
        $this->load->model('Admission_9th_reg_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $nxtrnosessyear = $this->Admission_9th_reg_model->checknextrno($_POST['cand_name'],$_POST['dob'],$_POST['father_cnic']);
        if($nxtrnosessyear[0][NextRno_Sess_Year] !="")
        {
            $nxtrnosessyear = $nxtrnosessyear[0]['NextRno_Sess_Year'];
            $result = $nxtrnosessyear;
            echo   json_encode($result);
        }
        else
        {
            //  $nxtrnosessyear = $this->Admission_9th_reg_model->checknextrno_newAdmission($_POST['cand_name'],$_POST['dob'],$_POST['father_cnic'],$_POST['bay_form']);
            // if($nxtrnosessyear[0][NextRno_Sess_Year] !="")
            // {
            //      $nxtrnosessyear = $nxtrnosessyear[0]['NextRno_Sess_Year'];
            //      $result = $nxtrnosessyear;
            //      echo   json_encode($result);
            //  }
            //  else
            //  {
            $result = "SUCCESS";
            echo   json_encode($result);
            //  }
            // $this->NewEnrolment_insert();

        }
        return $result;
    }
    public function NewEnrolment_insert()
    {
          

        
        $this->load->model('Registration_model');
        //DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $isfeeding = $userinfo['isfeedingallow'];
        $this->commonheader($userinfo);
        $error = array();
        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        // $this->Registration_model->Insert_NewEnorlement($data);    
        $formno = $this->Registration_model->GetFormNo($Inst_Id);//, $fname);//$_POST['username'],$_POST['password']);

        $allinputdata = array('cand_name'=>@$_POST['cand_name'],'father_name'=>@$_POST['father_name'],
            'bay_form'=>@$_POST['bay_form'],'father_cnic'=>@$_POST['father_cnic'],
            'dob'=>@$_POST['dob'],'mob_number'=>@$_POST['mob_number'],
            'medium'=>@$_POST['medium'],'Inst_Rno'=>@$_POST['Inst_Rno'],
            'speciality'=>@$_POST['speciality'],'MarkOfIden'=>@$_POST['MarkOfIden'],
            'medium'=>@$_POST['medium'],'nationality'=>@$_POST['nationality'],
            'gender'=>@$_POST['gender'],'hafiz'=>@$_POST['hafiz'],
            'religion'=>@$_POST['religion'],'std_group'=>@$_POST['std_group'],
            'address'=>@$_POST['address'],
            'UrbanRural'=>@$_POST['UrbanRural'],'sub1'=>@$_POST['sub1'],
            'sub2'=>@$_POST['sub2'],'sub3'=>@$_POST['sub3'],
            'sub4'=>@$_POST['sub4'],'sub5'=>@$_POST['sub5'],
            'sub6'=>@$_POST['sub6'],'sub7'=>@$_POST['sub7'],
            'sub8'=>@$_POST['sub8']
        );
        //DebugBreak();
        if($isfeeding != 1)
        {
         $allinputdata['excep'] = 'REGISTRATION CLOSED';
         $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
         redirect('Registration/NewEnrolment/');
         return;
        } 
        
        
        /* $target_path = './assets/uploads/'.$Inst_Id.'/';
        if (!file_exists($target_path)){
        mkdir($target_path, 0777, true);
        }*/

        $target_path = IMAGE_PATH;
        // $target_path = '../uploads2/'.$Inst_Id.'/';
        if (!file_exists($target_path)){

            mkdir($target_path);
        }
        $target_path = IMAGE_PATH.$Inst_Id.'/';
        if (!file_exists($target_path)){

            mkdir($target_path);
        } 

        $config['upload_path']   = $target_path;
        $config['allowed_types'] = 'jpg';
        $config['max_size']      = '20';
        $config['min_size']      = '4';
        //  $config['max_width']     = '260';
        // $config['max_height']    = '290';
        $config['min_width']     = '110';
        $config['min_height']    = '100';
        $config['overwrite']     = TRUE;
        $config['file_name']     = $formno.'.jpg';

        $filepath = $target_path. $config['file_name']  ;

        //$config['new_image']    = $formno.'.JPEG';

        $this->load->library('upload', $config);

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        $this->upload->initialize($config);

        if($check !== false) {

            $file_size = round($_FILES['image']['size']/1024, 2);
            if($file_size<=20 && $file_size>=4)
            {
                if ( !$this->upload->do_upload('image',true))
                {
                    if($this->upload->error_msg[0] != "")
                    {
                        $error['excep']= $this->upload->error_msg[0];
                        $allinputdata['excep'] = $this->upload->error_msg[0];
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                        redirect('Registration/NewEnrolment/');
                        return;

                    }


                }
            }
            else
            {
                $allinputdata['excep'] = 'The file you are attempting to upload size is between 4 to 20 Kb.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                redirect('Registration/NewEnrolment/');

            }
        }
        else
        {
            // $check = getimagesize($filepath);
            if($check === false)
            {
                $allinputdata['excep'] = 'Please Upload Your Picture';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/NewEnrolment/');
                return;
            }
        }
         
        $this->frmvalidation('NewEnrolment',$allinputdata,0);

        $a = getimagesize($filepath);
        if($a[2]!=2)
        {
            $this->convertImage($filepath,$filepath,100,$a['mime']);
        }
        $type = pathinfo($filepath, PATHINFO_EXTENSION);
        $pic_data = file_get_contents($filepath);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($pic_data);
        //$data['Image']=$base64;

        // $name = 'Waseem Saleem';
        // $fname = 'Muhammad Saleem'; 
        $sub1ap1 = 0;
        $sub2ap1 = 0;
        $sub3ap1 = 0;
        $sub4ap1 = 0;
        $sub5ap1 = 0;
        $sub6ap1 = 0;
        $sub7ap1 = 0;
        $sub8ap1 = 0;
        if(@$_POST['sub1'] != 0)
        {
            $sub1ap1 = 1;    
        }
        if(@$_POST['sub2'] != 0)
        {
            $sub2ap1 = 1;    
        }
        if(@$_POST['sub3'] != 0)
        {
            $sub3ap1 = 1;    
        }
        if(@$_POST['sub4'] != 0)
        {
            $sub4ap1 = 1;    
        }
        if(@$_POST['sub5'] != 0)
        {
            $sub5ap1 = 1;    
        }
        if(@$_POST['sub6'] != 0)
        {
            $sub6ap1 = 1;    
        }
        if(@$_POST['sub7'] != 0)
        {
            $sub7ap1 = 1;    
        }
        if(@$_POST['sub8'] != 0)
        {
            $sub8ap1 = 1;    
        }
        $data = array(
            'name' =>$this->input->post('cand_name'),
            'Fname' =>$this->input->post('father_name'),
            'BForm' =>$this->input->post('bay_form'),
            'FNIC' =>$this->input->post('father_cnic'),
            'Dob' =>$this->input->post('dob'),
            'CellNo' =>$this->input->post('mob_number'),
            'medium' =>$this->input->post('medium'),
            'Inst_Rno' =>$this->input->post('Inst_Rno'),
            'MarkOfIden' =>$this->input->post('MarkOfIden'),
            'Speciality' =>$this->input->post('speciality'),
            'nat' =>$this->input->post('nationality'),
            'sex' =>$this->input->post('gender'),
            'IsHafiz' =>$this->input->post('hafiz'),
            'rel' =>$this->input->post('religion'),
            'addr' =>$this->input->post('address'),
            'grp_cd' =>$this->input->post('std_group'),
            'sub1' =>$this->input->post('sub1'),
            'sub2' =>$this->input->post('sub2'),
            'sub3' =>$this->input->post('sub3'),
            'sub4' =>$this->input->post('sub4'),
            'sub5' =>$this->input->post('sub5'),
            'sub6' =>$this->input->post('sub6'),
            'sub7' =>$this->input->post('sub7'),
            'sub8' =>$this->input->post('sub8'),
            'sub1ap1' => ($sub1ap1),
            'sub2ap1' => ($sub2ap1),
            'sub3ap1' => ($sub3ap1),
            'sub4ap1' => ($sub4ap1),
            'sub5ap1' => ($sub5ap1),
            'sub6ap1' => ($sub6ap1),
            'sub7ap1' => ($sub7ap1),
            'sub8ap1' => ($sub8ap1),
            'UrbanRural' =>$this->input->post('UrbanRural'),
            'Inst_cd' =>($Inst_Id),
            'FormNo' =>($formno),
            'Image' =>$base64,





        );
        $logedIn = $this->Registration_model->Insert_NewEnorlement($data);//, $fname);//$_POST['username'],$_POST['password']);
        //////DebugBreak();
        if($logedIn[0]['error'] != 'false')
        {  
            $allinputdata = "";
            $allinputdata['excep'] = 'success';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration/NewEnrolment');
            return;


        }
        else
        {     
            $allinputdata['excep'] = 'An error has occoured. Please try again later. ';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration/NewEnrolment');
            return;
            echo 'Data NOT Saved Successfully !';

        } 




        $this->load->view('common/common_reg/footer.php');
    }
    public function NewEnrolment()
    {    
        // ////DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/common_reg/header.php',$userinfo);
        $data = array(
            'isselected' => '2',
        );
        //  ////DebugBreak();
        if($this->session->flashdata('NewEnrolment_error')){

            $error['excep'] = $this->session->flashdata('NewEnrolment_error');    
        }
        else{
            $error['excep'] = '';
        }


        $error['gender'] = $userinfo['gender'];
        $error['isrural'] = $userinfo['isrural'];
        $error['grp_cd'] = $userinfo['grp_cd'];
        $error['isgovt'] = $userinfo['isgovt'];

        $this->commonheader($data);
        $this->load->view('Registration/9th/NewEnrolment.php',$error);
        // $this->load->view('common/common_reg/footer.php');
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));
        // if(@$_POST['cand_name'] != '' )//&& @$_POST['father_name'] != '' && @$_POST['bay_form'] != '' && @$_POST['father_cnic'] != '' && @$_POST['dob'] != '' && @$_POST['mob_number'] != '') //{   



        //}



    }
    public function NewEnrolment_EditForm($formno)
    {    
        //          ////DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $Inst_Id = $userinfo['Inst_Id'];
        
        $this->load->view('common/common_reg/header.php',$userinfo);
        $isReAdm = 0;
        $year = 0;
        $data = array(
            'isselected' => '2',
        );
        $this->load->model('Registration_model');
        if($this->session->flashdata('NewEnrolment_error')){
            //////DebugBreak();

            $RegStdData['data'][0] = $this->session->flashdata('NewEnrolment_error');   
            $isReAdm = $RegStdData['data'][0]['isreadm'];
            $RegStdData['isReAdm']=$isReAdm;
            $RegStdData['Oldrno']=$RegStdData['data'][0]['regoldrno'];

        }
        else{
            $error['excep'] = '';

            if($this->session->flashdata('IsReAdm')){
                $isReAdm = 1;
                $year = 2016;
            }
            else{
                $isReAdm = 0;
                $year = regyear;    
            }
            $datainfo = $this->Registration_model->EditEnrolement_data($formno,$year,$Inst_Id);


            if($datainfo[0]['IsReAdm'] == 1 )
            {
                $isReAdm = 2;
            }
            $RegStdData = array('data'=>$datainfo,'isReAdm'=>$isReAdm,'Oldrno'=>0);

        }


        $this->load->view('common/menu.php',$data);
        $this->load->view('Registration/9th/Edit_Enrolement_form.php',$RegStdData);   
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js"))); 

    }
    public function NewEnrolment_update()
    {

        //DebugBreak();
        $this->load->model('Registration_model');

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $isfeeding = $userinfo['isfeedingallow'];
        $this->commonheader($userinfo);
        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
       
        $error = array();
        // ////DebugBreak();
        $formno =  $_POST['formNo'];  //$this->Registration_model->GetFormNo($Inst_Id);//, $fname);//$_POST['username'],$_POST['password']);
        $sub1ap1 = 0;
        $sub2ap1 = 0;
        $sub3ap1 = 0;
        $sub4ap1 = 0;
        $sub5ap1 = 0;
        $sub6ap1 = 0;
        $sub7ap1 = 0;
        $sub8ap1 = 0;
        if(@$_POST['sub1'] != 0)
        {
            $sub1ap1 = 1;    
        }
        if(@$_POST['sub2'] != 0)
        {
            $sub2ap1 = 1;    
        }
        if(@$_POST['sub3'] != 0)
        {
            $sub3ap1 = 1;    
        }
        if(@$_POST['sub4'] != 0)
        {
            $sub4ap1 = 1;    
        }
        if(@$_POST['sub5'] != 0)
        {
            $sub5ap1 = 1;    
        }
        if(@$_POST['sub6'] != 0)
        {
            $sub6ap1 = 1;    
        }
        if(@$_POST['sub7'] != 0)
        {
            $sub7ap1 = 1;    
        }
        if(@$_POST['sub8'] != 0)
        {
            $sub8ap1 = 1;    
        }
        $target_path = IMAGE_PATH.$Inst_Id.'/';
        // $target_path = '../uploads2/'.$Inst_Id.'/';
        if (!file_exists($target_path))
        {

            mkdir($target_path);
        }

        // ////DebugBreak();
        if(@$_POST['IsReAdm'] == '1')
        {


            $User_info_data = array('Inst_Id'=>$Inst_Id,'RollNo'=>@$_POST['OldRno'],'spl_case'=>17);
            $user_info  =  $this->Registration_model->readmission_check($User_info_data); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);

            if($user_info == false)
            {
                $this->session->set_flashdata('error', 'This Roll No. Result is not cancelled. Please Cancel result from 9th Branch Before proceeding!');
                redirect('Registration/ReAdmission');
                return;
            }
            // ////DebugBreak();
            $allinputdata = array('CellNo'=>@$_POST['mob_number'],
                'med'=>@$_POST['medium'],'classRno'=>@$_POST['Inst_Rno'],
                'speciality'=>@$_POST['speciality'],'markOfIden'=>@$_POST['MarkOfIden'],
                'med'=>@$_POST['medium'],'nat'=>@$_POST['nationality'],
                'sex'=>@$_POST['gender'],'Ishafiz'=>@$_POST['hafiz'],
                'rel'=>@$_POST['religion'],'RegGrp'=>@$_POST['std_group'],
                'addr'=>@$_POST['address'],
                'RuralORUrban'=>@$_POST['UrbanRural'],'sub1'=>@$_POST['sub1'],
                'sub2'=>@$_POST['sub2'],'sub3'=>@$_POST['sub3'],
                'sub4'=>@$_POST['sub4'],'sub5'=>@$_POST['sub5'],
                'sub6'=>@$_POST['sub6'],'sub7'=>@$_POST['sub7'],
                'sub8'=>@$_POST['sub8'],'PicPath'=>$config['file_name'],'formNo'=>$formno,
                'sub1ap1' => ($sub1ap1),
                'sub2ap1' => ($sub2ap1),
                'sub3ap1' => ($sub3ap1),
                'sub4ap1' => ($sub4ap1),
                'sub5ap1' => ($sub5ap1),
                'sub6ap1' => ($sub6ap1),
                'sub7ap1' => ($sub7ap1),
                'sub8ap1' => ($sub8ap1),

            );
            $allinputdata['name']= $user_info[0]['name'];
            $allinputdata['Fname']= $user_info[0]['Fname'];
            $allinputdata['BForm']= $user_info[0]['BForm'];
            $allinputdata['FNIC']= $user_info[0]['FNIC'];
            $allinputdata['Dob']= $user_info[0]['Dob'];
            $allinputdata['regoldrno']= $user_info[0]['rno'];
            $allinputdata['regoldsess']= $user_info[0]['sess'];
            $allinputdata['regoldclass']= $user_info[0]['class'];
            $allinputdata['regoldyear']= $user_info[0]['Iyear'];
            $allinputdata['isreadm']= 1;
            $formno = $this->Registration_model->GetFormNo($Inst_Id);
            $allinputdata['formNo']= $formno;
            //////DebugBreak();

        }
        else{
            $allinputdata = array('name'=>@$_POST['cand_name'],'Fname'=>@$_POST['father_name'],
                'BForm'=>@$_POST['bay_form'],'FNIC'=>@$_POST['father_cnic'],
                'Dob'=>@$_POST['dob'],'MobNo'=>@$_POST['mob_number'],
                'med'=>@$_POST['medium'],'classRno'=>@$_POST['Inst_Rno'],
                'speciality'=>@$_POST['speciality'],'markOfIden'=>@$_POST['MarkOfIden'],
                'med'=>@$_POST['medium'],'nat'=>@$_POST['nationality'],
                'sex'=>@$_POST['gender'],'Ishafiz'=>@$_POST['hafiz'],
                'rel'=>@$_POST['religion'],'RegGrp'=>@$_POST['std_group'],
                'addr'=>@$_POST['address'],
                'RuralORUrban'=>@$_POST['UrbanRural'],'sub1'=>@$_POST['sub1'],
                'sub2'=>@$_POST['sub2'],'sub3'=>@$_POST['sub3'],
                'sub4'=>@$_POST['sub4'],'sub5'=>@$_POST['sub5'],
                'sub6'=>@$_POST['sub6'],'sub7'=>@$_POST['sub7'],
                'sub8'=>@$_POST['sub8'],'PicPath'=>$config['file_name'],'formNo'=>@$_POST['formNo'],
                'sub1ap1' => ($sub1ap1),
                'sub2ap1' => ($sub2ap1),
                'sub3ap1' => ($sub3ap1),
                'sub4ap1' => ($sub4ap1),
                'sub5ap1' => ($sub5ap1),
                'sub6ap1' => ($sub6ap1),
                'sub7ap1' => ($sub7ap1),
                'sub8ap1' => ($sub8ap1),
            );
            $allinputdata['regoldrno']= 0;
            $allinputdata['regoldsess']= 0;
            $allinputdata['regoldclass']=0;
            $allinputdata['regoldyear']= 0;
            $allinputdata['isreadm']= $_POST['IsReAdm'];
        }


        if($isfeeding != 1)
        {
                $allinputdata['excep'] = 'REGISTRATION CLOSED';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                redirect('Registration/NewEnrolment_EditForm/'.$formno);
        }
        $config['upload_path']   = $target_path;
        $config['allowed_types'] = 'jpg|jpeg';
        $config['max_size']      = '20';
        // $config['max_width']     = '260';
        // $config['max_height']    = '290';
        $config['min_width']     = '110';
        $config['min_height']    = '100';
        $config['overwrite']     = TRUE;
        $config['file_name']     = $formno.'.jpg';

        $filepath = $target_path. $config['file_name']  ;



        //$config['new_image']    = $formno.'.JPEG';
        $this->load->library('upload', $config);

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        $this->upload->initialize($config);
        $base64 = '';
        if($check !== false) {

            $file_size = round($_FILES['image']['size']/1024, 2);
            if($file_size<=20 && $file_size>=4)
            {

                if ( !$this->upload->do_upload('image',True))
                {
                    if($this->upload->error_msg[0] != "")
                    {
                        $error['excep']= $this->upload->error_msg[0];
                        $allinputdata['excep'] = $this->upload->error_msg[0];
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration/NewEnrolment_EditForm/'.$formno);
                        return;

                    }

                }
            }
            else
            {
                $allinputdata['excep'] = 'The file you are attempting to upload size is between 4 to 20 Kb.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                redirect('Registration/NewEnrolment_EditForm/'.$formno);

            }

            $type = pathinfo($filepath, PATHINFO_EXTENSION);
            $pic_data = file_get_contents($filepath);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($pic_data);
            // $data['Image']=$base64;

        }
        else
        {
            $check = getimagesize($filepath);
            if($check === false)
            {
                $allinputdata['excep'] = 'Please Upload Your Picture';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/NewEnrolment_EditForm/'.$formno);
                return;
            }
        }  


        //////DebugBreak();
        $this->frmvalidation('NewEnrolment_EditForm/'.$formno,$allinputdata,1);

        /*  $a = getimagesize($filepath);
        if($a[2]!=2)
        {
        $this->convertImage($filepath,$filepath,100,$a['mime']);
        }*/

        // $name = 'Waseem Saleem'; Edit_Enrolement_form
        // $fname = 'Muhammad Saleem'; 
        $sub1ap1 = 0;
        $sub2ap1 = 0;
        $sub3ap1 = 0;
        $sub4ap1 = 0;
        $sub5ap1 = 0;
        $sub6ap1 = 0;
        $sub7ap1 = 0;
        $sub8ap1 = 0;
        if(@$_POST['sub1'] != 0)
        {
            $sub1ap1 = 1;    
        }
        if(@$_POST['sub2'] != 0)
        {
            $sub2ap1 = 1;    
        }
        if(@$_POST['sub3'] != 0)
        {
            $sub3ap1 = 1;    
        }
        if(@$_POST['sub4'] != 0)
        {
            $sub4ap1 = 1;    
        }
        if(@$_POST['sub5'] != 0)
        {
            $sub5ap1 = 1;    
        }
        if(@$_POST['sub6'] != 0)
        {
            $sub6ap1 = 1;    
        }
        if(@$_POST['sub7'] != 0)
        {
            $sub7ap1 = 1;    
        }
        if(@$_POST['sub8'] != 0)
        {
            $sub8ap1 = 1;    
        }
        // ////DebugBreak();
        $data = array(
            'name' =>$this->input->post('cand_name'),
            'Fname' =>$this->input->post('father_name'),
            'BForm' =>$this->input->post('bay_form'),
            'FNIC' =>$this->input->post('father_cnic'),
            'Dob' =>$this->input->post('dob'),
            'MobNo' =>$this->input->post('mob_number'),
            'medium' =>$this->input->post('medium'),
            'Inst_Rno' =>$this->input->post('Inst_Rno'),
            'MarkOfIden' =>$this->input->post('MarkOfIden'),
            'Speciality' =>$this->input->post('speciality'),
            'nat' =>$this->input->post('nationality'),
            'sex' =>$this->input->post('gender'),
            'IsHafiz' =>$this->input->post('hafiz'),
            'rel' =>$this->input->post('religion'),
            'addr' =>$this->input->post('address'),
            'grp_cd' =>$this->input->post('std_group'),
            'sub1' =>$this->input->post('sub1'),
            'sub2' =>$this->input->post('sub2'),
            'sub3' =>$this->input->post('sub3'),
            'sub4' =>$this->input->post('sub4'),
            'sub5' =>$this->input->post('sub5'),
            'sub6' =>$this->input->post('sub6'),
            'sub7' =>$this->input->post('sub7'),
            'sub8' =>$this->input->post('sub8'),
            'sub1ap1' => ($sub1ap1),
            'sub2ap1' => ($sub2ap1),
            'sub3ap1' => ($sub3ap1),
            'sub4ap1' => ($sub4ap1),
            'sub5ap1' => ($sub5ap1),
            'sub6ap1' => ($sub6ap1),
            'sub7ap1' => ($sub7ap1),
            'sub8ap1' => ($sub8ap1),
            'UrbanRural' =>$this->input->post('UrbanRural'),
            'Inst_cd' =>($Inst_Id),
            'FormNo' =>($formno),
            'regoldrno' =>($allinputdata['regoldrno']),
            'regoldsess' =>($allinputdata['regoldsess']),
            'regoldclass' =>( $allinputdata['regoldclass']),
            'regoldyear' =>( $allinputdata['regoldyear']),
            'isreadm'=>($allinputdata['isreadm']),
            'Image'=>($base64)




        );
        $logedIn = $this->Registration_model->Update_NewEnorlement($data);//, $fname);//$_POST['username'],$_POST['password']);
        if($logedIn[0]['error'] != 'false')
        {  

            $this->session->set_flashdata('error', 'success');
            redirect('Registration/EditForms');
            return;

            echo 'Data Saved Successfully !';

        }
        else
        {     
            $allinputdata['excep'] = 'An error has occoured. Please try again later. ';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration/NewEnrolment_EditForm/'.$formno);
            return;
            echo 'Data NOT Saved Successfully !';

        } 



        $this->load->view('common/common_reg/footer.php');
    }
    public function NewEnrolment_Delete($formno)
    {
        // ////DebugBreak();
        $this->load->model('Registration_model');
        $RegStdData = array('data'=>$this->Registration_model->Delete_NewEnrolement($formno));
        $this->load->library('session');
        $this->session->set_flashdata('error', '2');
        redirect('Registration/EditForms');
        return;
    }
    public function ReAdmission()
    {
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        // ////DebugBreak();
        $data = array(
            'isselected' => '2',
        );
        $this->load->view('common/common_reg/header.php',$userinfo);
        $this->commonheader($data);
        if(!( $this->session->flashdata('error'))){

            $error_msg_readmission = "";    
        }
        else{
            $error_msg_readmission = $this->session->flashdata('error');
        }
        $myinfo = array('error'=>$error_msg_readmission);  
        $this->load->view('Registration/9th/ReAdmission.php',$myinfo);
        $this->load->view('common/common_reg/footer.php');

    }
    public function BatchRelease()
    {
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        //////DebugBreak();
        $data = array(
            'isselected' => '2',
        );
        $Batch_ID = $this->uri->segment(3);
        $this->load->view('common/common_reg/header.php',$userinfo);
        $this->commonheader($data);
        if(!( $this->session->flashdata('BatchList_error'))){

            $error['batchId']= $Batch_ID;    
        }
        else{
            $error = $this->session->flashdata('BatchList_error');
        }
        // echo $error['batchId'];
        // $myinfo = array('error'=>$error_msg_readmission);
        $this->load->view('Registration/9th/BatchRelease.php',$error);//,$myinfo);
        $this->load->view('common/common_reg/footer.php');
    }
    public function Batchlist_INSERT()
    {
        $this->load->model('Registration_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $data = array(
            'isselected' => '2',
        );
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/common_reg/header.php',$userinfo);
        $batchId = @$_POST['batch_real_Id'];
        $reason = @$_POST['batch_real_reason'];
        $branch = @$_POST['batch_real_bankbranch'];
        $challan = @$_POST['batch_real_challanno'];
        $amount = @$_POST['batch_real_PaidAmount'];
        $date = @$_POST['batch_real_PaidDate'];
        $allinputdata['batchId'] = $batchId;
        $allinputdata['reason'] = $reason;
        $allinputdata['branch'] = $branch;
        $allinputdata['challan'] = $challan;
        $allinputdata['amount'] = $amount;
        $allinputdata['date'] = $date;
        // ////DebugBreak();
        if($batchId == 0 || $batchId == ''){
            $allinputdata['BatchRelease_excep'] = 'Please Select Batch From Batch List Section';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration/BatchRelease');
            return;
        }
        else if($reason == ''){
            $allinputdata['BatchRelease_excep'] = 'Please Give Reason';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration/BatchRelease');
            return;
        }
        else if($branch =='' ){
            $allinputdata['BatchRelease_excep'] = 'Please Select Bank Branch';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration/BatchRelease');
            return;
        }
        else if ($challan == '' || $challan == 0){
            $allinputdata['BatchRelease_excep'] = 'Please Give Challan No.';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration/BatchRelease');
            return;
        }
        else if ($amount == '' || $amount == 0){
            $allinputdata['BatchRelease_excep'] = 'Please Give Amount';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration/BatchRelease');
            return;
        }
        else if($date == '' || $date == 0){
            $allinputdata['BatchRelease_excep'] = 'Please Select Paid Date';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration/BatchRelease');
            return;
        }

        $allinputdata['Inst_Id'] = $Inst_Id;
        $user_info  =  $this->Registration_model->ReleaseBatch_INSERT($allinputdata); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);
        if($user_info == true){
            $allinputdata['BatchRelease_excep'] = 'Applied Successfully.';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration/BatchList');
            return;
        }
        else{
            $allinputdata['BatchRelease_excep'] = 'Not Applied Successfully! An Error occoured, Please Try Again Latter.';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Registration/BatchRelease');
            return;
        }

    }
    public function ReAdmission_check()
    {
        //DebugBreak();
        $RollNo = @$_POST['oldRno'];//$this->uri->segment(3);
        //$Spl_case = $this->uri->segment(4);

        $this->load->model('Registration_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $data = array(
            'isselected' => '2',
        );
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $Insgender = $userinfo['gender'];
        $this->load->view('common/common_reg/header.php',$userinfo);

        $User_info_data = array('Inst_Id'=>$Inst_Id,'RollNo'=>$RollNo,'spl_case'=>17);
        $user_info  =  $this->Registration_model->readmission_check($User_info_data); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);
        // ////DebugBreak();
        $dob = $user_info[0]['Dob'];
        $from = new DateTime($dob);
        $to   = new DateTime(DOB_LIMIT);
        //$dif = $from->diff($to)->y;
        //////DebugBreak();
        $isFeeded = $this->Registration_model->IsFeeded($User_info_data);
        if($user_info == false)
        {
            $this->session->set_flashdata('error', 'This Roll No. Result is not cancelled. Please Cancel result from 9th Branch Before proceeding!');
            redirect('Registration/ReAdmission');
            return;
        }
        else  if($isFeeded != false )
        {
            $this->session->set_flashdata('error', 'This Roll No.'.$RollNo.' '.$isFeeded["StdInfo"][0]['name'].' Father Name '.$isFeeded["StdInfo"][0]['Fname'].' is Already Fed in '.$isFeeded["SchInfo"][0]['Name'].' Institute.');
            redirect('Registration/ReAdmission');
            return;
        }
        else  if($user_info[0]['IsReAdm'] == '1')
        {
            $this->session->set_flashdata('error', 'This Roll No. is Already availed the chance of Re-Admission.');
            redirect('Registration/ReAdmission');
            return;
        }
        else  if($from > $to)
        {
            $this->session->set_flashdata('error', 'This Roll No. can not appear due to Underage!');
            redirect('Registration/ReAdmission');
            return;
        }
        /*else if($Insgender != $user_info[0]['sex'])
        {
            if($Insgender ==  2)
            {  
                $this->session->set_flashdata('error', 'GENDER CONTRADICTION! YOUR INSTITUTE CAN NOT SAVE MALE CANDIDATE RECORD!');

            }

            else
            {
                $this->session->set_flashdata('error', 'GENDER CONTRADICTION! YOUR INSTITUTE CAN NOT SAVE FEMALE CANDIDATE RECORD!');
            }
            redirect('Registration/ReAdmission');
            return;

        }  */
        else
        {


            // ////DebugBreak();
            $formno = $user_info[0]['formNo'];
            $OldRno = $user_info[0]['rno'];
            $year = Year;

            $RegStdData = array('isReAdm'=>'1','Oldrno'=>$OldRno);
            $RegStdData['data'][0]=$user_info[0];
            $RegStdData['data'][0]['CellNo'] = $RegStdData['data'][0]['MobNo'];

            $filledinfo['error'] = "";
            //$this->session->set_flashdata('isReAdm','1');
            $this->load->view('common/menu.php',$data);
            $this->load->view('Registration/9th/Edit_Enrolement_form.php',$RegStdData); 
            //$this->load->view('common/common_reg/footer.php');  
            $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js"))); 
        }
    }
    public function EditForms()
    {
        // ////DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/common_reg/header.php',$userinfo);
        $data = array(
            'isselected' => '2',

        );
        $msg = $this->uri->segment(3);



        if($msg == FALSE){

            $error_msg = $this->session->flashdata('error');    
        }
        else{
            $error_msg = $msg;
        }

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        $RegStdData = array('data'=>$this->Registration_model->EditEnrolement($user['Inst_Id']),'grp_cd'=>$user['grp_cd']);
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/common_reg/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('Registration/9th/EditForms.php',$RegStdData);
        $this->load->view('common/common_reg/footer.php');



    }
    public function BatchList()
    {
        // ////DebugBreak();
        $data = array(
            'isselected' => '2',

        );
        // $this->commonheader($data);
        $this->load->model('Registration_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        //$page_name  = "Create Batch";
        if($this->session->flashdata('BatchList_error')){

            $error_msg = $this->session->flashdata('BatchList_error');    

        }
        else{
            $error_msg = '';
        }
        $data1 = array('Inst_Id'=>$Inst_Id);
        $user_info  =  $this->Registration_model->Batch_List($data1);
        $user_info_arr = array('info'=>$user_info,'errors'=>$error_msg);
        $this->load->view('common/common_reg/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);

        $this->load->view('Registration/9th/BatchList.php',$user_info_arr);


        $this->load->view('common/common_reg/footer.php');
        //$this->commonheader($data);
        //  $this->load->view('Registration/9th/BatchList.php');
        //$this->commonfooter();
    }
    public function ProofReading()
    {
        $data = array(
            'isselected' => '2',

        );
        $this->commonheader($data);
        $this->load->view('Registration/9th/ProofReading.php');
        $this->commonfooter();
    }
    public function CreateBatch()
    {
        // ////DebugBreak();
        $data = array(
            'isselected' => '2',

        );
        $msg = $this->uri->segment(3);
        $spl_cd = $this->uri->segment(4);
        $grp_selected = $this->uri->segment(5);

        $this->load->library('session');
        if($this->session->flashdata('error')){

            $error_msg = $this->session->flashdata('error');    

        }
        else{
            $error_msg = 0;
        }


        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        $myinfo = array('Inst_cd'=>$user['Inst_Id'],'spl_cd'=>$spl_cd,'grp_cd'=>$user['grp_cd'],'grp_selected'=>$grp_selected);
        $RegStdData = array('data'=>$this->Registration_model->Spl_case_std_list($myinfo),'spl_cd'=>$spl_cd,'grp_selected'=>$grp_selected);
        $RegStdData['msg_status'] = $error_msg;
        $RegStdData['spl_cd'] =  $spl_cd;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/common_reg/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);

        $this->load->view('Registration/9th/CreateBatch.php',$RegStdData);
        $this->load->view('common/common_reg/footer.php');



    }
    public function Make_Batch_Group_wise()
    {
       // DebugBreak();
        $RegGrp = $this->uri->segment(3);
        $this->load->model('Registration_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];  
        $isfeeding = $userinfo['isfeedingallow'];  
        $page_name  = "Create Batch";
        $Spl_case = $this->uri->segment(4);
        
        if($isfeeding != 1)
        {
         $msg = 'REGISTRATION CLOSED';
            $this->session->set_flashdata('error',$msg);
            redirect('Registration/CreateBatch');
            return; 
        }
        
        if($Spl_case != false)
        {
            $RegGrp = FALSE;
        }
        if($RegGrp != FALSE || ($Spl_case !=false && $RegGrp == FALSE))
        {
            $Spl_case = $this->uri->segment(4);
            $User_info_data = array('Inst_Id'=>$Inst_Id,'RegGrp'=>$RegGrp,'spl_case'=>$Spl_case);
            $user_info  =  $this->Registration_model->user_info($User_info_data);

        }
        else
        {
            if(!empty($_POST["chk"]))
            {

                $forms_id =   "'".implode("','",$_POST["chk"])."'";    
            }
            else{
                return;
            }
            $User_info_data = array('Inst_Id'=>$Inst_Id,'forms_id'=>$forms_id);
            $user_info  =  $this->Registration_model->user_info_Formwise($User_info_data); 

            // ////DebugBreak();

        }

        $info =  $this->feeFinalCalculate($User_info_data,$user_info,0);
        $data = $info['data'];

        $AllUser = $info['AllUser'];
        $status = $this->Registration_model->Batch_Insertion($data,$AllUser);
        if($status == 0)
        {
            //error
            $msg = '4';
            $this->session->set_flashdata('error',$msg);
            redirect('Registration/CreateBatch');
            return; 
        }
        else
        {
            redirect('Registration/BatchList');
            return; 
        }  



    }
    public function FormPrinting()
    {

        $this->load->library('session');
        //////DebugBreak();
        if(!( $this->session->flashdata('error'))){

            $error_msg = "";    
        }
        else{
            $error_msg = $this->session->flashdata('error');
        }
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/common_reg/header.php',$userinfo);
        $data = array(
            'isselected' => '2',
        );
        //  ////DebugBreak();
        $error = array();
        $error['excep'] = '';
        $error['gender'] = $userinfo['gender'];
        $error['isrural'] = $userinfo['isrural'];
        $error['error'] = $error_msg;
        $this->commonheader($data);
        $this->load->view('Registration/9th/FormPrinting.php',$error);
        // $this->load->view('common/common_reg/footer.php');
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));

        //$this->load->model('Registration_model');
    }
    public function Reg_Cards_Printing_9th()
    {

        $this->load->library('session');
        //  ////DebugBreak();
        if(!( $this->session->flashdata('error'))){

            $error_msg = "";    
        }
        else{
            $error_msg = $this->session->flashdata('error');
        }
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/common_reg/header.php',$userinfo);
        $data = array(
            'isselected' => '2',
        );
        //  ////DebugBreak();
        $error = array();
        $error['excep'] = '';
        $error['gender'] = $userinfo['gender'];
        $error['isrural'] = $userinfo['isrural'];
        $error['error'] = $error_msg;
        $this->commonheader($data);
        $this->load->view('Registration/9th/RegCards.php',$error);
        //$this->load->view('common/common_reg/footer.php');
        $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));

    }
    public function Reg_Cards_Printing_9th_PDF()
    {

        //   ////DebugBreak();
        $Condition = $this->uri->segment(4);
        /*
        $Condition  1 == Batch Id wise printing.
        2 == Final Group wise prining.
        3 == Final Formno wise Printing.
        4 == Proof reading Group wise Printing.
        5 == Proof reading Formno wise Printing.
        */
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        if($Condition == "1")
        {
            $Batch_Id = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
            $result = array('data'=>$this->Registration_model->return_pdf($fetch_data),'inst_Name'=>$user['inst_Name']);    
        }
        else if($Condition == "2")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>0);
            $result = array('data'=>$this->Registration_model->Print_Form_Groupwise($fetch_data));

        }

        else if($Condition == "3")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);


            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>0);
            $result = array('data'=>$this->Registration_model->Print_Form_Formnowise($fetch_data));
        }
        else if($Condition == "4")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_model->Print_Form_Groupwise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }
        else if($Condition == "5")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_model->Print_Form_Formnowise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }

        // ////DebugBreak();
        if(empty($result['data'])){
            $this->session->set_flashdata('error', 'No Record Found.');
            redirect('Registration/Reg_Cards_Printing_9th');
            return;

        }

        // $pdf->Image(base_url().'assets/pdfs/'.'/'.$image,6.3,0.5, 1.8, 0.20, "PNG");
        //$studeninfo['data']['info'][0]['barcode'] = $image;
        $this->load->library('PDF_Rotate');

        $turn=1;     
        $pdf = new PDF_Rotate('P','in',"A4");
        //$pdf=new FPDF_BARCODE("P","in","A4");
        $pdf->SetMargins(0.5,1.2,0.5);
        $pdf->AliasNbPages();

        $generatingpdf=false;
        $result = $result['data'] ;
        $inc=0 ;
        foreach ($result as $key=>$data) 
        {
            // ////DebugBreak();

            if($data['strRegNo'] == NULL)
            {
                $data['strRegNo'] = $this->Registration_model->generateStrNo($data['sex'],$data['formNo']) ;
            }

            $temp = str_replace("-","",$data['strRegNo']).'@09@'.sessReg;
            $image =  $this->set_barcode($temp);

            $generatingpdf=true;
            if($turn==1){$pdf->AddPage(); $dy=0.1;} else {
                if($turn==2){$dy=3.8;} else {$dy=7.5; $turn=0;}
            }
            $inc++;
            $turn++;
            $y = 0.05;
            $pdf->SetFont('Arial','U',16);
            $pdf->SetXY(1.2,$y+$dy+0.17);
            $pdf->Cell(0, $y, "Board of Intermediate and Secondary Education,Gujranwala", 0.25, "C");

            $pdf->Image(base_url()."assets/img/logo.jpg",0.3,$y+$dy+0.1, 0.60,0.60, "JPG", "http://www.bisegrw.com");
            $pdf->SetFont('Arial','',10);
            $y += 0.25;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(1.4,$y+$dy-0.00);
            $pdf->Cell(0, 0.25, "".Reg_Cards_9th_Heading." REGULAR STUDENT REGISTRATION CARD SESSION (".sessReg.")", 0.25, "C");

            $pdf->SetDrawColor(0,0,0);
            //  $pdf->PrintBarcode(6.2,0.25+$dy,trim(str_replace("-","",$data['strRegNo'])),0.25,0.013);    

            //--------------------------- Form No & Rno
            $pdf->SetXY(6,$y+$dy+0.1);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0.5,0.5,"Form No: _______________",0,'L');

            $pdf->SetXY(6.7,$y+$dy+0.08);
            $pdf->SetFont('Arial','IB',12);
            $pdf->Cell( 0.5,0.5,$data['formNo'],0,'L');

            //--------------------------- Registration Number  
            $pdf->SetXY(1.5,$y+0.1+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Registration No: ________________",0,'L');

            $pdf->SetFont('Arial','IB',12);
            $pdf->SetXY(2.6,$y+0.08+$dy);
            $pdf->Cell(0.5,0.5, $data['strRegNo'],0,'L');    
            //$pdf->Cell(0.5,0.5, $data['StrRegNo'],0,'L');    

            $pdf->Image(BARCODE_PATH.$image,4.1,$y+0.23+$dy, 1.8, 0.20, "PNG"); 



            //--------------------------- Institution Code and Name  
            $pdf->SetXY(0.2,$y+0.35+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Institution Code & Name:",0,'L');

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(1.78,$y+0.53+$dy);
            $pdf->MultiCell(6,0.15,$data["Sch_cd"]."-". $user['inst_Name'],0,'L',0);
            //$pdf->Cell(0.5,0.5, $data["Sch_cd"]."-". $user['inst_Name'],0,'L');    

            //------ Picture Box on Centre      .$data["Inst_Cd"].'/'. $data["PicPath"]
            $pdf->SetXY(6.5, $y+1+$dy);
            $pdf->Cell(1.25,1.4,'',1,0,'C',0);
            $pdf->Image(IMAGE_PATH. $data["Sch_cd"].'/'. $data["PicPath"],6.5, 1+ $y+$dy, 1.25, 1.4, "JPG");
            $pdf->SetFont('Arial','',10);

            //------------- Personal Infor Box    
            $x = 0.55;
            $y += 0.65;
            //--------------------------- 1st line 
            $font =  10;
            if(strlen($data["name"])>24 && strlen($data["name"])<32)
            {
                $font =  8.6;  
            }
            else if(strlen($data["name"])>=32)
            {
                $font =  8;  
            }





            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell( 0.5,0.5,"Name:",0,'L');
            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(1.7,$y+$dy);
            $pdf->Cell(0.5,0.5,$data["name"],0,'L');
            //--------------------------- FATHER NAME 
            $font =  10;
            if(strlen($data["Fname"])>24 && strlen($data["Fname"])<32)
            {
                $font =  8.6;  
            }
            else if(strlen($data["Fname"])>=32)
            {
                $font =  8;  
            }


            $pdf->SetXY(3.5+$x,$y+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Father Name:",0,'L');
            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(4.5+$x,$y+$dy);
            $pdf->Cell(0.5,0.5,$data["Fname"],0,'L');

            $y += 0.2;
            //--------------------------- 3rd line 
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0.5,0.5,"Date Of Birth:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$y+$dy);
            $pdf->Cell(0.5,0.5,'     '.date('d-m-Y',strtotime($data["Dob"])),0,'L');     
            //    $pdf->Cell(0.5,0.5,$data["Rel"]==1?"Muslim":"Non-Muslim",0,'L');

            $pdf->SetXY(3.5+$x,$y+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Gender:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$y+$dy);
            $pdf->Cell(0.5,0.5,$data["sex"]==1?"MALE":"FEMALE",0,'L');            

            //--------------------------- 4th line 
            //////DebugBreak();
            $y += 0.2;
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0.5,0.5,"Bay Form No:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$y+$dy);
            $pdf->Cell(0.5,0.5,'     '.$data["BForm"],0,'L');     
            //    $pdf->Cell(0.5,0.5,$data["Rel"]==1?"Muslim":"Non-Muslim",0,'L');

            $pdf->SetXY(3.5+$x,$y+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Father's CNIC:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$y+$dy);
            $pdf->Cell(0.5,0.5,$data["FNIC"],0,'L');     
            //========================================  Identification Mark
            $y += 0.2;
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Identification Mark:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.7,$y+$dy);
            $pdf->Cell(0.5,0.5, $data['markOfIden'],0,'L');

            //========================================  Exam Info 
            $y += 0.2;
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Group:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.7,$y+$dy);
            $grp_name = $data["grp_cd"];
            $sub8 = $data['sub7'];
            switch ($grp_name) {
                case '1':
                    $grp_name = 'SCIENCE WITH BIOLOGY';
                    break;
                case '7':
                    $grp_name = 'SCIENCE  WITH COMPUTER SCIENCE';
                    break;
                case '8':
                    $grp_name = 'SCIENCE  WITH ELECTRICAL WIRING';
                    break;
                case '2':
                    $grp_name = 'GENERAL';
                    break;
                case '5':
                    $grp_name = 'Deaf and Dumb';
                    break;
                default:
                $grp_name = "No Group Selected.";
            }

            switch ($sub8) {
                case '78':
                    $grp_name = 'SCIENCE  WITH COMPUTER SCIENCE';
                    break;
                case '43':
                    $grp_name = 'SCIENCE  WITH ELECTRICAL WIRING';
                    break;

            }


            $pdf->Cell(0.5,0.5, $grp_name,0,'L');

            $y += 0.2;
            $x = 1;                 
            //--------------------------- Subjects
            //  $y += 0.2;
            $pdf->SetFont('Arial','',10);
            //------------- sub 1 & 5
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell(0.5,0.5, '1. '.($data['sub1_NAME']),0,'L');
            $pdf->SetXY(3+$x,$y+$dy);
            $pdf->Cell(0.5,0.5, '5. '.($data['sub4_NAME']),0,'L');
            //------------- sub 2 & 6
            $pdf->SetXY(0.5,0.2+$y+$dy);
            $pdf->Cell(0.5,0.5, '2. '.($data['sub2_NAME']),0,'L');
            $pdf->SetXY(3+$x,0.2+$y+$dy);
            $pdf->Cell(0.5,0.5, '6. '.($data['sub5_NAME']),0,'R');
            //------------- sub 3 & 7
            $pdf->SetXY(0.5,0.4+$y+$dy);
            $pdf->Cell(0.5,0.5,  '3. '.($data['sub3_NAME']),0,'L');
            $pdf->SetXY(3+$x,0.4+$y+$dy);
            $pdf->Cell(0.5,0.5, '7. '.($data['sub6_NAME']),0,'R');
            //------------- sub 4 & 8
            $pdf->SetXY(0.5,0.6+$y+$dy);
            $pdf->Cell(0.5,0.5, '4. '.($data['sub8_NAME']),0,'L');
            $pdf->SetXY(3+$x,0.6+$y+$dy);
            $pdf->Cell(0.5,0.5, '8. '.($data['sub7_NAME']),0,'L');
            $y += 0.95;
            //------------- Signature
            $pdf->SetXY(0.2,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Head of the Institution: ___________________',0,'L');
            $pdf->SetXY(5.8,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Secretary: _________________',0,'L');    
            $pdf->Image('assets/img/sec_sign.png',6.5,$y+$dy-.2, .96, .6, "png");

            if ($turn>1){
                $y += 0.5;
                $pdf->Image(base_url()."assets/img/cut_line.png",0.3,$y+$dy, 7.5,0.15, "PNG");
            }
            /* if ($inc >4)
            {
            break;
            }  */

        }    

        if ($generatingpdf==true)
        {
            $pdf->Output('Registration Cards.pdf','I');
        } else {
            $containsError=true;
            $errorMessage = "<br />Your Institute does not have any student registration card(s) in accordance your selected group or form no. range.";
        }

    }
    public function ChallanForm_Reg9th_Regular()
    {
        ////DebugBreak();
        $Batch_Id = $this->uri->segment(3);
        $this->load->library('session');
        $this->load->library('NumbertoWord');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
        //$grp_cd = $this->uri->segment(3);
        // $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'formno'=>$formno);
        //  ////DebugBreak();
        $result = $this->Registration_model->Print_challan_Form($fetch_data);
        $this->load->library('PDF_RotateWithOutPage');

        $ctid=1;  //correction type of id starts from one and multiples by 2 for next type of correction id

        $feestructure[]    =  $result[0]['Total_ProcessingFee'];    
        $displayfeetitle[] =  'Total Processing Fee';    

        $feestructure[]    =  $result[0]['Total_RegistrationFee'];   
        $displayfeetitle[] =  'Total Registration Fee';   

        $feestructure[]    =  $result[0]['Total_LateRegistrationFee']; 
        $displayfeetitle[] =  'Total Late Registration Fee'; 

        $feestructure[]    =  $result[0]['COUNT']; 
        $displayfeetitle[] =  'Total Candidate(s)'; 

        /* $feestructure[]    =  $result[0]['TotalCertificateFee']; 
        $displayfeetitle[] =  'Total Certificate Fee';  */  

        $turn=1;     
        $pdf=new PDF_RotateWithOutPage("P","in","A4");
        $pdf->AliasNbPages();
        $pdf->SetTitle("Challan Form | Registration 9th ".sessReg." Batch Form Fee");
        $pdf->SetMargins(0.5,0.5,0.5);
        $pdf->AddPage();
        $generatingpdf=false;
        $challanCopy=array(1=>"Depositor Copy",  2=>"Registration Branch Copy",3=>"Bank Copy", 4=>"Board Copy",);
        $challanMSG=array(1=>"(May be deposited in any HBL Branch)",2=>"(To be sent to the Registration Branch Via BISE One Window)", 3=>"(To be retained with HBL)", 4=>"(Along with scroll)"  );
        $challanNo = $result[0]['Challan_No']; 
        // ////DebugBreak();
        // $User_info_data = array('Inst_Id'=>$user['Inst_Id'],'RegGrp'=>@$RegGrp,'spl_case'=>@$Spl_case);
        // $user_info  =  $this->Registration_model->getuser_info($User_info_data); 
        $isfine = 0;

        $User_info_data = array('Inst_Id'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
        $user_info  =  $this->Registration_model->user_info_Batch_Id($User_info_data); 

        //$User_info_data = array('Inst_Id'=>$Inst_Id,'RegGrp'=>$RegGrp,'spl_case'=>$Spl_case);
        //$user_info  =  $this->Registration_model->user_info($User_info_data);
       $data_Final = $this->feeFinalCalculate($User_info_data,$user_info,$Batch_Id);

        /*if($user['isSpecial']==1 && date('Y-m-d',strtotime($user['isSpecial_Fee']['FeedingDate']))>=date('Y-m-d')  )
        {
        $rule_fee[0]['Fine']   =  $user['isSpecial_Fee']['SpecialFee']; 
        $rule_fee[0]['Reg_Processing_Fee']   =  $user['isSpecial_Fee']['ProcessingFee']; 
        $rule_fee[0]['Reg_Fee']   =  $user['isSpecial_Fee']['RegFee']; 
        $rule_fee[0]['Rule_Fee_ID']   = 0; 
        $rule_fee[0]['isfine'] = 1; 
        $lastdate  = date('Y-m-d',strtotime($user['isSpecial_Fee']['FeedingDate'])) ;
        }
        else

        {
        if(date('Y-m-d',strtotime(SINGLE_LAST_DATE))>=date('Y-m-d'))
        {
        $rule_fee[0]['isfine'] = 0; 
        $lastdate  = date('Y-m-d',strtotime($user_info['rule_fee'][0]['End_Date'])) ;
        }
        else if($user_info['info'][0]['feedingDate'] != null)
        {
        $lastdate  = date('Y-m-d',strtotime($user_info['info'][0]['feedingDate'])) ;
        if(date('Y-m-d')<=$lastdate)
        {

        $rule_fee  =  $this->Registration_model->getreulefee(1);
        $rule_fee[0]['isfine'] = 0; 
        }
        else 
        {
        $rule_fee   =  $this->Registration_model->getreulefee(2);
        $rule_fee[0]['isfine'] = 1;
        }
        }
        else   if(date('Y-m-d',strtotime(DOUBLE_LAST_DATE))>date('Y-m-d'))
        {
        $isfine = 1;
        $rule_fee   =  $this->Registration_model->getreulefee(2);
        $rule_fee[0]['isfine'] = 1; 
        $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
        }  */
        //  ////DebugBreak();
        /*if(ISREADMISSION == 1)
        {
        $rule_fee  =  $this->Registration_model->getreulefee(1);
        $rule_fee[0]['isfine'] = 1; 
        $isfine = 1;
        }  */
        //  $data = array('data'=>$this->Registration_model->revenue_pdf($fetch_data),'inst_Name'=>$user['inst_Name'],'inst_cd'=>$user['Inst_Id'],'barcode'=>$image,"rulefee"=>$rule_fee);
        /* if($rule_fee[0]['isfine'] == 1)
        {
        // ////DebugBreak();
        $count = $result[0]["COUNT"];
        $data['data']["Total_RegistrationFee"] =  $count*$rule_fee[0]['Reg_Fee'] ;
        $data['data']["Total_ProcessingFee"] =  $count*$rule_fee[0]['Reg_Processing_Fee'] ;
        $data['data']["Total_LateRegistrationFee"] =  $count*$rule_fee[0]['Fine'] ;
        $data['data']["Amount"] = $data['data']["Total_RegistrationFee"]+ $data['data']["Total_ProcessingFee"]+$data['data']["Total_LateRegistrationFee"] ;
        $data['data']['batch_info'][0]['Batch_ID'] = $result[0]['Batch_ID'];

        array('myd'=>$this->Registration_model->UpdateBatchFee($data));
        } */

        //  } 
        /*if(date('Y-m-d',strtotime(SINGLE_LAST_DATE))>=date('Y-m-d'))
        {
        $rule_fee   =  $this->Registration_model->getreulefee(); 
        $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else
        {
        $rule_fee   =  $this->Registration_model->getreulefee(); 
        $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }  */
      // DebugBreak();
        $obj    = new NumbertoWord();
        $obj->toWords($result[0]['Amount'],"Only.","");
        // $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');
        $feeInWords = ucwords($obj->words);//strtoupper(cNum2Words($totalfee)); 

        //-------------------- PRINT BARCODE
        //  $pdf->SetDrawColor(0,0,0);
        // $temp = $user['Inst_Id'].'11-2017-19';
        //$image =  $this->set_barcode($temp);
        //  ////DebugBreak();
        $temp = $challanNo.'@'.$user['Inst_Id'].'@'.$Batch_Id;
        //  $image =  $this->set_barcode($temp);
        //////DebugBreak();
        $temp =  $this->set_barcode($temp);

        $yy = 0.05;
        $dyy = 0.1;
        $corcnt = 0;
        $lastdate = $data_Final['data']['lastdate'];
        $lastdate = date("d-m-Y", strtotime($lastdate));
        for ($j=1;$j<=4;$j++) 
        {
            $yy = 0.04;
            if($turn==1){$dyy=0.2;} 
            else {
                if($turn==2){$dyy=2.65;} else  if($turn==3) {$dyy=5.2; } else {$dyy=7.75 ; $turn=0;}
            }
            $corcnt = 0;
            $pdf->SetFont('Arial','B',11);
            $pdf->SetXY(1.0,$yy+$dyy);
            //   ////DebugBreak();
            $pdf->Cell(2.45, 0.4, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "L");
            $pdf->Image("assets/img/icon2.png",0.30,$yy+$dyy, 0.50,0.50, "PNG", "http://www.bisegrw.com");
            //  $pdf->Image(BARCODE_PATH.$Barcode,3.2, 1.15+$yy ,1.8,0.20,"PNG");
            $pdf->Image(BARCODE_PATH.$temp,5.8, $yy+$dyy+0.30 ,1.9,0.22,"PNG");

            //$pdf->SetXY(2.6,$y+0.08+$dy);
            $pdf->Image(assets.'9th.PNG',7.6, $yy+$dyy+0.05 ,0.20,0.22,"PNG");
            //$pdf->Image(assets.'/9th.PNG',4.5,$y+0.23+$dy, 1, 2.0, "PNG"); 

            $challanTitle = $challanCopy[$j];
            $generatingpdf=true;


            if($turn==1){$dy=0.5;} else {
                if($turn==2){$dy=3.0;} else  if($turn==3) {$dy=5.5; }else {$dy=8.1 ; $turn=0;}
            }
            $turn++;
            $y = 0.08;

            //$pdf->SetFont('Arial','BI',14);
            //$pdf->SetXY(5.5,$y+$dy);
            //$pdf->Image(BARCODE_PATH.$image,3.2, 0.61  ,1.8,0.20,"PNG");
            //$pdf->Cell(0.5, $y, $challanCopy[$j], 0.25, "L");

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(1.0,$y+$dy);
            $pdf->Cell(0.5, $y, $challanCopy[$j], 0.25, "L");
            $w = $pdf->GetStringWidth($challanCopy[$j]);
            $pdf->SetXY($w+1.2,$y+$dy);
            $pdf->SetFont('Arial','I',7);
            $pdf->Cell(0, $y, $challanMSG[$j], 0.25, "L");

            $pdf->SetXY($w+1.4,$y+$dy+0.15);
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(0, $y, 'Registration Session '.CURRENT_SESS.' ('.corr_bank_chall_class.')', 0.25, "L");

            $y += 0.25;
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.5,$y+$dy-0.01);
            $pdf->SetFillColor(0,0,0);
            $pdf->Cell(1.5,0.2,'',1,0,'C',1);
            $pdf->SetFillColor(255,255,255);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetXY(0.5,$y+$dy-0.01);
            $pdf->Cell(0, 0.25, "Due Date: ".$lastdate, 0.25, "C");
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(2.0,$y+$dy-0.04);                                                                                                
            $pdf->Cell(0, 0.25, "Printing Date: ".date("d/m/y",time())."         Account Title: BISE, GUJRANWALA             CMD Account No. 00427900072103", 0.25, "C");
            //CMD Account No. 00427900072103
            //--------------------------- Fee Description
            $pdf->SetXY(2.8,$y+$dy);
            $pdf->SetFont('Arial','U',8);
            $pdf->Cell(0.5,0.5,"Fee Description",0,'L');

            //  ////DebugBreak();
            //--------------------------- Challan Depositor Information
            $pdf->SetXY(4,$y+0.1+$dy);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.3,"Bank Challan No:".$result[0]['Challan_No']."           Batch No.".$result[0]['Batch_ID'],0,2,'L');
            $pdf->SetFont('Arial','U',9);
            $pdf->Cell(0.5,0.25, "Particulars of Depositor",0,2,'L');
            $pdf->SetX(4.0);
            $pdf->SetFont('Arial','B',8);

            //if(intval($result[0]['sex'])==1){$sodo="S/O ";}else{$sodo="D/O ";}
            // $pdf->Cell(0.5,0.25,$user['Inst_Id'].'-'.$user['inst_Name'],0,2,'L');
            // $pdf->Cell(0.5,0.25,,0,2,'L');
            $pdf->SetX(4);
            $pdf->SetFont('Arial','B',6.5);
            // ////DebugBreak();
            //$pdf->Cell(0.5,0.3,"Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0,2,'L');
            $pdf->MultiCell(4, .1, "Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0);
            $pdf->SetXY(4,$y+1.15+$dy);
            $pdf->SetFont('Arial','B',9);
            $pdf->MultiCell(4, .15, "Amount in Words: ".$feeInWords,0);
            //$pdf->Cell(0.5,0.3,"Amount in Words: ".$feeInWords,0,2,'L');

            $x = 0.55;
            $y += 0.2;

            //------------- Fee Statement
            //  ////DebugBreak();
            $ctid=1;
            $multiply=1;

            /*    foreach ($feestructure as $value) {
            //  $value = $value * 2;

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell( 0.5,0.5,$displayfeetitle[$ctid],0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(3,$y+$dy);
            $pdf->Cell(0.8,0.5,$feestructure[$ctid],0,'C');
            $ctid *= 2;
            $y += 0.18;
            }*/
            // ////DebugBreak();
            $total =  count($feestructure);
            for ($k = 0; $k<count($feestructure); $k++){


                $pdf->SetFont('Arial','',9);
                $pdf->SetXY(0.5,$y+$dy);

                //$feestructure = array(1=>0, 2=>0, 4=>0, 8=>0, 16=>0, 32=>0, 64=>0, 128=>0);
                $pdf->Cell( 0.5,0.5,$displayfeetitle[$k],0,'L');
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(3,$y+$dy);
                $pdf->Cell(0.8,0.5,$feestructure[$k],0,'C');
                $y += 0.18;
                $corcnt = $k;




            }

            //------------- Total Amount


            if($corcnt ==0){
                $y += 1.0;
            }
            else if($corcnt ==1){
                $y += .7;
            }
            else if($corcnt ==2){
                $y += .6;
            }
            else if($corcnt ==3){
                $y += .4;
            }
            else if($corcnt ==4){
                $y += .3;
            }
            else if($corcnt ==5){
                $y += .2;
            }

            else if($corcnt ==6){
                $y += .16;
            }
            $y += -0.2;
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(0.5,($y)+$dy-.15);
            $pdf->Cell( 0.5,0.5,"Total Amount(Rs.): ",0,'L');
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(3,$y+$dy-.15);
            $pdf->Cell(0.8,0.5,$result[0]['Amount'].'/-',0,'C');

            //------------- Signature
            $y += 0.2;
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Cashier: ___________________',0,'L');
            $pdf->SetXY(5.6,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Manager: _________________',0,'L');    

            if ($turn>1){
                $y += 0.4;
                $pdf->Image( base_url().'assets/img/cut_line.png' ,0.3,$y+$dy, 7.5,0.15, "PNG");   
                // $pdf->Image("images/cut_line.png",0.3,$y+$dy, 7.5,0.15, "PNG");
            }            
        }  
        if ($generatingpdf==true)
        {
            $pdf->Output('challanform.pdf','I');
        } 
        else
        {
            $containsError=true;
            $errorMessage = "<br />Your Institute does not have any student registration card in accordance with selected group or form no. range.";
        }  
    }


    public function feeFinalCalculate($User_info_data,$user_info,$isBatchExists)

    {
       // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];

        $isfeeding = $userinfo['isfeedingallow'];
        if($isfeeding == 1)
        {
            $is_gov =  $user_info['info'][0]['IsGovernment'];  
            /*====================  Counting Fee  ==============================*/
            $processing_fee = 0;
            $reg_fee           = 1000;
            $Lreg_fee          = 0;
            $TotalRegFee = 0;
            $TotalLatefee = 0;
            $Totalprocessing_fee = 0;
            $netTotal = 0;
            /*====================  Counting Fee  ==============================*/    
            if($userinfo['isSpecial']==1 && date('Y-m-d',strtotime($userinfo['isSpecial_Fee']['FeedingDate']))>=date('Y-m-d')  )
            {
                $rule_fee[0]['Fine']   =  $userinfo['isSpecial_Fee']['SpecialFee']; 
                $rule_fee[0]['readmfine']   =  $userinfo['isSpecial_Fee']['readmfine'];
                $rule_fee[0]['Reg_Processing_Fee']   =  $userinfo['isSpecial_Fee']['ProcessingFee']; 
                $rule_fee[0]['Reg_Fee']   =  $userinfo['isSpecial_Fee']['RegFee']; 
                $rule_fee[0]['Rule_Fee_ID']   = 0; 
                $lastdate  = date('Y-m-d',strtotime($userinfo['isSpecial_Fee']['FeedingDate'])) ;
            }
            else
            {  
                if(date('Y-m-d',strtotime(SINGLE_LAST_DATE))>=date('Y-m-d'))
                {
                    $rule_fee   =  $this->Registration_model->getreulefee(1); 
                    $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
                }
                else if($user_info['info'][0]['feedingDate'] != null)
                {
                    $lastdate  = date('Y-m-d',strtotime($user_info['info'][0]['feedingDate'])) ;
                    if(date('Y-m-d')<=$lastdate)
                    {
                        $rule_fee  =  $this->Registration_model->getreulefee(1); 
                        $is_gov    =  $user_info['info'][0]['IsGovernment'];   
                    }
                    else
                    {
                        $rule_fee  =  $this->Registration_model->getreulefee(2); 
                    }

                }
                else if(date('Y-m-d',strtotime(DOUBLE_LAST_DATE))>=date('Y-m-d'))
                {
                    $rule_fee   =  $this->Registration_model->getreulefee(2); 
                    $lastdate  = date('Y-m-d',strtotime($rule_fee[0]['End_Date'] )) ;
                } 
                if($is_gov == 1 && $rule_fee[0]['Rule_Fee_ID'] ==1)
                {
                    $reg_fee = 0;
                    $Lreg_fee = $rule_fee[0]['Fine'];
                    $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];
                }
                else
                {
                    $reg_fee = $rule_fee[0]['Reg_Fee'];
                    $Lreg_fee = $rule_fee[0]['Fine'];
                    $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];
                }
            }
            $q1 = $user_info['fee'];
            $total_std = 0;
            $total_record = 0;
            //$rule_fee[0]['readmfine'] = 0;
            $AllUser = array();
            foreach($q1 as $k=>$v) 
            {
                $ids[] = $v["formNo"];
                $total_std++;
                if(date('Y-m-d', strtotime($v["edate"] ))<= $lastdate) 
                {
                    if($is_gov == 1 &&   $rule_fee[0]['Rule_Fee_ID'] ==1)
                    {
                        if($v['IsReAdm']==1)
                        {
                            $Lreg_fee = $rule_fee[0]['readmfine']; 
                        }
                        else
                        {
                            $Lreg_fee = $rule_fee[0]['Fine'];
                        }
                        $reg_fee = 0;

                        $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];
                    }
                    else
                    {
                        if($v['IsReAdm']==1)
                        {
                            $Lreg_fee = $rule_fee[0]['readmfine']; 
                        }
                        else
                        {
                            $Lreg_fee = $rule_fee[0]['Fine'];
                        }
                        $reg_fee = $rule_fee[0]['Reg_Fee'];

                        $processing_fee = $rule_fee[0]['Reg_Processing_Fee'];

                    }

                    if($v["Spec"] == 1 || $v["Spec"] ==  2 )
                    {
                        $reg_fee = 0;
                        $TotalLatefee = $TotalLatefee + $Lreg_fee;
                        $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                    }

                    else 
                    {
                        $TotalRegFee = $TotalRegFee + $reg_fee;
                        $TotalLatefee = $TotalLatefee + $Lreg_fee;
                        $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                    } 
                } 
                else
                {
                    if($v['IsReAdm']==1)
                    {
                        $Lreg_fee = $rule_fee[0]['readmfine']; 
                    }
                    else
                    {
                        $Lreg_fee = $rule_fee[0]['Fine'];
                    }
                    $reg_fee = $rule_fee[0]['Reg_Fee'];
                    $TotalRegFee = $TotalRegFee + $reg_fee;
                    $TotalLatefee = $TotalLatefee + $Lreg_fee;
                    $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                } // end of Else

                $netTotal = (int)$netTotal +$reg_fee + $Lreg_fee+$processing_fee;
                $AllUser[$total_record]['regFee'] = $reg_fee;
                $AllUser[$total_record]['RegFineFee'] = $Lreg_fee;
                $AllUser[$total_record]['RegProcessFee'] = $processing_fee;
                $AllUser[$total_record]['RegTotalFee'] = $reg_fee+$Lreg_fee+$processing_fee;
                $AllUser[$total_record]['formNo'] = $v["formNo"];

                $total_record++;
            }
            $Lreg_fee = $rule_fee[0]['Fine'];
            if($Lreg_fee == '')
            {
                $Lreg_fee = 0;
            }
            $forms_id   = implode(",",$ids);        
            $tot_fee     = $Totalprocessing_fee+$TotalRegFee+$TotalLatefee;
            $today = date("Y-m-d H:i:s");
            $data = array('inst_cd'=>$user_info['info'][0]['Inst_cd'] ,'total_fee'=>$tot_fee,'proces_fee'=>$processing_fee,'reg_fee'=>$reg_fee,'fine'=>$Lreg_fee,'TotalRegFee'=>$TotalRegFee,'TotalLatefee'=>$TotalLatefee,'Totalprocessing_fee'=>$Totalprocessing_fee,'forms_id'=>$forms_id,'todaydate'=>$today,'total_std'=>$total_std);
            if($isBatchExists != 0)    
            {
                ////DebugBreak();
                $data['data']["Total_RegistrationFee"] = $TotalRegFee;
                $data['data']["Total_ProcessingFee"] = $Totalprocessing_fee;
                $data['data']["Total_LateRegistrationFee"] =     $TotalLatefee;
                $data['data']["Amount"] = $tot_fee;
                $data['data']['batch_info'][0]['Batch_ID'] = $isBatchExists;
                
                $data['rulefee']=$rule_fee;
                $data['lastdate'] = $lastdate;
                $data['Alluser']=$AllUser;
                //$data['rule_fee'][];

                array('myd'=>$this->Registration_model->UpdateFee_Final($data));

            }
        }
        else
        {
            //DebugBreak();
            $q1 = $user_info['fee'];
            $total_std = 0;
            $total_record = 0;
            $TotalRegFee =0;
            $TotalLatefee = 0;
            $rule_fee[0]['readmfine'] = 0;
            $AllUser = array();
            foreach($q1 as $k=>$v) 
            {
                $ids[] = $v["formNo"];
                $total_std++;

                $reg_fee = $q1[$total_std]['regFee'];
                $Lreg_fee = $q1[$total_std]['RegFineFee'];
                $processing_fee = $q1[$total_std]['RegProcessFee'];
                $TotalRegFee = $TotalRegFee + $reg_fee;
                $TotalLatefee = $TotalLatefee + $Lreg_fee;
                $Totalprocessing_fee = $Totalprocessing_fee + $processing_fee;
                // end of Else

                $netTotal = (int)$netTotal +$reg_fee + $Lreg_fee+$processing_fee;
                $AllUser[$total_record]['regFee'] = $reg_fee;
                $AllUser[$total_record]['RegFineFee'] = $Lreg_fee;
                $AllUser[$total_record]['RegProcessFee'] = $processing_fee;
                $AllUser[$total_record]['RegTotalFee'] = $reg_fee+$Lreg_fee+$processing_fee;
                $AllUser[$total_record]['formNo'] = $v["formNo"];

                $total_record++;
            }
            $tot_fee     = $Totalprocessing_fee+$TotalRegFee+$TotalLatefee;
            $data['data']["Total_RegistrationFee"] = $TotalRegFee;
            $data['data']["Total_ProcessingFee"] = $Totalprocessing_fee;
            $data['data']["Total_LateRegistrationFee"] =     $TotalLatefee;
            $data['data']["Amount"] = $tot_fee;
            $data['data']['batch_info'][0]['Batch_ID'] = $isBatchExists;
            $data['rulefee']=$rule_fee;
            $data['Alluser']=$AllUser;
        }


       // DebugBreak();
        return $information = array('data'=>$data,'AllUser'=>$AllUser);

    }
    private function set_barcode($code)
    {
        //DebugBreak()  ;
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');


        $file = Zend_Barcode::draw('code128','image', array('text' => $code,'drawText'=>false), array());
        //$code = $code;
        $store_image = imagepng($file,BARCODE_PATH."{$code}.png");
        return $code.'.png';

    }
    public function return_pdf()
    {

        // ////DebugBreak();
        $Condition = $this->uri->segment(4);
        /*
        $Condition  1 == Batch Id wise printing.
        2 == Final Group wise prining.
        3 == Final Formno wise Printing.
        4 == Proof reading Group wise Printing.
        5 == Proof reading Formno wise Printing.
        */
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        if($Condition == "1")
        {
            $Batch_Id = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
            $result = array('data'=>$this->Registration_model->return_pdf($fetch_data),'inst_Name'=>$user['inst_Name']);    
        }
        else if($Condition == "2")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>0);
            $result = array('data'=>$this->Registration_model->Print_Form_Groupwise($fetch_data));

        }

        else if($Condition == "3")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);


            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>0);
            $result = array('data'=>$this->Registration_model->Print_Form_Formnowise($fetch_data));
        }
        else if($Condition == "4")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_model->Print_Form_Groupwise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }
        else if($Condition == "5")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_model->Print_Form_Formnowise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }

        // ////DebugBreak();
        if(empty($result['data'])){
            $this->session->set_flashdata('error', 'No Record Found');
            redirect('Registration/FormPrinting');
            return;

        }
        $temp = $user['Inst_Id'].'@09@'.sessReg;
        $image =  $this->set_barcode($temp);
        // $pdf->Image(base_url().'assets/pdfs/'.'/'.$image,6.3,0.5, 1.8, 0.20, "PNG");
        //$studeninfo['data']['info'][0]['barcode'] = $image;
        $this->load->library('PDF_Rotate');


        $pdf = new PDF_Rotate('P','in',"A4");
        $pdf->Rotate(0,-1,-1);
        //   $pdf->SetFont('Arial','B',50);
        //             $pdf->SetTextColor(255,192,203);
        //             $pdf->Rotate(35,190,'W a t e r m a r k   d e m o',45);
        $pdf->AliasNbPages();
        if($Condition==4 or $Condition == 5)
        {
            $pdf->SetTitle('Proof Print of Return');   
        }
        else
        {
            $pdf->SetTitle('Final Print of Return');
        }


        $pdf->SetMargins(0.5,0.5,0.5);
        $lmargin =0.5;
        $rmargin =7.5;
        $topMargin = 0.5;
        $countofrecords=14;
        $title=1.0;
        $cnt=0; $ln[0]=1.5;
        $SR=1;
        while($cnt<15) 
        {
            $cnt++;
            $ln[$cnt]=$ln[$cnt-1]+ 0.6;  //0.5;
        }

        $i = 4;
        $result = $result['data'] ;
        // ////DebugBreak();
        foreach ($result as $key=>$data) 
        {
            //////DebugBreak();
            //////DebugBreak();
            $i++;
            $countofrecords=$countofrecords+1;
            if($countofrecords==15) {
                $countofrecords=0;

                $pdf->AddPage();

                //     $pdf->SetFont('Arial','B',50);
                //                 $pdf->SetTextColor(255,192,203);
                //                 $pdf->Rotate(35,190,'W a t e r m a r k   d e m o',45);


                if($Condition==4 or $Condition == 5)
                {
                    $pdf->Image( base_url().'assets/img/PROOF_READ.jpg' ,1,3.5 , 6,4 , "JPG");     
                }

                $pdf->SetFont('Arial','U',14);
                $pdf->SetXY( 0.4,0.2);
                $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(1.7,0.4);
                $pdf->Cell(0, 0.25, "SSC/MATRIC PART-I ENROLMENT RETURN SESSION (".sessReg.")", 0.25, "C");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(2.6,0.4);
                $pdf->Image(BARCODE_PATH.$image,6.3,0.43, 1.8, 0.20, "PNG"); 
                $pdf->SetFont('Arial','',8);
                $pdf->SetXY(0.5,0.66);
                //$pdf->Cell(0, 0.25,$user['Inst_Id']. "-". $user['inst_Name'], 0.25, "C");

                $pdf->MultiCell(7.5, .1, $user['Inst_Id']. "-". $user['inst_Name'],0);


                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(6.8,0.8);
                $pdf->Cell(0, 0.25,  'Gender: '. ($data['sex']==1?"MALE":"FEMALE" ), 0.25, "C");
                $grp_name = $data["RegGrp"];
                switch ($grp_name) {
                    case '1':
                        $grp_name = 'SCIENCE WITH BIOLOGY';
                        break;
                    case '7':
                        $grp_name = 'SCIENCE  WITH COMPUTER SCIENCE';
                        break;
                    case '8':
                        $grp_name = 'SCIENCE  WITH ELECTRICAL WIRING';
                        break;
                    case '2':
                        $grp_name = 'GENERAL';
                        break;
                    case '5':
                        $grp_name = 'Deaf and Dumb';
                        break;
                    default:
                        $grp_name = "No Group Selected.";
                }
                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(0.5,0.8);
                $pdf->Cell(0, 0.25,  'Group: '.$grp_name, 0.25, "C");


                $pdf->rect($lmargin,1,$rmargin,10.5);                //the main rectangle box
                $cnt=-1;

                while($cnt<15) 
                { 
                    $cnt++;
                    $pdf->Line($lmargin, $ln[$cnt],$rmargin+.5,$ln[$cnt]);    
                }


                $col1=$lmargin+.3;    
                $col2=$col1+0.9;    
                $col3=$col2+1.8;
                $col4=$col3+1.1;    
                $col5=$col4+1.0;    
                $col6=$col5+1.8;

                $pdf->Line($col1,$title,$col1,$ln[15]);
                $pdf->Line($col2,$title,$col2,$ln[15]);
                $pdf->Line($col3,$title,$col3,$ln[15]);
                $pdf->Line($col4,$title,$col4,$ln[15]);
                $pdf->Line($col5,$title,$col5,$ln[15]);
                $pdf->Line($col6,$title,$col6,$ln[15]);

                $pdf->SetFont('Arial','B',9);
                $pdf->Text($lmargin+.03,$title+.3,"Sr#");    //$pdf->Text(3,3,"TEXT TO DISPLAY");
                $pdf->Text($col1+.2,$title+.3,"FormNo.");

                $pdf->Text($col2+.1,$title+.2,"Name / Father`s Name");
                $pdf->Text($col2+.1,$title+.4,"Mobile No");

                $pdf->Text($col3+.1,$title+.2,"Bay Form No"); 
                $pdf->Text($col3+.1,$title+.4,"Father CNIC");

                $pdf->Text($col4+.1,$title+.2,"Date Of Birth");
                $pdf->Text($col4+.1,$title+.31,"Religion");
                $pdf->Text($col4+.1,$title+.45,"Old RNo-Year");

                $pdf->Text($col5+.1,$title+.3,"Subjects");

                $pdf->Text($col6+.1,$title+.3,"Picture");
            }
            $dob = date("d-m-Y", strtotime($data["Dob"]));
            $adm = date("d-m-Y", strtotime($data["edate"]));

            //============================ Values ==========================================            
            $pdf->SetFont('Arial','',10);    
            $pdf->Text($lmargin+.03  , $ln[$countofrecords]+0.3 , $SR);                 // Sr No
            $pdf->Text($col1+.05    , $ln[$countofrecords]+0.3,$data["formNo"]);       // Form No

            $pdf->SetFont('Arial','B',8);    
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.2,strtoupper($data["name"]));
            $pdf->SetFont('Arial','',8);                
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.4,strtoupper($data["Fname"]));
            $pdf->SetFont('Arial','',7.5);                
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.55,$data["CellNo"]);
            $pdf->SetFont('Arial','',8);
            $pdf->Text($col3+.1,$ln[$countofrecords]+0.2,$data["BForm"]);
            $pdf->Text($col3+.1,$ln[$countofrecords]+0.4,$data["FNIC"]);

            $pdf->Text($col4+.1,$ln[$countofrecords]+0.2,$dob);
            $pdf->Text($col4+.1,$ln[$countofrecords]+0.4,$data["rel"]==1?"Muslim":"Non-Muslim");

            if($data["IsReAdm"] == '1' )
                $pdf->Text($col4+.1,$ln[$countofrecords]+0.55,strtoupper($data["oldRno_reg"]).'-'.$data["oldYear_reg"]);
            //$pdf->Text($col4+.1,$ln[$countofrecords]+0.55,'(Re-Admission)');
            else
                $pdf->Text($col4+.1,$ln[$countofrecords]+0.55,'(NEW)');

            $pdf->SetFont('Arial','B',7);    
            //            $pdf->Text($col5+.05,$ln[$countofrecords]+0.2,GroupName($data["Grp_Cd"]));
            $pdf->Text($col5+.05,$ln[$countofrecords]+0.2,  $data["sub1_abr"].','.$data["sub2_abr"].','.$data["sub3_abr"].','.$data["sub8_abr"]);
            $pdf->SetFont('Arial','',7);    
            $pdf->Text($col5+.05,$ln[$countofrecords]+0.4,$data["sub4_abr"].','.$data["sub5_abr"].','.$data["sub6_abr"].','.$data["sub7_abr"]);

            $pdf->Image(IMAGE_PATH.$data["Sch_cd"].'/'.$data["PicPath"],$col6+0.05,$ln[$countofrecords]+0.05 , 0.50, 0.50, "JPG"); 

            ++$SR;


            //Certified that I have checked all the relevant record of the students and the particulars as mentioned above are correct.
            $pdf->SetFont('Arial','',8);
            $pdf->Text($lmargin+.5,10.8,"Certified that I have checked all the relevant record of the students and the particulars as mentioned above are correct.");
            //$pdf->Text($lmargin+.5,11,"Signature _____________________");
            $pdf->SetFont('Arial','',10);
            $pdf->Text($rmargin-2.5,11.2,"_____________________________________");
            $pdf->Text($rmargin-2.5,11.4,"Signature of Head of Institution with Stamp");
            $pdf->Text($lmargin+0.5,11.4,'Print Date: '. date('d-m-Y H:i:s a'));    

        }
        $pdf->Output($data["Sch_cd"].'.pdf', 'I');
    }
    public function revenue_pdf()
    {    

        ////DebugBreak();

        $Batch_Id = $this->uri->segment(3);
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
        $temp = $user['Inst_Id'].'@09@'.sessReg.'';
        $image =  $this->set_barcode($temp);

        //  ////DebugBreak();    
        $User_info_data = array('Inst_Id'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
        $user_info  =  $this->Registration_model->user_info_Batch_Id($User_info_data); 

        //$User_info_data = array('Inst_Id'=>$Inst_Id,'RegGrp'=>$RegGrp,'spl_case'=>$Spl_case);
        //$user_info  =  $this->Registration_model->user_info($User_info_data);
        $mango_info = $this->feeFinalCalculate($User_info_data,$user_info,$Batch_Id);
        $data = array('data'=>$this->Registration_model->revenue_pdf($fetch_data),'inst_Name'=>$user['inst_Name'],'inst_cd'=>$user['Inst_Id'],'barcode'=>$image,"rulefee"=>$mango_info['data']['rulefee']);
        $isfine = 0;
        $this->load->view('Registration/9th/RevenueForm.php',$data);
    }
    public function commonheader($data)
    {
        $this->load->view('common/common_reg/header.php',$data);
        $this->load->view('common/menu.php',$data);
    } 
    public function commonfooter($data)
    {
        $this->load->view('common/common_reg/footer.php',$data);
    }
    public function Print_Registration_Form_Proofreading_Groupwise()
    {

        //  ////DebugBreak();
        $Condition = $this->uri->segment(4);

        $this->load->library('session');

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');

        if($Condition == "1")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_model->Print_Form_Groupwise($fetch_data),'inst_Name'=>$user['inst_Name']);
        }
        else if($Condition == "2")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>-1);
            $result = array('data'=>$this->Registration_model->Print_Form_Formnowise($fetch_data),'inst_Name'=>$user['inst_Name']);
            //Print_Form_Formnowise
        }


        if(empty($result['data'])){
            $this->session->set_flashdata('error', 'No Record Found');
            redirect('Registration/FormPrinting');
            return;

        }


        $this->load->library('PDF_Rotate');


        $pdf = new PDF_Rotate('P','in',"A4");
        //      $this->load->library('PDFF');
        //        $pdf=new PDFF('P','in',"A4");  
        $pdf->AliasNbPages();
        $pdf->SetMargins(0.5,0.5,0.5);
        $grp_cd = $this->uri->segment(3);

        $pdf->SetTitle('Proof Print Registration From');

        $fontSize = 10;
        $marge    = .4;   // between barcode and hri in pixel
        $x        = 7.5;  // barcode center
        $y        = 1.2;  // barcode center
        $height   = 0.35;   // barcode height in 1D ; module size in 2D
        $width    = .013;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $type     = 'code128';
        $black    = '000000'; // color in hex
        // ////DebugBreak();
        $result = $result['data'] ;
        //if(!empty($result)):
        foreach ($result as $key=>$data) 
        {

            //First Page ---class instantiation    
            //$pdf = new FPDF_BARCODE("P","in","A4");
            $pdf->AddPage();
            $Y = 0.5;


            $pdf->SetFillColor(0,0,0);
            $pdf->SetDrawColor(0,0,0); 

            $temp = $data['formNo'].'@09@'.regyear.'@1';
            $image =  $this->set_barcode($temp);
            $pdf->Image(BARCODE_PATH.$image,6.0, 1.2  ,1.8,0.20,"PNG");
            $pdf->SetFont('Arial','U',16);
            $pdf->SetXY( 1.2,0.2);
            $pdf->Cell(0, 0.2, "Board Of Intermediate and Secondary Education,Gujranwala", 0.25, "C");
            $pdf->Image(base_url()."assets/img/logo2.PNG",0.05,0.2, 0.75,0.75, "PNG", "http://www.bisegrw.com");


            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(1.7,0.4);
            $pdf->Cell(0, 0.25, " REGISTRATION FORM FOR SSC/MATRIC SESSION ".sessReg."", 0.25, "C");
            $pdf->Image(base_url(). 'assets/img/PROOF_READ.jpg' ,1,3.5 , 6,4 , "JPG");     
            //--------------- Proof Read
            $ProofReed = "NOT FOR BOARD, ONLY FOR PROOF READING";
            $pdf->SetXY(3,0.8);
            $pdf->SetFont("Arial",'',12);
            $pdf->Cell(0, 0.25, $ProofReed  ,0,'C');

            //--------------------------- Form No & Rno
            $pdf->SetXY(0.2,0.5+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Form No: _______________",0,'L');

            $pdf->SetXY(0.8,0.5+$Y);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell( 0.5,0.5,$data['formNo'],0,'L');

            //--------------------------- Institution Code and Name   $user['Inst_Id']. "-". $user['inst_Name']
            $pdf->SetXY(0.2,0.85+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Institution Code/Name:",0,'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.75,0.95+$Y);
            $pdf->MultiCell(6, .15, $user['Inst_Id']."-".$user['inst_Name'], 0);
            // $pdf->Cell(0.5,0.5,  $user['Inst_Id']. "-". $user['inst_Name'],0,'L');    

            //------ Picture Box on Centre      
            $pdf->SetXY(6.8, $Y +1.75);
            $pdf->Cell(1.25,1.4,'',1,0,'C',0);

            $pdf->Image(IMAGE_PATH.$data["Sch_cd"].'/'.$data["PicPath"],6.8, 1.75+ $Y, 1.25, 1.4, "JPG"); 
            $pdf->SetFont('Arial','',10);

            //------------- Personal Infor Box
            //====================================================================================================================

            $x = 0.55;
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.2,1.28+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.3,'PERSONAL INFORMATION',1,0,'L',1);
            $Y = 0.3;
            //--------------------------- 1st line 
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,1.65+$Y);
            $pdf->Cell( 0.5,0.5,"Name:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,1.65+$Y);
            $pdf->Cell(0.5,0.5,  strtoupper($data["name"]),0,'L');
            //--------------------------- FATHER NAME 
            $pdf->SetXY(3.5+$x,1.65+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Father Name:.",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,1.65+$Y);
            $pdf->Cell(0.5,0.5, strtoupper($data["Fname"]),0,'L');


            //--------------------------- 3rd line 
            $pdf->SetXY(0.5,$Y+ 2);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Date Of Birth:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,2+$Y);

            $pdf->Cell(0.5,0.5,date('d-m-Y', strtotime($data['Dob'])),0,'L');     
            //    $pdf->Cell(0.5,0.5,$data["Rel"]==1?"Muslim":"Non-Muslim",0,'L');

            $pdf->SetXY(3.5+$x,2+$Y);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Gender:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,2+$Y);
            $pdf->Cell(0.5,0.5,$data["sex"]==1?"MALE":"FEMALE",0,'L');            
            //--------------------------- BAY FORM NO line 
            $pdf->SetXY(0.5,$Y+2.35);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Bay Form No:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+2.35);
            $pdf->Cell(0.5,0.5,$data["BForm"],0,'L');


            $pdf->SetXY(3.5+$x,$Y+2.35);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0.5,0.5,"Father CNIC:",0,'R');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$Y+2.35);
            $pdf->Cell(0.5,0.5,$data["FNIC"],0,'L');
            //---------------------------  
            $spl_casename = 'NONE';
            if($data["Spec"] == 0)
            {
                $spl_casename = 'NONE';
            }
            else  if($data["Spec"] == 1)
            {
                $spl_casename = 'DEAF & DUMB';  
            }
            else  if($data["Spec"] == 2)
            {
                $spl_casename = 'BOARD EMPLOYEE';
            }


            $pdf->SetXY(0.5,$Y+2.7);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Speciality:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+2.7);
            $pdf->Cell(0.5,0.5, ($spl_casename),0,'L');

            $pdf->SetXY(3.5+$x,$Y+2.7);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0.5,0.5,"Locality:",0,'R');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$Y+2.7);
            $pdf->Cell(0.5,0.5,$data["RuralORUrban"]==1?"URBAN":"RURAL",0,'L');

            //--------------------------- Gender Nationality 
            $pdf->SetXY(0.5,$Y+3.05);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Medium:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+3.05);
            $pdf->Cell(0.5,0.5,$data["med"]==1?"URDU":"ENGLISH",0,'L');            

            $pdf->SetXY(3.5+$x,$Y+3.05);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Nationality:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$Y+3.05);
            $pdf->Cell(0.5,0.5,$data["nat"]==1?"PAKISTANI":"NON-PAKISTANI",0,'R');             
            //--------------------------- id mark and Medium 
            $pdf->SetXY(0.5,$Y+3.40);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Ident Mark:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+3.40);
            $pdf->Cell(0.5,0.5,strtoupper($data["markOfIden"]),0,'L');

            $pdf->SetXY(3.5+$x,$Y+3.40);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Religion:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$Y+3.40);
            $pdf->Cell(0.5,0.5,$data["rel"]==1?"MUSLIM":"NON-MUSLIM",0,'L');            
            //             $pdf->Cell(0.5,0.5, $data["MobNo"],0,'L');
            //----- Contact No.    
            $pdf->SetXY(0.5,$Y+3.75);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Mobile No:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,$Y+3.75);
            $pdf->Cell(0.5,0.5, $data["MobNo"],0,'L');


            $pdf->SetXY(3.5+$x,$Y+3.75);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Hafiz-e-Quran:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(4.5+$x,$Y+3.75);
            $pdf->Cell(0.5,0.5,$data["Ishafiz"]==1?"No":"Yes",0,'L');


            $pdf->SetXY(0.5,$Y+4.1);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Address:",0,'L');
            $pdf->SetFont('Arial','b',10);
            $pdf->SetXY(1.5,$Y + 4.1);
            $pdf->Cell(0.5,0.5, strtoupper($data["addr"]),0,'L');
            //========================================  Exam Info ===============================================================================            
            $sY = -1.2;//0.5;
            $pdf->SetXY(0.2,6.1+$sY);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.3,'SUBJECT INFORMATION',1,0,'L',1);

            //--------------------------- Subject Group
            $grp_name = $data["RegGrp"];
            switch ($grp_name) {
                case '1':
                    $grp_name = 'SCIENCE WITH BIOLOGY';
                    break;
                case '7':
                    $grp_name = 'SCIENCE  WITH COMPUTER SCIENCE';
                    break;
                case '8':
                    $grp_name = 'SCIENCE  WITH ELECTRICAL WIRING';
                    break;
                case '2':
                    $grp_name = 'GENERAL';
                    break;
                case '5':
                    $grp_name = 'Deaf and Dumb';
                    break;
                default:
                    $grp_name = "No Group Selected.";
            }
            $pdf->SetXY(0.5,6.45+$sY);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell( 0.5,0.5,"Subject Group:",0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(1.5,6.45+$sY);
            $pdf->Cell(0.5,0.5, ($grp_name),0,'L');

            $y = $sY - 0.3;
            $x = 1;
            //--------------------------- Subjects
            $pdf->SetFont('Arial','',10);
            //////DebugBreak();
            //------------- sub 1 & 5
            $pdf->SetXY(0.5,7.05+$y);
            $pdf->Cell(0.5,0.5, '1. '.($data['sub1_NAME']),0,'L');
            $pdf->SetXY(3+$x,7.05+$y);
            $pdf->Cell(0.5,0.5, '5. '.($data['sub4_NAME']),0,'L');
            //------------- sub 2 & 6
            $pdf->SetXY(0.5,7.35+$y);
            $pdf->Cell(0.5,0.5, '2. '.($data['sub2_NAME']),0,'L');
            $pdf->SetXY(3+$x,7.35+$y);
            $pdf->Cell(0.5,0.5, '6. '.($data['sub5_NAME']),0,'R');
            //------------- sub 3 & 7
            $pdf->SetXY(0.5,7.70+$y);
            $pdf->Cell(0.5,0.5,  '3. '.($data['sub3_NAME']),0,'L');
            $pdf->SetXY(3+$x,7.70+$y);
            $pdf->Cell(0.5,0.5, '7. '.($data['sub6_NAME']),0,'R');
            //------------- sub 4 & 8
            $pdf->SetXY(0.5,8.05+$y);
            $pdf->Cell(0.5,0.5, '4. '.($data['sub8_NAME']),0,'L');
            $pdf->SetXY(3+$x,8.05+$y);
            $pdf->Cell(0.5,0.5, '8. '.($data['sub7_NAME']),0,'L');


            $pdf->SetFont('Arial','U',10);  
            $pdf->SetXY(5.6,  6.9);
            $date = strtotime($data['edate']); 
            $pdf->Cell(8,0.24,'Feeding Date: '. date('d-m-Y h:i:s a', $date) ,0,'L','');

            //date_format($$data['EDate'], 'd/m/Y H:i:s');

            $pdf->SetXY(5.6,  7.2);
            $pdf->Cell(8,0.24,'Print Date: '. date('d-m-Y h:i:s a'),0,'L','');

            $pdf->SetXY(0.6,  8.8);
            $pdf->Cell(8,0.24,'Candidate\'s Signature ',0,'L','');

            //======================================================================================
        }

        $pdf->Output($data["Sch_cd"].'.pdf', 'I');
    }
    public function forwarding_pdf()
    {

        //////DebugBreak();

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');

        $Batch_Id = $this->uri->segment(3);
        if($Batch_Id > 0)
        {
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
            $result = array('data'=>$this->Registration_model->forwarding_pdf_final($fetch_data),'inst_Name'=>$user['inst_Name']);
        }
        else
        {
            $Batch_Id = 0;
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
            $result = array('data'=>$this->Registration_model->forwarding_pdf_final($fetch_data),'inst_Name'=>$user['inst_Name']);
        }


        if(empty($result['data'])){
            $this->session->set_flashdata('error', 'No Record Found');
            redirect('Registration/FormPrinting');
            return; }


        $temp = $user['Inst_Id'].'@09@'.sessReg.'';
        $image =  $this->set_barcode($temp);
        // $pdf->Image(base_url().'assets/pdfs/'.'/'.$image,6.3,0.5, 1.8, 0.20, "PNG");
        //$studeninfo['data']['info'][0]['barcode'] = $image;
        $this->load->library('PDF_RotateWithOutPage');
        $pdf = new PDF_RotateWithOutPage('P','in',"A4");
        $pdf->Rotate(0,-1,-1);
        //   $pdf->SetFont('Arial','B',50);
        //             $pdf->SetTextColor(255,192,203);
        //             $pdf->Rotate(35,190,'W a t e r m a r k   d e m o',45);
        $pdf->AliasNbPages();
        $pdf->SetTitle('Forwarding Letter');
        $pdf->SetMargins(0.5,0.5,0.5);
        $lmargin =0.5;
        $rmargin =7.5;
        $topMargin = 0.5;
        $countofrecords=14;
        $title=1.0;
        $cnt=0; $ln[0]=1.5;
        $SR=1;

        $pdf->SetAutoPageBreak(false);
        $pdf->AddPage();

        $pdf->Image("assets/img/logo2.png",0.4, 0.25, 0.55, 0.55, "PNG");

        $pdf->SetFont('Arial','U',14);
        $pdf->SetXY( 1.0,0.2);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(3.0,0.4);
        $pdf->Cell(0, 0.25, "FORWARDING LETTER",0.25, "C");
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(2.1,0.6);
        $pdf->Cell(0, 0.25, "SHOWING DETAILS OF ".class_for_9th_Adm." REGISTRATION, ".sessReg, 0.25, "C");
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(2.6,2.6);
        $pdf->Image(BARCODE_PATH.$image,6.3,0.45, 1.8, 0.20, "PNG"); 
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(0.8,0.94);
        $pdf->MultiCell(7, 0.18,$user['Inst_Id']. "-". $user['inst_Name'],'',"L",0);


        $x = 0;
        $y = 0.2;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(0.4+$x,0.7+$y);
        $pdf->Cell(0, 0.25, "FROM", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9+$x,1.+$y);
        $pdf->Cell(0, 0.25, "PRINCIPAL", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9+$x,1.+$y);
        $pdf->Cell(0, 0.25, "______________________________", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9+$x,1.4+$y);
        $pdf->Cell(0, 0.25, "______________________________", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9+$x,1.8+$y);
        $pdf->Cell(0, 0.25, "No:___________________________", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(4.9+$x,1.2+$y);
        $pdf->Cell(0, 0.25, "Phone No:___________________________", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(4.9+$x,1.6+$y);
        $pdf->Cell(0, 0.25, "Mobile No:___________________________", 0.25, "C");

        $y = $y-0.8;
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9+$x,2.95+$y);
        $pdf->Cell(0, 0.25, "TO", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(1.2+$x,3.1+$y);
        $pdf->Cell(0, 0.25, "The Secretary", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(1.2+$x,3.3+$y);
        $pdf->Cell(0, 0.25, "Board of Intermediate & Secondary Education,", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(1.2+$x,3.5+$y);
        $pdf->Cell(0, 0.25, "Gujranwala", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.4+$x,4.0+$y);
        $pdf->Cell(0, 0.25, "Sir,", 0.25, "C");


        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(0.9+$x,4.2+$y);

        $pdf->MultiCell(6.5, 0.2, "I am forwarding registration return along with the relevent enclosures of Candidates Group wise registered from my Institute in the ensuring ".class_for_9th_Adm." REGISTRATION, ".sessReg." are
            ", 0,"J",0);



        // $y += 0.2;
        //$y += 0.2;
        $x = 1; 
        $dy = 4.6; 
        $pdf->SetXY(0.5,$y+$dy);
        $pdf->SetFont('Arial','',10);
        //$pdf->Cell( 0.5,0.5,"Group:",0,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(1.7,$y+$dy);

        $xx= 2.0;
        $y = $y - 1.1;                
        $yy = 2.05+$y;

        $fontsize = 8;
        $boxWidth = 2.9;
        $boxhieght =  .26;
        $yy =  3.75+$yy;

        // ////DebugBreak();

        $boxWidth = 2.9;



        $pdf->SetXY($xx,$yy);
        $pdf->SetFillColor(240,240,240);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'Sr#',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,'Group Name',1,0,'L',1);
        $pdf->SetFont('Arial','B',$fontsize);
        $pdf->Cell($boxWidth-1.5,$boxhieght,'No. of Students.',1,0,'C',1);

        $yy = $boxhieght+$yy;
        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',$fontsize);
        $pdf->SetXY($xx,$yy);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'1',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,'SCIENCE (WITH BIOLOGY)',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['grpFee1'],1,0,'C',1);

        $yy = $boxhieght+$yy;
        $pdf->SetXY($xx,$yy);
        $pdf->SetFont('Arial','',$fontsize);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'2',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,'SCIENCE (WITH COMPUTER SCIENCE)',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['grpFee2'],1,0,'C',1);

        $yy = $boxhieght+$yy;
        $pdf->SetXY($xx,$yy);
        $pdf->SetFont('Arial','',$fontsize);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'3',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,'SCIENCE (WITH ELECTRICAL WIRING)',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['grpFee3'],1,0,'C',1);

        $yy = $boxhieght+$yy;
        $pdf->SetXY($xx,$yy);
        $pdf->SetFont('Arial','',$fontsize);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'4',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,'GENERAL',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['grpFee4'],1,0,'C',1);

        $yy = $boxhieght+$yy;
        $pdf->SetXY($xx,$yy);

        $pdf->SetFont('Arial','',$fontsize);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'5',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,'DEAF & DUMB',1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['grpFee5'],1,0,'C',1);

        $yy = $boxhieght+$yy;
        $pdf->SetXY($xx,$yy);
        $pdf->SetFont('Arial','',$fontsize);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'5',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7,$boxhieght,"BOARD EMPLOYEE's CHILD (IF ANY)",1,0,'L',1);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['grpFee6'],1,0,'C',1);

        $yy = $boxhieght+$yy;
        $pdf->SetXY($xx,$yy);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell($boxWidth-2.2,$boxhieght,'',1,0,'C',1);
        $pdf->Cell($boxWidth-0.7    ,$boxhieght,'Total:',1,0,'L',1);
        $pdf->Cell($boxWidth-1.5,$boxhieght,$result['data'][0]['totalFee'],1,0,'C',1);

        $y = $y+0.5;
        /*$pdf->SetFont('Arial','',10);
        $pdf->SetXY(0.9,6.7+$y);    
        $pdf->MultiCell(6.5,0.2,"Name of the candidates who have not completed the required number of attendances up to the date of the submission of their forms are being submitted provisionally and are mentioned overleaf. Final report regarding their eligibility will be sent to you in due course as instructed in the book of instructions and information.
        ",0,"J",0)    ; */

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(0.87,7.6+$y);    
        $pdf->MultiCell(6.5,0.2,"I certify that the forwarding letter has been filled in strictly according to the instructions and the certificate printed on the registration returns has been signed by me.",0,"J",0); //// I also certify that I have initialled all corrections made in the registration forms.

        /*  $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,8.0+$y);    
        $pdf->MultiCell(8.5,0.2," All my candidates will appear at ________________________________________________________ ",0,"L",0)    ;*/

        $pdf->SetFont('Arial','BU',10);
        $pdf->SetXY(0.9,8.05+$y);    
        $pdf->MultiCell(1.5,0.2,"Amount: ".$result['data'][0]['Amount'],0,"L",0); 

        $pdf->SetFont('Arial','BU',10);
        $pdf->SetXY(0.9,8.35+$y);    
        $pdf->MultiCell(7,0.15,"Challan No(s): ".$result['data'][0]['Challan_No'],0,"L",0); 

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,8.65+$y);    
        $pdf->MultiCell(10,0.2,"Paid Date:____________________________",0,"L",0); 

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,8.95+$y);    
        $pdf->MultiCell(10,0.2,"Bank Branch Name:__________________________________________________________________",0,"L",0); 

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.49+$y);    
        $pdf->Cell(1.6,0.2,"(Other remarks if any)",0,"R",0);

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.55+$y); 
        $pdf->MultiCell(8.5,0.2,"____________________________________________________________________________________",0,"L",0)    ;   


        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.85+$y);    
        $pdf->MultiCell(8.5,0.2,"____________________________________________________________________________________",0,"L",0)    ;   

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,10.15+$y);    
        $pdf->MultiCell(8.5,0.2,"____________________________________________________________________________________",0,"L",0)    ;   



        // ////DebugBreak();

        //
        /*$pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,10+$y);    
        $pdf->MultiCell(10,0.2,"",0,"L",0); */

        $y = $y+0.9;

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.65+$y);    
        $pdf->MultiCell(8.5,0.2,"Enclosures:",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,9.95+$y);    
        $pdf->MultiCell(8.5,0.2,"1.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,10.25+$y);    
        $pdf->MultiCell(8.5,0.2,"2.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,10.55+$y);    
        $pdf->MultiCell(8.5,0.2,"3.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,10.85+$y);    
        $pdf->MultiCell(8.5,0.2,"4.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.9,11.15+$y);    
        $pdf->MultiCell(8.5,0.2,"5.____________________________",0,"L",0)    ;  

        $pdf->SetFont('Arial','UB',10);
        $pdf->SetXY(5.4,11.05+$y);    
        $pdf->MultiCell(8.5,0.2,"Signature & Stamp of Principal",0,"L",0)    ; 

        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(1.0,11.69+$y); 
        $pdf->Cell(0,0,'Print Date: '. date('d-m-Y H:i:s a'),0,0,'L',0);   
        //$pdf->MultiCell(5.5,0.2,'Print Date: '. date('d-m-Y H:i:s a'),0,"L",0)    ;  


        $i = 4;


        $pdf->Output('Forwarding'.'.pdf', 'I');
    }
    function convertImage($originalImage, $outputImage, $quality,$ext)
    {

        if (preg_match('/jpg|jpeg/i',$ext))
            $imageTmp=imagecreatefromjpeg($originalImage);
        else if (preg_match('/png/i',$ext))
            $imageTmp=imagecreatefrompng($originalImage);
            else if (preg_match('/gif/i',$ext))
                $imageTmp=imagecreatefromgif($originalImage);
                else if (preg_match('/bmp/i',$ext))
                    $imageTmp=imagecreatefrombmp($originalImage);
                    else
                        return 0;

        imagejpeg($imageTmp, $outputImage, $quality);
        imagedestroy($imageTmp);

        return 1;
    }
    function frmvalidation($viewName,$allinputdata,$isupdate)
    {
        // ////DebugBreak();
        $_POST['address']  = str_replace("'", "", $_POST['address'] );
        $subjectslang = array('22','23','36','34','35');
        $subjectshis = array('20','21','19');
        $cntzero = substr_count(@$_POST['bay_form'],"0");
        $cntone = substr_count(@$_POST['bay_form'],"1");
        $cnttwo = substr_count(@$_POST['bay_form'],"2");
        $cntthr = substr_count(@$_POST['bay_form'],"3");
        $cntfour = substr_count(@$_POST['bay_form'],"4");
        $cntfive = substr_count(@$_POST['bay_form'],"5");
        $cntsix = substr_count(@$_POST['bay_form'],"6");
        $cntseven = substr_count(@$_POST['bay_form'],"7");
        $cnteight = substr_count(@$_POST['bay_form'],"8");
        $cntnine = substr_count(@$_POST['bay_form'],"9");
        if(@$_POST['dob'] != null || $allinputdata['Dob'] != null)
        {
            $date = new DateTime(@$_POST['dob']);
            $convert_dob = $date->format('Y-m-d');     
        }
        if(@$_POST['cand_name'] == ''  || ($allinputdata['name'] == '' && $isupdate ==1)  )
        {
            $allinputdata['excep'] = 'Please Enter Your Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration/'.$viewName);
            return;

        }


        /*if( (count($_POST['cand_name'] < 3) ) || (strlen($allinputdata['name'] < 3) && $isupdate ==1)  )
        {
        $ss = count(@$_POST['cand_name']); 
        $allinputdata['excep'] = 'Please Enter Your Name';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration/'.$viewName);
        return;

        }                                                                                               */
        //(strpos($a, 'are') !== false)
        /* if ((strpos(@$_POST['cand_name'], 'MOHAMMAD') !== false)|| (strpos(@$_POST['cand_name'], 'MOHAMAD') !== false) || (strpos(@$_POST['cand_name'], 'MOHD') !== false) || (strpos(@$_POST['cand_name'], 'MUHAMAD') !== false) || (strpos(@$_POST['cand_name'], 'MOOHAMMAD') !== false)|| (strpos(@$_POST['cand_name'], 'MOOHAMAD') !== false))
        {
        $allinputdata['excep'] = 'MUHAMMAD Spelling is not Correct in Name';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration/'.$viewName);
        return;

        }

        else*/ 
        if (@$_POST['father_name'] == ''  || ($allinputdata['Fname'] == '' && $isupdate ==1) )
        {
            $allinputdata['excep'] = 'Please Enter Your Father Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration/'.$viewName);
            return;

        }
        /* if (strlen(@$_POST['father_name']<3)  || (strlen($allinputdata['Fname']<3)   && $isupdate ==1) )
        {
        $allinputdata['excep'] = 'Please Enter Your Father Name';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration/'.$viewName);
        return;

        }  */
        /* if (@$_POST['father_name']==@$_POST['cand_name']  || (@$_POST['name']==@$_POST['Fname']   && $isupdate ==1) )
        {
        $allinputdata['excep'] = 'Please Enter Your Name and Father Name as both can not be same';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration/'.$viewName);
        return;

        }  */
        /*  if ((strpos(@$_POST['father_name'], 'MOHAMMAD') !== false)|| (strpos(@$_POST['father_name'], 'MOHAMAD') !== false) || (strpos(@$_POST['father_name'], 'MUHAMAD') !== false) || (strpos(@$_POST['father_name'], 'MOOHAMMAD') !== false)|| (strpos(@$_POST['father_name'], 'MOOHAMAD') !== false))
        {
        $allinputdata['excep'] = 'MUHAMMAD Spelling is not Correct in Fathers Name';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Registration/'.$viewName);
        return;

        }*/

        else if(@$_POST['bay_form'] == ''  || ($allinputdata['BForm'] == '' && $isupdate ==1) )
        {
            $allinputdata['excep'] = 'Please Enter Your Bay Form No.';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Registration/'.$viewName);
            return;


        }
        else if( (@$_POST['bay_form'] == '00000-0000000-0') || (@$_POST['bay_form'] == '11111-1111111-1') || (@$_POST['bay_form'] == '22222-2222222-2') || (@$_POST['bay_form'] == '33333-3333333-3') || (@$_POST['bay_form'] == '44444-4444444-4')
            || (@$_POST['bay_form'] == '55555-5555555-5') || (@$_POST['bay_form'] == '66666-6666666-6') || (@$_POST['bay_form'] == '77777-7777777-7') || (@$_POST['bay_form'] == '88888-8888888-8') || (@$_POST['bay_form'] == '99999-9999999-9') ||
            (@$_POST['bay_form'] == '00000-1111111-0') || (@$_POST['bay_form'] == '00000-1111111-1') || (@$_POST['bay_form'] == '00000-0000000-1' || $cntzero >7 || $cntone >7 || $cnttwo >7 || $cntfour >7 || $cntthr >8 || $cntfive >7 || $cntsix >7 || $cntseven >7 || $cnteight >7 || $cntnine >7)
            )
            {
                $allinputdata['excep'] = 'Please Enter Your Correct Bay Form No.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if($this->Registration_model->bay_form_comp(@$_POST['bay_form']) == true && $isupdate ==0 )
            {
                // ////DebugBreak();
                $allinputdata['excep'] = 'This Bay Form is already Feeded.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;



            }
            else if(@$_POST['oldbform'] !=  @$_POST['bay_form'] && $isupdate ==1 )
            {
                // ////DebugBreak();
                if($this->Registration_model->bay_form_comp(@$_POST['bay_form']) == true )
                {
                    // ////DebugBreak();
                    $allinputdata['excep'] = 'This Bay Form is already Feeded.';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Registration/'.$viewName);
                    return;
                }
                else if($this->Registration_model->bay_form_fnic(@$_POST['bay_form'],@$_POST['father_cnic']) == true  )
                {
                    // ////DebugBreak();
                    $allinputdata['excep'] = 'This Form is already Feeded.';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Registration/'.$viewName);
                    return;
                }      
            }
            else if($this->Registration_model->bay_form_fnic(@$_POST['bay_form'],@$_POST['father_cnic']) == true && $isupdate ==0 )
            {
                // ////DebugBreak();
                $allinputdata['excep'] = 'This Form is already Feeded.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;



            }
            else if($this->Registration_model->bay_form_fnic_dob_comp(@$_POST['bay_form'],@$_POST['father_cnic'],$convert_dob) == true && $isupdate == 0 )
            {
                // ////DebugBreak();
                $allinputdata['excep'] = 'This Form is already Feeded.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;



            }                

            else if(@$_POST['father_cnic'] == '' || ($allinputdata['FNIC'] == '' && $isupdate ==1)  )
            {
                $allinputdata['excep'] = 'Please Enter Your Father CNIC';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;


            }
            else if((@$_POST['bay_form'] == @$_POST['father_cnic']) || (@$_POST['father_cnic'] == @$_POST['bay_form']) )
            {
                $allinputdata['excep'] = 'Your Bay Form and FNIC No. are not same';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;


            }
            else if (@$_POST['dob'] == ''  || ($allinputdata['Dob'] == ''   && $isupdate ==1) )
            {
                $allinputdata['excep'] = 'Please Enter Your  Date of Birth';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if(@$_POST['mob_number'] == '')
            {
                $allinputdata['excep'] = 'Please Enter Your Mobile Number';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if(@$_POST['medium'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Your Medium';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if(@$_POST['Inst_Rno']== '')
            { 
                $allinputdata['excep'] = 'Please Enter Your Roll Number';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if(@$_POST['MarkOfIden']== '')
            {
                $allinputdata['excep'] = 'Please Enter Your Mark of Identification';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }

            /* else if((@$_POST['speciality'] != '0')or (@$_POST['speciality'] != '1') or (@$_POST['speciality'] != '2'))
            {
            $error['excep'] = 'Please Enter Your Speciality';
            $this->load->view('Registration/9th/NewEnrolment.php',$error);
            }*/
            else if((@$_POST['medium'] != '1') and (@$_POST['medium'] != '2') )
            {
                $allinputdata['excep'] = 'Please Select Your medium';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['nationality'] != '1') and (@$_POST['nationality'] != '2') )
            {
                $allinputdata['excep'] = 'Please Select Your Nationality';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['gender'] != '1') and (@$_POST['gender'] != '2'))
            {
                $allinputdata['excep'] = 'Please Select Your Gender';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['hafiz']!= '1') and (@$_POST['hafiz']!= '2'))
            {
                $allinputdata['excep'] = 'Please Select Your Hafiz-e-Quran option';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['religion'] != '1') and (@$_POST['religion'] != '2'))
            {
                $allinputdata['excep'] = 'Please Select Your religion';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['UrbanRural'] != '1') and (@$_POST['UrbanRural'] != '2'))
            {
                $allinputdata['excep'] = 'Please Select Your Residency';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if(@$_POST['address'] =='')
            {
                $allinputdata['excep'] = 'Please Enter Your Address';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if(@$_POST['std_group'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Your Study Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['std_group'] == 1) && ((@$_POST['sub4']!=5) || (@$_POST['sub5']!=6)||(@$_POST['sub6']!=7)|| (@$_POST['sub7']!=8)))
            {
                // ////DebugBreak();
                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['std_group'] == 7)&& ((@$_POST['sub4']!=5) || (@$_POST['sub5']!=6)||(@$_POST['sub6']!=7)|| (@$_POST['sub7']!=78)))
            {

                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['std_group'] == 8)&& ((@$_POST['sub4']!=5) || (@$_POST['sub5']!=6)||(@$_POST['sub6']!=7)|| (@$_POST['sub7']!=43)))
            {

                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }
            else if((@$_POST['std_group'] == 2) && ((@$_POST['sub4']==5) || (@$_POST['sub5']==6)||(@$_POST['sub6']==7)|| (@$_POST['sub7']==43) || (@$_POST['sub7']==8)))
            {
                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }

            else if((@$_POST['std_group'] == 5)&& ((@$_POST['sub4']==5) || (@$_POST['sub5']==6)||(@$_POST['sub6']==7)|| (@$_POST['sub7']==43) || (@$_POST['sub7']==8)))
            {
                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/'.$viewName);
                return;

            }

            else if((@$_POST['sub1'] == @$_POST['sub2']) ||(@$_POST['sub1'] == @$_POST['sub3'])||(@$_POST['sub1'] == @$_POST['sub4'])||(@$_POST['sub1'] == @$_POST['sub5'])||(@$_POST['sub1'] == @$_POST['sub6'])||(@$_POST['sub1'] == @$_POST['sub7'])||
                (@$_POST['sub1'] == @$_POST['sub8']))
                {
                    $allinputdata['excep'] = 'Please Select Different Subjects';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Registration/'.$viewName);
                    return;

                }
                else if((@$_POST['sub2'] == @$_POST['sub1']) ||(@$_POST['sub2'] == @$_POST['sub3'])||(@$_POST['sub2'] == @$_POST['sub4'])||(@$_POST['sub2'] == @$_POST['sub5'])||(@$_POST['sub2'] == @$_POST['sub6'])||(@$_POST['sub2'] == @$_POST['sub7'])                         ||(@$_POST['sub2'] == @$_POST['sub8'])
                    )
                    {
                        $allinputdata['excep'] = 'Please Select Different Subjects';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Registration/'.$viewName);
                        return;

                    }
                    else if((@$_POST['sub3'] == @$_POST['sub1']) ||(@$_POST['sub3'] == @$_POST['sub2'])||(@$_POST['sub3'] == @$_POST['sub4'])||(@$_POST['sub3'] == @$_POST['sub5'])||(@$_POST['sub3'] == @$_POST['sub6'])||(@$_POST['sub3'] == @$_POST['sub7'])||(@$_POST['sub3'] == @$_POST['sub8'])
                        )
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub4'] == @$_POST['sub1']) ||(@$_POST['sub4'] == @$_POST['sub3'])||(@$_POST['sub4'] == @$_POST['sub2'])||(@$_POST['sub4'] == @$_POST['sub5'])||(@$_POST['sub4'] == @$_POST['sub6'])||(@$_POST['sub4'] == @$_POST[                                 'sub7'])||(@$_POST['sub4'] == @$_POST['sub8']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub5'] == @$_POST['sub1']) ||(@$_POST['sub5'] == @$_POST['sub3'])||(@$_POST['sub5'] == @$_POST['sub4'])||(@$_POST['sub5'] == @$_POST['sub2'])||(@$_POST['sub5'] == @$_POST['sub6'])||(@$_POST['sub5'] == @$_POST['sub7'])||(@$_POST['sub5'] == @$_POST['sub8']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub6'] == @$_POST['sub1']) ||(@$_POST['sub6'] == @$_POST['sub3'])||(@$_POST['sub6'] == @$_POST['sub4'])||(@$_POST['sub6'] == @$_POST['sub5'])||(@$_POST['sub6'] == @$_POST['sub2'])||(@$_POST['sub6'] ==                                          @$_POST['sub7'])||(@$_POST['sub6'] == @$_POST['sub8']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub7'] == @$_POST['sub1']) ||(@$_POST['sub7'] == @$_POST['sub3'])||(@$_POST['sub7'] == @$_POST['sub4'])||(@$_POST['sub7'] == @$_POST['sub5'])||(@$_POST['sub7'] == @$_POST['sub6'])||(@$_POST['sub7'] == @$_POST['sub2'])||(@$_POST['sub7'] == @$_POST['sub8']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub8'] == @$_POST['sub1']) ||(@$_POST['sub8'] == @$_POST['sub3'])||(@$_POST['sub8'] == @$_POST['sub4'])||(@$_POST['sub8'] == @$_POST['sub5'])||(@$_POST['sub8'] == @$_POST['sub6'])||(@$_POST['                                                   sub8'] == @$_POST['sub7'])||(@$_POST['sub8'] == @$_POST['sub2']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if (in_array($_POST['sub6'], $subjectslang) && in_array($_POST['sub7'], $subjectslang))
                        {
                            $allinputdata['excep'] = 'Double Language is not Allowed Please choose a different Subject';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;
                        }
                        else if (in_array($_POST['sub6'], $subjectshis) && in_array($_POST['sub7'], $subjectshis))
                        {
                            $allinputdata['excep'] = 'Double History is not Allowed Please choose a different Subject';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;
                        }
                        else if(@$_POST['sub6'] == @$_POST['sub7'])
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub7'] == @$_POST['sub5'])
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }

                        else if(@$_POST['sub1'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 1';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub2'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 2';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;
                        }
                        else if(@$_POST['sub3'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 3';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub4'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 4';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }

                        else if(@$_POST['sub5'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 5';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub6'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 6';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub7'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 7';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub8'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Subject 8';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Registration/'.$viewName);
                            return;

                        }
    }  
    public function EditPicForms()
    {
        // ////DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        //  $this->load->view('common/common_reg/header.php',$userinfo);
        $data = array(
            'isselected' => '2',

        );
        $msg = $this->uri->segment(3);

        //echo $this->upload->error_msg[0];exit();

        if($msg == FALSE){

            $error_msg = $this->session->flashdata('error');    
        }
        else{
            $error_msg = $msg;
        }

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Registration_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        $RegStdData = array('data'=>$this->Registration_model->EditPicEnrolement($user['Inst_Id']),'grp_cd'=>$user['grp_cd']);
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/common_reg/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('Registration/9th/EditPicForms.php',$RegStdData);
        $this->load->view('common/common_reg/footer.php');



    }
    public function uplaodpics()
    {
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $formno = $_POST['formno']  ;
        $target_path = IMAGE_PATH;

        $Inst_Id = $userinfo['Inst_Id'];
        if (!file_exists($target_path)){

            mkdir($target_path);
        }
        $target_path = IMAGE_PATH.$Inst_Id.'/';
        if (!file_exists($target_path)){

            mkdir($target_path);
        } 


        $config['upload_path']   = $target_path;
        $config['allowed_types'] = 'jpg|jpeg';
        $config['max_size']      = '20';
        $config['min_size']      = '4';
        //  $config['max_width']     = '260';
        // $config['max_height']    = '290';
        $config['min_width']     = '110';
        $config['min_height']    = '100';
        $config['overwrite']     = TRUE;
        $config['file_name']     = $formno.'.jpg';

        $filepath = $target_path. $config['file_name']  ;



        //$config['new_image']    = $formno.'.JPEG';

        $this->load->library('upload', $config);

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        $this->upload->initialize($config);

        if($check !== false) {

            $file_size = round($_FILES['image']['size']/1024, 2);

            if($file_size<=20 && $file_size>=4)
            {
                if ( !$this->upload->do_upload('image',true))
                {

                    if($this->upload->error_msg[0] != "")
                    {
                        $error['excep']= $this->upload->error_msg[0];
                        $allinputdata['excep'] = $this->upload->error_msg[0];
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                        redirect('Registration/EditPicForms/');
                        return;

                    }


                }
            }
            else
            {
                $allinputdata['excep'] = 'The file you are attempting to upload size is between 4 to 20 Kb.';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                redirect('Registration/EditPicForms/');

            }
        }
        else
        {
            // $check = getimagesize($filepath);
            if($check === false)
            {
                $allinputdata['excep'] = 'Please Upload Your Picture';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Registration/EditPicForms/');
                return;
            }
        }

        // $this->frmvalidation('NewEnrolment',$allinputdata,0);

        $a = getimagesize($filepath);
        if($a[2]!=2)
        {
            $this->convertImage($filepath,$filepath,100,$a['mime']);
        }
        redirect('Registration/EditPicForms/');
        return;
    }
    public function deleteExtarfiles($dirPath)
    {
        //////DebugBreak();
        if (is_dir($dirPath)) {
            $objects = scandir($dirPath);
            foreach ($objects as $object) {
                if ($object != "." && $object !="..") {
                    if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
                        $this->deleteExtarfiles($dirPath . DIRECTORY_SEPARATOR . $object);
                    } else {
                        $filepath = $dirPath . DIRECTORY_SEPARATOR . $object;
                        $filepath = explode('.',$filepath);
                        if(strtolower(@$filepath[1])!= 'jpg')
                        {
                            unlink($dirPath . DIRECTORY_SEPARATOR . $object); 
                        }

                    }
                }
            }
            reset($objects);
            //rmdir(@$dirPath);
            //rmdir(@$dirPath);
        }
    }
}
