<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admission_inter extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');   

        $this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
            redirect('login');
        }
    }
    public function index()
    {

//        DebugBreak(); 
        $msg = $this->uri->segment(3);
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 11;
        $userinfo['isinterfeeding'] = 0;
        $Inst_Id = $userinfo['Inst_Id'];
        $isgovt = $userinfo['isgovt'];
        $emis = $userinfo['emis'];
        $email = $userinfo['email'];
        $phone = $userinfo['phone'];
        $cell = $userinfo['cell'];
        $dist = $userinfo['dist'];
        $teh = $userinfo['teh'];
        $zone = $userinfo['zone'];
        $isInserted = $userinfo['isInserted'];
        $field_status = array();
        $field_status['emis'] = 0;
        $field_status['email'] = 0;
        $field_status['phone'] = 0;
        $field_status['cell'] = 0;
        $field_status['dist'] = 0;
        $field_status['teh'] = 0;
        $field_status['zone'] = 0;

        if($isgovt == 1)
        {
            if(strlen($emis)> 1)
            {
                $field_status['emis'] = 1;
            }
            if(strlen($email) > 5){
                $field_status['email'] = 1;
            }
            if(strlen($phone) > 3){
                $field_status['phone'] = 1;
            }
            if(strlen(($cell)>5)){
                $field_status['cell'] = 1;
            }
            if(($dist > 0)){
                $field_status['dist'] = 1;
            }
            if(($teh > 0)){
                $field_status['teh'] = 1;
            }
            if(($zone > 0)){
                $field_status['zone'] = 1;
            }
        }
        else
        {
            $field_status['emis'] = 1;
            if(strlen($email) > 5){
                $field_status['email'] = 1;
            }
            if(strlen($phone) > 3){
                $field_status['phone'] = 1;
            }
            if(strlen(($cell)>5)){
                $field_status['cell'] = 1;
            }
            if(($dist > 0)){
                $field_status['dist'] = 1;
            }
            if(($teh > 0)){
                $field_status['teh'] = 1;
            }
            if(($zone > 0)){
                $field_status['zone'] = 1;
            }
        }
        $Inst_name = $userinfo['inst_Name'];
        $this->load->view('common/header.php',$userinfo);
        ////DebugBreak();
        if($msg == 7)
        {
            $this->load->view('common/menu.php',$userinfo);
            $this->load->model('Admission_inter_model');
            $count = $this->Admission_inter_model->Dashboard($Inst_Id);
            $info = array('count'=>$count,'Inst_id'=>$Inst_Id,'Inst_name'=>$Inst_name);
            $this->load->view('Admission/Inter/Admission.php',$info);
            $this->load->view('common/commonfooter_inter_regular.php');  
        }
        else
        {
            if( ($field_status['email'] == 0) || ($field_status['phone'] == 0) || ($field_status['cell'] == 0) || ($field_status['dist'] == 0) || ($field_status['teh'] == 0)|| ($field_status['zone'] == 0))
            {
                // $this->session->set_userdata("status",$this->session->flashdata('status'));
                if($this->session->flashdata('status'))
                {
                    $this->load->view('common/menu.php',$userinfo);
                    $this->load->model('Admission_inter_model');
                    $count = $this->Admission_inter_model->Dashboard($Inst_Id);
                    $info = array('count'=>$count,'Inst_id'=>$Inst_Id,'Inst_name'=>$Inst_name);
                    $this->load->view('Admission_inter/Admission_inter.php',$info);
                    $this->load->view('common/commonfooter_inter_regular.php');  

                }
                else{
                    if($isInserted < 1)
                    {
                        $this->load->model('Admission_inter_model');
                        $count = $this->Admission_inter_model->Dashboard($Inst_Id);
                        // //DebugBreak();
                        if($field_status['zone'] == 0)
                        {
                            $zone = $this->Admission_inter_model->get_zone();
                        }
                        ////DebugBreak();
                        if($this->session->flashdata('incomplete'))
                        {
                            $all_PreData = $this->session->flashdata('incomplete'); 
                            $fillvalues['emis'] = $all_PreData['emis'];
                            $fillvalues['email'] = $all_PreData['email'];
                            $fillvalues['phone'] = $all_PreData['phone'];
                            $fillvalues['cell'] = $all_PreData['cell'];
                            $fillvalues['dist'] = $all_PreData['dist'];
                            $fillvalues['teh'] = $all_PreData['teh'];
                            $fillvalues['zone'] = $all_PreData['zone'];
                            $errors = $all_PreData['error'];
                        }
                        else{
                            $errors ="";
                            $fillvalues="";
                        }
                        //$this->session->set_flashdata('incomplete',$allinfo);
                        $info = array('count'=>$count,'Inst_id'=>$Inst_Id,'Inst_name'=>$Inst_name,'field_status'=>$field_status,'zone'=>$zone,'error'=>$errors,'fill_values'=>$fillvalues);
                        //$this->load->view('Admission_inter/Admission_inter.php',$info);
                       // $this->load->view('Admission_inter/9th/Incomplete_inst_info.php',$info);
                       // $this->load->view('common/commonfooter_inter_regular.php');
                   
                        $this->load->view('common/menu.php',$userinfo);
                        $this->load->model('Admission_inter_model');
                        $count = $this->Admission_inter_model->Dashboard($Inst_Id);
                        $info = array('count'=>$count,'Inst_id'=>$Inst_Id,'Inst_name'=>$Inst_name);
                        $this->load->view('Admission/inter/Admission.php',$info);
                        $this->load->view('common/commonfooter_inter_regular.php');    

                    } 
                }

                //$this->load->view('common/menu.php',$userinfo);

            }
            else
            {
                $this->load->view('common/menu.php',$userinfo);
                $this->load->model('Admission_inter_model');
                $count = $this->Admission_inter_model->Dashboard($Inst_Id);
                $info = array('count'=>$count,'Inst_id'=>$Inst_Id,'Inst_name'=>$Inst_name);
                $this->load->view('Admission/inter/Admission.php',$info);
                $this->load->view('common/footer.php');    
            } 
        }


    }
     public function ChallanForm_Adm10th_Regular()
    {
       // DebugBreak();
     $Batch_Id = $this->uri->segment(3);
     $this->load->library('session');
        $this->load->library('NumbertoWord');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
         $this->load->model('Admission_inter_model');
        $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
         //$grp_cd = $this->uri->segment(3);
       // $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'formno'=>$formno);
        //  DebugBreak();
        $result = $this->Admission_inter_model->Print_challan_Form($fetch_data);
        $this->load->library('PDF_Rotate');

        $ctid=1;  //correction type of id starts from one and multiples by 2 for next type of correction id
      
            $feestructure[]    =  $result[0]['Total_ProcessingFee'];    
            $displayfeetitle[] =  'Total Processing Fee';    
       
            $feestructure[]     = $result[0]['Total_RegistrationFee'];   
            $displayfeetitle[] =  'Total Admission Fee';   
       
            $feestructure[]=$result[0]['Total_LateRegistrationFee']; 
            $displayfeetitle[] =  'Total Late Admission Fee';   
       
        $turn=1;     
        $pdf=new PDF_Rotate("P","in","A4");
        $pdf->AliasNbPages();
        $pdf->SetTitle("Challan Form | Admission inter 2016 Supplemantry Batch Form Fee");
        $pdf->SetMargins(0.5,0.5,0.5);
        $pdf->AddPage();
        $generatingpdf=false;
        $challanCopy=array(1=>"Depositor Copy",  2=>"Admission Branch Copy",3=>"Bank Copy", 4=>"Board Copy",);
        $challanMSG=array(1=>"(May be deposited in any HBL Branch)",2=>"(To be sent to the Admission Branch Via BISE One Window)", 3=>"(To be retained with HBL)", 4=>"(To be sent to the Board via HBL Branch aloongwith scroll)"  );
        $challanNo = $result[0]['Challan_No']; 

       // DebugBreak();
        if(date('Y-m-d',strtotime(SINGLE_LAST_DATE11))>=date('Y-m-d'))
        {
            $rule_fee   =  $this->Admission_inter_model->getrulefee(); 
            $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else
        {
            $rule_fee   =  $this->Admission_inter_model->getrulefee(); 
            $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }

        $obj    = new NumbertoWord();
        $obj->toWords($result[0]['Amount'],"Only.","");
        // $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');
        $feeInWords = ucwords($obj->words);//strtoupper(cNum2Words($totalfee)); 

        //-------------------- PRINT BARCODE
        //  $pdf->SetDrawColor(0,0,0);
        // $temp = $user['Inst_Id'].'11-2017-19';
        //$image =  $this->set_barcode($temp);
        
        $temp = $challanNo.'@'.$user['Inst_Id'].'@'.$Batch_Id.'@11@2016@1';
        //  $image =  $this->set_barcode($temp);
        //DebugBreak();
        $temp =  $this->set_barcode($temp);

        $yy = 0.05;
        $dyy = 0.1;
        $corcnt = 0;
        for ($j=1;$j<=4;$j++) 
        {

            
            
            
            $yy = 0.04;
            if($turn==1){$dyy=0.2;} 
            else {
                if($turn==2){$dyy=2.65;} else  if($turn==3) {$dyy=5.2; } else {$dyy=7.75 ; $turn=0;}
            }
            $corcnt = 0;
            $pdf->SetFont('Arial','BI',11);
            $pdf->SetXY(1.0,$yy+$dyy);
            //   DebugBreak();
            $pdf->Cell(2.45, 0.4, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "L");
            $pdf->Image(base_url()."assets/img/icon2.png",0.30,$yy+$dyy, 0.50,0.50, "PNG", "http://www.bisegrw.com");
            //  $pdf->Image(BARCODE_PATH.$Barcode,3.2, 1.15+$yy ,1.8,0.20,"PNG");
            $pdf->Image(base_url().BARCODE_PATH.$temp,5.8, $yy+$dyy+0.30 ,1.8,0.20,"PNG");
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

            $pdf->SetFont('Arial','BI',9);
            $pdf->SetXY(1.0,$y+$dy);
            $pdf->Cell(0.5, $y, $challanCopy[$j], 0.25, "L");
            $w = $pdf->GetStringWidth($challanCopy[$j]);
            $pdf->SetXY($w+1.2,$y+$dy);
            $pdf->SetFont('Arial','I',7);
            $pdf->Cell(0, $y, $challanMSG[$j], 0.25, "L");

            $pdf->SetXY($w+1.4,$y+$dy+0.15);
            $pdf->SetFont('Arial','I',7);
            $pdf->Cell(0, $y, 'Admission Session '.CURRENT_SESS1.' '.corr_bank_chall_class1, 0.25, "L");

            $y += 0.25;
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.5,$y+$dy-0.01);
            $pdf->SetFillColor(0,0,0);
            $pdf->Cell(1.5,0.2,'',1,0,'C',1);
            $pdf->SetFillColor(255,255,255);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetXY(0.5,$y+$dy-0.01);
            $pdf->Cell(0, 0.25, "Due Date: ".$challanDueDate, 0.25, "C");
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','BI',8);
            $pdf->SetXY(2.0,$y+$dy-0.04);
            $pdf->Cell(0, 0.25, "Printing Date: ".date("d/m/y",time())."  Account Title: BISE, GUJRANWALA   CMD Account No. 00427900072103", 0.25, "C");
            //CMD Account No. 00427900072103
            //--------------------------- Fee Description
            $pdf->SetXY(2.8,$y+$dy);
            $pdf->SetFont('Arial','U',8);
            $pdf->Cell(0.5,0.5,"Fee Description",0,'L');

            //  DebugBreak();
            //--------------------------- Challan Depositor Information
            $pdf->SetXY(4,$y+0.1+$dy);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.3,"Bank Challan No:".$challanNo."           Batch No.".$result[0]['Batch_ID'],0,2,'L');
            $pdf->SetFont('Arial','U',9);
            $pdf->Cell(0.5,0.25, "Particulars Of Depositor",0,2,'L');
            $pdf->SetX(4.0);
            $pdf->SetFont('Arial','B',8);

            //if(intval($result[0]['sex'])==1){$sodo="S/O ";}else{$sodo="D/O ";}
           // $pdf->Cell(0.5,0.25,$user['Inst_Id'].'-'.$user['inst_Name'],0,2,'L');
            // $pdf->Cell(0.5,0.25,,0,2,'L');
            $pdf->SetX(4);
            $pdf->SetFont('Arial','I',6.5);
            // DebugBreak();
            //$pdf->Cell(0.5,0.3,"Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0,2,'L');
            $pdf->MultiCell(4, .1, "Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0);
            $pdf->SetXY(4,$y+1.15+$dy);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(0.5,0.3,"Amount in Words: ".$feeInWords,0,2,'L');

            $x = 0.55;
            $y += 0.2;

            //------------- Fee Statement
            //  DebugBreak();
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
            // DebugBreak();
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
            $pdf->SetXY(0.5,($y)+$dy);
            $pdf->Cell( 0.5,0.5,"Total Amount: ",0,'L');
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(3,$y+$dy);
            $pdf->Cell(0.8,0.5,$result[0]['Amount'],0,'C');

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
        } else {
            $containsError=true;
            $errorMessage = "<br />Your Institute does not have any student registration card in accordance with selected group or form no. range.";
        }  

        //======================================================================================
        //  }

        //  $pdf->Output($data["Sch_cd"].'.pdf', 'I');
    }
    public function StudentsData()
    {    
      // DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '11',

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
        $this->load->model('Admission_inter_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        $myarr = array('Inst_Id'=>$user['Inst_Id'],'gender'=>$user['gender']);
        $data = array(
            'data' => $this->Admission_inter_model->getStudentsData($myarr),
            'isselected' => '11'
        );
        $data['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('Admission/inter/OldStudentsData.php',$data);
        $this->load->view('common/commonfooter_inter_regular.php');

    }
    public function Profile(){

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 5;
        $Inst_Id = $userinfo['Inst_Id'];
        $isgovt = $userinfo['isgovt'];
        $emis = $userinfo['emis'];
        $email = $userinfo['email'];
        $phone = $userinfo['phone'];
        $cell = $userinfo['cell'];
        $dist = $userinfo['dist'];
        $teh = $userinfo['teh'];
        $zone = $userinfo['zone'];
        $isInserted = $userinfo['isInserted'];
        $this->load->model('Admission_inter_model');
        if($isInserted == 1)
        {
            $newinfo = $this->Admission_inter_model->Profile_info($Inst_Id);  
            $emis = $newinfo[0]['emis_code']; 
            $email =  $newinfo[0]['email']; 
            $phone = $newinfo[0]['LandLine'];
            $cell =  $newinfo[0]['MobNo']; 
        }
        if($this->session->flashdata('msg'))
        {

            $msg = $this->session->flashdata('msg');    
        }
        else
        {
            $msg = '';
        }

        $info = array('isgovt'=>$isgovt,'emis'=>$emis,'email'=>$email,'phone'=>$phone, 'cell'=>$cell,'isInserted'=>$isInserted,'msg'=>$msg)  ;
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$userinfo);

        $this->load->view('Admission/inter/Profile.php',$info);
        $this->load->view('common/commonfooter_inter_regular.php');


    }
    public function Profile_Update(){
        $this->load->model('Admission_inter_model');
        // //DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 5;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->commonheader($userinfo);
        $error = array();

        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        if(@$_POST['isGovt']== 1){
            $emis = @$_POST['Profile_emis'];
        }
        else{
            $emis = '';
        }
        $allinputdata = array('isGovt'=>@$_POST['isGovt'],'Profile_email'=>@$_POST['Profile_email'],'Profile_password'=>@$_POST['Profile_password'],'Profile_phone'=>@$_POST['Profile_phone'],'Profile_cell'=>@$_POST['Profile_cell'],'isInserted'=>@$_POST['isInserted'],'Inst_Id'=>$Inst_Id,'Inst_Id'=>$Inst_Id,'emis'=>$emis
        );

        $result =  $this->Admission_inter_model->Profile_UPDATE($allinputdata); 
        if($result == true){
            $msg = 'success';
            $this->session->set_flashdata('msg',$msg);
            redirect('Admission_inter/Profile');
            return;
        }   
        else{
            $msg = 'error';
            $this->session->set_flashdata('msg',$msg);
            redirect('Admission_inter/Profile');
            return;

        }


    }
    public function NewEnrolment_update_inter()
    {
//   DebugBreak();
        $this->load->model('Admission_inter_model');
        // //DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 11;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->commonheader($userinfo);
        $error = array();

        // //DebugBreak();

        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        // if (!isset($Inst_Id))
        // {
        //$error['excep'][1] = 'Please Login!';
        //    $this->load->view('login/login.php');
        // }
        // $this->Registration_model->Insert_NewEnorlement($data);    
        $formno = @$_POST['formNo']; //$formno = $this->Admission_inter_model->GetFormNo($Inst_Id);// $this->Admission_model->GetFormNo();//, $fname);//$_POST['username'],$_POST['password']);

        $allinputdata = array('cand_name'=>@$_POST['cand_name'],'father_name'=>@$_POST['father_name'],
            'bay_form'=>@$_POST['bay_form'],'father_cnic'=>@$_POST['father_cnic'],
            'dob'=>@$_POST['dob'],'mob_number'=>@$_POST['mob_number'],
            'medium'=>@$_POST['medium'],//'Inst_Rno'=>@$_POST['Inst_Rno'],
            'speciality'=>@$_POST['speciality'],'MarkOfIden'=>@$_POST['MarkOfIden'],
            'medium'=>@$_POST['medium'],'nationality'=>@$_POST['nationality'],
            'gender'=>@$_POST['gend'],'hafiz'=>@$_POST['hafiz'],
            'religion'=>@$_POST['religion'],'std_group'=>@$_POST['std_group'],
            'address'=>@$_POST['address'],
            'UrbanRural'=>@$_POST['UrbanRural'],
            'dist'=>@$_POST['pvtinfo_dist'],
            'teh'=>@$_POST['pvtinfo_teh'],
            'zone'=>@$_POST['pvtZone'],
            'oldrno'=>@$_POST['OldRno'],
            'oldsess'=>@$_POST['OldSess'],
            'oldyear'=>@$_POST['OldYear'],
            'oldboard'=>@$_POST['OldBrd'],
            'Marksimp'=>@$_POST['ddlMarksImproveoptions'],
            'sub1'=>@$_POST['sub1'],'sub2'=>@$_POST['sub2'],'sub3'=>@$_POST['sub3'],
            'sub4'=>@$_POST['sub4'],'sub5'=>@$_POST['sub5'],'sub6'=>@$_POST['sub6'],
            'sub7'=>@$_POST['sub7'],'sub8'=>@$_POST['sub8'],
            'sub1p2'=>@$_POST['sub1p2'],'sub2p2'=>@$_POST['sub2p2'],'sub3p2'=>@$_POST['sub3p2'],
            'sub4p2'=>@$_POST['sub4p2'],'sub5p2'=>@$_POST['sub5p2'],'sub6p2'=>@$_POST['sub6p2'],
            'sub7p2'=>@$_POST['sub7p2'],'sub8p2'=>@$_POST['sub8p2'],

        );

        // $name = 'Waseem Saleem';
        // $fname = 'Muhammad Saleem'; 
         $sub1 = 0;         $sub2 = 0;              $sub3 = 0;          $sub4 = 0;           $sub5 = 0;         $sub6 = 0;            $sub7 = 0;  $sub8=0; $sub4a=0; $sub5a =0; $sub6a = 0; $sub7a = 0;     
        $sub1ap1 = 0;        $sub2ap1 = 0;        $sub3ap1 = 0;        $sub4ap1 = 0;        $sub5ap1 = 0;        $sub6ap1 = 0;        $sub7ap1 = 0;     
        $sub1ap2 = 0;        $sub2ap2 = 0;        $sub3ap2 = 0;        $sub4ap2 = 0;        $sub5ap2 = 0;        $sub6ap2 = 0;        $sub7ap2 = 0;     $sub8ap2 = 0; 


        $is11th = 0;
//debugBreak();
        if(@$_POST['sub1'] != 0)
        {
            $sub1ap1 = 1; 
            $sub1 =  $_POST['sub1'];   
            $is11th = 1;
        }
        if(@$_POST['sub2'] != 0)
        {
            $sub2ap1 = 1;    
            $sub2 =  $_POST['sub2'];
            $is11th = 1;
        }
        if(@$_POST['sub3'] != 0)
        {
            $sub3ap1 = 1;   
            $sub3 =  $_POST['sub3'];
            $is11th = 1;
        }
        if(@$_POST['sub4'] != 0)
        {
            $sub4ap1 = 1;    
            $sub4 =  $_POST['sub4'];
            $is11th = 1;
        }
        if(@$_POST['sub5'] != 0)
        {
            $sub5ap1 = 1;    
            $sub5 =  $_POST['sub5'];
            $is11th = 1;
        }
        if(@$_POST['sub6'] != 0)
        {
            $sub6ap1 = 1;    
            $sub6 =  $_POST['sub6'];
            $is11th = 1;
        }
        if(@$_POST['sub7'] != 0)
        {
            $sub7ap1 = 1;    
            $sub7 =  $_POST['sub7'];
            $is11th = 1;
        }
        if(@$_POST['sub3p2'] != 0)
        {
            $sub8ap2 = 1;    
            $sub8 =  @$_POST['sub3p2'];

        }

        if(@$_POST['sub4p2'] != 0)
        {
            $sub4ap2 = 1;    
            $sub4 =  @$_POST['sub4p2'];

        }
        if(@$_POST['sub5p2'] != 0)
        {
            $sub5ap2 = 1;    
            $sub5a =  @$_POST['sub5p2'];

        }
        if(@$_POST['sub6p2'] != 0)
        {
            $sub6ap2 = 1;    
            $sub6a =  @$_POST['sub6p2'];

        }
        if(@$_POST['sub7p2'] != 0)
        {
            $sub7ap2 = 1;    
            $sub7a =  @$_POST['sub7p2'];

        }


        if(@$_POST['sub1p2'] != 0)
        {
            $sub1ap2 = 1; 
            $sub1 =  $_POST['sub1p2'];  
        }
        if(@$_POST['sub2p2'] != 0)
        {
            $sub2ap2 = 1; 
            $sub2 =  $_POST['sub2p2'];    
        }
        /* if(@$_POST['sub3p2'] != 0)
        {
        $sub3ap2 = 1;  
        $sub3 =  $_POST['sub3p2'];    
        }*/
        /* if(@$_POST['sub4p2'] != 0)
        {
        $sub4ap2 = 1; 
        $sub4 =  $_POST['sub4p2'];     
        }
        if(@$_POST['sub5p2'] != 0)
        {
        $sub5ap2 = 1;    
        $sub5 =  $_POST['sub5p2'];  
        }
        if(@$_POST['sub6p2'] != 0)
        {
        $sub6ap2 = 1;    
        $sub6 =  $_POST['sub6p2'];  
        }
        if(@$_POST['sub7p2'] != 0)
        {
        $sub7ap2 = 1;    
        $sub7 =  $_POST['sub7p2'];  
        }*/


        //$examtype = @$_POST['exam_type'];
        $marksImp = @$_POST['ddlMarksImproveoptions'];
        // debugBreak();

        //$cat = $this->makecat($examtype,$marksImp,$is11th);
        
        if($is11th==1)
        {
        $cat11 = 2;    
        }
        else
        {
        $cat11 = 0;        
        }
        
        $cat12 = 1;
        $Speciality = $this->input->post('speciality');
        $grp_cd = $this->input->post('std_group');

        ////DebugBreak();
      
// DebugBreak();
        $data = array(
            'name' =>$this->input->post('cand_name'),
            'Fname' =>$this->input->post('father_name'),
            'BForm' =>$this->input->post('bay_form'),
            'FNIC' =>$this->input->post('father_cnic'),
            'MobNo' =>$this->input->post('mob_number'),
            'med' =>$this->input->post('medium'),
            'classRno' =>$this->input->post('Inst_Rno'),
            'markOfIden' =>$this->input->post('MarkOfIden'),
            'Spec' =>$this->input->post('speciality'),
            'nat' =>$this->input->post('nationality'),
            'sex' =>$this->input->post('sex'),
            'Ishafiz' =>$this->input->post('hafiz'),
            //'rel' =>(4),
            'rel' =>$this->input->post('religion'),
            'addr' =>$this->input->post('address'),
            'grp_cd' =>$this->input->post('std_group_hidden'),
            'sub1' =>$this->input->post('sub1'),
            'sub2' =>$this->input->post('sub2'),
            'sub3' =>$this->input->post('sub3'),
            'sub4' =>$this->input->post('sub4'),
            'sub5' =>$this->input->post('sub5'),
            'sub6' =>$this->input->post('sub6'),
            'sub7' =>($sub7),
            'sub8' =>($sub8),
            'sub1p2' =>$this->input->post('sub1p2'),
            'sub2p2' =>$this->input->post('sub2p2'),
            //'sub3p2' =>$this->input->post('sub3p2'),
            'sub4p2' =>$this->input->post('sub4p2'),
            'sub5p2' =>$this->input->post('sub5p2'),
            'sub6p2' =>$this->input->post('sub6p2'),
            'sub7p2' =>($sub7a),
            'sub8p2' =>$sub8,
            'sub1ap1' => ($sub1ap1),
            'sub2ap1' => ($sub2ap1),
            'sub3ap1' => ($sub3ap1),
            'sub4ap1' => ($sub4ap1),
            'sub5ap1' => ($sub5ap1),
            'sub6ap1' => ($sub6ap1),
            'sub7ap1' => ($sub7ap1),
           // 'sub8ap1' => ($sub8ap1),
            'sub1ap2' => ($sub1ap2),
            'sub2ap2' => ($sub2ap2),
            //'sub3ap2' => ($sub3ap2),
            'sub4ap2' => ($sub4ap2),
            'sub5ap2' => ($sub5ap2),
            'sub6ap2' => ($sub6ap2),
            'sub7ap2' => ($sub7ap2),
            'sub8ap2' => ($sub8ap2),
            'ruralOrurban' =>$this->input->post('UrbanRural'),
            'Inst_cd' =>($Inst_Id),
            'FormNo' =>($formno),
            'cat09' =>$cat11,
            'cat10' =>$cat12,
            'oldRno'=>@$_POST['OldRno'],
            'sess'=>@$_POST['Oldsess'],
            'Iyear'=>@$_POST['Oldyear'],
            'Brd_cd'=>@$_POST['Oldbrd'],
            'schm'=>1,
            //'picpath'=>@$_POST['pic'],
               'oldFormNo'=>@$_POST['formNo'],
               'pvtinfo_dist'=>@$_POST['pvtinfo_dist'],
            'pvtinfo_teh'=>@$_POST['pvtinfo_teh'],
            'pvtZone'=>@$_POST['pvtZone'],





                                         
        );                  
                        
 
               // DebugBreak();
    /*  $target_path = REGULAR_IMAGE_PATH.$Inst_Id.'/';
        if (!file_exists($target_path)){

            mkdir($target_path);
        }
       
        $base_path = GET_PRIVATE_IMAGE_PATH_COPY.@$_POST['pic'];
        $copyimg = $target_path.$formno.'.jpg';
       
        
        if (!(copy($base_path, $copyimg))) 
        {
            
            $data['excep'] = 'The picture is not upload.';
            $this->session->set_flashdata('NewEnrolment_error',$data);
                //  echo '<pre>'; print_r($allinputdata['excep']);exit();
            redirect('Admission_inter/NewEnrolment_NewForm_inter/');
        }*/
      
        $this->frmvalidation('NewEnrolment_EditForm_inter',$data,0);
        $data['isupdate']=1;
        $logedIn = $this->Admission_inter_model->Insert_NewEnorlement($data);//, $fname);//$_POST['username'],$_POST['password']);
        ////DebugBreak();
        if( !isset($logedIn))
        {  
            $allinputdata = "";
            $allinputdata['excep'] = 'success';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission_inter/EditForms');
            return;
        }
        else
        {     
            $allinputdata = "";
            $allinputdata['excep'] = 'An error has occoured. Please try again later. ';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission_inter/StudentsData');
            return;
            echo 'Data NOT Saved Successfully !';
        } 
        $this->load->view('common/footer.php');
    }
    public function NewEnrolment_INSERT_inter()
    {
//   DebugBreak();
        $this->load->model('Admission_inter_model');
        // //DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 11;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->commonheader($userinfo);
        $error = array();

        // //DebugBreak();

        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        // if (!isset($Inst_Id))
        // {
        //$error['excep'][1] = 'Please Login!';
        //    $this->load->view('login/login.php');
        // }
        // $this->Registration_model->Insert_NewEnorlement($data);    
        $formno = $formno = $this->Admission_inter_model->GetFormNo($Inst_Id);// $this->Admission_model->GetFormNo();//, $fname);//$_POST['username'],$_POST['password']);

        $allinputdata = array('cand_name'=>@$_POST['cand_name'],'father_name'=>@$_POST['father_name'],
            'bay_form'=>@$_POST['bay_form'],'father_cnic'=>@$_POST['father_cnic'],
            'dob'=>@$_POST['dob'],'mob_number'=>@$_POST['mob_number'],
            'medium'=>@$_POST['medium'],//'Inst_Rno'=>@$_POST['Inst_Rno'],
            'speciality'=>@$_POST['speciality'],'MarkOfIden'=>@$_POST['MarkOfIden'],
            'medium'=>@$_POST['medium'],'nationality'=>@$_POST['nationality'],
            'gender'=>@$_POST['gend'],'hafiz'=>@$_POST['hafiz'],
            'religion'=>@$_POST['religion'],'std_group'=>@$_POST['std_group'],
            'address'=>@$_POST['address'],
            'UrbanRural'=>@$_POST['UrbanRural'],
            'dist'=>@$_POST['pvtinfo_dist'],
            'teh'=>@$_POST['pvtinfo_teh'],
            'zone'=>@$_POST['pvtZone'],
            'oldrno'=>@$_POST['OldRno'],
            'oldsess'=>@$_POST['OldSess'],
            'oldyear'=>@$_POST['OldYear'],
            'oldboard'=>@$_POST['OldBrd'],
            'Marksimp'=>@$_POST['ddlMarksImproveoptions'],
            'sub1'=>@$_POST['sub1'],'sub2'=>@$_POST['sub2'],'sub3'=>@$_POST['sub3'],
            'sub4'=>@$_POST['sub4'],'sub5'=>@$_POST['sub5'],'sub6'=>@$_POST['sub6'],
            'sub7'=>@$_POST['sub7'],'sub8'=>@$_POST['sub8'],
            'sub1p2'=>@$_POST['sub1p2'],'sub2p2'=>@$_POST['sub2p2'],'sub3p2'=>@$_POST['sub3p2'],
            'sub4p2'=>@$_POST['sub4p2'],'sub5p2'=>@$_POST['sub5p2'],'sub6p2'=>@$_POST['sub6p2'],
            'sub7p2'=>@$_POST['sub7p2'],'sub8p2'=>@$_POST['sub8p2'],

        );

        // $name = 'Waseem Saleem';
        // $fname = 'Muhammad Saleem'; 
         $sub1 = 0;         $sub2 = 0;              $sub3 = 0;          $sub4 = 0;           $sub5 = 0;         $sub6 = 0;            $sub7 = 0;  $sub8=0; $sub4a=0; $sub5a =0; $sub6a = 0; $sub7a = 0;     
        $sub1ap1 = 0;        $sub2ap1 = 0;        $sub3ap1 = 0;        $sub4ap1 = 0;        $sub5ap1 = 0;        $sub6ap1 = 0;        $sub7ap1 = 0;     
        $sub1ap2 = 0;        $sub2ap2 = 0;        $sub3ap2 = 0;        $sub4ap2 = 0;        $sub5ap2 = 0;        $sub6ap2 = 0;        $sub7ap2 = 0;     $sub8ap2 = 0; 


        $is11th = 0;
//debugBreak();
        if(@$_POST['sub1'] != 0)
        {
            $sub1ap1 = 1; 
            $sub1 =  $_POST['sub1'];   
            $is11th = 1;
        }
        if(@$_POST['sub2'] != 0)
        {
            $sub2ap1 = 1;    
            $sub2 =  $_POST['sub2'];
            $is11th = 1;
        }
        if(@$_POST['sub3'] != 0)
        {
            $sub3ap1 = 1;   
            $sub3 =  $_POST['sub3'];
            $is11th = 1;
        }
        if(@$_POST['sub4'] != 0)
        {
            $sub4ap1 = 1;    
            $sub4 =  $_POST['sub4'];
            $is11th = 1;
        }
        if(@$_POST['sub5'] != 0)
        {
            $sub5ap1 = 1;    
            $sub5 =  $_POST['sub5'];
            $is11th = 1;
        }
        if(@$_POST['sub6'] != 0)
        {
            $sub6ap1 = 1;    
            $sub6 =  $_POST['sub6'];
            $is11th = 1;
        }
        if(@$_POST['sub7'] != 0)
        {
            $sub7ap1 = 1;    
            $sub7 =  $_POST['sub7'];
            $is11th = 1;
        }
        if(@$_POST['sub3p2'] != 0)
        {
            $sub8ap2 = 1;    
            $sub8 =  @$_POST['sub3p2'];

        }

        if(@$_POST['sub4p2'] != 0)
        {
            $sub4ap2 = 1;    
            $sub4 =  @$_POST['sub4p2'];

        }
        if(@$_POST['sub5p2'] != 0)
        {
            $sub5ap2 = 1;    
            $sub5a =  @$_POST['sub5p2'];

        }
        if(@$_POST['sub6p2'] != 0)
        {
            $sub6ap2 = 1;    
            $sub6a =  @$_POST['sub6p2'];

        }
        if(@$_POST['sub7p2'] != 0)
        {
            $sub7ap2 = 1;    
            $sub7a =  @$_POST['sub7p2'];

        }


        if(@$_POST['sub1p2'] != 0)
        {
            $sub1ap2 = 1; 
            $sub1 =  $_POST['sub1p2'];  
        }
        if(@$_POST['sub2p2'] != 0)
        {
            $sub2ap2 = 1; 
            $sub2 =  $_POST['sub2p2'];    
        }
        /* if(@$_POST['sub3p2'] != 0)
        {
        $sub3ap2 = 1;  
        $sub3 =  $_POST['sub3p2'];    
        }*/
        /* if(@$_POST['sub4p2'] != 0)
        {
        $sub4ap2 = 1; 
        $sub4 =  $_POST['sub4p2'];     
        }
        if(@$_POST['sub5p2'] != 0)
        {
        $sub5ap2 = 1;    
        $sub5 =  $_POST['sub5p2'];  
        }
        if(@$_POST['sub6p2'] != 0)
        {
        $sub6ap2 = 1;    
        $sub6 =  $_POST['sub6p2'];  
        }
        if(@$_POST['sub7p2'] != 0)
        {
        $sub7ap2 = 1;    
        $sub7 =  $_POST['sub7p2'];  
        }*/


        //$examtype = @$_POST['exam_type'];
        $marksImp = @$_POST['ddlMarksImproveoptions'];
        // debugBreak();

        //$cat = $this->makecat($examtype,$marksImp,$is11th);
        
        if($is11th==1)
        {
        $cat11 = 2;    
        }
        else
        {
        $cat11 = 0;        
        }
        
        $cat12 = 1;
        $Speciality = $this->input->post('speciality');
        $grp_cd = $this->input->post('std_group');

        //DebugBreak();
      
      // DebugBreak();
        $data = array(
            'name' =>$this->input->post('cand_name'),
            'Fname' =>$this->input->post('father_name'),
            'BForm' =>$this->input->post('bay_form'),
            'FNIC' =>$this->input->post('father_cnic'),
            'MobNo' =>$this->input->post('mob_number'),
            'med' =>$this->input->post('medium'),
            'classRno' =>$this->input->post('Inst_Rno'),
            'markOfIden' =>$this->input->post('MarkOfIden'),
            'Spec' =>$this->input->post('speciality'),
            'nat' =>$this->input->post('nationality'),
            'sex' =>$this->input->post('sex'),
            'Ishafiz' =>$this->input->post('hafiz'),
            //'rel' =>(4),
            'rel' =>$this->input->post('religion'),
            'addr' =>$this->input->post('address'),
            'grp_cd' =>$this->input->post('std_group_hidden'),
            'sub1' =>$this->input->post('sub1'),
            'sub2' =>$this->input->post('sub2'),
            'sub3' =>$this->input->post('sub3'),
            'sub4' =>$this->input->post('sub4'),
            'sub5' =>$this->input->post('sub5'),
            'sub6' =>$this->input->post('sub6'),
            'sub7' =>($sub7),
            'sub8' =>($sub8),
            'sub1p2' =>$this->input->post('sub1p2'),
            'sub2p2' =>$this->input->post('sub2p2'),
            //'sub3p2' =>$this->input->post('sub3p2'),
            'sub4p2' =>$this->input->post('sub4p2'),
            'sub5p2' =>$this->input->post('sub5p2'),
            'sub6p2' =>$this->input->post('sub6p2'),
            'sub7p2' =>($sub7a),
            'sub8p2' =>$sub8,
            'sub1ap1' => ($sub1ap1),
            'sub2ap1' => ($sub2ap1),
            'sub3ap1' => ($sub3ap1),
            'sub4ap1' => ($sub4ap1),
            'sub5ap1' => ($sub5ap1),
            'sub6ap1' => ($sub6ap1),
            'sub7ap1' => ($sub7ap1),
           // 'sub8ap1' => ($sub8ap1),
            'sub1ap2' => ($sub1ap2),
            'sub2ap2' => ($sub2ap2),
            //'sub3ap2' => ($sub3ap2),
            'sub4ap2' => ($sub4ap2),
            'sub5ap2' => ($sub5ap2),
            'sub6ap2' => ($sub6ap2),
            'sub7ap2' => ($sub7ap2),
            'sub8ap2' => ($sub8ap2),
            'ruralOrurban' =>$this->input->post('UrbanRural'),
            'Inst_cd' =>($Inst_Id),
            'FormNo' =>($formno),
            'cat09' =>$cat11,
            'cat10' =>$cat12,
            'rno'=>@$_POST['OldRno'],
            'sess'=>@$_POST['Oldsess'],
            'Iyear'=>@$_POST['Oldyear'],
            'Brd_cd'=>@$_POST['Oldbrd'],
            'schm'=>1,
            //'picpath'=>@$_POST['pic'],
            
            'oldFormNo'=>@$_POST['formNo'],
            ////       pvtinfo_dist     pvtinfo_teh      pvtZone
            'pvtinfo_dist'=>@$_POST['pvtinfo_dist'],
            'pvtinfo_teh'=>@$_POST['pvtinfo_teh'],
            'pvtZone'=>@$_POST['pvtZone'],






        );
        
 

    /* 
     $target_path = REGULAR_IMAGE_PATH.$Inst_Id.'/';
        if (!file_exists($target_path)){

            mkdir($target_path);
        }
       
        $base_path = GET_PRIVATE_IMAGE_PATH_COPY.@$_POST['pic'];
        $copyimg = $target_path.$formno.'.jpg';
       
        
        if (!(copy($base_path, $copyimg))) 
        {
            
            $data['excep'] = 'The picture is not upload.';
            $this->session->set_flashdata('NewEnrolment_error',$data);
                //  echo '<pre>'; print_r($allinputdata['excep']);exit();
            redirect('Admission_inter/NewEnrolment_NewForm_inter/');
        }
        
        */
        
       //DebugBreak();
        
       
        $temp_file_name = @$_POST['pic']; //'OldPics/Pic16-MA/MA11th16/123456.jpg';
        $whatIWant = substr($temp_file_name, strpos($temp_file_name, ".") - 6);    
      
        $temp_db_rno = @$_POST['OldRno'];
        $spreate_filename = explode(".",$whatIWant);
        $temp_file_rno= $spreate_filename[0];
        if($temp_file_rno != $temp_db_rno)
        {
            $allinputdata = "";
            $data_error['excep'] = 'Your Pictures is not matched. ';
            $this->session->set_flashdata('NewEnrolment_error',$data_error);
            redirect('Admission_inter/NewEnrolment_NewForm_inter/'.@$_POST['OldRno']);

            return;
        }
       
        
        $target_path = REGULAR_IMAGE_PATH.$Inst_Id;
        $base_path = GET_PRIVATE_IMAGE_PATH_COPY.@$_POST['pic'];
        if (!file_exists($target_path)){

            mkdir($target_path);
        }
        $copyimg = $target_path.$formno.'.jpg';
        if (!(copy($base_path, $copyimg))) 
        {
            $data_error['excep'] = 'The file you are attempting to upload size is between 4 to 20 Kb.';
            $this->session->set_flashdata('NewEnrolment_error',$data_error);

            redirect('Admission_inter/NewEnrolment_NewForm_inter/'.@$_POST['OldRno']);

        }
             
      
      $data_error = array(
      'formNo' =>$this->input->post('formNo'),
      
      );
    //  debugBreak();
        $this->frmvalidation('NewEnrolment_NewForm_inter',$data,0);
        $data['isupdate']=0;
        $logedIn = $this->Admission_inter_model->Insert_NewEnorlement($data);//, $fname);//$_POST['username'],$_POST['password']);
        ////DebugBreak();
        if( !isset($logedIn))
        {  
            $allinputdata = "";
            $allinputdata['excep'] = 'success';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission_inter/EditForms');
            return;
        }
        else
        {     
            $allinputdata = "";
            $allinputdata['excep'] = 'An error has occoured. Please try again later. ';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission_inter/StudentsData');
            return;
            echo 'Data NOT Saved Successfully !';
        } 
        $this->load->view('common/footer.php');
    }
     private function makecat($exam_type,$marksImp,$is11th)
    {
        // debugBreak();
        $cate =  array();

        if($exam_type == 2)

        {
            $cate['cat11'] = 1;
            $cate['cat12'] = 1;
        }
        else  if($exam_type == 1)

        {
            $cate['cat11'] = 0;
            $cate['cat12'] = 1;
        }
        else
            if($exam_type == 3)
            {
                if($is11th==1)
                {
                    $cate['cat11'] = 2;     
                }
                else{
                    $cate['cat11'] = 0;          
                }
                $cate['cat12'] = 1;
            }
            else if($exam_type == 4){
                $cate['cat11'] = 0;
                $cate['cat12'] = 2;
            }
            else if($exam_type == 5){
                $cate['cat11'] = 2;
                $cate['cat12'] = 0;
            }
            else if($exam_type == 6){
                $cate['cat11'] = 2;
                $cate['cat12'] = 2;
            }
            else if(($exam_type == 16 || ($exam_type == 16 && $cattype == 1)) && $marksImp == 2)
            {
                $cate['cat11'] = 0;
                $cate['cat12'] = 3;
            }
            else if(($exam_type == 16 || ($exam_type == 16 && $cattype == 1))  && $marksImp == 1){
                $cate['cat11'] = 3;
                $cate['cat12'] = 0;
            }
            else if(($exam_type == 16 || ($exam_type == 16 && $cattype == 1))  && $marksImp == 3){
                $cate['cat11'] = 3;
                $cate['cat12'] = 3;
            }
            else if(($exam_type == 16 || ($exam_type == 16 && $cattype == 1))  && $marksImp ==4){
                $cate['cat11'] = 7;
                $cate['cat12'] = 7;
            }

            else if($exam_type == 16 || ($exam_type == 16 && $cattype == 2)){
                $cate['cat11'] =  5;
                $cate['cat12'] = 5;
            }        
            return $cate;
    }
     public function NewEnrolment_NewForm_inter()
    {    

   // $this->uri->segment(3);
    
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $isReAdm = 0;
        $year = 0;
        $data = array(
            'isselected' => '11',
        );
        $this->load->model('Admission_inter_model');
        
        if($this->session->flashdata('NewEnrolment_error')){
           // DebugBreak();
            //$formno
            $RegStdata = $this->session->flashdata('NewEnrolment_error');   
            $isReAdm = 0;
            $RegStdData['isReAdm']=$isReAdm;
            $RegStdData['Oldrno']=0;
             $formno = $this->uri->segment(3);
            $year = 2015; 
            $error_msg = $RegStdata['excep'];
            $RegStdData = array('data'=>$this->Admission_inter_model->EditEnrolement_data($formno,$year,$Inst_Id),'isReAdm'=>$isReAdm,'Oldrno'=>0,'error_msg'=>$error_msg);

        }
        else{
            $error['excep'] = '';
            if($this->session->flashdata('IsReAdm')){
                $isReAdm = 1;
                $year = 2015;
            }
            else{
                $isReAdm = 0;
                $year = 2015;    
            }
            $formno = $this->uri->segment(3);
            $error_msg = '';
            $RegStdData = array('data'=>$this->Admission_inter_model->EditEnrolement_data($formno,$year,$Inst_Id),'isReAdm'=>$isReAdm,'Oldrno'=>0,'error_msg'=>$error_msg);
        }
        $this->load->view('common/menu.php',$data);
        $this->load->view('Admission/inter/New_Enrolement_form.php',$RegStdData);   
        $this->load->view('common/commonfooter_inter_regular.php');

    }
    public function NewEnrolment_EditForm_inter()
    {    
   //DebugBreak();
        $this->load->library('session');
        $formno = $this->uri->segment(3);
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $isReAdm = 0;
        $year = 0;
        $data = array(
            'isselected' => '11',
        );
        $msg = $this->uri->segment(3);
        if(isset($msg))
        {
          $formno=$msg;  
        }
        $this->load->model('Admission_inter_model');
     //   DebugBreak();
        if($this->session->flashdata('NewEnrolment_error')){
            //DebugBreak();
            $RegStdData['data'][0] = $this->session->flashdata('NewEnrolment_error');   
            $isReAdm = 0;
            $RegStdData['isReAdm']=$isReAdm;
            $RegStdData['Oldrno']=0;
            $formno = $RegStdData['data'][0]['FormNo'];
            $error_msg = $RegStdData['data'][0]['excep'];
            $year = 2016; 
            $RegStdData = array('data'=>$this->Admission_inter_model->EditEnrolement_singleForm($formno,$year,$Inst_Id),'isReAdm'=>$isReAdm,'Oldrno'=>0,'error_msg'=>$error_msg);

        }
        else{
            $error['excep'] = '';
            if($this->session->flashdata('IsReAdm')){
                $isReAdm = 1;
                $year = 2015;
            }
            else{
                $isReAdm = 0;
                $year = 2016;    
            }
              $error_msg = '';
            $RegStdData = array('data'=>$this->Admission_inter_model->EditEnrolement_singleForm($formno,$year,$Inst_Id),'isReAdm'=>$isReAdm,'Oldrno'=>0,'error_msg'=>$error_msg);
        }
        $this->load->view('common/menu.php',$data);
        $this->load->view('Admission/inter/Edit_Enrolement_form.php',$RegStdData);   
        $this->load->view('common/commonfooter_inter_regular.php');

    }
    public function NewEnrolment_update()
    {
        // //DebugBreak();

        $this->load->model('Admission_inter_model');

        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 11;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->commonheader($userinfo);
        if (!isset($Inst_Id))
        {
            //$error['excep'][1] = 'Please Login!';
            $this->load->view('login/login.php');
        }
        $error = array();
        // //DebugBreak();
        $formno =  $_POST['formNo'];  //$this->Admission_inter_model->GetFormNo($Inst_Id);//, $fname);//$_POST['username'],$_POST['password']);
        $target_path = IMAGE_PATH.$Inst_Id.'/';
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
        $config['max_width']     = '260';
        $config['max_height']    = '290';
        $config['overwrite']     = TRUE;
        $config['file_name']     = $formno.'.jpg';

        $filepath = $target_path. $config['file_name']  ;


        //$config['new_image']    = $formno.'.JPEG';

        $this->load->library('upload', $config);
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
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        // //DebugBreak();
        if(@$_POST['IsReAdm'] == '1')
        {


            $User_info_data = array('Inst_Id'=>$Inst_Id,'RollNo'=>@$_POST['OldRno'],'spl_case'=>17);
            $user_info  =  $this->Admission_inter_model->readmission_check($User_info_data); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);

            if($user_info == false)
            {
                $this->session->set_flashdata('error', 'This Roll No. Result is not cancelled. Please Cancel result from 9th Branch Before proceeding!');
                redirect('Admission_inter/ReAdmission');
                return;
            }
            // //DebugBreak();
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
            $formno = $this->Admission_inter_model->GetFormNo($Inst_Id);
            $allinputdata['formNo']= $formno;
            ////DebugBreak();

        }
        else{
            $allinputdata = array('name'=>@$_POST['cand_name'],'Fname'=>@$_POST['father_name'],
                'BForm'=>@$_POST['bay_form'],'FNIC'=>@$_POST['father_cnic'],
                'Dob'=>@$_POST['dob'],'CellNo'=>@$_POST['mob_number'],
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
            $allinputdata['isreadm']= 0;
        }


        /*  $this->upload->initialize($config);

        if($check !== false) {

        $file_size = round($_FILES['image']['size']/1024, 2);
        if($file_size<=20)
        {

        if ( !$this->upload->do_upload('image',True))
        {
        if($this->upload->error_msg[0] != "")
        {
        $error['excep']= $this->upload->error_msg[0];
        $allinputdata['excep'] = $this->upload->error_msg[0];
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Admission_inter/NewEnrolment_EditForm/'.$formno);
        return;

        }

        }
        }
        else
        {
        $allinputdata['excep'] = 'The file you are attempting to upload is larger than the permitted size.';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        //  echo '<pre>'; print_r($allinputdata['excep']);exit();
        redirect('Admission_inter/NewEnrolment_EditForm/'.$formno);

        }


        }
        else
        {
        $check = getimagesize($filepath);
        if($check === false)
        {
        $allinputdata['excep'] = 'Please Upload Your Picture';
        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
        redirect('Admission_inter/NewEnrolment_EditForm/'.$formno);
        return;
        }
        }*/


        ////DebugBreak();
        

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
         $cat09 = 0;
        for($i=1; $i<9; $i++)
        {
            if( ${'sub'.$i.'ap1'}==1)
            {
                $cat09 = 2;
                break;
            }
        }
        //DebugBreak();
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
            'regoldrno' =>($allinputdata['regoldrno']),
            'regoldsess' =>($allinputdata['regoldsess']),
            'regoldclass' =>( $allinputdata['regoldclass']),
            'regoldyear' =>( $allinputdata['regoldyear']),
            'isreadm'=>($allinputdata['isreadm']),
            'cat09'=>$cat09




        );
        $this->frmvalidation('NewEnrolment_EditForm/',$data,1);
        $logedIn = $this->Admission_inter_model->Update_NewEnorlement($data);//, $fname);//$_POST['username'],$_POST['password']);
        if($logedIn != false)
        {  

            $this->session->set_flashdata('error', 'success');
            redirect('Admission_inter/EditForms');
            return;

            echo 'Data Saved Successfully !';

        }
        else
        {     
            echo 'Data NOT Saved Successfully !';

        } 



        $this->load->view('common/footer.php');
    }
    public function NewEnrolment_Delete($formno)
    {
        // //DebugBreak();
        $this->load->model('Admission_inter_model');
        $RegStdData = array('data'=>$this->Admission_inter_model->Delete_NewEnrolement($formno));
        $this->load->library('session');
        $this->session->set_flashdata('error', '2');
        redirect('Admission_inter/EditForms');
        return;
    }
    public function BatchRelease()
    {
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        // //DebugBreak();
        $data = array(
            'isselected' => '11',
        );
        $Batch_ID = $this->uri->segment(3);
        $this->load->view('common/header.php',$userinfo);
        $this->commonheader($data);
        if(!( $this->session->flashdata('BatchList_error'))){

            $error['batchId']= $Batch_ID;    
        }
        else{
            $error = $this->session->flashdata('BatchList_error');
        }
        // echo $error['batchId'];
        // $myinfo = array('error'=>$error_msg_readmission);
        $this->load->view('Admission/inter/BatchRelease.php',$error);//,$myinfo);
        $this->load->view('common/commonfooter_inter_regular.php');
    }
    public function Batchlist_INSERT()
    {
        $this->load->model('Admission_inter_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $data = array(
            'isselected' => '11',
        );
        $userinfo['isselected'] = 11;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
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
        //DebugBreak();
        if($batchId == 0 || $batchId == ''){
            $allinputdata['BatchRelease_excep'] = 'Please Select Batch From Batch List Section';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Admission_inter/BatchRelease');
            return;
        }
        else if($reason == ''){
            $allinputdata['BatchRelease_excep'] = 'Please Give Reason';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Admission_inter/BatchRelease');
            return;
        }
        else if($branch =='' ){
            $allinputdata['BatchRelease_excep'] = 'Please Select Bank Branch';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Admission_inter/BatchRelease');
            return;
        }
        else if ($challan == '' || $challan == 0){
            $allinputdata['BatchRelease_excep'] = 'Please Give Challan No.';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Admission_inter/BatchRelease');
            return;
        }
        else if ($amount == '' || $amount == 0){
            $allinputdata['BatchRelease_excep'] = 'Please Give Amount';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Admission_inter/BatchRelease');
            return;
        }
        else if($date == '' || $date == 0){
            $allinputdata['BatchRelease_excep'] = 'Please Select Paid Date';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Admission_inter/BatchRelease');
            return;
        }

        $allinputdata['Inst_Id'] = $Inst_Id;
        $user_info  =  $this->Admission_inter_model->ReleaseBatch_INSERT($allinputdata); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);
        if($user_info == true){
            $allinputdata['BatchRelease_excep'] = 'Applied Successfully.';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Admission_inter/BatchList');
            return;
        }
        else{
            $allinputdata['BatchRelease_excep'] = 'Not Applied Successfully! An Error occoured, Please Try Again Latter.';
            $this->session->set_flashdata('BatchList_error',$allinputdata);
            redirect('Admission_inter/BatchRelease');
            return;
        }

    }
    public function ReAdmission_check()
    {
        // //DebugBreak();
        $RollNo = $this->uri->segment(3);
        //$Spl_case = $this->uri->segment(4);

        $this->load->model('Admission_inter_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $data = array(
            'isselected' => '2',
        );
        $userinfo['isselected'] = 2;
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->view('common/header.php',$userinfo);
        $User_info_data = array('Inst_Id'=>$Inst_Id,'RollNo'=>$RollNo,'spl_case'=>17);
        $user_info  =  $this->Admission_inter_model->readmission_check($User_info_data); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);

        if($user_info == false)
        {
            $this->session->set_flashdata('error', 'This Roll No. Result is not cancelled. Please Cancel result from 9th Branch Before proceeding!');
            redirect('Admission_inter/ReAdmission');
            return;
        }
        else
        {
            $formno = $user_info[0]['formNo'];
            $OldRno = $user_info[0]['rno'];
            $year = 2015;
            $RegStdData = array('data'=>$this->Admission_inter_model->EditEnrolement_data($formno,$year,$Inst_Id),'isReAdm'=>'1','Oldrno'=>$OldRno);

            $filledinfo['error'] = "";
            //$this->session->set_flashdata('isReAdm','1');
            $this->load->view('common/menu.php',$data);
            $this->load->view('Admission_inter/9th/Edit_Enrolement_form.php',$RegStdData);   
            $this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js"))); 
        }
    }
     public function EditForms()
    {
     //  DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '11',

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
        $this->load->model('Admission_inter_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        $RegStdData = array('data'=>$this->Admission_inter_model->EditEnrolement($user['Inst_Id']),'grp_cd'=>$user['grp_cd']);
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('Admission/inter/EditForms.php',$RegStdData);
        $this->load->view('common/commonfooter_inter_regular.php');



    }
    public function NewForms()
    {
     //  DebugBreak();
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '11',

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
        $this->load->model('Admission_inter_model');
        //  $error['grp_cd'] = $user['grp_cd'];
        $RegStdData = array('data'=>$this->Admission_inter_model->EditEnrolement($user['Inst_Id']),'grp_cd'=>$user['grp_cd']);
        $RegStdData['msg_status'] = $error_msg;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('Admission/inter/EditForms.php',$RegStdData);
        $this->load->view('common/commonfooter_inter_regular.php');



    }
     public function BatchList()
    {
        // //DebugBreak();
        $data = array(
            'isselected' => '11',

        );
        // $this->commonheader($data);
        $this->load->model('Admission_inter_model');
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
        $user_info  =  $this->Admission_inter_model->Batch_List($data1);
        $user_info_arr = array('info'=>$user_info,'errors'=>$error_msg);
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);

        $this->load->view('Admission/inter/BatchList.php',$user_info_arr);


        $this->load->view('common/commonfooter_inter_regular.php');
        //$this->commonheader($data);
        //  $this->load->view('Admission_inter/9th/BatchList.php');
        //$this->commonfooter();
    }
    public function ProofReading()
    {
        $data = array(
            'isselected' => '11',

        );
        $this->commonheader($data);
        $this->load->view('Admission/inter/ProofReading.php');
        $this->commonfooter();
    }
    public function CreateBatch()
    {
       // DebugBreak();
        $data = array(
            'isselected' => '11',

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
        $this->load->model('Admission_inter_model');
        $myinfo = array('Inst_cd'=>$user['Inst_Id'],'spl_cd'=>$spl_cd,'grp_cd'=>$user['grp_cd'],'grp_selected'=>$grp_selected);
        $RegStdData = array('data'=>$this->Admission_inter_model->Spl_case_std_list($myinfo),'spl_cd'=>$spl_cd,'grp_selected'=>$grp_selected);
        $RegStdData['msg_status'] = $error_msg;
        $RegStdData['spl_cd'] =  $spl_cd;
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);

        $this->load->view('Admission/inter/CreateBatch.php',$RegStdData);
        $this->load->view('common/commonfooter_inter_regular.php');



    }
    public function Make_Batch_Group_wise()
    {
       // DebugBreak();
        $RegGrp = $this->uri->segment(3);
        $Spl_case = $this->uri->segment(4);

        $this->load->model('Admission_inter_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 11;
        $Inst_Id = $userinfo['Inst_Id'];
        $page_name  = "Create Batch";
        $User_info_data = array('Inst_Id'=>$Inst_Id,'RegGrp'=>$RegGrp,'spl_case'=>$Spl_case);
        $user_info  =  $this->Admission_inter_model->user_info($User_info_data); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);
        if($user_info == false)
        {
            $this->session->set_flashdata('error', '3');
            redirect('Admission_inter/CreateBatch');
            return;
        }
       // $is_gov            =  $user_info['info'][0]['IsGovernment'];  //getValue("IsGovernment", " Admission_online..tblinstitutes_all", "Inst_cd =".$user->inst_cd);
        /*====================  Counting Fee  ==============================*/
        $processing_fee = 0;
        $Adm_fee           = 0;
        $LAdm_fee          = 0;
        $TotalAdmFee = 0;
        $TotalLatefee = 0;
        $Totalprocessing_fee = 0;
        $netTotal = 0;
        /*====================  Counting Fee  ==============================*/    
              $practical_Sub = array(
            'LibSC'=>'8',
            'GEO'=>'12',
            'PSY'=>'16',
            'ST'=>'18',
            'H-ECO'=>'21',
            'F/ART'=>'23',
            'CP'=>'38',
            'HPD'=>'42',
            'BIO'=>'46',
            'PHY'=>'47',
            'CH'=>'48',
            'Cl/T'=>'75',
            'HM'=>'76',
            'NUR'=>'79',
            'CSc'=>'83',
            'AGRI'=>'90',
            'TYP'=>'96',
            'CST'=>'98',
            
        );
        // DebugBreak();
        $ispractical = 0;
        $AdmFee = $this->Admission_inter_model->getrulefee($ispractical);//$this->makefee($cat,$Speciality,$sub7,$sub8,$grp_cd,$per_grp);
        $Adm_Fee_withSci_Composite = $AdmFee[0]['Comp_Amount'];
        $Adm_Fee_withSci_10th_Only = $AdmFee[0]['Amount'];
        $Adm_Fee_withArts_Composite = $AdmFee[1]['Comp_Amount'];
        $Adm_Fee_withArts_10th_Only = $AdmFee[1]['Amount'];
        $Adm_ProcessingFee = $AdmFee[0]['Processing_Fee'];
        DebugBreak();
        $q1 = $user_info['fee'];
        $total_std = 0;
        foreach($q1 as $k=>$v) 
        {
            $ids[] = $v["FormNo"];
            $total_std++;
            $ispractical = 0;
            $is9th = 0;
             if($v["Spec"] == 1 || $v["Spec"] ==  2)
                {
                    $Adm_fee = 0;
                    $TotalLatefee = $TotalLatefee + $LAdm_fee;
                    $Adm_ProcessingFee; 
                   // $Totalprocessing_fee = $Totalprocessing_fee + $Adm_ProcessingFee;
                }
                else
                {
                    if($v['grp_cd']==1 ||$v['grp_cd']==2 || $v['grp_cd']==4)
                    {
                        $ispractical = 1;    
                    }
                   if(array_search($v['sub4'],$practical_Sub) || array_search($v['sub5'],$practical_Sub) || array_search($v['sub5a'],$practical_Sub) || array_search($v['sub6a'],$practical_Sub) || array_search($v['sub6'],$practical_Sub) || array_search($v['sub7a'],$practical_Sub))
                    {
                    $ispractical =1;
                     }
                     else
                     {
                         $ispractical =0;
                     }
                    
                    if($v['cat11'] != 0)
                    {
                        $is9th=1;
                    }
                    else
                    {
                        $is9th=0;
                    }
                    if($ispractical == 1 && $is9th==0)
                    {
                    
                    $Adm_fee = $Adm_Fee_withSci_10th_Only;
                    $TotalLatefee = $TotalLatefee + $LAdm_fee;
                    $Adm_ProcessingFee; 
                   // $Totalprocessing_fee = $Totalprocessing_fee + $Adm_ProcessingFee;
                    }
                    else if($ispractical == 1 && $is9th != 0)
                    {
                    $Adm_fee = $Adm_Fee_withSci_Composite;
                    $TotalLatefee = $TotalLatefee + $LAdm_fee;
                    $Adm_ProcessingFee; 
                   // $Totalprocessing_fee = $Totalprocessing_fee + $Adm_ProcessingFee;  
                    }
                    else if($ispractical == 0 && $is9th ==0)
                    {
                    $Adm_fee = $Adm_Fee_withArts_10th_Only;
                    $TotalLatefee = $TotalLatefee + $LAdm_fee;
                    $Adm_ProcessingFee; 
                   // $Totalprocessing_fee = $Totalprocessing_fee + $Adm_ProcessingFee;  
                    }
                    else if($ispractical == 0 && $is9th !=0)
                    {
                    $Adm_fee = $Adm_Fee_withArts_Composite;
                    $TotalLatefee = $TotalLatefee + $LAdm_fee;
                    $Adm_ProcessingFee; 
                  //  $Totalprocessing_fee = $Totalprocessing_fee + $Adm_ProcessingFee;  
                    }
                    //$AdmFee
                }
            
                    $TotalAdmFee = $TotalAdmFee + $Adm_fee;
                    $TotalLatefee = $TotalLatefee + $LAdm_fee;
                    $Totalprocessing_fee = $Totalprocessing_fee + $Adm_ProcessingFee;
                } 
             
            

            $netTotal = (int)$netTotal +$Adm_fee + $LAdm_fee+$Adm_ProcessingFee;
        


        $forms_id   = implode(",",$ids);        
        $tot_fee     = $Totalprocessing_fee+$TotalAdmFee+$TotalLatefee;
        // $challan_No = 0;
        $today = date("Y-m-d H:i:s");
        $data = array('inst_cd'=>$Inst_Id,'total_fee'=>$tot_fee,'proces_fee'=>$Adm_ProcessingFee,'reg_fee'=>$Adm_fee,'fine'=>$LAdm_fee,'TotalRegFee'=>$TotalAdmFee,'TotalLatefee'=>$TotalLatefee,'Totalprocessing_fee'=>$Totalprocessing_fee,'forms_id'=>$forms_id,'todaydate'=>$today,'total_std'=>$total_std);
        $this->Admission_inter_model->Batch_Insertion($data); 
        redirect('Admission_inter/BatchList');
        return;
        // $result    = $db->query(" EXEC Batch_Create @Inst_Cd = ".$user->inst_cd.",@UserId = ".$user->get_currentUser_ID()."@Amount = ".$tot_fee.",@Total_ProcessingFee = ".$prs_fee.",@Total_Admission_interFee = ".$reg_fee.",@Total_LateAdmission_interFee =".$late_fee.",@Total_LateAdmissionFee = 0,@Valid_Date = '$today',@form_ids = '$forms_id'");

        // redirect_to("create-batch.php");


        //  $iselectricalactive = getValue("iselectricalallow", "Admission_online..tblinstitutes_all", "Inst_cd =".$user->inst_cd); 
    }
    public function Make_Batch_Formwise()
    {
      //  DebugBreak();
        if(!empty($_POST["chk"]))
        {

            $forms_id =   "'".implode("','",$_POST["chk"])."'";    
        }
        else{
            return;
        }

        DebugBreak();
        $RegGrp = $this->uri->segment(3);
        $this->load->model('Admission_inter_model');
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 11;
        $Inst_Id = $userinfo['Inst_Id'];
        $page_name  = "Create Batch";
        $rule_fee = $this->Admission_inter_model->getrulefee();
        $User_info_data = array('Inst_Id'=>$Inst_Id,'forms_id'=>$forms_id,'rule_fee'=>$rule_fee[0]['Rule_Fee_ID']);
        $user_info  =  $this->Admission_inter_model->user_info_Formwise($User_info_data); //$db->first("SELECT * FROM  Admission_online..tblinstitutes_all WHERE Inst_Cd = " .$user->inst_cd);
        $is_gov            =  $user_info['info'][0]['IsGovernment'];  //getValue("IsGovernment", " Admission_online..tblinstitutes_all", "Inst_cd =".$user->inst_cd);
            /*====================  Counting Fee  ==============================*/
        $processing_fee = 0;
        $Adm_fee           = 0;
        $LAdm_fee          = 0;
        $TotalAdmFee = 0;
        $TotalLatefee = 0;
        $Totalprocessing_fee = 0;
        $netTotal = 0;
        
        /*====================  Counting Fee  ==============================*/    
                      $practical_Sub = array(
            'LibSC'=>'8',
            'GEO'=>'12',
            'PSY'=>'16',
            'ST'=>'18',
            'H-ECO'=>'21',
            'F/ART'=>'23',
            'CP'=>'38',
            'HPD'=>'42',
            'BIO'=>'46',
            'PHY'=>'47',
            'CH'=>'48',
            'Cl/T'=>'75',
            'HM'=>'76',
            'NUR'=>'79',
            'CSc'=>'83',
            'AGRI'=>'90',
            'TYP'=>'96',
            'CST'=>'98',
            
        );
        // DebugBreak();
        $ispractical = 0;
        $AdmFee =$rule_fee;// $this->Admission_inter_model->getrulefee($ispractical);//$this->makefee($cat,$Speciality,$sub7,$sub8,$grp_cd,$per_grp);
        $Adm_Fee_withSci_Composite = $AdmFee[0]['Comp_Amount'];
        $Adm_Fee_withSci_10th_Only = $AdmFee[0]['Amount'];
        $Adm_Fee_withArts_Composite = $AdmFee[1]['Comp_Amount'];
        $Adm_Fee_withArts_10th_Only = $AdmFee[1]['Amount'];
        $Adm_ProcessingFee = $AdmFee[0]['Processing_Fee'];
      // DebugBreak();
        $q1 = $user_info['fee'];
        $total_std = 0;
        foreach($q1 as $k=>$v) 
        {
            $ids[] = $v["FormNo"];
            $total_std++;
            $ispractical = 0;
            $is9th = 0;
             if($v["Spec"] == 1 || $v["Spec"] ==  2)
                {
                    $Adm_fee = 0;
                    $TotalLatefee = $TotalLatefee + $LAdm_fee;
                    $Totalprocessing_fee = $Totalprocessing_fee + $Adm_ProcessingFee;
                }
                else
                {
                    if($v['grp_cd']==1 ||$v['grp_cd']==2 || $v['grp_cd']==4)
                    {
                        $ispractical = 1;    
                    }
                   if(array_search($v['sub4'],$practical_Sub) || array_search($v['sub5'],$practical_Sub) || array_search($v['sub5a'],$practical_Sub) || array_search($v['sub6a'],$practical_Sub) || array_search($v['sub6'],$practical_Sub) || array_search($v['sub7a'],$practical_Sub))
                    {
                    $ispractical =1;
                     }
                     else
                     {
                         $ispractical =0;
                     }
                    
                    if($v['cat11'] != 0)
                    {
                        $is9th=1;
                    }
                    else
                    {
                        $is9th=0;
                    }
                    if($ispractical == 1 && $is9th==0)
                    {
                    
                    $Adm_fee = $Adm_Fee_withSci_10th_Only;
                     $LAdm_fee;
                    $Adm_ProcessingFee;
                    }
                    else if($ispractical == 1 && $is9th != 0)
                    {
                    $Adm_fee = $Adm_Fee_withSci_Composite;
                     $LAdm_fee;
                    $Adm_ProcessingFee;  
                    }
                    else if($ispractical == 0 && $is9th ==0)
                    {
                    $Adm_fee = $Adm_Fee_withArts_10th_Only;
                     $LAdm_fee;
                    $Adm_ProcessingFee;  
                    }
                    else if($ispractical == 0 && $is9th !=0)
                    {
                    $Adm_fee = $Adm_Fee_withArts_Composite;
                     $LAdm_fee;
                     $Adm_ProcessingFee;  
                    }
                    //$AdmFee
                }
            
                    $TotalAdmFee = $TotalAdmFee + $Adm_fee;
                    $TotalLatefee = $TotalLatefee + $LAdm_fee;
                    $Totalprocessing_fee = $Totalprocessing_fee + $Adm_ProcessingFee;
                } 
             
            

            $netTotal = (int)$netTotal +$Adm_fee + $LAdm_fee+$Adm_ProcessingFee;
        


        $forms_id   = implode(",",$ids);        
        $tot_fee     = $Totalprocessing_fee+$TotalAdmFee+$TotalLatefee;
        // $challan_No = 0;
        $today = date("Y-m-d H:i:s");
        $data = array('inst_cd'=>$Inst_Id,'total_fee'=>$tot_fee,'proces_fee'=>$Adm_ProcessingFee,'reg_fee'=>$Adm_fee,'fine'=>$LAdm_fee,'TotalRegFee'=>$TotalAdmFee,'TotalLatefee'=>$TotalLatefee,'Totalprocessing_fee'=>$Totalprocessing_fee,'forms_id'=>$forms_id,'todaydate'=>$today,'total_std'=>$total_std);
        $this->Admission_inter_model->Batch_Insertion($data); 
        redirect('Admission_inter/BatchList');
        return;
    }
    public function FormPrinting()
    {

        $this->load->library('session');
        ////DebugBreak();
        if(!( $this->session->flashdata('error'))){

            $error_msg = "0";    
        }
        else{
            $error_msg = $this->session->flashdata('error');
        }
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $this->load->view('common/header.php',$userinfo);
        $data = array(
            'isselected' => '11',
        );
        //  //DebugBreak();
        $error = array();
        $error['excep'] = '';
        $error['gender'] = $userinfo['gender'];
        $error['isrural'] = $userinfo['isrural'];
        $error['error_msg'] = $error_msg;
        $this->commonheader($data);
        $this->load->view('Admission/inter/FormPrinting.php',$error);
        $this->load->view('common/commonfooter_inter_regular.php');
        //$this->commonfooter(array("files"=>array("jquery.maskedinput.js","validate.NewEnrolment.js")));

        //$this->load->model('Admission_inter_model');
    }
    private function set_barcode($code)
    {
        ////DebugBreak()  ;
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

      //  DebugBreak();

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
        $this->load->model('Admission_inter_model');
        if($Condition == "1")
        {
            $Batch_Id = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
            $result = array('data'=>$this->Admission_inter_model->return_pdf($fetch_data),'inst_Name'=>$user['inst_Name']);    
        }
        else if($Condition == "2")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>0);
            $result = array('data'=>$this->Admission_inter_model->Print_Form_Groupwise($fetch_data));

        }

        else if($Condition == "3")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);


            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>0);
            $result = array('data'=>$this->Admission_inter_model->Print_Form_Formnowise($fetch_data));
        }
        else if($Condition == "4")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>-1);
            $result = array('data'=>$this->Admission_inter_model->Print_Form_Groupwise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }
        else if($Condition == "5")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>-1);
            $result = array('data'=>$this->Admission_inter_model->Print_Form_Formnowise($fetch_data),'inst_Name'=>$user['inst_Name']);

        }

        // //DebugBreak();
        if(empty($result['data'])){
            $this->session->set_flashdata('error', $Condition);
            redirect('Admission_inter/FormPrinting');
            return;

        }
        $temp = $user['Inst_Id'].'09-2016-18';
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
        // //DebugBreak();
        foreach ($result as $key=>$data) 
        {
            ////DebugBreak();
            ////DebugBreak();
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
                $pdf->Cell(0, 0.25, "inter PART-II ADMISSION RETURN SESSION (2016-2018)", 0.25, "C");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(2.6,0.4);
                $pdf->Image(BARCODE_PATH.$image,6.3,0.43, 1.8, 0.20, "PNG"); 
                $pdf->SetFont('Arial','',9);
                $pdf->SetXY(1.4,0.6);
                $pdf->Cell(0, 0.25,$user['Inst_Id']. "-". $user['inst_Name'], 0.25, "C");

                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(6.9,0.8);
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
                        $grp_name = 'Humanities';
                        break;
                    case '5':
                        $grp_name = 'Deaf and Dumb';
                        break;
                    default:
                        $grp_name = "No Group Selected.";
                }
                $pdf->SetFont('Arial','',10);
                $pdf->SetXY(2.5,0.8);
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
                $pdf->Text($col4+.1,$title+.31,"Relegion");
                $pdf->Text($col4+.1,$title+.45,"Old RNo-Year");

                $pdf->Text($col5+.1,$title+.3,"Subjects");

                $pdf->Text($col6+.1,$title+.3,"Picture");
            }
            $dob = date("d-m-Y", strtotime($data["Dob"]));
            $adm = date("d-m-Y", strtotime($data["edate"]));

            //============================ Values ==========================================            
            $pdf->SetFont('Arial','',10);    
            $pdf->Text($lmargin+.1  , $ln[$countofrecords]+0.3 , $SR);                 // Sr No
            $pdf->Text($col1+.05    , $ln[$countofrecords]+0.3,$data["formNo"]);       // Form No

            $pdf->SetFont('Arial','B',8);    
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.2,strtoupper($data["name"]));
            $pdf->SetFont('Arial','',8);                
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.4,strtoupper($data["Fname"]));
            $pdf->SetFont('Arial','',7.5);                
            $pdf->Text($col2+.1,$ln[$countofrecords]+0.55,$data["MobNo"]);
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
            $pdf->Text($col5+.05,$ln[$countofrecords]+0.2,  $data["sub1_abr"].','.$data["sub2_abr"].','.$data["sub3_abr"].','.$data["sub4_abr"]);
            $pdf->SetFont('Arial','',7);    
            $pdf->Text($col5+.05,$ln[$countofrecords]+0.4,$data["sub5_abr"].','.$data["sub6_abr"].','.$data["sub7_abr"].','.$data["sub8_abr"]);

            //$pdf->Image(IMAGE_PATH.$data["Sch_cd"].'/'.$data["PicPath"],$col6+0.05,$ln[$countofrecords]+0.05 , 0.50, 0.50, "JPG"); 

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
        //  //DebugBreak();
        $Batch_Id = $this->uri->segment(3);
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Admission_inter_model');
        $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
        $temp = $user['Inst_Id'].'09-2016-18';
        $image =  $this->set_barcode($temp);
        $data = array('data'=>$this->Admission_inter_model->revenue_pdf($fetch_data),'inst_Name'=>$user['inst_Name'],'inst_cd'=>$user['Inst_Id'],'barcode'=>$image);
        $this->load->view('Admission/inter/RevenueForm.php',$data);
    }
    public function commonheader($data)
    {
        $this->load->view('common/header.php',$data);
        $this->load->view('common/menu.php',$data);
    } 
    public function GetSubNameHere($_sub_cd)
    {
        $ret_val = "";
        if($_sub_cd == 1)  $ret_val = "URDU";
        else if($_sub_cd == 2)  $ret_val = "ENGLISH";
            else if($_sub_cd == 3)  $ret_val = "ISLAMIYAT (COMPULSORY)";
                else if($_sub_cd == 4)  $ret_val = "PAKISTAN STUDIES";
                    else if($_sub_cd == 5)  $ret_val = "MATHEMATICS";
                        else if($_sub_cd == 6)  $ret_val = "PHYSICS";
                            else if($_sub_cd == 7)  $ret_val = "CHEMISTRY";
                                else if($_sub_cd == 8)  $ret_val = "BIOLOGY";
                                    else if($_sub_cd == 9)  $ret_val = "GENERAL SCIENCE";
                                        else if($_sub_cd == 11)  $ret_val = "GEOGRAPHY OF PAKISTAN";
                                            else if($_sub_cd == 18)  $ret_val = "ART/ART & MODEL DRAWING";
                                                else if($_sub_cd == 22)  $ret_val = "ARABIC";
                                                    else if($_sub_cd == 23)  $ret_val = "PERSIAN";
                                                        else if($_sub_cd == 36)  $ret_val = "PUNJABI";
                                                            else if($_sub_cd == 20)  $ret_val = "ISLAMIC HISTORY";
                                                                else if($_sub_cd == 21)  $ret_val = "HISTORY OF PAKISTAN/ HISTORY OF INDO PAK";
                                                                    else if($_sub_cd == 78)  $ret_val = "COMPUTER SCIENCE";
                                                                        else if($_sub_cd == 12)  $ret_val = "HOUSE HOLD ACCOUNTS & ITS RELATED PROBLEMS";
                                                                            else if($_sub_cd == 13)  $ret_val = "ELEMENTS OF HOME ECONOMICS";
                                                                                else if($_sub_cd == 14)  $ret_val = "PHYSIOLOGY & HYGIENE";
                                                                                    else if($_sub_cd == 15)  $ret_val = "GEOMETRICAL & TECHNICAL DRAWING";
                                                                                        else if($_sub_cd == 16)  $ret_val = "GEOLOGY";
                                                                                            else if($_sub_cd == 17)  $ret_val = "ASTRONOMY & SPACE SCIENCE";
                                                                                                else if($_sub_cd == 19)  $ret_val = "ISLAMIC STUDIES";
                                                                                                    else if($_sub_cd == 27)  $ret_val = "FOOD AND NUTRITION";
                                                                                                        else if($_sub_cd == 28)  $ret_val = "ART IN HOME ECONOMICS";
                                                                                                            else if($_sub_cd == 29)  $ret_val = "MANAGEMENT FOR BETTER HOME";
                                                                                                                else if($_sub_cd == 30)  $ret_val = "CLOTHING & TEXTILES";
                                                                                                                    else if($_sub_cd == 31)  $ret_val = "CHILD DEVELOPMENT AND FAMILY LIVING";
                                                                                                                        else if($_sub_cd == 32)  $ret_val = "MILITARY SCIENCE";
                                                                                                                            else if($_sub_cd == 33)  $ret_val = "COMMERCIAL GEOGRAPHY";
                                                                                                                                else if($_sub_cd == 34)  $ret_val = "URDU LITERATURE";
                                                                                                                                    else if($_sub_cd == 35)  $ret_val = "ENGLISH LITERATURE";
                                                                                                                                        else if($_sub_cd == 37)  $ret_val = "EDUCATION";
                                                                                                                                            else if($_sub_cd == 38)  $ret_val = "ELEMENTARY NURSING & FIRST AID";
                                                                                                                                                else if($_sub_cd == 39)  $ret_val = "PHOTOGRAPHY";
                                                                                                                                                    else if($_sub_cd == 40)  $ret_val = "HEALTH & PHYSICAL EDUCATION";
                                                                                                                                                        else if($_sub_cd == 41)  $ret_val = "CALIGRAPHY";
                                                                                                                                                            else if($_sub_cd == 42)  $ret_val = "LOCAL (COMMUNITY) CRAFTS";
                                                                                                                                                                else if($_sub_cd == 43)  $ret_val = "ELECTRICAL WIRING";
                                                                                                                                                                    else if($_sub_cd == 44)  $ret_val = "RADIO ELECTRONICS";
                                                                                                                                                                        else if($_sub_cd == 45)  $ret_val = "COMMERCE";
                                                                                                                                                                            else if($_sub_cd == 46)  $ret_val = "AGRICULTURE";
                                                                                                                                                                                else if($_sub_cd == 53)  $ret_val = "ANIMAL PRODUCTION";
                                                                                                                                                                                    else if($_sub_cd == 54)  $ret_val = "PRODUCTIVE INSECTS AND FISH CULTURE";
                                                                                                                                                                                        else if($_sub_cd == 55)  $ret_val = "HORTICULTURE";
                                                                                                                                                                                            else if($_sub_cd == 56)  $ret_val = "PRINCIPLES OF HOME ECONOMICS";
                                                                                                                                                                                                else if($_sub_cd == 57)  $ret_val = "RELATED ACT";
                                                                                                                                                                                                    else if($_sub_cd == 58)  $ret_val = "HAND AND MACHINE EMBROIDERY";
                                                                                                                                                                                                        else if($_sub_cd == 59)  $ret_val = "DRAFTING AND GARMENT MAKING";
                                                                                                                                                                                                            else if($_sub_cd == 60)  $ret_val = "HAND & MACHINE KNITTING & CROCHEING";
                                                                                                                                                                                                                else if($_sub_cd == 61)  $ret_val = "STUFFED TOYS AND DOLL MAKING";
                                                                                                                                                                                                                    else if($_sub_cd == 62)  $ret_val = "CONFECTIONERY AND BAKERY";
                                                                                                                                                                                                                        else if($_sub_cd == 63)  $ret_val = "PRESERVATION OF FRUITS,VEGETABLES & OTHER FOODS";
                                                                                                                                                                                                                            else if($_sub_cd == 64)  $ret_val = "CARE AND GUIDENCE OF CHILDREN";
                                                                                                                                                                                                                                else if($_sub_cd == 65)  $ret_val = "FARM HOUSE HOLD MANAGEMENT";
                                                                                                                                                                                                                                    else if($_sub_cd == 66)  $ret_val = "ARITHEMATIC";
                                                                                                                                                                                                                                        else if($_sub_cd == 67)  $ret_val = "BAKERY";
                                                                                                                                                                                                                                            else if($_sub_cd == 68)  $ret_val = "CARPET MAKING";
                                                                                                                                                                                                                                                else if($_sub_cd == 69)  $ret_val = "DRAWING";
                                                                                                                                                                                                                                                    else if($_sub_cd == 70)  $ret_val = "EMBORIDERY";
                                                                                                                                                                                                                                                        else if($_sub_cd == 71)  $ret_val = "HISTORY";
                                                                                                                                                                                                                                                            else if($_sub_cd == 72)  $ret_val = "TAILORING";
                                                                                                                                                                                                                                                                else if($_sub_cd == 24)  $ret_val = "GEOGRAPHY";
                                                                                                                                                                                                                                                                    else if($_sub_cd == 25)  $ret_val = "ECONOMICS";
                                                                                                                                                                                                                                                                        else if($_sub_cd == 26)  $ret_val = "CIVICS";
                                                                                                                                                                                                                                                                            else if($_sub_cd == 47)  $ret_val = "BOOK KEEPING & ACCOUNTANCY";
                                                                                                                                                                                                                                                                                else if($_sub_cd == 48)  $ret_val = "WOOD WORK (FURNITURE MAKING)";
                                                                                                                                                                                                                                                                                    else if($_sub_cd == 49)  $ret_val = "GENERAL AGRICULTURE";
                                                                                                                                                                                                                                                                                        else if($_sub_cd == 50)  $ret_val = "FARM ECONOMICS";
                                                                                                                                                                                                                                                                                            else if($_sub_cd == 52)  $ret_val = "LIVE STOCK FARMING";
                                                                                                                                                                                                                                                                                                else if($_sub_cd == 73)  $ret_val = "TYPE WRITING";
                                                                                                                                                                                                                                                                                                    else if($_sub_cd == 74)  $ret_val = "WEAVING";
                                                                                                                                                                                                                                                                                                        else if($_sub_cd == 75)  $ret_val = "SECRETARIAL PRACTICE";
                                                                                                                                                                                                                                                                                                            else if($_sub_cd == 76)  $ret_val = "CANDLE MAKING";
                                                                                                                                                                                                                                                                                                                else if($_sub_cd == 77)  $ret_val = "SECRETARIAL PRACTICE AND CORRESPONDANCE";
                                                                                                                                                                                                                                                                                                                    else if($_sub_cd == 10)  $ret_val = "FOUNDATION OF EDUCATION";
                                                                                                                                                                                                                                                                                                                        else if($_sub_cd == 51)  $ret_val = "ETHICS";
                                                                                                                                                                                                                                                                                                                            else if($_sub_cd == 79)  $ret_val = "WOOD WORK (BOAT MAKING)";
                                                                                                                                                                                                                                                                                                                                else if($_sub_cd == 80)  $ret_val = "PRINCIPLES OF ARITHMATIC";
                                                                                                                                                                                                                                                                                                                                    else if($_sub_cd == 81)  $ret_val = "SEERAT-E-RASOOL";
                                                                                                                                                                                                                                                                                                                                        else if($_sub_cd == 82)  $ret_val = "AL-QURAAN";
                                                                                                                                                                                                                                                                                                                                            else if($_sub_cd == 83)  $ret_val = "POULTRY FARMING";
                                                                                                                                                                                                                                                                                                                                                else if($_sub_cd == 84)  $ret_val = "ART & MODEL DRAWING";
                                                                                                                                                                                                                                                                                                                                                    else if($_sub_cd == 85)  $ret_val = "BUSINESS STUDIES";
                                                                                                                                                                                                                                                                                                                                                        else if($_sub_cd == 86)  $ret_val = "HADEES & FIQAH";
                                                                                                                                                                                                                                                                                                                                                            else if($_sub_cd == 87)  $ret_val = "ENVIRONMENTAL STUDIES";
                                                                                                                                                                                                                                                                                                                                                                else if($_sub_cd == 88)  $ret_val = "REFRIGERATION AND AIR CONDITIONING";
                                                                                                                                                                                                                                                                                                                                                                    else if($_sub_cd == 89)  $ret_val = "FISH FARMING";
                                                                                                                                                                                                                                                                                                                                                                        else if($_sub_cd == 90)  $ret_val = "COMPUTER HARDWARE";
                                                                                                                                                                                                                                                                                                                                                                            else if($_sub_cd == 91)  $ret_val = "BEAUTICIAN";
                                                                                                                                                                                                                                                                                                                                                                                else if($_sub_cd == 92)  $ret_val = "General Math"; 
                                                                                                                                                                                                                                                                                                                                                                                    else if($_sub_cd == 93)  $ret_val = "COMPUTER SCIENCES_DFD";    
                                                                                                                                                                                                                                                                                                                                                                                        else if($_sub_cd == 94)  $ret_val = "HEALTH & PHYSICAL EDUCATION_DFD";   
                                                                                                                                                                                                                                                                                                                                                                                            return $ret_val ;             
    }

    public function commonfooter($data)
    {
        $this->load->view('common/footer.php',$data);
    }
    public function Print_Admission_inter_Form_Proofreading_Groupwise()
    {

      // DebugBreak();
        $Condition = $this->uri->segment(4);

        $this->load->library('session');

        $Logged_In_Array = $this->session->all_userdata();
        $user = $Logged_In_Array['logged_in'];
        $this->load->model('Admission_inter_model');

        if($Condition == "1")
        {
            $grp_cd = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'grp_cd'=>$grp_cd,'Batch_Id'=>-1);
            $result = array('data'=>$this->Admission_inter_model->Print_Form_Groupwise($fetch_data),'inst_Name'=>$user['inst_Name']);
        }
        else if($Condition == "2")
        {
            $start_formno = $this->uri->segment(3);
            $end_formno = $this->uri->segment(5);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'start_formno'=>$start_formno,'end_formno'=>$end_formno,'Batch_Id'=>-1);
            $result = array('data'=>$this->Admission_inter_model->Print_Form_Formnowise($fetch_data),'inst_Name'=>$user['inst_Name']);
            //Print_Form_Formnowise
        }
           if($Condition == "3")
        {
            $Batch_Id = $this->uri->segment(3);
            $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'Batch_Id'=>$Batch_Id);
            $result = array('data'=>$this->Admission_inter_model->Print_Form_Batchwise($fetch_data),'inst_Name'=>$user['inst_Name']);    
        }

        

        if(empty($result['data'])){
            $this->session->set_flashdata('error', $Condition);
            redirect('Admission_inter/FormPrinting');
            return;

        }


        $this->load->library('PDF_Rotate');


        $pdf = new PDF_Rotate('P','in',"A4");
        //      $this->load->library('PDFF');
        //        $pdf=new PDFF('P','in',"A4");  
        $pdf->AliasNbPages();
        $pdf->SetMargins(0.5,0.5,0.5);
        $grp_cd = $this->uri->segment(3);

        $pdf->SetTitle('Proof Print Admission_inter From');

        $fontSize = 10;
        $marge    = .4;   // between barcode and hri in pixel
        $x        = 7.5;  // barcode center
        $y        = 1.2;  // barcode center
        $height   = 0.35;   // barcode height in 1D ; module size in 2D
        $width    = .013;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $type     = 'code128';
        $black    = '000000'; // color in hex
        // //DebugBreak();
        $result = $result['data'] ;
        //if(!empty($result)):
        $session_constant='';
        if(Session==1){
            $session_constant="ANNUAL";
        }
        else if(Session==2){
            $session_constant="SUPPLYMENTARY";
        }
        foreach ($result as $key=>$data) 
        {

            // //DebugBreak();
            $form_No = $data["FormNo"]; 
            $fontSize = 8; 
            $marge    = .4;   // between barcode and hri in pixel
            $bx        = 4.2;  // barcode center
            $by        = .88;  // barcode center
            $height   = 0.25;   // barcode height in 1D ; module size in 2D
            $width    = .010;  // barcode height in 1D ; not use in 2D
            $angle    = 0;   // rotation in degrees

            $code     = $user['Inst_Id'];     // barcode (CP852 encoding for Polish and other Central European languages)
            $type     = 'code128';
            $black    = '000000'; // color in hex

            $pdf->AddPage();
            $Y = 0;

            //$Barcode = $form_No.$data["iYear"].$data['sess'].$data['class'];

          //  DebugBreak();
      
            $Barcode = $form_No."@".'10'.'@'.$data['sess'].'@'.$data["Iyear"];

            $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

            $len = $pdf->GetStringWidth($bardata['hri']);
            Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);

            $pdf->SetDrawColor(0, 0, 0, 50);
            $pdf->SetFillColor(0, 0, 0, 100);
            $pdf->SetTextColor(0, 0, 0, 100);
            //$pdf->PrintBarcode(3.75,0.8,(int)$Barcode,.3,.0099);
            $pdf->SetFont('Arial','U',14);
            $pdf->SetXY( 0.75,0.2);
            $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");
            $pdf->Image(base_url()."assets/img/logo2.png",0.05,0.2, 0.75,0.75, "PNG");
            $pdf->Image(base_url()."assets/img/12.jpg",7.49,0.39, 0.36,0.36, "JPG");    

            
            if(Session==1)
            {
                $pdf->SetFont('Arial','',8);
                $pdf->SetXY(1.2,0.4);    
            }
            else if(Session==2)
            {
                $pdf->SetFont('Arial','',9);
                $pdf->SetXY(1.2,0.35);    
            }
            
            $pdf->Cell(0, 0.25, "ADMISSION FORM FOR INTERMEDIATE (PART-II & COMPOSITE) ".$session_constant." EXAMINATION, 2016", 0.25, "C");
           // DebugBreak();
            //--------------- Proof Read    
            if($data['Batch_ID'] == 0 and $data['regPvt']==1)
            {
                $pdf->Image( base_url().'assets/img/PROOF_READ.jpg' ,1,3.5 , 6,4 , "JPG");     
                $ProofReed = "(PROOF READ) (Not for Board) ";
                $pdf->SetXY(3.3,1.2);
                $pdf->SetFont("Arial",'',8);
                $pdf->Cell(0, 0.25, $ProofReed   ,0,'C');
            }




            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(3.2,0.5);
            $pdf->Cell(0, 0.25,"(REGULAR CANDIDATE)", 0.25, "C");

            //--------------------------- Form No & Rno

            $pdf->SetXY(0.9,0.65+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Form No: _________________",0,'L');

            $pdf->SetXY(1.4,0.60+$Y);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.5,$data['FormNo'],0,'L');

            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(5.8,0.65+$Y);
            $pdf->Cell(0.5,0.5, "Roll No: _______________",0,'L');    
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(6.6,.80+$Y);
            $pdf->Cell(0.5,0.5, "(For office use only)",0,'L');
            // //DebugBreak();
            if($data["regPvt"]==1)
            {
                $pdf->SetXY(0.4,0.95+$Y);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell( 0.5,0.5,'Institute: '.$user['Inst_Id'].''.'-'.$user['inst_Name'],0,'R');
            }


           // DebugBreak();
            //------ Picture Box on Centre      
            $pdf->SetXY(6.6, 1.55+$Y );
            $pdf->Cell(1.0,1.0,'',1,0,'C',0);
           // $pdf->Image(base_url().REGULAR_IMAGE_PATH.$user['Inst_Id']."/".$data["picpath"],6.5, 1.55+$Y, 1.25, 1.4, "JPG");
          if($data["sex"]==1)
          {
            $pdf->Image( base_url().'uploads/download.jpg',6.6, 1.55+$Y, 1.0, 1.0, "JPG");  
          }
          else
          {
              $pdf->Image( base_url().'uploads/130659.jpg',6.6, 1.55+$Y, 1.0, 1.0, "JPG");
          }
            
            $pdf->SetFont('Arial','',8);

            //------------- Personal Infor Box
            //====================================================================================================================

            $x = 0.55;
            $pdf->SetXY(0.2,1.28+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(8,0.2,'PERSONAL INFORMATION',1,0,'L',1);

            $Y = -0.2;
            //--------------------------- 1st line 
            $pdf->SetXY(0.5,1.6+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Name:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.5,1.6+$Y);
            $pdf->Cell(0.5,0.5,$data["name"],0,'L');
             //--------------------------- 
              $pdf->SetXY(3.5+$x,1.6+$Y);
            $pdf->SetFont('Arial','',7);
            
            $pdf->Cell( 0.5,0.5,"Bay Form/CNIC No:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.5+$x,1.6+$Y);
            
            $pdf->Cell(0.5,0.5,$data["BForm"],0,'L');
            
            //--------------------------- FATHER NAME 
            
          $pdf->SetXY(0.5, 1.85+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Father's Name:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.5,1.85+$Y);
            $pdf->Cell(0.5,0.5,$data["Fname"],0,'L');


            //--------------------------- 3rd line 
            
            $pdf->SetXY(0.5,2.1+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Nationality:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.5,2.1+$Y);
            $pdf->Cell(0.5,0.5,$data["nat"]==1?"PAKISTANI":"NON-PAKISTANI",0,'R');  
            /*$pdf->SetXY(0.5, 1.85+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Date Of Birth:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.5,1.85+$Y);*/
            //$pdf->Cell(0.5,0.5,$data["Dob"],0,'L');

             $pdf->SetXY(3.5+$x,2.35+$Y);
            $pdf->SetFont('Arial','',8);
            
            $pdf->Cell( 0.5,0.5,"Registration No:",0,'L');
             $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.5+$x,2.35+$Y);
            
            
            $pdf->Cell(0.5,0.5,$data["strRegNo"],0,'L');
            //--------------------------- BAY FORM NO line 
            

            $pdf->SetXY(3.5+$x,1.85+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0.5,0.5,"Father's CNIC:",0,'R');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.5+$x,1.85+$Y);
            $pdf->Cell(0.5,0.5,$data["FNIC"],0,'L');
            
               $spl_casename = 'NONE';
            if($data["Spec"] == 0)
            {
                $spl_casename = 'NONE';
            }
            else  if($data["Spec"] == 1)
            {
                $spl_casename = 'Deaf & Dumb';  
            }
            else  if($data["Spec"] == 2)
            {
                $spl_casename = 'Board Employee';
            }
           $pdf->SetXY(3.5+$x,2.10+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Speciality:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.5+$x,2.10+$Y);
            $pdf->Cell(0.5,0.5,($spl_casename),0,'L');


            //--------------------------- RELEGION line 
            $pdf->SetXY(0.5,2.35+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Religion:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.5,2.35+$Y);
            $pdf->Cell(0.5,0.5,$data["rel"]==1?"MUSLIM":"NON-MUSLIM",0,'L');

            /*     $pdf->SetXY(2.4,$Y+2.7);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Nationality:",0,'R');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(3.4,$Y+2.7);
            $pdf->Cell(0.5,0.5,$data["nat"]==1?"PAKISTANI":"NON-PAKISTANI",0,'R');

            */
            
           /* $pdf->Cell(0.5,0.5,"Locality:",0,'R');
           


            if($data['regPvt']==1)
            {
                $pdf->Cell(0.5,0.5,$data["ruralOrurban"]==0?"URBAN":"RURAL",0,'L');
            }
            else if($data['regPvt']==2){

                $pdf->Cell(0.5,0.5,$data["ruralOrurban"]==1?"URBAN":"RURAL",0,'L');
            }*/
            
              //--------------------------- Speciality and Internal Grade 
           $pdf->SetXY(0.5,2.60+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Institute Grade:",0,'L');
             $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.5,2.60+$Y);
            $pdf->Cell(0.5,0.5,$data["CollGrade"],0,'L');

            //--------------------------- Gender Nationality 
           /* $pdf->SetXY(0.5,2.60+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Gender:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.5,2.60+$Y);

            /*    if($data["sex"] == 0)
            {
            $arr1 = array( 
            "sex"           => trim($gender_allowed));
            $db->update("Admission_online..adm_reg_ma2016",$arr1,"sch_cd = ".trim($user->inst_cd));
            }*/

            $pdf->SetXY(6.9,2.6+$Y);
            $pdf->Cell(0.5,0.5,$data['sex']==1?"MALE":"FEMALE",0,'L');
            // //DebugBreak();
            /*$pdf->SetXY(3.5+$x,2.60+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Nationality:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.5+$x,2.60+$Y);
            $pdf->Cell(0.5,0.5,$data["nat"]==1?"PAKISTANI":"NON-PAKISTANI",0,'R');  */           
            //--------------------------- id mark and Contact No. 
         





           // $pdf->SetFont('Arial','B',8);
            /* $pdf->SetXY(4.5+$x,3.35+$Y);
            $pdf->Cell(0.5,0.5, $data["mobNo"],0,'L');    */
           /* $pdf->SetXY(3.5+$x,2.85+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Contact No:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.5+$x,2.85+$Y);
            $pdf->Cell(0.5,0.5, $data["MobNo"],0,'L'); */     

            //         
            //    $pdf->SetXY(3.5+$x,2.85+$Y);
            //     $pdf->SetFont('Arial','',8);
            //     $pdf->Cell( 0.5,0.5,"Medium:",0,'L');
            //               $pdf->SetFont('Arial','B',8);
            //             $pdf->SetXY(4.5+$x,2.85+$Y);
            //             $pdf->Cell(0.5,0.5,$data["med"]==1?"URDU":"ENGLISH",0,'L');            

            //--------------------------- Speciality and Internal Grade 
           /* $pdf->SetXY(0.5,3.1+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Identification:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.50,3.1+$Y);
            $pdf->Cell(0.5,0.5,$data["markOfIden"],0,'L');*/



            $pdf->SetXY(3.5+$x,2.60+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Institute Roll No:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.5+$x,2.60+$Y);
            $pdf->Cell(0.5,0.5, ($data["classRno"]),0,'L');            



            //====================================================================================================================            
          //DebugBreak();
            $Y = $Y-0.5;
            //------------- Old Exam Infor if any Box
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(0.2,3.5+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.2,'SSC EXAMINATION INFORMATION  ',1,0,'L',1);          
            //--------------------------- 7th line    
            $pdf->SetXY(0.5,3.6+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Roll No:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.45,3.6+$Y);
            $pdf->Cell(0.5,0.5,$data["matRno"],0,'L');

            $pdf->SetXY(2.5,3.6+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Year:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(3.25,3.6+$Y);
            $pdf->Cell(0.5,0.5,$data["yearOfPass"],0,'L');

            $pdf->SetXY(3.8,3.6+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Session:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.3,3.6+$Y);
            $pdf->Cell(0.5,0.5,$data["sessOfPass"]==1?"Annual":"Supplementary",0,'R');
            // //DebugBreak();
            $pdf->SetXY(5.3,3.6+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Board:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(6,3.6+$Y);
            $pdf->Cell(0.5,0.5,$data["brd_name"],0,'R');


            /*$pdf->SetXY(3.5+$x,3.35+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Contact No:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.5+$x,3.35+$Y);
            $pdf->Cell(0.5,0.5, $data["mobNo"],0,'L');     */

            $Y= $Y+0.45;            

            //------------- Old Exam Infor if any Box
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(0.2,3.5+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.2,'PART-I EXAMINATION INFORMATION  ',1,0,'L',1);          
            //--------------------------- 7th line    
            $pdf->SetXY(0.5,3.6+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Roll No:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.45,3.6+$Y);
            $pdf->Cell(0.5,0.5,$data["oldRno"],0,'L');

            $pdf->SetXY(2.5,3.6+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Year:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(3.25,3.6+$Y);
            $pdf->Cell(0.5,0.5,$data["YearOfLastAp"],0,'L');

            $pdf->SetXY(3.8,3.6+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Session:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.3,3.6+$Y);
            $pdf->Cell(0.5,0.5,$data["SessOfLastAp"]==1?"Annual":"Supplementary",0,'R');
            // //DebugBreak();
            $pdf->SetXY(5.3,3.6+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Board:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(6,3.6+$Y);
            $pdf->Cell(0.5,0.5,$data["ibrd_name"],0,'R');
            //============================ Contact Detail ========================================================
            //------------- Contact Info Box
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(0.2,3.95+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.2,'CONTACT INFORMATION',1,0,'L',1);
            //--------------------------- 8th line 

            //----- DISTRICT    
            $pdf->SetXY(0.5,4.05+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0.5,0.5,"District:",0,'L');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.0,4.05+$Y);
            $pdf->Cell( 0.5,0.5, $data['distName'],0,'L');
            //__TEHSIL
            $pdf->SetXY(3.5,4.05+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0.5,0.5,"Tehsil:",0,'R');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.1,4.05+$Y);
            $pdf->Cell( 0.5,0.5, $data['tehName'],0,'L');
            //__Zone      
            $pdf->SetXY(0.5,4.25+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0.5,0.5,"Zone:",0,'R');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.0,4.25+$Y);
            $pdf->Cell( 0.5,0.5,$data['zone_cd']." - ".$data['ZoneName']."GUJRANWALA",0,'L');
            
            $pdf->SetXY(3.5,4.25+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0.5,0.5,"Mobile No:",0,'R');
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(4.1,4.25+$Y);
            $pdf->Cell( 0.5,0.5, $data['MobNo'],0,'L');
            
            /*     //__Mobile    
            $pdf->SetXY(6.4,4.05+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Mobile No:",0,'L');
            $pdf->SetFont('Arial','b',8);
            $pdf->SetXY(7.0,4.05+$Y);
            $pdf->Cell(0.5,0.5,$data["mobNo"],0,'R');*/


            //__Address
            /*  $pdf->SetXY(0.5,4.05+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Address(In Urdu):",0,'L');
            $pdf->SetFont('Arial','b',8);
            $pdf->SetXY(1.45,4.05+$Y);
            $pdf->Cell(0.5,0.5,'_______________________________________________________________________________________________',0,'L');       */


            //__Address
            $pdf->SetXY(0.5,4.4+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Address:",0,'L');
            $pdf->SetFont('Arial','b',8);
            $pdf->SetXY(1.2,4.4+$Y);
            $pdf->Cell(0.5,0.5,$data["addr"],0,'L');

            //__Address
            $pdf->SetXY(0.5,4.570+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Address(In Urdu):",0,'L');
            $pdf->SetFont('Arial','b',8);
            $pdf->SetXY(1.45,4.57+$Y);
            $pdf->Cell(0.5,0.5,'__________________________________________________________________________________________________',0,'L');     



            //-----

            /* //__Address
            $pdf->SetXY(0.5,4.05+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Address(In Urdu):",0,'L');
            $pdf->SetFont('Arial','b',8);
            $pdf->SetXY(1.45,4.05+$Y);
            $pdf->Cell(0.5,0.5,'______________________________________________________________________________________',0,'L');     

            //__Address
            $pdf->SetXY(0.5,4.30+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Address:",0,'L');
            $pdf->SetFont('Arial','b',8);
            $pdf->SetXY(1.2,4.30+$Y);
            $pdf->Cell(0.5,0.5,$data["addr"],0,'L');    */
            ////DebugBreak();
            //------------- Exam Info Box
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(0.2,4.99+$Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell(8,0.2,'EXAM INFORMATION',1,0,'L',1);
            //---------------------- Feeding DATE      
            $pdf->SetFont('Arial','UI',7);
            $pdf->SetXY(4.0,4.92+$Y);
            $pdf->Cell(0.3,0.4,"FEEDING DATE:",0,'L');        
            $pdf->SetXY(4.8,4.87+$Y);
            $pdf->SetFont('Arial','IB',7);
            $fedDate = $data['edate'];
            $newDate = date("d-M-Y h:i A", strtotime($fedDate));
            $pdf->Cell(0.5,0.5,$newDate,0,'L');
            //---------------------- Printing DATE                      
            $pdf->SetFont('Arial','UI',7);
            $pdf->SetXY(5.95,4.92+$Y);
            $pdf->Cell(0.3,0.4,"Download DATE:",0,'L');        
            $pdf->SetXY(6.75,4.87+$Y);
            $pdf->SetFont('Arial','IB',7);
            $pdf->Cell(0.5,0.5,date('d-M-Y h:i A'),0,'L');
            //__ Exam info
            $pdf->SetXY(0.5,4.8+$Y);
            $pdf->SetFont('Arial','',8);
            if($data['regPvt']== 2)
            {
                $pdf->Cell(0.5,0.5,"Proposed Exam Centre:",0,'L');
                $pdf->SetXY(1.8,4.8+$Y);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell( 0.5,0.5,GetCentreName($data['pp_cent']),0,'L');
            }

            //--------------------------- Subject Group
            $pdf->SetXY(0.5,5.05+$Y);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell( 0.5,0.5,"Subject Group:",0,'L');

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(1.5,5.05+$Y);
            if ($data["grp_cd"]=='1')
                $pdf->Cell(0.5,0.5,"PRE-MEDICAL",0,'L');
            else      if ($data["grp_cd"]=='2')
                $pdf->Cell(0.5,0.5,"PRE-ENGINEERING",0,'L');
                else      if ($data["grp_cd"]=='3')
                    $pdf->Cell(0.5,0.5,"HUMANITIES",0,'L');
                    else      if ($data["grp_cd"]=='4')
                        $pdf->Cell(0.5,0.5,"GENERAL SCIENCE",0,'L');
                        else      if ($data["grp_cd"]=='5')
                            $pdf->Cell(0.5,0.5,"COMMERCE",0,'L');             
                            //-----catagories
                            $pdf->SetFont('Arial','UB',8);
            $pdf->SetXY(0.5,5.3+$Y);
            $pdf->Cell( 0.5,0.5,"Exam Type:",0,'L');


            $bx = 4.02;
            $by = 10.8;
            $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

            $len = $pdf->GetStringWidth($bardata['hri']);
            Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
            ////DebugBreak();
            $cat = $data['cat11'];
            $cat_name ="";
            if ($cat==1) $cat_name= "Full Appear";
            else if ($cat ==2) $cat_name="Re-Appear";
                else if ($cat ==3 or $cat == 7) $cat_name="Marks Improve";
                    else if ($cat ==5 ) $cat_name="Additional";



                        if(($cat_name)!= '') 
                $catt09 =  $cat_name;
            else 
                $catt09 = '';

            $cat = $data['cat12'];
            $cat_name ="";
            if ($cat==1) $cat_name= "Full Appear";
            else if ($cat ==2) $cat_name="Re-Appear";
                else if ($cat ==3 or $cat == 7) $cat_name="Marks Improve";
                    else if ($cat ==5 ) $cat_name="Additional";
                        if(($cat_name)!= '') 
                $catt10 =   $cat_name ;
            else 
                $catt10 =  '';
            $pdf->SetFont('Arial','B',9);    
            $pdf->SetXY(1.5,5.3+$Y);
            if($catt09 != '')
            {
            $pdf->Cell( 0.5,0.5,$catt09.' in Part-I and '.$catt10.' in Part-II ' ,0,'L');    
            }
            else
            {
            $pdf->Cell( 0.5,0.5,$catt10.' in Part-II ' ,0,'L');
            }
            

            //$pdf->SetXY(4.7,5.3+$Y);
           // $pdf->Cell( 0.5,0.5,$catt10.' in Part-II ',0,'L');
            //--------------
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(0.5,5.75+$Y);
           // $pdf->Cell( 0.5,0.5,"9th",0,'L');
            $boxWidth = 3.8;
            $xx= 0.5;
        $yy = $Y+2.2;
         $pdf->SetFont('Arial','B',8);
        $pdf->SetXY($xx,3.8+$yy);
        $pdf->SetFillColor(240,240,240);
        $pdf->Cell($boxWidth,0.2,'Part-I Subjects',1,0,'L',1);
        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub1Ap1'] != 1 ? '':   '    '.'1. '. $this->GetSubNameHere($data['sub1']),1,0,'L',1);

       /* $pdf->Image(base_url().'assets/img/crossed.jpg',6.2,5.35+$yy, 1.3,0.15, "jpeg");  
        $pdf->SetXY(6.1,3.8+$yy);
        $pdf->Cell(1.4,1.5,'',1,0,'C',0); 
        $pdf->SetXY(6.3,3.8+$yy);
        $pdf->MultiCell(1.1,0.2, 'Paste Recent Photograph & Must Be Cross Attested by the Head/Deputy Head of Institution',0,'C'); 

        $pdf->SetXY(6.1,6.0+$yy);
        $pdf->Cell(1.4,0.65,'',1,0,'C',0); 
        $pdf->SetXY(6.2,6.48+$yy);
        $pdf->MultiCell(1.1,0.2, 'Thumb Impression',0,'C'); */

        //   DebugBreak();

        $pdf->SetFillColor(255,255,255);
        
         $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub1Ap1'] != 1 ? '':  '    '.'1. '.  $data['sub1_NAME'],1,0,'L',1);
        
        
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub2Ap1'] != 1 ? '':   '    '.'2. '.  $data['sub2_NAME'],1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub3Ap1'] != 1 ? '':   '    '.'3. '.  $data['sub3_NAME'],1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.6+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub4Ap1'] != 1 ? '':   '    '.'4. '. $data['sub4_NAME'],1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.8+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub5Ap1'] != 1 ? '':   '    '.'5. '.  $data['sub5_NAME'],1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,5.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub6Ap1'] != 1 ? '':   '    '.'6. '.  $data['sub6_NAME'],1,0,'L',1);

        $pdf->SetFont('Arial','',7);                                                                     
        $pdf->SetXY($xx,5.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub7Ap1'] != 1 ? '':   '    '.'7. '.  $data['sub7_NAME'],1,0,'L',1);

        /*$pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,5.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub8Ap2'] != 1 ? '':   '    '.'8. '. $this->GetSubNameHere($data['sub8']),1,0,'L',1);
        */
        $xangle = 4.0;

        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY($xangle,3.8+$yy);
        $pdf->SetFillColor(240,240,240);
        $pdf->Cell($boxWidth,0.2,'Part-II Subjects',1,0,'L',1);    
        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub1Ap2'] != 1 ? '':  '    '.'1. '.  $data['sub1_NAME'],1,0,'L',1);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub2Ap2'] != 1 ? '':  '    '.'2. '.  $data['sub2_NAME'],1,0,'L',1);

        /* $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub3Ap1'] != 1 ? '':  '    '.'3. '.  $this->GetSubNameHere($data['sub3']),1,0,'L',1);*/

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub8Ap2'] != 1 ? '':  '    '.'3. '.  $data['sub8_NAME'],1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.6+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub4Ap2'] != 1 ? '':  '    '.'4. '. $data['sub4_NAME'],1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.8+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub5Ap2'] != 1 ? '':  '    '.'5. '.  $data['sub5_NAME'],1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,5.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub6Ap2'] != 1 ? '':  '    '.'6. '. $data['sub6_NAME'],1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,5.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub7Ap2'] != 1 ? '':  '    '.'7. '. $data['sub7_NAME'],1,0,'L',1);
      //  $pdf->Cell($boxWidth,0.2,$data['sub1Ap1'] != 1 ? '':   '    '.'1. '. $this->GetSubNameHere($data['sub1']),1,0,'L',1);
           /* $pdf->SetXY(5.2,5.55+$Y);
            $pdf->Cell( 0.5,0.5,"10th",0,'L');*/
            //-----------------------------

            $x = 1;
            //--------------------------- Subjects
          /*  $pdf->SetFont('Arial','',8);
            $pdf->SetXY(1.1,5.85+$Y);
            $pdf->Cell(0.3,0.4,"1._______________________________",0,'L');             
            $pdf->SetXY(1.15,5.75+$Y);
            $pdf->Cell(0.5,0.5, $data['sub1Ap1'] != 1 ? '':   '    '. $data['sub1_NAME'] ,1,'L');

            $pdf->SetXY(4.6,5.85+$Y);
            $pdf->Cell(0.3,0.4,"1._______________________________",0,'L');
            $pdf->SetXY(4.65,5.75+$Y);
            $pdf->Cell(0.5,0.5,  $data['sub1Ap2'] != 1 ? '':  '    '.  $data['sub1_NAME'],1,'R');
            //------------------sub2
            $pdf->SetXY(1.1,6.1+$Y);
            $pdf->Cell(0.3,0.4,"2._______________________________",0,'L');    
            $pdf->SetXY(1.15,6.0+$Y);
            $pdf->Cell(0.5,0.5,  $data['sub2Ap1'] != 1 ? '':  '    '.  $data['sub2_NAME'],1,'L');

            $pdf->SetXY(4.6,6.1+$Y);
            $pdf->Cell(0.3,0.4,"2._______________________________",0,'L');
            $pdf->SetXY(4.65,6.0+$Y);
            $pdf->Cell(0.5,0.5,  $data['sub2Ap2'] != 1 ? '':   '    '. $data['sub2_NAME'],1,'R');
            //------------------sub3
            $pdf->SetXY(1.1,6.35+$Y);
            $pdf->Cell(0.3,0.4,"3._______________________________",1,'L');    
            $pdf->SetXY(1.15,6.25+$Y);
            $pdf->Cell(0.5,0.5,  $data['sub3Ap1'] != 1 ? '':   '    '. $data['sub3_NAME'],1,'L');
            ////DebugBreak();
            $pdf->SetXY(4.6,6.35+$Y);
            $pdf->Cell(0.3,0.4,"3._______________________________",1,'L');
            $pdf->SetXY(4.65,6.25+$Y);
            //$pdf->Cell(0.5,0.5,  $data['sub3ap2'] != 1 ? '':   '    '. $data['sub3_NAME'],0,'R');
            //----------- sub4
            $pdf->SetXY(1.1,6.6+$Y);
            $pdf->Cell(0.3,0.4,"4._______________________________",1,'L');    
            $pdf->SetXY(1.15,6.5+$Y);
            //$pdf->Cell(0.5,0.5,  $data['sub8ap1'] != 1 ? '':   '    '. $data['sub4_NAME'],0,'L');

            $pdf->SetXY(4.6,6.6+$Y);
            $pdf->Cell(0.3,0.4,"4._______________________________",1,'L');
            $pdf->SetXY(4.65,6.5+$Y);
            $pdf->Cell(0.5,0.5,  $data['sub8Ap2'] != 1 ? '':  '    '. $data['sub8_NAME'],1,'R');


            //----------------sub5    
            $pdf->SetXY(1.1,6.85+$Y);
            $pdf->Cell(0.3,0.4,"5._______________________________",1,'L');    
            $pdf->SetXY(1.15,6.75+$Y);
            $pdf->Cell(0.5,0.5,  $data['sub4Ap1'] != 1 ? '':   '    '. $data['sub4_NAME'],1,'L');


            $pdf->SetXY(4.6,6.85+$Y);
            $pdf->Cell(0.3,0.4,"5._______________________________",1,'L');
            $pdf->SetXY(4.65,6.75+$Y);
            $pdf->Cell(0.5,0.5,  $data['sub4Ap2'] != 1 ? '':   '    '. $data['sub4_NAME'],1,'R');
            //-----------------sub6
            $pdf->SetXY(1.1,7.1+$Y);
            $pdf->Cell(0.3,0.4,"6._______________________________",1,'L');    
            $pdf->SetXY(1.20,7.0+$Y);
            $pdf->Cell(0.5,0.5,  $data['sub5Ap1'] != 1 ? '': '  '. $data['sub5_NAME'],1,'L');

            $pdf->SetXY(4.6,7.1+$Y);
            $pdf->Cell(0.3,0.4,"6._______________________________",1,'L');
            $pdf->SetXY(4.65,7.0+$Y);
            $pdf->Cell(0.5,0.5,  $data['sub5Ap2'] != 1 ? '':  '    '. $data['sub5_NAME'],1,'R');

            //----------------sub7
            $pdf->SetXY(1.1,7.35+$Y);
            $pdf->Cell(0.3,0.4,"7._______________________________",1,'L');        
            $pdf->SetXY(1.15,7.25+$Y);
            $pdf->Cell(0.5,0.5,  $data['sub6Ap1'] != 1 ? '':   '    '. $data['sub6_NAME'],1,'L');

            $pdf->SetXY(4.6,7.35+$Y);
            $pdf->Cell(0.3,0.4,"7._______________________________",1,'L');
            $pdf->SetXY(4.65,7.25+$Y);
            $pdf->Cell(0.5,0.5,  $data['sub6Ap2'] != 1 ? '':   '    '. $data['sub6_NAME'],1,'R');
            //-----------------sub8

            $pdf->SetXY(1.1,7.6+$Y);
            $pdf->Cell(0.3,0.4,"8._______________________________",1,'L');        
            $pdf->SetXY(1.15,7.5+$Y);
            $pdf->Cell(0.5,0.5,  $data['sub7Ap1'] != 1 ? '':   '    '. $data['sub7_NAME'],1,'L');

            $pdf->SetXY(4.6,7.6+$Y);
            $pdf->Cell(0.3,0.4,"8._______________________________",1,'L');
            $pdf->SetXY(4.65,7.50+$Y);
            $pdf->Cell(0.5,0.5,  $data['sub7Ap2'] != 1 ? '':   '    '. $data['sub7_NAME'],1,'R');*/
            //-------------------     
            $pdf->SetXY(0.5,7.55 +$Y);
            $pdf->SetFont('Arial','UIB',9);
            $pdf->Cell( 0.5,0.5,'Affidavit:',0,'L');

            $pdf->SetXY(0.5,7.9+$Y);
            $pdf->SetFont('Arial','',9);
            $pdf->MultiCell( 7.2,0.15,"    I have read this form. The data/information on this form and in online system is same as last entered/modified/provided by me and its correctness is only my responsbility. I understand that only the information/data provided in the online system alongwith photograph and some other handwritten details on this form will be used for further processing. I accept all the terms and conditions in this  regard.",0,'J');
            //------ Thumb Box on Centre      

            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0.2,8.55+$Y);
            $pdf->Cell(2,0.65,'',1,0,'C',0); 
            $pdf->SetXY(0.2,8.73+$Y);
            $pdf->Cell(4,0.75,"Candidate's signature in Urdu",'',0,'L',0); 
            //---------------------------------------------------------------------------

            //---------------------------------------------------------------------------
            $InstName = 'Head of Institute Name:';
            $CNICNO = 'CNIC No:';
            $EMISCode= 'EMIS CODE:';
            $MobileNo = 'Mobile No.';
            $inst = 'Attestation Of Head Of Institution';
            $emstxt = '(Govt.Institution Only)';

            $pdf->SetXY(2.5,8.55+$Y);
            $pdf->Cell(3.4,2.07,'',1,0,'C',0); 
            $pdf->SetXY(2.5,8.9+$Y);
            $pdf->Cell(1.6,0.001,$InstName,'',0,'L',0); 
            $pdf->SetXY(3.74,8.9+$Y);
            $pdf->Cell(1.6,0.001,'___________________________','',0,'L',0);
            $pdf->SetXY(2.5,9.0+$Y);
            $pdf->Cell(1.6,0.67,$CNICNO,'',0,'L',0); 
            $pdf->SetXY(2.97,9.30+$Y);
            $pdf->Cell(1.6,0.001,'______________________________________','',0,'L',0);
            $pdf->SetXY(2.5,9.75+$Y);
            $pdf->Cell(1.6,0.67,$EMISCode,'',0,'L',0); 
            $pdf->SetXY(3.2,10.1+$Y);
            $pdf->Cell(1.6,0.001,'__________________________________','',0,'L',0); 
            $pdf->SetXY(2.5,9.4+$Y);
            $pdf->Cell(1.6,0.67,$MobileNo ,'',0,'L',0);  
            $pdf->SetXY(3.05,9.75+$Y);
            $pdf->Cell(1.6,0.001,'_____________________________________','',0,'L',0);
            $pdf->SetXY(3.65,9.9+$Y);
            $pdf->Cell(1.6,0.67,$emstxt ,'',0,'L',0);  
            /*$pdf->SetXY(2.5,10.1+$Y);
            $pdf->Cell(1.6,0.69,$inst ,'',0,'L',0); */
            //---------------------------------------------------------------------------

            $pdf->SetXY(0.2,9.25+$Y);
            $pdf->Cell(2,0.65,'',1,0,'C',0); 
            $pdf->SetXY(0.2,9.4+$Y);
            $pdf->Cell(4,0.75,"Candidate's Signature in English",'',0,'L',0); 
            //------------------------------------------------------------------------------
            $pdf->SetXY(0.2,9.98+$Y);
            $pdf->Cell(2,0.65,'',1,0,'C',0); 
            $pdf->SetXY(0.2,10.0+$Y);
            $pdf->Cell(4,1.09,"Candidate's Thumb Impression",'',0,'L',0); 

            //------ Picture Box on right side on Top      
            $pdf->SetXY(6.2,8.9+$Y);
            $pdf->Cell(1.4,1.5,'',1,0,'C',0); 
            $pdf->SetXY(6.3,9.15+$Y); 
            $pdf->MultiCell(1.1,0.2, 'Paste Recent Photograph & Must Be Cross Attested.',0,'C');  // by the Head/Deputy Head of Institution

            //------------------------- Image 
            $pdf->SetXY(6.2,10.4+$Y);
            $pdf->Image(base_url()."assets/img/note2.jpg",6.19,10.8, 1.48,0.25, "jpg");   

            //-------------------------- End of Page 1     
           


            //======================================================================================
        }

        $pdf->Output($data["coll_cd"].'.pdf', 'I');
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
     public function getcenter()
    {
       // DebugBreak();
        $data = array(
            'zoneCode' => $this->input->post('pvtZone'),
            'gen' => $this->input->post('gend'),
        );
           
        $this->load->model('Admission_model');
        $value = array('center'=> $this->Admission_model->getcenter($data)) ;
        echo json_encode($value);

    }
    function frmvalidation($viewName,$allinputdata,$isupdate)
    {

      // DebugBreak();
        $_POST['address']  = str_replace("'", "", $_POST['address'] );


        if(@$_POST['cand_name'] == '' )
        {
            $allinputdata['excep'] = 'Please Enter Your Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission_inter/'.$viewName.'');
            return; //"NewEnrolment_EditForm_inter"

        }
        //(strpos($a, 'are') !== false)
       

        else if (@$_POST['father_name'] == '')
        {
            $allinputdata['excep'] = 'Please Enter Your Father Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission_inter/'.$viewName);
            return;

        }
      
        else if(@$_POST['bay_form'] == '' )
        {
            $allinputdata['excep'] = 'Please Enter Your Bay Form No.';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission_inter/'.$viewName);
            $this->$viewName($allinputdata['formNo']);
            return;


        }
      
            else if(@$_POST['father_cnic'] == '' )
            {
                $allinputdata['excep'] = 'Please Enter Your Father CNIC';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;


            }
           
            /*else if (@$_POST['dob_hidden'] == '' )
            {
                $allinputdata['excep'] = 'Please Enter Your  Date of Birth';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            } */
            else if(@$_POST['mob_number'] == '')
            {
                $allinputdata['excep'] = 'Please Enter Your Mobile Number';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            else if(@$_POST['medium'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Your Medium';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            else if(@$_POST['Inst_Rno']== '')
            { 
                $allinputdata['excep'] = 'Please Enter Your Roll Number';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            else if(@$_POST['MarkOfIden']== '')
            {
                $allinputdata['excep'] = 'Please Enter Your Mark of Identification';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            /* else if((@$_POST['speciality'] != '0')or (@$_POST['speciality'] != '1') or (@$_POST['speciality'] != '2'))
            {
            $error['excep'] = 'Please Enter Your Speciality';
            $this->load->view('Admission_inter/9th/NewEnrolment.php',$error);
            }*/
            else if((@$_POST['medium'] != '1') and (@$_POST['medium'] != '2') )
            {
                $allinputdata['excep'] = 'Please Select Your medium';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            else if((@$_POST['nationality'] != '1') and (@$_POST['nationality'] != '2') )
            {
                $allinputdata['excep'] = 'Please Select Your Nationality';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            else if((@$_POST['gender'] != '1') and (@$_POST['gender'] != '2'))
            {
                $allinputdata['excep'] = 'Please Select Your Gender';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            else if((@$_POST['hafiz']!= '1') and (@$_POST['hafiz']!= '2'))
            {
                $allinputdata['excep'] = 'Please Select Your Hafiz-e-Quran option';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            else if((@$_POST['religion'] != '1') and (@$_POST['religion'] != '2'))
            {
                $allinputdata['excep'] = 'Please Select Your religion';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            else if((@$_POST['UrbanRural'] != '1') and (@$_POST['UrbanRural'] != '2'))
            {
                $allinputdata['excep'] = 'Please Select Your Residency';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            else if(@$_POST['address'] =='')
            {
                $allinputdata['excep'] = 'Please Enter Your Address';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
             else if(@$_POST['pvtinfo_dist'] =='')
        {
            $allinputdata['excep'] = 'Please Select Your District First!';        
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission_inter/'.$viewName);
            return;

        }
        else if(@$_POST['pvtinfo_teh'] =='')
        {
            $allinputdata['excep'] = 'Please Select Your Tehsil First! ';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission_inter/'.$viewName);
            return;

        }
        else if(@$_POST['pvtZone'] =='')
        {
            $allinputdata['excep'] = 'Please Select Your Zone First! ';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission_inter/'.$viewName);
            return;

        }
            else if(@$_POST['std_group_hidden'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Your Study Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            else if((@$_POST['std_group_hidden'] == 1) && ((@$_POST['sub4p2']!=47) || (@$_POST['sub5p2']!=48)||(@$_POST['sub6p2']!=46)))
            {

                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            else if((@$_POST['std_group_hidden'] == 7)&& ((@$_POST['sub5p2']!=6) || (@$_POST['sub6p2']!=7)||(@$_POST['sub7p2']!=78)))
            {

                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            else if((@$_POST['std_group_hidden'] == 8)&& ((@$_POST['sub5p2']!=6) || (@$_POST['sub6p2']!=7)||(@$_POST['sub7p2']!=43)))
            {

                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            else if((@$_POST['std_group_hidden'] == 2) && ((@$_POST['sub5p2']==6) || (@$_POST['sub6p2']==7)||(@$_POST['sub7p2']==43)|| (@$_POST['sub7p2']==43) || (@$_POST['sub7p2']==8)))
            {
                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            else if((@$_POST['std_group_hidden'] == 5)&& ((@$_POST['sub5p2']==6) || (@$_POST['sub6p2']==7)|| (@$_POST['sub7p2']==43) || (@$_POST['sub7p2']==8)))
            {
                $allinputdata['excep'] = 'Subjects not according to Group';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission_inter/'.$viewName);
                return;

            }
            
          /*  else if((@$_POST['sub1p2'] == @$_POST['sub2p2']) ||(@$_POST['sub1p2'] == @$_POST['sub3p2'])||(@$_POST['sub1p2'] == @$_POST['sub4p2'])||(@$_POST['sub1p2'] == @$_POST['sub5p2'])||(@$_POST['sub1p2'] == @$_POST['sub6p2'])||(@$_POST['sub1p2'] == @$_POST['sub7p2'])||
                (@$_POST['sub1p2'] == @$_POST['sub8p2']))
                {
                    $allinputdata['excep'] = 'Please Select Different Subjects';
                    $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                    redirect('Admission_inter/'.$viewName);
                    return;

                }
                else if((@$_POST['sub2p2'] == @$_POST['sub1p2']) ||(@$_POST['sub2p2'] == @$_POST['sub3p2'])||(@$_POST['sub2p2'] == @$_POST['sub4p2'])||(@$_POST['sub2p2'] == @$_POST['sub5p2'])||(@$_POST['sub2p2'] == @$_POST['sub6p2'])||(@$_POST['sub2p2'] == @$_POST['sub7p2'])                         ||(@$_POST['sub2'] == @$_POST['sub8'])
                    )
                    {
                        $allinputdata['excep'] = 'Please Select Different Subjects';
                        $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                        redirect('Admission_inter/'.$viewName);
                        return;

                    }
                    else if((@$_POST['sub3p2'] == @$_POST['sub1p2']) ||(@$_POST['sub3p2'] == @$_POST['sub2p2'])||(@$_POST['sub3p2'] == @$_POST['sub4p2'])||(@$_POST['sub3p2'] == @$_POST['sub5p2'])||(@$_POST['sub3p2'] == @$_POST['sub6p2'])||(@$_POST['sub3p2'] == @$_POST['                                sub7'])||(@$_POST['sub3'] == @$_POST['sub8'])
                        )
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub4p2'] == @$_POST['sub1p2']) ||(@$_POST['sub4p2'] == @$_POST['sub3p2'])||(@$_POST['sub4p2'] == @$_POST['sub2p2'])||(@$_POST['sub4p2'] == @$_POST['sub5p2'])||(@$_POST['sub4p2'] == @$_POST['sub6p2'])||(@$_POST['sub4p2'] == @$_POST[                                 'sub7p2'])||(@$_POST['sub4p2'] == @$_POST['sub8p2']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub5p2'] == @$_POST['sub1p2']) ||(@$_POST['sub5p2'] == @$_POST['sub3p2'])||(@$_POST['sub5p2'] == @$_POST['sub4p2'])||(@$_POST['sub5p2'] == @$_POST['sub2p2'])||(@$_POST['sub5p2'] == @$_POST['sub6p2'])||(@$_POST['sub5p2'] == @                                        $_POST['sub7'])||(@$_POST['sub5'] == @$_POST['sub8']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub6p2'] == @$_POST['sub1p2']) ||(@$_POST['sub6p2'] == @$_POST['sub3p2'])||(@$_POST['sub6p2'] == @$_POST['sub4p2'])||(@$_POST['sub6p2'] == @$_POST['sub5p2'])||(@$_POST['sub6p2'] == @$_POST['sub2p2'])||(@$_POST['sub6p2'] ==                                          @$_POST['sub7'])||(@$_POST['sub6'] == @$_POST['sub8']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub7p2'] == @$_POST['sub1p2']) ||(@$_POST['sub7p2'] == @$_POST['sub3p2'])||(@$_POST['sub7p2'] == @$_POST['sub4p2'])||(@$_POST['sub7p2'] == @$_POST['sub5p2'])||(@$_POST['sub7p2'] == @$_POST['sub6p2'])||(@$_POST['sub7p2']                                              == @$_POST['sub2'])||(@$_POST['sub7'] == @$_POST['sub8']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub8p2'] == @$_POST['sub1p2']) ||(@$_POST['sub8p2'] == @$_POST['sub3p2'])||(@$_POST['sub8p2'] == @$_POST['sub4p2'])||(@$_POST['sub8p2'] == @$_POST['sub5p2'])||(@$_POST['sub8p2'] == @$_POST['sub6p2'])||(@$_POST['                                                   sub8'] == @$_POST['sub7'])||(@$_POST['sub8'] == @$_POST['sub2']))
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }*/
                        else if((@$_POST['sub7p2'] ==20) && (@$_POST['sub8p2']==21))
                        {
                            $allinputdata['excep'] = 'Double History is not Allowed Please choose a different Subject';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }
                        else if((@$_POST['sub8p2'] ==20) && (@$_POST['sub7p2']==21))
                        {
                            $allinputdata['excep'] = 'Double History is not Allowed Please choose a different Subject';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub6p2'] == @$_POST['sub8p2'])
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }
                       /* else if(@$_POST['sub7p2'] == @$_POST['sub8p2'])
                        {
                            $allinputdata['excep'] = 'Please Select Different Subjects';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }  */
                        else if(@$_POST['sub1p2'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Part-II Subject 1';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub2p2'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Part-II Subject 2';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;
                        }
                        else if(@$_POST['sub3p2'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Part-II Subject 3';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub4p2'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Part-II Subject 4';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub5p2'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Part-II Subject 5';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub6p2'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Part-II Subject 6';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }
                        else if(@$_POST['sub7p2']==0 && @$_POST['std_group_hidden']==7)
                        {
                            $allinputdata['excep'] = 'Please Select Part-II Subject 7';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }
                        /*else if(@$_POST['sub8p2'] == 0)
                        {
                            $allinputdata['excep'] = 'Please Select Part-II Subject 8';
                            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                            redirect('Admission_inter/'.$viewName);
                            return;

                        }     */
    }

}
