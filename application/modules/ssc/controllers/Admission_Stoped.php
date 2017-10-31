<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admission extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url'); 
       $this->load->library('Browsercache');
        $this->browsercache->dontCache();
        $this->clear_cache();
        $this->clear_all_cache();
    }
    public function clear_all_cache()
{
    $CI =& get_instance();
$path = $CI->config->item('cache_path');

    $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

    $handle = opendir($cache_path);
    while (($file = readdir($handle))!== FALSE) 
    {
        //Leave the directory protection alone
        if ($file != '.htaccess' && $file != 'index.html')
        {
           @unlink($cache_path.'/'.$file);
        }
    }
    closedir($handle);
}
     function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
    public function index()
    {
        $data = array(
            'isselected' => '3',
        );
        $this->load->model('Admission_model');
        $this->load->library('session');

        $error ="";

        if($this->session->flashdata('downerror'))
        {
            $error = $this->session->flashdata('downerror');
        }
        else{
            $error = "";
        }

        $this->load->view('common/commonheader.php');
        $mydata = array('error'=>$error);

        $this->load->view('Admission/Matric/matric_default.php',$mydata);

        $this->load->view('common/homepagefooter.php');
    }
    function GetSpeciality($spclty)
    {
        if ($spclty == 0 )
            return('NONE');
         else if ($spclty == 3 )
            return('BLIND');
        else if ($spclty == 2 )
            return('BOARD EMPLOYEE CHILD');
            else if ($spclty == 1 )
                return('DISABLE');

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
     public function checkFormNo_then_download()
    {

       //  DebugBreak();
        $formno_seg = $this->uri->segment(3);
        $dob_seg = '';//$this->uri->segment(4);
        if($formno_seg !=0 ){
            $formno = $formno_seg;     
            $dob = $dob_seg;
        }
        else{
            return true;
        }


        $this->load->model('Admission_model');
        $this->load->library('session');
        // DebugBreak();
        $data = $this->Admission_model->get_formno_data($formno);
        
        
        
        
        if($data == false)
        {
            $error = 'No Data Exist againt '.$formno.' Form No. Please check it again.';
            $this->session->set_flashdata('downerror',$error);
            redirect('Admission');
            return;
        }

        $data = $data[0];
        //DebugBreak();
        $retfee = $this->feecalculate($data);
        
        $data['AdmFee'] = $retfee[0]['AdmFee'];
        $data['AdmTotalFee'] = $retfee[0]['AdmTotalFee'];
        
        
        $this->load->library('pdf_rotate');
        $pdf = new pdf_rotate('P','in',"A4");
        $lmargin =1.5;
        $rmargin =7.3;
        $pdf ->SetRightMargin(5);
        $pdf->AddPage();
        $x = 0.55;
        $Y = -0.2;


        $session = Session == "1" ? "Annual" : "Supplymentry";
        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(1.2,0.2);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");
        $pdf->Image("assets/img/ExamCenter.jpg",4.9,2.85+$Y, 2.78,0.15, "jpg");        
        $pdf->Image("assets/img/10th.png",7.30,0.25, 0.30,0.30, "PNG");    

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(1.8,0.4);
        $pdf->Cell(0, 0.2, "ADMISSION /REVENUE FORM ", 0.25, "C");
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(3.85,0.4);
        $pdf->Cell(0, 0.2,  "(Private Candidate) for SSC " .$session."  Examination , ".Year, 0.25, "C");

        //--------------------------- Form No & Rno
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(5.8,0.65+$Y);
        $pdf->Cell(0.5,0.5, "Roll No: _______________",0,'L');    
        $pdf->SetFont('Arial','B',7);
        $pdf->SetXY(6.6,.80+$Y);
        $pdf->Cell(0.5,0.5, "(For office use only)",0,'L');
        //------ Picture Box on Centre      

        //DebugBreak();
        $Barcode = $data['formNo']."@".$data['class'].'@'.$data['sess'].'@'.$data["Iyear"];
        $image =  $this->set_barcode($Barcode);




        $pdf->Image(BARCODE_PATH.$image,3.2, 0.61  ,1.8,0.20,"PNG");
        //$data['PicPath']
        $pdf->Image(PRIVATE_IMAGE_PATH.$data['PicPath'],6.96, 1.15+$Y, 0.95, 1.0, "JPG");
        $pdf->Image("assets/img/logo2.png",0.4, 0.2, 0.65, 0.65, "PNG");
        $pdf->SetFont('Arial','',8);

        //------------- Personal Infor Box
        //====================================================================================================================

        $FontSize=7;
        $HeightLine1= 1.75;
        $HeightLine2=2.0;
        $Y = -0.7;
        //--------------------------- Subject Group
        $grp_name = $data["grp_cd"];
        
        
        
        switch ($grp_name) {
            case '1':
                $grp_name = 'SCIENCE';
                break;
            case '7':
                $grp_name = 'SCIENCE';
                break;
            case '8':
                $grp_name = 'SCIENCE';
                break;
            case '2':
                $grp_name = 'GENERAL';
                break;
            
            case '5':
                $grp_name = 'Deaf and Dumb';
                break;
            default:
                $grp_name = "";
        }
        
        if($data["grp_cd"] == 4 && ($data['cat09'] == 4 || $data['cat10'] == 4))
        {
            $grp_name = 'AAMA';
        }
        else if($data["grp_cd"] == 4 && ($data['cat09'] == 9 || $data['cat10'] == 9))
        {
            $grp_name = 'ADIB/ALIM';
        }
        
        $pdf->SetXY(1.8,1.28+$Y);
        $pdf->SetFont('Arial','bU',10);
        $pdf->Cell( 0.5,0.7,$grp_name." GROUP",0,'L');
        //--------------------------- 1st line 
        $pdf->SetXY(0.5,1.55+$Y);
        $pdf->SetFont('Arial','B',$FontSize+1);
        $pdf->Cell( 0.5,0.5,"Form No:",0,'L');

        $pdf->SetFont('Arial','B',$FontSize+3);
        $pdf->SetXY(1.5,1.55+$Y);
        $pdf->Cell( 0.5,0.5,$data['formNo'],0,'L');


        $chkcat09 = ($data['mi_type']!= 2?$this->getCatName($data['cat09']):'Aditional') ;

        $chkcat10 = ($data['mi_type']!= 2?$this->getCatName($data['cat10']):'Aditional');
        //DebugBreak();
        if(@$data['isOtherbrd']==1)
        {
            /*
            if ($cat==1) return "Full Appear";
            else if ($cat ==2) return "Re-Appear";
            else if ($cat ==3 or $cat == 7) return "Marks Improve";
            else if ($cat ==5 ) return "Additional";
            */
            
            if($data['cat09']>1)
            {
                $chkcat09 = "Re-Appear";
                $chkcat10 = "Full Appear";
            }
            if($data['cat10']>1 && $data['cat09']>1)
            {
                $chkcat09 = "Full Appear";
                $chkcat10 = "Full Appear";
            }
            if($data['cat10']>1 && $data['cat09']<1)
            {
                $chkcat09 = "";
                $chkcat10 = "Full Appear";
            }

        }
        if(@$data['isFresh']==1)
        {
             
            if($data['cat09']>1)
            {
                $chkcat09 = "Full Appear";
                $chkcat10 = "Full Appear";
            }
            if($data['cat10']>1 && $data['cat09']>1)
            {
                $chkcat09 = "Full Appear";
                $chkcat10 = "Full Appear";
            }
            if($data['cat10']>1 && $data['cat09']<1)
            {
                $chkcat09 = "Full Appear";
                $chkcat10 = "Full Appear";
            }
        }
        if($chkcat09 != -1 && $chkcat10 != -1)
        {    
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(2.5,1.55+$Y);
            $pdf->Cell( 0.5,0.5,"(9th: ",0,'L');
            $pdf->SetXY(3.0,1.55+$Y);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.5, $chkcat09,0,'L'); 
            $pdf->SetXY(4.0,1.55+$Y);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.5,"10th: ",0,'L');
            $pdf->SetXY(4.4,1.55+$Y);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.5,$chkcat10.")",0,'L');

        }
        else if($chkcat09 != -1)
        {
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(2.5,1.55+$Y);
            $pdf->Cell( 0.5,0.5,"(9th: ",0,'L');
            $pdf->SetXY(3.0,1.55+$Y);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0.5,0.5, $chkcat09.')',0,'L');
        }
        else if($chkcat10 != -1)
        {
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(2.5,1.55+$Y);
            $pdf->Cell( 0.5,0.5,"(10th: ",0,'L');
            $pdf->SetXY(3.0,1.55+$Y);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0.5,0.5,$chkcat10.')',0,'L');  
        }
        $LastSess = 0 ;
        //  //DebugBreak();
        if($data["SessOfLastAp"] == 1 or $data["SessOfLastAp"] == 2  )
        {
            $LastSess =  $data["SessOfLastAp"]==1?"A":"S";
        }     
        $pdf->SetXY(0.5, 1.7+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Prev Roll No:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,1.7+$Y);

        // DebugBreak();
        $yearOfLastAp = $data['YearOfLastAp'];
        $cand_chance = $data['chance'];
        $cand_Notif = $data['Prev_result2'];
        $cand_Nofif_part1 = $data['Prev_result1'];
        $str = '';
        if(($data['cat09']==2 && $data['cat10'] == 0) || ($data['cat09'] == 0 && $data['cat10']==2) || ($data['cat09'] == 2 && $data['cat10']==2))
        {

            if($data['Prev_chance']==1)
            {
                /*if($data['cat09']==2 && $data['cat10']==2)
                {

                    $str = "S-17 [P-I $cand_Nofif_part1,P-II $cand_Notif]";    
                }
                else if($data['cat09']==2 && $data['cat10'] !=2)
                {
                    $str = "S-17 [P-I $cand_Nofif_part1]";        
                }
                else if($data['cat09'] !=2 && $data['cat10']==2)
                {
                    $str = "S-17 [P-II $cand_Notif]";        
                }
                
*/
                if($data['cat09']==2 && $data['cat10']==2)
                {

                    $str = "A-18 [P-I $cand_Nofif_part1,P-II $cand_Notif]";    
                }
                else if($data['cat09']==2 && $data['cat10'] !=2)
                {
                    $str = "A-18 [P-I $cand_Nofif_part1]";        
                }
                else if($data['cat09'] !=2 && $data['cat10']==2)
                {
                    $str = "A-18 [P-II $cand_Notif]";        
                }
            }
            else
                if($data['Prev_chance']==2)
                {
                    if($data['cat09']==2 && $data['cat10']==2)
                    {

                        $str = "S-17 [P-I $cand_Nofif_part1,P-II $cand_Notif]";    
                    }
                    else if($data['cat09']==2 && $data['cat10'] !=2)
                    {
                        $str = "S-17 [P-I $cand_Nofif_part1]";        
                    }
                    else if($data['cat09'] !=2 && $data['cat10']==2)
                    {
                        $str = "S-17 [P-II $cand_Notif]";        
                    }
            }
            else
                if($data['Prev_chance']==3)
                {
                    if($data['cat09']==2 && $data['cat10']==2)
                    {

                        $str = " A-17 [P-I $cand_Nofif_part1,P-II $cand_Notif]";    
                    }
                    else if($data['cat09']==2 && $data['cat10'] !=2)
                    {
                        $str = "A-17 [P-I $cand_Nofif_part1]";        
                    }
                    else if($data['cat09'] !=2 && $data['cat10']==2)
                    {
                        $str = "A-17 [P-II $cand_Notif]";        
                    }
            }
            if($data['Prev_chance']==4)
            {
                $str ="";
            }    
        }
        //if()
             //DebugBreak();
             if(@$data['isFresh']==1 && @$data['oldRno']<=0 )
             {
             $pdf->Cell(0.5,0.5,"FRESH COMPOSITE",0,'L');
             }
             else
             {
             $pdf->Cell(0.5,0.5,@$data["oldRno"]." ( $LastSess,  $yearOfLastAp )  $str",0,'L');
             }
        

        $pdf->SetXY(0.5,1.85+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,1.85+$Y);
        $pdf->Cell(0.5,0.5,$data["name"],0,'L');
        //--------------------------- FATHER NAME 

        $pdf->SetXY(0.5, 2.0+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Father's Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,2.0+$Y);
        $pdf->Cell(0.5,0.5,$data["Fname"],0,'L');

        //--------------------------- 3rd line 
        //__Mobile    

        $pdf->SetXY(3.5+$x,1.85+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell(0.5,0.5,"Father CNIC:",0,'R');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,1.85+$Y);
        $pdf->Cell(0.5,0.5,$data["FNIC"],0,'L');
        // //DebugBreak();
        //--------------------------- BAY FORM NO line 
        $pdf->SetXY(3.5+$x, 1.70+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Bay Form No:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,1.70+$Y);
        $pdf->Cell(0.5,0.5,$data["BForm"],0,'L');
        $pdf->SetXY(3.5+$x,2.0+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Mobile No:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,2.0+$Y);
        $pdf->Cell(0.5,0.5,$data["MobNo"],0,'L');
        //--------------------------- Dob line 
        $pdf->SetXY(0.5,2.15+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Date Of Birth:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,2.15+$Y);
        $pdf->Cell(0.5,0.5,date("d-m-Y", strtotime($data["Dob"])),0,'L');

        //--------------------------- Gender Nationality Dob

        //  DebugBreak();
        $pdf->SetXY(0.5,2.30+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Registration No:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,2.30+$Y);
        $pdf->Cell(0.5,0.5,$data["strRegNo"],0,'L');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(7.2,2.53+$Y);                                               
        $pdf->Cell(0.5,0.5,$data["sex"]==1?"MALE":"FEMALE",0,'L');

        //--------------------------- id mark and Medium 
        //DebugBreak();
        $pdf->SetXY(0.5,2.45+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Speciality:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.50,2.45+$Y);
        $pdf->Cell(0.5,0.5,$this->GetSpeciality($data["Spec"]),0,'L');

        //DebugBreak();
        //--------------------------- Speciality and Internal Grade 
        $pdf->SetXY(3.5+$x,2.15+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Board Name:",0,'L');
        if($data["Brd_cd"] !=  null && $data["Brd_cd"] >0)
        {
            $OldBoard = ($data["Brd_Abbr"]);
        }
        else
        {
            $OldBoard = 'Nil';  
        }

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,2.15+$Y);
        $pdf->Cell(0.5,0.5,$OldBoard,0,'L');

        $pdf->SetXY(3.5+$x,2.30+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Religion:",0,'L');
        if($data["rel"] !=  null && $data["rel"] ==1)
        {
            $Religion = "MUSLIM";
        }
        else
        {
            $Religion = "NON-MUSLIM";
        }

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.5+$x,2.30+$Y);
        $pdf->Cell(0.5,0.5,$Religion,0,'L');
        
        $pdf->SetXY(-.2+$x,1.75+$Y);
        $pdf->SetFont('Arial','B',$FontSize+15);
        $pdf->TextWithRotation($x-.13,2.8+$Y, $data['formNo'],90,0); 
        
        
        $xx= 0.4;
        $yy = $Y-0.2;
        $boxWidth = 2.62;
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY($xx,3.8+$yy);
        $pdf->SetFillColor(240,240,240);
        $pdf->Cell($boxWidth,0.2,'Part I Subjects',1,0,'C',1);
        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub1Ap1'] != 1 ? '':'1. '. $this->GetSubNameHere($data['sub1']),1,0,'L',1);

        $pdf->Image('assets/img/crossed.jpg',6.7,5.35+$yy, 1.3,0.15, "jpeg");  
        $pdf->SetXY(6.6,3.8+$yy);
        $pdf->Cell(1.4,1.5,'',1,0,'C',0); 
        $pdf->SetXY(6.7,3.8+$yy);
        $pdf->MultiCell(1.1,0.2, 'Paste Recent Photograph & Must Be Cross Attested by the Head/Deputy Head of Institution',0,'C'); 

        $pdf->SetXY(5.69,3.8+$yy);
        $pdf->Cell(.75,1.1,'',1,0,'C',0); 
        $pdf->SetXY(5.72,4.52+$yy);
        $pdf->SetFont('Arial','',6.5);
        $pdf->MultiCell(.65,0.1, "Candidate's Thumb Impression",0,'C');

        //   DebugBreak();

        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub2Ap1'] != 1 ? '':'2. '. $this->GetSubNameHere($data['sub2']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub3Ap1'] != 1 ? '':'3. '. $this->GetSubNameHere($data['sub3']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.6+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub8ap1'] != 1 ? '':'4. '. $this->GetSubNameHere($data['sub8']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.8+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub4Ap1'] != 1 ? '':'5. '. $this->GetSubNameHere($data['sub4']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,5.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub5Ap1'] != 1 ? '':'6. '. $this->GetSubNameHere($data['sub5']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);                                                                     
        $pdf->SetXY($xx,5.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub6Ap1'] != 1 ? '':'7. '. $this->GetSubNameHere($data['sub6']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,5.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub7Ap1'] != 1 ? '':'8. '. $this->GetSubNameHere($data['sub7']),1,0,'L',1);

        $xangle = 2.9;

        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY($xangle,3.8+$yy);
        $pdf->SetFillColor(240,240,240);
        $pdf->Cell($boxWidth,0.2,'Part II Subjects',1,0,'C',1);    
        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub1Ap2'] != 1 ? '':'1. '.  $this->GetSubNameHere($data['sub1']),1,0,'L',1);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub2Ap2'] != 1 ? '':'2. '.  $this->GetSubNameHere($data['sub2']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub3ap2'] != 1 ? '':'3. '.  $this->GetSubNameHere($data['sub3']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.6+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub8Ap2'] != 1 ? '':'4. '.  $this->GetSubNameHere($data['sub8']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.8+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub4Ap2'] != 1 ? '':'5. '.  $this->GetSubNameHere($data['sub4']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,5.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub5Ap2'] != 1 ? '':'6. '.  $this->GetSubNameHere($data['sub5']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,5.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub6Ap2'] != 1 ? '':'7. '.  $this->GetSubNameHere($data['sub6']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,5.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub7Ap2'] != 1 ? '':'8. '.  $this->GetSubNameHere($data['sub7']),1,0,'L',1);

        //DebugBreak();
        $pdf->SetXY(0.5,2.65+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell( 0.5,0.5,"Address:",0,'L');

        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(1.5,2.65+$Y);
        $pdf->Cell(0.5,0.5,$data["addr"],0,'L');

        $pdf->SetXY(0.5,2.95+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.5,0.5,"Proposed Exam Area:",0,'R');
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(1.7,2.95+$Y);
        $pdf->Cell( 0.5,0.5,$data['Zone_cd']." - ".$data['zone_name']."",0,'L');

        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(3.98,3.05+$Y);
        $pdf->Cell(4,0.50,'',1,0,'C',0); 

        $pdf->Image('assets/img/admission_form.jpg',4.07,1.9, 2.38,0.20, "jpeg");

        $pdf->SetXY(3.2,5.75+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell(0.2,0.5,"Signature",0,'R');
        $pdf->SetXY(3.2,5.9+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.2,0.5,"Headmaster/Headmistress/Principal",0,'R');
        $pdf->SetXY(3.2,6.05+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.2,0.5,"Head Of Institution Name",0,'R');
        $pdf->SetXY(3.2,6.2+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.2,0.5,"School/College Code",0,'R');
        $pdf->SetXY(3.2,6.35+$Y);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0.2,0.5,"CNIC",0,'R');

        $pdf->SetXY(0.2,5.25+$Y);
        $pdf->SetFont('Arial','b',9);
        $pdf->Cell(0.5,0.5,"Affidavit:-",0,'R');
        $pdf->SetXY(0.8,5.25+$Y);
        $pdf->SetFont('Arial','b',7);
        $pdf->Cell(0.5,0.5,"I have read this form. The data/information on this form and in online system is same as last entered/modified/provided by me and it's correctness",0,'R');
        $pdf->SetXY(0.2,5.37+$Y);
        $pdf->SetFont('Arial','b',7);
        $pdf->Cell(0.5,0.5,"is only my responsibility.I understand that only the information/data provided in the online system along with the photograph and some other handwritten ",0,'R');
        $pdf->SetXY(0.2,5.49+$Y);
        $pdf->SetFont('Arial','b',7);
        $pdf->Cell(0.5,0.5,"details on this form will be used for further processing. I accept all the terms and conditions in this regard.",0,'R');

        $pdf->SetXY(0.2,5.75+$Y);
        $pdf->SetFont('Arial','b',7);
        $pdf->Cell(0.5,0.5,"Candidate's Signature in Urdu______________________",0,'R');
        $pdf->SetXY(0.2,6.05+$Y);
        $pdf->SetFont('Arial','b',7);
        $pdf->Cell(0.5,0.5,"Candidate's Signature in English____________________",0,'R');

        
        $pdf->SetXY(5.7,6+$yy);
        $pdf->Cell(2.3,0.75,'',1,0,'C',0); 
        $pdf->SetXY(6.2,6.55+$yy);
        $pdf->SetFont('Arial','',8);
        $pdf->MultiCell(1.4,0.1, 'Head of Institution Stamp',0,'C'); 
        

        $pdf->SetXY(0.2,6.4+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$this->GetDueDate(),1,0,'C',1); 

        $bx = 6.8;
        $by = 6.1;
        $Barcode = $data['formNo']."@".$data['class'].'@'.$data['sess'].'@'.$data["Iyear"];

        $pdf->SetXY(0.2,6.46+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(3.2,6.46+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"CMD Account No. 00427900072103",0,'L');

        $pdf->SetXY(5.2,6.46+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Bank Challan No. ".$data['formNo'],0,'L');

        $Y = $Y - 0.5;
        $pdf->SetXY(0.2, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Admission Fee ",0,'L');

        /* $todayd = date("d-M-Y");
        $fdate = date("d-M-Y",strtotime($data['edate']));
        $formarr[] = 62249;
        $isfee = -1;
        for($i = 0 ; $i< count($formarr) ;  $i++ )
        {
        if($formno == $formarr[$i])
        {
        $isfee = 1;
        }  
        }

        //  DebugBreak();
        if($isfee == 1)
        {
        $data['AdmFee'] = 1300;

        $data['AdmTotalFee'] = $data['AdmFee']  + $data['AdmProcessFee']+$data['AdmFine'];  
        $this->Admission_model->updatefee($formno,$data['AdmFee'],$data['AdmTotalFee'],$data['AdmFine']); 
        }
        else if($todayd>$fdate && $data['cDate'] == null )
        {
        $data['AdmFine'] = $this->GetFeeWithdue($data['AdmFee']);

        $data['AdmTotalFee'] = $data['AdmFee']  + $data['AdmProcessFee'];  
        $this->Admission_model->updatefee($formno,$data['AdmFee'],$data['AdmTotalFee']);
        }
        else if($data['cDate'] != null  )
        {
        $fdate = date("d-M-Y",strtotime($data['cDate']));   

        if($todayd>=$fdate)
        {
        $data['AdmFine'] = $this->GetFeeWithdue($data['AdmFee']);

        $data['AdmTotalFee'] = $data['AdmFee']  + $data['AdmProcessFee']+$data['AdmFine'];  
        $this->Admission_model->updatefee($formno,$data['AdmFee'],$data['AdmTotalFee'],$data['AdmFine']);  
        }
        }
        else if($data['edate'] != null )
        {
        $data['AdmFine'] = $this->GetFeeWithdue($data['AdmFee']);

        $data['AdmTotalFee'] = $data['AdmFee']  + $data['AdmProcessFee'] +$data['AdmFine'];  
        $this->Admission_model->updatefee($formno,$data['AdmFee'],$data['AdmTotalFee'],$data['AdmFine']); 
        } 

        if($data['AdmFine'] == null)
        {
        $data['AdmFine'] = 0;
        }                                                               */
        $pdf->SetXY(1.2, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,$data['AdmFee'].'/-',0,'L');


        $pdf->SetXY(1.8, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Late Fee ",0,'L');


        $pdf->SetXY(2.59, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,$data['AdmFine'].'/-',0,'L');

        $pdf->SetXY(3.2, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Processing + Form Fee ",0,'L');
        $pdf->SetXY(4.6, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,$data['AdmProcessFee'].' /-',0,'L');

        $pdf->SetXY(5.42, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Certificate Fee ",0,'L');
        $pdf->SetXY(6.3, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,@$data['certFee'].'/-',0,'L');

        $pdf->SetXY(6.8, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Registration Fee ",0,'L');
        $pdf->SetXY(7.59, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,$data['regFee'].'/-',0,'L');

        $pdf->SetXY(0.2, 7.19+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Total Amount Rs.",0,'L');

        $pdf->SetXY(1.2, 7.19+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,$data['AdmTotalFee'].' /-',0,'L');

        $pdf->SetXY(1.8, 7.19+$Y);
        $pdf->SetFont('Arial','',$FontSize-0.5);
        $pdf->Cell( 0.5,0.5,"Amount in Words:",0,'L');

        $this->load->library('NumbertoWord');
        $obj    = new NumbertoWord();
        $obj->toWords($data['AdmTotalFee'],"Only.",""); 

        $pdf->SetXY(2.6, 7.19+$Y);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');

        $pdf->SetXY(5.3, 7.29+$Y);
        $pdf->SetFont('Arial','b',$FontSize+0.5);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');

        $pdf->SetXY(0,5.0+3.0+$Y);
        $pdf->SetFont('Arial','',10);

        $pdf->Image('assets/img/cutter.jpg',0.2,6.50, 9.2,0.09, "jpeg"); 

        ///



        $Y = $Y + 1.6;

        ///Bank Copy



        $pdf->SetXY(1.2,6.32+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA (SSC ".$session." Examination ,".Year." )",0,'C');


        $pdf->SetXY(0.2,6.42+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0,0,"Bank Copy:  (To be retained with HBL) ",0,'L');

        $pdf->SetXY(3.3,6.55+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0,0,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(0.2,6.5+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$this->GetDueDate(),1,0,'C',1); 

        $pdf->Image(BARCODE_PATH.$image,5.75, 6.5+$Y  ,1.8,0.20,"PNG");

        $pdf->Image("assets/img/10th.png",7.58,6.3+$Y, 0.30,0.30, "PNG");  



        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(0.2,6.79+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Form No:",0,'L');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.02,6.79+$Y);
        $pdf->Cell( 0,0,$data['formNo'],0,'L');

        $pdf->SetXY(3.3, 6.79+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0,0,"CMD Account No. 00427900072103",0,'L');


        $pdf->SetXY(5.42, 6.79+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0,0,"Bank Challan No. ".$data['formNo'],0,'L');      



        $pdf->SetXY(0.2,6.95+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);

        $pdf->SetXY(1.0,6.95+$Y);
        $pdf->Cell(0,0,$data["name"],0,'L');
        //--------------------------- FATHER NAME 

        $pdf->SetXY(3.3, 6.95+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Father's Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.2,6.95+$Y);
        $pdf->Cell(0,0,$data["Fname"],0,'L');




        $pdf->SetXY(0.2, 7.1+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Total Amount Rs.",0,'L');

        $pdf->SetXY(1.0, 7.1+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0,0,$data['AdmTotalFee'].'/-',0,'L');


        $pdf->SetXY(1.85, 7.1+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Amount in Words:",0,'L');

        $pdf->SetXY(2.68, 7.1+$Y);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell( 0,0,ucwords($obj->words),0,'L');  





        $pdf->SetXY(5.3, 7.1+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');

        $pdf->Image('assets/img/BankCopy.jpg',0.25,7.65, 4.8,0.25, "jpeg");   

        $pdf->Image('assets/img/cutter.jpg',0.2,7.98, 8.6,0.09, "jpeg");       

        //Board Copy Alogn With Scroll
        $pdf->SetXY(1.2,7.8+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA (SSC ".$session." Examination ,".Year." )",0,'C');

        $pdf->SetXY(0.2,7.9+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0,0,"Board Copy: (Along with Scroll)",0,'L');

        $pdf->SetXY(0.2,7.98+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$this->GetDueDate(),1,0,'C',1); 


        $pdf->Image("assets/img/10th.png",7.58,7.7+$Y, 0.30,0.30, "PNG");  

        $pdf->Image(BARCODE_PATH.$image,5.75, 7.98+$Y  ,1.8,0.20,"PNG");

        $pdf->SetXY(3.3,8.05+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0,0,"Printing Date: " .date('d-M-Y h:i A'),0,'L');


        $pdf->SetXY(0.2,8.3+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Form No:",0,'L');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.02,8.3+$Y);
        $pdf->Cell( 0,0,$data['formNo'],0,'L');




        $pdf->SetXY(3.3,8.3+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"CMD Account No. 00427900072103",0,'L');

        $pdf->SetXY(5.42,8.3+$Y);
        $pdf->SetFont('Arial','b',$FontSize+1);
        $pdf->Cell( 0,0,"Bank Challan No. ".$data['formNo'],0,'L');

        $Y = $Y - 0.4;

        $pdf->SetXY(0.2,8.9+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.02,8.9+$Y);
        $pdf->Cell(0,0,$data["name"],0,'L');
        //--------------------------- FATHER NAME 

        $pdf->SetXY(3.3, 8.9+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Father's Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.0,8.9+$Y);
        $pdf->Cell(0,0,$data["Fname"],0,'L');

        $Y = $Y +.2;

        $pdf->SetXY(0.2, 8.9+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Admission Fee ",0,'L');


        $pdf->SetXY(1.02, 8.9+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0, $data['AdmFee'].'/-',0,'L');


        $pdf->SetXY(1.8, 8.9+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Late Fee ",0,'L');


        $pdf->SetXY(2.59,8.9+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$data['AdmFine'].'/-',0,'L');

        $pdf->SetXY(3.3, 8.9+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Processing + Form Fee ",0,'L');

        $pdf->SetXY(4.6,8.9+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,$data['AdmProcessFee'].'/-',0,'L');

        $pdf->SetXY(5.42, 8.9+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Certificate Fee ",0,'L');
        $pdf->SetXY(6.3, 8.9+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,@$data['certFee'].'/-',0,'L');

        $pdf->SetXY(6.8, 8.9+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Registration Fee ",0,'L');
        $pdf->SetXY(7.59, 8.9+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,@$data['regFee'].'/-',0,'L');

        $Y = $Y -.2;
        $Y = $Y +.15;
        $pdf->SetXY(0.2, 9.19+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Total Amount Rs.",0,'L');

        $pdf->SetXY(1.02, 9.19+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0,0,$data['AdmTotalFee'].'/-',0,'L');


        $pdf->SetXY(1.8, 9.19+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Amount in Words:",0,'L');


        $pdf->SetXY(2.6, 9.19+$Y);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell( 0,0,ucwords($obj->words),0,'L');


        $pdf->SetXY(5.3, 9.39+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Manager/Cashier:___________________________ ",0,'L');
        $Y = $Y -.15;


        $pdf->Image('assets/img/cutter.jpg',0.2,9.72, 8.6,0.09, "jpeg");

        //Candidate Copy 
        $Y = $Y - 0.1;
        $pdf->SetXY(1.2,10.1+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA (SSC ".$session." Examination ,".Year." )",0,'C');

        $pdf->SetXY(0.2,10.2+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0,0,"Candidate Copy",0,'L');


        $pdf->SetXY(3.3,10.23+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0,0,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(0.2,10.25+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$this->GetDueDate(),1,0,'C',1); 

        $pdf->Image(BARCODE_PATH.$image,5.75, 10.4+$Y  ,1.8,0.20,"PNG");

        $pdf->Image("assets/img/10th.png",7.58,10.2+$Y, 0.30,0.30, "PNG");  

        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(3.3, 10.4+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0,0,"CMD Account No.  00427900072103",0,'L');


        $pdf->SetXY(3.3, 10.55+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0,0,"Bank Challan No. ".$data['formNo'],0,'L');

        $pdf->SetXY(0.5,10.55+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Form No:",0,'L');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.0,10.55+$Y);
        $pdf->Cell( 0,0,$data['formNo'],0,'L');




        $pdf->Image(PRIVATE_IMAGE_PATH.$data['PicPath'],6.5, 10.68+$Y, 0.95, 1.0, "JPG");
        $pdf->SetFont('Arial','',8);

        $pdf->SetXY(0.5,10.70+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.0,10.70+$Y);
        $pdf->Cell(0,0,$data["name"],0,'L');
        //--------------------------- FATHER NAME 

        $pdf->SetXY(3.3, 10.75+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Father's Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.0,10.75+$Y);
        $pdf->Cell(0,0,$data["Fname"],0,'L');


        $pdf->SetXY(0.5, 10.85+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Total Amount Rs.",0,'L');

        $pdf->SetXY(1.35, 10.85+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0,0,$data['AdmTotalFee'].'/-',0,'L');


        $pdf->SetXY(0.5, 11.0+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0,0,"Proposed Exam Area:",0,'L');

        $pdf->SetXY(1.48, 11.0+$Y);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell( 0,0,$data['Zone_cd']." - ".$data['zone_name'],0,'L');

        $pdf->SetXY(3.3, 11.0+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0,0,"Manager/Cashier:___________________________ ",0,'L'); 


        $pdf->Image('assets/img/CandidateCopy.jpg',0.27,11.0, 6.1,0.45, "jpeg");  





        $filename="Admission_Forms_".$data['formNo']."_"   .  ".pdf";
        $pdf->Output($filename, 'I');

    }
    function GetFeeWithdue($fee)
    {
        //DebugBreak();
        $dueDate='';
        $single_date= SingleDateFee9th;  $double_date= DoubleDateFee9th;  $tripple_date= TripleDateFee9th;
        $today = date("d-m-Y");

        if(strtotime($today) <= strtotime($single_date)) 
        {
            $dueDate = 0;
        }
        else if( strtotime($today) <=  strtotime($double_date) )
        {
            $dueDate = 0;
        }
        else if( strtotime($today) <= strtotime($tripple_date)  )
        {

            $dueDate = 0;

        }
        else if(strtotime($today) > strtotime($tripple_date) )
        {
            $now = time(); // or your date as well
            $your_date = strtotime($tripple_date);
            $datediff = $now - $your_date;
            $days = floor($datediff/(60*60*24));

            $dueDate = $days*500;
            // $fee = $fee/3;
            //    $dueDate = $fee*3 + $fine;
        }
        return $dueDate;

    }
    function feecalculate($data)
    {
        //DebugBreak();
        $isper = 0;
        if( $this->practicalsubjects($data['sub5'])|| $this->practicalsubjects($data['sub6'])|| $this->practicalsubjects($data['sub7']))
        {
           $isper = 1; 
        }
        $User_info_data = array('Inst_Id'=>999999, 'date' => date('Y-m-d'),'isPratical'=>$isper);
        $user_info  =  $this->Admission_model->getuser_infoPVT($User_info_data); 
        $isfine = 0;
        $Total_fine = 0;
        $processFee = 295;
        $admfee = 1300;
        $admfeecmp = 1300;
        // Declare Science & Arts Fee's According to Fee Table .  Note: this will assign to Triple date fee. After triple date it will not asign fees.
        if(!empty($user_info['rule_fee'])) 
        {    $endDate =date('Y-m-d', strtotime($user_info['rule_fee'][0]['End_Date'])); 
            $singleDate = $endDate;
            if($user_info['rule_fee'][0]['isPrSub']==1)
            {
                $admfee = $user_info['rule_fee'][0]['PVT_Amount'];
                $processFee = $user_info['rule_fee'][0]['Processing_Fee'];;
                $admfeecmp = $user_info['rule_fee'][0]['Comp_Pvt_Amount'];
            } 
            else if($user_info['rule_fee'][0]['isPrSub']== 0 )
            {
                $admfee = $user_info['rule_fee'][0]['PVT_Amount'];
                $processFee = $user_info['rule_fee'][0]['Processing_Fee'];;
                $admfeecmp = $user_info['rule_fee'][0]['Comp_Pvt_Amount'];
            }
        }
        else
        {
            $date = new DateTime(SingleDateFee9th);
            $singleDate =  $date->format('Y-m-d');                                                                     
            $User_info_data = array('Inst_Id'=>999999, 'date' => $singleDate,'isPratical'=>$isper);
            $user_info  =  $this->Admission_model->getuser_infoPVT($User_info_data);
            if($user_info['rule_fee'][0]['isPrSub'] == 1)
            {
                $admfee = $user_info['rule_fee'][0]['PVT_Amount'];
                $processFee = $user_info['rule_fee'][0]['Processing_Fee'];;
                $admfeecmp = $user_info['rule_fee'][0]['Comp_Pvt_Amount'];

            } 
            else if( $user_info['rule_fee'][0]['isPrSub'] == 0 )
            {
                $admfee = $user_info['rule_fee'][0]['PVT_Amount'];
                $processFee = $user_info['rule_fee'][0]['Processing_Fee'];;
                $admfeecmp = $user_info['rule_fee'][0]['Comp_Pvt_Amount'];

            }
           
            $TripleDate = date('Y-m-d',strtotime(TripleDateFee9th)); 
            $now = date('Y-m-d'); // or your date as well
            $days = (strtotime($TripleDate) - strtotime($now)) / (60 * 60 * 24);
            $fine = 500;
            $days = abs($days);
            $endDate = date('d-m-Y');
            $admfee =  ($admfee*3); 
            $admfeecmp =  ($admfeecmp*3); 
            $Total_fine = $days*$fine;

        }  // DebugBreak();
        $finalFee = '';
        if($data['cat09'] !=  NULL && $data['cat10'] != NULL)
        {
            $finalFee = $admfeecmp;
        }
        else
        {
            $finalFee = $admfee;
        }
        if($data['Spec']>0 && (strtotime(date('Y-m-d')) <= strtotime(SingleDateFee9th) ))
        {
            $regfee =  1000;
            if($data['Spec'] >  2)
            {
                $regfee = 0; 
            }
            $data['AdmFee'] = $finalFee;
            $data['AdmTotalFee'] = $processFee+$Total_fine+$data['regFee']+$data['certFee'];
            $AllStdFee = array('formNo'=>$data['formNo'],'AdmFee'=>0,'AdmFine'=>$Total_fine,'AdmTotalFee'=> $data['AdmTotalFee']);
        }
        else
        {
            $data['AdmFee'] = $finalFee;
            $data['AdmTotalFee'] = $processFee+$Total_fine+$data['regFee']+$data['certFee']+$finalFee;
            $AllStdFee = array('formNo'=>$data['formNo'],'AdmFee'=>$finalFee,'AdmFine'=>$Total_fine,'AdmTotalFee'=>$data['AdmTotalFee']);
        }

        $info =   $this->Admission_model->Update_AdmissionFeePvt($AllStdFee);
        return $info;
    }
    
    function GetDueDate()
    {
        $dueDate='';
        $single_date= SingleDateFee9th;  $double_date= DoubleDateFee9th;  $tripple_date= TripleDateFee9th;
        $today = date("d-m-Y");

        if(strtotime($today) <= strtotime($single_date)) 
        {
            $dueDate = $single_date;
        }
        else if( strtotime($today) <=  strtotime($double_date) )
        {
            $dueDate = $double_date;
        }
        else if( strtotime($today) <= strtotime($tripple_date)  )
        {
            $dueDate = $tripple_date;
        }
        else if(strtotime($today) > strtotime($tripple_date) )
        {
            $dueDate = $today;
        }
        return $dueDate;

    }
    function  GetSubNameHere($_sub_cd)
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
    function getCatName($cat)
    {
        if ($cat==1) return "Full Appear";
        else if ($cat ==2) return "Re-Appear";
            else if ($cat ==3 or $cat == 7) return "Marks Improve";
                else if ($cat ==5 ) return "Additional";
                    else return -1;
    }
    private function makecat($cattype, $exam_type,$marksImp,$is9th)
    {


        $cate =  array();

        if($exam_type == 2)

        {
            $cate['cat09'] = 1;
            $cate['cat10'] = 1;
        }
        else  if($exam_type == 1)

        {
            $cate['cat09'] = 0;
            $cate['cat10'] = 1;
        }
        else
            if($exam_type == 3)
            {
                if($is9th==1)
                {
                    $cate['cat09'] = 2;     
                }
                else{
                    $cate['cat09'] = 0;          
                }
                $cate['cat10'] = 1;
            }
            else if($exam_type == 4){
                $cate['cat09'] = 0;
                $cate['cat10'] = 2;
            }
            else if($exam_type == 5){
                $cate['cat09'] = 2;
                $cate['cat10'] = 0;
            }
            else if($exam_type == 6){
                $cate['cat09'] = 2;
                $cate['cat10'] = 2;
            }
            else if(($exam_type == 14 || ($exam_type == 16 && $cattype == 1)) && $marksImp == 2){
                $cate['cat09'] = 0;
                $cate['cat10'] = 3;
            }
            else if(($exam_type == 14 || ($exam_type == 16 && $cattype == 1))  && $marksImp == 1){
                $cate['cat09'] = 3;
                $cate['cat10'] = 0;
            }
            else if(($exam_type == 14 || ($exam_type == 16 && $cattype == 1))  && $marksImp == 3){
                $cate['cat09'] = 3;
                $cate['cat10'] = 3;
            }
            else if(($exam_type == 14 || ($exam_type == 16 && $cattype == 1))  && $marksImp ==4){
                $cate['cat09'] = 7;
                $cate['cat10'] = 7;
            }

            else if($exam_type == 15 || ($exam_type == 16 && $cattype == 2)){
                $cate['cat09'] =  5;
                $cate['cat10'] = 5;
            }        
            return $cate;
    }
    public function Pre_Matric_data()
    {

         //  DebugBreak();
        $this->load->library('session');
        $this->load->model('Admission_model');
        $error = $this->session->flashdata('NewEnrolment_error');
        if($error) 
        {
            $data[0] = $this->session->flashdata('NewEnrolment_error'); 
            $dob     = $data[0]["Dob"];
            $mrollno = $data[0]["rno"];
            $oldClass= $data[0]["class"];
            $year    = $data[0]["Iyear"];
            $session = $data[0]["sess"];
            $board   = $data[0]["Brd_cd"];
            @$cattype   = $data[0]["category"];

            $error_msg = $data[0]["excep"];
            
            if($year >=2015)
            {
            $data = array('dob'=>$dob,'mrno'=>$mrollno,'class'=>$oldClass,'year'=>$year,'session'=>$session,'board'=>$board);
            $data = $this->Admission_model->Pre_Matric_data($data);
            }
            
            $brd_name=$this->Admission_model->Brd_Name($board);
            $data[0]['brd_name']=$brd_name[0]['Brd_Abr'] ;
            $data[0]['excep']=$error_msg;
               
            if(!$data){
                $error_msg.= '<span style="font-size: 16pt; color:red;">' . 'No Any Student Found Against Your Criteria</span>';            
                $data['error'] = $error_msg;
                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/getinfo.php', $data);
                $this->load->view('common/footer.php');    
                return false;
            }
            if($year < 2015)
            {
              
               
                
             if(@$data[0]['status'] == 1)
                {
                    $error_msg.= '<span style="font-size: 16pt; color:red;">' . 'You can not appear.</span>';            
                    $data['error'] = $error_msg;
                    $this->load->view('common/commonheader.php');        
                    $this->load->view('Admission/Matric/getinfo.php', $data);
                    $this->load->view('common/footer.php');    
                    return false;
                }
                else
                {
                // DebugBreak();
                /*$data[0]['name'] = $data[0]['Name'] ;
                $data[0]['BForm'] = $data[0]['bFormNo'] ;
                $data[0]['Dob'] = $data[0]['dob'] ;
                $data[0]['Iyear'] = $data[0]['iyear'] ;
                $data[0]['rno'] = $data[0]['RNo'] ;   */
                $data[0]['sess'] =    $session;
                $data[0]['class'] =    $oldClass;
                $data[0]['status']=2;
                    $this->load->view('common/commonheader.php');
                    $this->load->view('Admission/Matric/matricFreshForm.php', array('data'=>$data[0]));
                    $this->load->view('common/common_ma/Otherboard10thfooter.php');
                    return false;  
                }
                
            }
            $exam_type = $data[0]['exam_type'];
            $specialcode = $data[0]['spl_cd'];
            $specialcase = $data[0]['result2'];
            $nxtrnosessyear = $data[0]['NextRno_Sess_Year'];

             $pic =  explode('Pictures$',@$data[0]['picpath']);
            $picpath = DIRPATH.'\\'.@$pic[1];
           // echo $picpath;die();
            $isexit = is_file($picpath);
            if(!$isexit)
            {
                $error_msg.= '<span style="font-size: 16pt; color:red;">' . 'Your Picture is missing.</span>';            
                $data['error'] = $error_msg;
                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/getinfo.php', $data);
                $this->load->view('common/footer.php');    
                return false;
               
            }
            else
            {
                $type = pathinfo($picpath, PATHINFO_EXTENSION);
                $data[0]['picpath'] = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($picpath));
               
            } 
            
            if(($exam_type == 16 || $exam_type == 15) && ($cattype == 1 || $cattype == 2)){
                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/AdmissionForm.php',  array('data'=>$data, 'cattype'=>$cattype));
                $this->load->view('common/common_ma/commonfooter.php'); 
            }

            else if($specialcode != '' || $exam_type == 17 || $exam_type == 16 || $exam_type == 18 || $nxtrnosessyear != '')
            {
                $data[0]['dob'] = $dob;
                $data[0]['oldRno'] = $mrollno;
                $data[0]['oldClass'] = $oldClass;
                $data[0]['oldYear'] = $year;
                $data[0]['oldSess'] = $session;
                $data[0]['oldBrd_cd'] = $board;


                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/getinfo.php', $data[0]);
                $this->load->view('common/footer.php');    
            }
            else
            {  
                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/AdmissionForm.php',  array('data'=>$data));
                $this->load->view('common/common_ma/commonfooter.php');
            }
        }

        else{  
         $error_msg = '';   
        if( empty($_POST["dob"]) || empty($_POST["oldRno"]) )
        {
           $error_msg.= '<span style="font-size: 16pt; color:red;">' . 'No Data Against Your Information.</span>';            
                    $data['error'] = $error_msg;
                    $this->load->view('common/commonheader.php');        
                    $this->load->view('Admission/Matric/getinfo.php', $data);
                    $this->load->view('common/footer.php');    
                    return false;
        }     
            $dob     = $_POST["dob"];
            $mrollno = $_POST["oldRno"];
            $oldClass= $_POST["oldClass"];
            $year    = $_POST["oldYear"];
            $session = $_POST["oldSess"];
            $board   = $_POST["oldBrd_cd"];
            @$cattype   = $_POST["CatType"]; 
            $data = array('dob'=>$dob,'mrno'=>$mrollno,'class'=>$oldClass,'year'=>$year,'session'=>$session,'board'=>$board);
                // DebugBreak();
            $data = $this->Admission_model->Pre_Matric_data($data);

          

            $error_msg = '';

            if(!$data){
                $error_msg.= '<span style="font-size: 16pt; color:red;">' . 'No Any Student Found Against Your Criteria</span>';            
                $data['error'] = $error_msg;
                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/getinfo.php', $data);
                $this->load->view('common/footer.php');    
                return false;
            }
           //  
            $brd_name=$this->Admission_model->Brd_Name($board);
            $data[0]['brd_name']=@$brd_name[0]['Brd_Abr'] ;
            $exam_type = @$data[0]['exam_type'];
            $specialcode = @$data[0]['spl_cd'];
            $specialcase = @$data[0]['result2'];
            $status = @$data[0]['status'];
            $grp_cd = @$data[0]['grp_cd'];
            $specialcase = @$data[0]['result2'];
            $nxtrnosessyear = @$data[0]['NextRno_Sess_Year'];

             if($year < 2015)
            {
            //  DebugBreak();
          
            $nxtrnosessyear = $this->Admission_model->checknextrno($data[0]['RNo'],$data[0]['iyear'],$session,$oldClass);
            //if($nxtrnosessyear !=  -1)
            if($nxtrnosessyear[0]['NextRno_Sess_Year']!=NULL)
            {
                $nxtrnosessyear = $nxtrnosessyear[0]['NextRno_Sess_Year'];
                $error_msg.= '<span style="font-size: 16pt; color:red;">' . 'Please use this details:'.$nxtrnosessyear.'</span>';            
                $data['error'] = $error_msg;
                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/getinfo.php', $data);
                $this->load->view('common/footer.php');    
                return false; 
            }        

            else  if($data[0]['status'] == 1 && $data[0]['class'] == 10)
            {
                $error_msg.= '<span style="font-size: 16pt; color:red;">' . 'You are already passed due to that can not appear again.</span>';            
                $data['error'] = $error_msg;
                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/getinfo.php', $data);
                $this->load->view('common/footer.php');    
                return false;
            }

            else if($data[0]['Spl_Name'] !="")
            {
                $error_msg.= '<span style="font-size: 16pt; color:red;">' . 'You can not appear due to  '.$data[0]['Spl_Name'].' Condition.</span>';            
                $data['error'] = $error_msg;
                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/getinfo.php', $data);
                $this->load->view('common/footer.php');    
                return false;
            }
                else
                {
                // DebugBreak();
                $data[0]['name'] = $data[0]['Name'] ;
                $data[0]['BForm'] = $data[0]['bFormNo'] ;
                $data[0]['Dob'] = $data[0]['dob'] ;
                $data[0]['Iyear'] = $data[0]['iyear'] ;
                $data[0]['rno'] = $data[0]['RNo'] ;
                $data[0]['sess'] =    $session;
                $data[0]['class'] =    $oldClass;
                $data[0]['isNotFresh'] =    1;
                    $this->load->view('common/commonheader.php');
                    $this->load->view('Admission/Matric/matricFreshForm.php', array('data'=>$data[0]));
                    $this->load->view('common/common_ma/Otherboard10thfooter.php');
                    return false;  
                }
            
            }
          // DebugBreak();
            $pic =  explode('Pictures$',@$data[0]['picpath']);
            $picpath = DIRPATH.'\\'.@$pic[1];
           // echo $picpath;die();
            $isexit = is_file($picpath);
            if(!$isexit)
            {
                $error_msg.= '<span style="font-size: 16pt; color:red;">' . 'Your Picture is missing.</span>';            
                $data['error'] = $error_msg;
                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/getinfo.php', $data);
                $this->load->view('common/footer.php');    
                return false;
               
            }
            else
            {
                $type = pathinfo($picpath, PATHINFO_EXTENSION);
                $data[0]['picpath'] = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($picpath));
               
            } 

            
            if($exam_type == 16 && ($cattype == 1 || $cattype == 2)){
                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/AdmissionForm.php',  array('data'=>$data, 'cattype'=>$cattype));
                $this->load->view('common/common_ma/commonfooter.php'); 
            }
            else if($specialcode != '' || $exam_type == 17 || $exam_type == 16 || $exam_type == 18 || $nxtrnosessyear != '' || ($grp_cd ==4 && $status == 1))
            {
                $data[0]['dob'] = $dob;
                $data[0]['oldRno'] = $mrollno;
                $data[0]['oldClass'] = $oldClass;
                $data[0]['oldYear'] = $year;
                $data[0]['oldSess'] = $session;
                $data[0]['oldBrd_cd'] = $board;

                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/getinfo.php', $data[0]);
                $this->load->view('common/footer.php');    
            }
            else
            {  
                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/AdmissionForm.php',  array('data'=>$data));
                $this->load->view('common/common_ma/commonfooter.php');
            }
        }





    }
    public function practicalsubjects($_sub_cd)
    {        
        if($_sub_cd == 6)  $ret_val = "1";
        else if($_sub_cd == 7)  $ret_val = "1";
            else if($_sub_cd == 8)  $ret_val = "1";
                else if($_sub_cd == 18)  $ret_val = "1";
                    else if($_sub_cd == 27)  $ret_val = "1";
                        else if($_sub_cd == 28)  $ret_val = "1";
                            else if($_sub_cd == 30)  $ret_val = "1";
                                else if($_sub_cd == 40)  $ret_val = "1";
                                    else if($_sub_cd == 43)  $ret_val = "1";
                                        else if($_sub_cd == 45)  $ret_val = "1";
                                            else if($_sub_cd == 46)  $ret_val = "1";
                                                else if($_sub_cd == 48)  $ret_val = "1";
                                                    else if($_sub_cd == 68)  $ret_val = "1";
                                                        else if($_sub_cd == 69)  $ret_val = "1";
                                                            else if($_sub_cd == 70)  $ret_val = "1";
                                                                else if($_sub_cd == 72)  $ret_val = "1";
                                                                    else if($_sub_cd == 73)  $ret_val = "1";
                                                                        else if($_sub_cd == 78)  $ret_val = "1";
                                                                            else if($_sub_cd == 79)  $ret_val = "1";
                                                                                else if($_sub_cd == 89)  $ret_val = "1";
                                                                                    else if($_sub_cd == 88)  $ret_val = "1";
                                                                                        else if($_sub_cd == 89)  $ret_val = "1";
                                                                                            else if($_sub_cd == 90)  $ret_val = "1";
                                                                                                else if($_sub_cd == 93)  $ret_val = "1";
                                                                                                    else if($_sub_cd == 94)  $ret_val = "1";
                                                                                                        else $ret_val = 0;
        return $ret_val;
    }
    public function NewEnrolment_insert()
    {
        //DebugBreak();
        $this->load->model('Admission_model');
        $this->load->library('session');
        $userinfo = '';//$Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = 999999;
        $this->commonheader($userinfo);
        $error = array();

        $formno = $this->Admission_model->GetFormNo();
        $dob = @$_POST['dob'];

        if(@$_POST['isFresh']==1)
        {
           $nxtrnosessyear = $this->Admission_model->checkalready(@$_POST['cand_name'],$_POST['father_cnic'],$_POST['dob']);
           
           if($nxtrnosessyear != -1  && $nxtrnosessyear[0]['NextRno_Sess_Year'] != NULL)
           {
               $nxtrnosessyear = $nxtrnosessyear[0]['NextRno_Sess_Year'];
                $allinputdata['excep'] = 'You have already Appeared in Matric'.$nxtrnosessyear;
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/matric_fresh/');
                return;
           }
          
          
        }
        
        
        $allinputdata = array('cand_name'=>@$_POST['cand_name'],
            'father_name'=>@$_POST['father_name'],
            'bay_form'=>@$_POST['bay_form'],
            'father_cnic'=>@$_POST['father_cnic'],
            'Dob'=>@$_POST['dob'],
            'mob_number'=>@$_POST['mob_number'],
            'medium'=>@$_POST['medium'],
            'speciality'=>@$_POST['speciality'],
            'MarkOfIden'=>@$_POST['MarkOfIden'],
            'medium'=>@$_POST['medium'],
            'nationality'=>@$_POST['nationality'],
            'gender'=>@$_POST['gend'],
            'hafiz'=>@$_POST['hafiz'],
            'religion'=>@$_POST['religion'],
            'std_group'=>@$_POST['std_group'],
            'address'=>@$_POST['address'],
            'UrbanRural'=>@$_POST['UrbanRural'],
            'dist'=>@$_POST['pvtinfo_dist'],
            'teh'=>@$_POST['pvtinfo_teh'],
            'zone'=>@$_POST['pvtZone'],
            'oldrno'=>@$_POST['oldrno'],
            'oldsess'=>@$_POST['oldsess'],
            'oldyear'=>@$_POST['oldyear'],
            'oldboard'=>@$_POST['oldboard'],
            'oldClass'=>@$_POST['oldClass'],
            'cattype' => @$_POST['category'],
            'sub1'=>@$_POST['sub1'],
            'sub2'=>@$_POST['sub2'],
            'sub3'=>@$_POST['sub3'],
            'sub4'=>@$_POST['sub4'],
            'sub5'=>@$_POST['sub5'],
            'sub6'=>@$_POST['sub6'],
            'sub7'=>@$_POST['sub7'],
            'sub8'=>@$_POST['sub8'],
            'sub1p2'=>@$_POST['sub1p2'],
            'sub2p2'=>@$_POST['sub2p2'],
            'sub3p2'=>@$_POST['sub3p2'],
            'sub4p2'=>@$_POST['sub4p2'],
            'sub5p2'=>@$_POST['sub5p2'],
            'sub6p2'=>@$_POST['sub6p2'],
            'sub7p2'=>@$_POST['sub7p2'],
            'sub8p2'=>@$_POST['sub8p2'],
        );
        
        $sub1 = 0;
        $sub2 = 0;
        $sub3 = 0;
        $sub4 = 0;
        $sub5 = 0;
        $sub6 = 0;
        $sub7 = 0;
        $sub8 = 0;
        $sub1ap1 = 0;
        $sub2ap1 = 0;
        $sub3ap1 = 0;
        $sub4ap1 = 0;
        $sub5ap1 = 0;
        $sub6ap1 = 0;
        $sub7ap1 = 0;
        $sub8ap1 = 0;
        $sub1ap2 = 0;
        $sub2ap2 = 0;
        $sub3ap2 = 0;
        $sub4ap2 = 0;
        $sub5ap2 = 0;
        $sub6ap2 = 0;
        $sub7ap2 = 0;
        $sub8ap2 = 0;

        $is9th = 0;
        if(@$_POST['sub1'] != 0)
        {
            $sub1ap1 = 1; 
            $sub1 =  $_POST['sub1'];   
            $is9th = 1;
        }
        if(@$_POST['sub2'] != 0)
        {
            $sub2ap1 = 1;    
            $sub2 =  $_POST['sub2'];
            $is9th = 1;
        }
        if(@$_POST['sub3'] != 0)
        {
            $sub3ap1 = 1;   
            $sub3 =  $_POST['sub3'];
            $is9th = 1;
        }
        if(@$_POST['sub4'] != 0)
        {
            $sub4ap1 = 1;    
            $sub4 =  $_POST['sub4'];
            $is9th = 1;
        }
        if(@$_POST['sub5'] != 0)
        {
            $sub5ap1 = 1;    
            $sub5 =  $_POST['sub5'];
            $is9th = 1;
        }
        if(@$_POST['sub6'] != 0)
        {
            $sub6ap1 = 1;    
            $sub6 =  $_POST['sub6'];
            $is9th = 1;
        }
        if(@$_POST['sub7'] != 0)
        {
            $sub7ap1 = 1;    
            $sub7 =  $_POST['sub7'];
            $is9th = 1;
        }
        if(@$_POST['sub8'] != 0)
        {
            $sub8ap1 = 1;    
            $sub8 =  $_POST['sub8'];
            $is9th = 1;
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
        if(@$_POST['sub3p2'] != 0)
        {
            $sub3ap2 = 1;  
            $sub3 =  $_POST['sub3p2'];    
        }
        if(@$_POST['sub4p2'] != 0)
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
        }
        if(@$_POST['sub8p2'] != 0)
        {
            $sub8ap2 = 1;    
            $sub8 =  $_POST['sub8p2'];  
        }

        $cattype = @$_POST['category'];
        $examtype = @$_POST['exam_type'];
        $marksImp = @$_POST['ddlMarksImproveoptions'];

        if(@$_POST['isotherbrd']==1 )
        {
            if($is9th == 1)
            {
                $examtype = 3;
                $cat09 = 2;
                $cat10 = 1;
            }
            else
            {
                $examtype = 1;
                $cat09 = 0;
                $cat10 = 1;
            }
            @$_POST['exam_type']=$examtype;
        }
        
        if(@$_POST['isFresh']==1)
        {
            $examtype = 2;
            $cat09 = 1;
            $cat10 = 1;
        }
        
        else if(@$_POST['isotherbrd']==0)
        {
            $cat = $this->makecat($cattype, $examtype,$marksImp,$is9th);
            $cat09 = @$cat['cat09'];
            $cat10 = @$cat['cat10'];
        }
         $Speciality = $this->input->post('speciality');
        $grp_cd = $this->input->post('std_group');
        $per_grp = $this->input->post('pergrp');
        if(@$grp_cd == 4)
        {
            $cat09 = 4;
            $cat10 = 4;
        }
         else  if(@$grp_cd == 9)
        {
            $cat09 = 9;
            $cat10 = 9;
            $grp_cd =4;
        }
        if($examtype == 15 || ($examtype == 16 && $cattype == 2))
        {
            $sub1 = 0;
            $sub1ap1 =0;
            $sub1ap2 = 0;
            $sub2 = 0;
            $sub2ap1 =0;
            $sub2ap2 = 0;
            $sub3 = 0;
            $sub3ap1 =0;
            $sub3ap2 = 0;
            $sub4 = 0;
            $sub4ap1 =0;
            $sub4ap2 = 0;
            $sub8 = 0;
            $sub8ap1 =0;
            $sub8ap2 = 0;
        }

        

        if($grp_cd == '1' || $grp_cd == '7' || $grp_cd == '8'){
            $grp_cd = '1';
        }
        else if($grp_cd == '2' )
        {
            $grp_cd = '2';        
        }
        else if($grp_cd == '5')
        {
            $grp_cd = '5';        
        }

        $practical_Sub = array(
            'PHY'=>'6',
            'CHM'=>'7',
            'BIO'=>'8',
            'ART&MD'=>'18',
            'F&N'=>'27',
            'AHE'=>'28',
            'C&T'=>'30',
            'HPD'=>'40',
            'EW'=>'43',
            'COM'=>'45',
            'AGR'=>'46',
            'WW(FM)'=>'48',
            'CM'=>'68',
            'DRAW'=>'69',
            'EMB'=>'70',
            'TAIL'=>'72',
            'TYPE'=>'73',
            'CSC'=>'78',
            'WW(BM)'=>'79',
            'POUL'=>'83',
            'R/AC'=>'88',
            'F/FRM'=>'89',
            'CHW'=>'90',
            'CSC/D'=>'93',
            'HPD/D'=>'94'
        );
        $ispractical = 0;
        if($per_grp == 1)
        {
            $ispractical =1;
        }
        if(array_search(@$_POST['sub5'],$practical_Sub) || array_search(@$_POST['sub6'],$practical_Sub) || array_search(@$_POST['sub7'],$practical_Sub) ||
            array_search(@$_POST['sub5p2'],$practical_Sub) || array_search(@$_POST['sub6p2'],$practical_Sub) || array_search(@$_POST['sub7p2'],$practical_Sub))
        {
            $ispractical =1;
        }
        $regfee = 0;
        $cerfee = 0;
        $AdmFee = $this->Admission_model->getrulefee($ispractical);
        $AdmFeeCatWise = '1300';
        if($cat09 != 0 && $cat10 != 0)
        {
            $AdmFeeCatWise = $AdmFee[0]['Comp_Pvt_Amount'];
        }
        else if(($cat09 == 0 && $cat10 != 0) || ($cat09 != 0 && $cat10 == 0))
        {
            $AdmFeeCatWise = $AdmFee[0]['PVT_Amount'];
        }
        else if($cat09 == 0 && $cat10 == 0)
        {
            return;
        }

        if(strtotime( date("d-m-Y")) <= strtotime(SingleDateFee9th)) 
        {
            if($Speciality > 0 || $grp_cd ==  5)
            {
                $AdmFeeCatWise = 0; 
            }
            else if ($Speciality > 0 && $cat09 =2)
            {
               $AdmFeeCatWise = $AdmFee[0]['PVT_Amount'];
            } 
        }
   //     DebugBreak();
        if(@$_POST['isotherbrd']>0 || @$_POST['isFresh']>0)
        {
            $regfee =   $AdmFee[0]['Reg_Fee'];
            $cerfee =   $AdmFee[0]['Certificate_Fee'];
            if((@$_POST['isNotFresh'] ==1) )
            {
                $regfee =   0;
                $cerfee =   0;
            }  
           
        }
        if(@$_POST['isFresh']>0)
        {
            if((@$_POST['isNotFresh'] ==0) )
            {
                @$_POST['oldrno'] =   0;
                @$_POST['oldsess'] =  0;
                @$_POST['oldyear'] =  0;
                @$_POST['oldclass'] = 0;
            }
            
            if($_POST['oldrno'] >0)
            {
                $regfee =   0;
            }
            else
            {
                $regfee =   1000;
                $cerfee =   550;   
            }
          
        // if(empty($_POST['isNotFresh']) && (@$_POST['isNotFresh'] ==0))
         //   {
            
           // $regfee =   0 ;
           // $cerfee =   0 ;
          //  }
        }           
 // echo  '<pre>'; print_r($AdmFee);die;
        if($examtype == 1 || $examtype == 3 || (@$_POST['oldexam_type'] == 3 || @$_POST['oldexam_type'] == 1))
        {
           $cerfee =   550;  
        } 
        $fine = $this->GetFeeWithdue( $AdmFeeCatWise);

        $TotalAdmFee = $AdmFee[0]['Processing_Fee'] +$AdmFeeCatWise +$fine + $regfee+$cerfee ;


        $oldsess = @$_POST['oldsess'];
        if($oldsess == 'Annual')
        {
            $oldsess =  1;    
        }
        else if($oldsess == 'Supplementary')
        {
            $oldsess =  2;    
        }

        
        $addre =  str_replace("'", "", $this->input->post('address'));
        $MarkOfIden =  str_replace("'", "", $this->input->post('MarkOfIden'));
        $data = array(
            'name' =>$this->input->post('cand_name'),
            'Fname' =>$this->input->post('father_name'),
            'BForm' =>$this->input->post('bay_form'),
            'FNIC' =>$this->input->post('father_cnic'),
            'Dob' =>$this->input->post('dob'),
            'MobNo' =>$this->input->post('mob_number'),
            'medium' =>$this->input->post('medium'),
            'Inst_Rno' =>$this->input->post('Inst_Rno'),
            'markOfIden' =>$MarkOfIden,
            'Speciality' => ($Speciality),
            'nat' =>$this->input->post('nationality'),
            'sex' =>$this->input->post('gend'),
            'IsHafiz' =>$this->input->post('hafiz'),
            'rel' =>$this->input->post('religion'),
            'addr' =>$addre,
            'grp_cd' => $grp_cd,
            'sub1' =>$sub1,
            'sub2' =>$sub2,
            'sub3' =>$sub3,
            'sub4' =>$sub4,
            'sub5' =>$sub5,
            'sub6' =>$sub6,
            'sub7' => $sub7,
            'sub8' => $sub8,
            'sub1ap1' => ($sub1ap1),
            'sub2ap1' => ($sub2ap1),
            'sub3ap1' => ($sub3ap1),
            'sub4ap1' => ($sub4ap1),
            'sub5ap1' => ($sub5ap1),
            'sub6ap1' => ($sub6ap1),
            'sub7ap1' => ($sub7ap1),
            'sub8ap1' => ($sub8ap1),
            'sub1ap2' => ($sub1ap2),
            'sub2ap2' => ($sub2ap2),
            'sub3ap2' => ($sub3ap2),
            'sub4ap2' => ($sub4ap2),
            'sub5ap2' => ($sub5ap2),
            'sub6ap2' => ($sub6ap2),
            'sub7ap2' => ($sub7ap2),
            'sub8ap2' => ($sub8ap2),

            'RuralORUrban' =>$this->input->post('UrbanRural'),
            'strRegNo' =>@$_POST['strRegNo'],
            'FormNo' =>($formno),
            'cat09' =>$cat09,
            'cat10' =>$cat10,
            'dist'=>@$_POST['pvtinfo_dist'],
            'teh'=>@$_POST['pvtinfo_teh'],
            'zone'=>@$_POST['pvtZone'],
            'Reggrp'=>"2",
            'rno'=>@$_POST['oldrno'],
            'sess'=>$oldsess,
            'Iyear'=>@$_POST['oldyear'],
            'Brd_cd'=>@$_POST['oldboardid'],
            'class'=>@$_POST['oldclass'],
            'schm'=>1,
            'category'=>@$_POST['category'],
            'exam_type'=>@$_POST['exam_type'],
            'spl_cd'=>@$data[0]['spl_cd'],
            'result2'=>@$data[0]['result2'],
            'NextRno_Sess_Year'=>@$data[0]['NextRno_Sess_Year'],

            'AdmFee'=>$AdmFeeCatWise,
            'AdmProcessFee'=>295,
            'AdmTotalFee'=>$TotalAdmFee,
            'regFee'=>$regfee,
            'certFee'=>$cerfee,
            'AdmFine'=>$fine,

            'picpath'=>@$_POST['pic'],
            'isotherbrd'=>@$_POST['isotherbrd'],
            'isFresh'=>@$_POST['isFresh'],
            'preResult'=>@$_POST['preResult'],
            'brd_name'=>@$_POST['oldboard'] ,
            'isNotFresh'=>@$_POST['isNotFresh']

        );
        
      //  echo '<pre>'; print_r($data);die;
        
          if(@$_POST['isotherbrd']>0)
          {
            if(@$_POST['preResult'] == '' )
        {
            $allinputdata['excep'] = 'Please Enter Your Previous Result';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/matric_otherboard');
            return; //"NewEnrolment_EditForm_matric"

        }
        if(@$_POST['oldrno'] == '' )
        {
            $allinputdata['excep'] = 'Please Enter Your Old Rno.';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/matric_otherboard');
            return; //"NewEnrolment_EditForm_matric"

        }
          }
        $target_path = PRIVATE_IMAGE_PATH;
        if (!file_exists($target_path)){

            mkdir($target_path);
        }

        // DebugBreak();
     
        $base_path = GET_PRIVATE_IMAGE_PATH_COPY.@$_POST['pic'];

        $config['upload_path']   = $target_path;
        $config['allowed_types'] = 'jpg';
        $config['max_size']      = '20';
        $config['min_size']      = '4';
     
        $config['min_width']     = '110';
        $config['min_height']    = '100';
        $config['overwrite']     = TRUE;
        $config['file_name']     = $formno.'.jpg';

        $filepath = $target_path. $config['file_name']  ;


        $this->load->library('upload', $config);
        
        $this->upload->initialize($config);
        if(@$_POST['isotherbrd']>0 || @$_POST['isFresh']>0)
         {
             $check = getimagesize(@$_FILES["pic"]["tmp_name"]);
        if($check !== false) {

            $file_size = round($_FILES['pic']['size']/1024, 2);
            if($file_size<=20 && $file_size>=4)
            {
                if ( !$this->upload->do_upload('pic',true))
                {
                    if($this->upload->error_msg[0] != "")
                    {
                        $error['excep']= $this->upload->error_msg[0];
                        $data['excep'] = $this->upload->error_msg[0];
                        $this->session->set_flashdata('NewEnrolment_error',$data);
                        //  echo '<pre>'; print_r($allinputdata['excep']);exit();
                        if(@$_POST['isotherbrd']==1){
                            redirect('Admission/matric_otherboard');
                            return;
                        }
                       else if(@$_POST['isFresh']==1){
                            redirect('Admission/matric_fresh');
                            return;
                        }
                        else
                        {
                           
                             redirect('Admission/matric_fresh');
                            return;
                        }



                    }


                }
            }
            else
            {
                $data['excep'] = 'The file you are attempting to upload size is between 4 to 20 Kb.';
                $this->session->set_flashdata('NewEnrolment_error',$data);
                if(@$_POST['isotherbrd']==1){
                    redirect('Admission/matric_otherboard/');
                    return;
                }
                else
                {
                    redirect('Admission/matric_fresh');
                            return;
                }

            }
        }
        else
        {
            if($check === false)
            {
                $data['excep'] = 'Please Upload Your Picture';
                $this->session->set_flashdata('NewEnrolment_error',$data);
                if(@$_POST['isotherbrd']==1){
                    redirect('Admission/matric_otherboard/');
                    return;
                }
                else if(@$_POST['isFresh']==1)
                {
                    redirect('Admission/matric_fresh/');
                    return;
                }
                else 
                {
                    redirect('Admission/Pre_Matric_data');
                    return;
                }
                return;
            }
        }  
         }
         else
         {
        
        $base_path = GET_PRIVATE_IMAGE_PATH_COPY.@$_POST['pic'];
        $copyimg = $target_path.$formno.'.jpg';
        
        $this->base64_to_jpeg($_POST['pic'],$copyimg)   ;
        
        
        /*if (!(copy($base_path, $copyimg))) 
        {
            $data['excep'] = 'The picture is not upload.';
            $this->session->set_flashdata('NewEnrolment_error',$data);
                //  echo '<pre>'; print_r($allinputdata['excep']);exit();
            redirect('Admission/Pre_Matric_data/');
        }          */
         }
    
        $this->frmvalidation('Pre_Matric_data',$data,0);       
        $logedIn = $this->Admission_model->Insert_NewEnorlement($data);
        if($logedIn != false)
        {
            $allinputdata = "";
            $allinputdata['excep'] = 'success';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            $msg = $formno;                                           
            redirect('Admission_stopped/'.'formdownloaded/'.$formno.'/'.$dob);
        }
        else
        {     
            $allinputdata = "";
            $allinputdata['excep'] = 'An error has occoured. Please try again later. ';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect(checkFormNo_then_download);
            redirect('Admission');
            return;
            echo 'Data NOT Saved Successfully !';
        } 
        $this->load->view('common/footer.php');
    }
    public function formdownloaded(){

        //DebugBreak();

        $msg = $this->uri->segment(3);
        $dob = $this->uri->segment(4);
        $this->load->model('Admission_model');
        $this->load->library('session');
        $myarray = array('msg'=>$msg,'dob'=>$dob);
        $this->load->view('common/commonheader.php');
        $this->load->view('Admission/Matric/FormDownloaded.php',$myarray);
        $this->load->view('common/commonfooter.php');
    }
    public function matric_default()
    {
     //  DebugBreak();
        $data = array(
            'isselected' => '3',
        );
        $this->load->library('session');
        if($this->session->flashdata('matric_error'))
        {
            $spl_cd = array('spl_cd'=>$this->session->flashdata('matric_error'));  
        }
        else{
            $spl_cd = array('spl_cd'=>"");
        }
        $this->load->view('common/commonheader.php');
        $this->load->view('Admission/Matric/getinfo.php',$spl_cd);
        $this->load->view('common/footer.php');
    }
    public function matric_otherboard()
    {
        $data = array(
            'isselected' => '3',
        );
      //  DebugBreak();
        $this->load->library('session');
        if($this->session->flashdata('NewEnrolment_error'))
        {
           $data[0] = $this->session->flashdata('NewEnrolment_error');  
        }
        else{
              $data = array('0'=>"");
        }
        $this->load->view('common/commonheader.php');
        $this->load->view('Admission/Matric/OtherBoard10th.php', array('data'=>$data[0]));
        $this->load->view('common/common_ma/Otherboard10thfooter.php');
    }
    public function matric_fresh()
    {
       /* $data = array(
            'isselected' => '3',
        ); */
       // DebugBreak();
        $this->load->library('session');
        if($this->session->flashdata('NewEnrolment_error'))
        {
           $data[0] = $this->session->flashdata('NewEnrolment_error'); 
        }
        else{
            $data = array('0'=>"");
        }
        //DebugBreak();
        $this->load->view('common/commonheader.php');
        $this->load->view('Admission/Matric/matricFreshForm.php',array('data'=>$data[0]));
        $this->load->view('common/common_ma/Otherboard10thfooter.php');
    }
    public function getzone()
    {
        //DebugBreak();
       
        $data = array(
            'tehCode' => $this->input->post('tehCode'),
            'gend' => $this->input->post('gend'),
        );

        $tehCode = $data['tehCode'];
        $this->load->model('Admission_model');
        $value = array('teh'=> $this->Admission_model->getzone($data)) ;
        echo json_encode($value);

    }
    public function getcenter()
    {
      //  DebugBreak();
        $data = array(
            'zoneCode' => $this->input->post('pvtZone'),
            'gen' => $this->input->post('gend'),
        );

        $this->load->model('Admission_model');
        $value = array('center'=> $this->Admission_model->getcenter($data)) ;
        echo json_encode($value);

    }
    public function commonheader($data)
    {
        $this->load->view('common/header.php');
        $this->load->view('common/menu.php',$data);
    } 
    public function commonfooter($arrfilePath=array())
    {
        $data = $arrfilePath;
        $this->load->view('common/footer.php',$data);
    }
    function frmvalidation($viewName,$allinputdata,$isupdate)
    {

        $_POST['address']  = str_replace("'", "", $_POST['address'] );

        if(@$_POST['dob'] != null)
        {
            $date = new DateTime(@$_POST['dob']);
            $convert_dob = $date->format('Y-m-d');     
        }

        if(@$_POST['cand_name'] == '' )
        {
            $allinputdata['excep'] = 'Please Enter Your Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return; //"NewEnrolment_EditForm_matric"

        }
        else if (@$_POST['father_name'] == '')
        {
            $allinputdata['excep'] = 'Please Enter Your Father Name';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }

        else if(@$_POST['bay_form'] == '' || @$_POST['bay_form'] == '00000-0000000-0')
        {
            $allinputdata['excep'] = 'Please Enter Your Bay Form No.';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            $this->$viewName($allinputdata['formNo']);
            return;


        }

        else if(@$_POST['father_cnic'] == '' || @$_POST['father_cnic'] == '00000-0000000-0' )
        {
            $allinputdata['excep'] = 'Please Enter Your Father CNIC';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;


        }

        else if (@$_POST['dob'] == '' )
        {
            $allinputdata['excep'] = 'Please Enter Your  Date of Birth';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if(@$_POST['mob_number'] == '')
        {
            $allinputdata['excep'] = 'Please Enter Your Mobile Number';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if(@$_POST['medium'] == 0)
        {
            $allinputdata['excep'] = 'Please Select Your Medium';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }

        else if(@$_POST['MarkOfIden']== '')
        {
            $allinputdata['excep'] = 'Please Enter Your Mark of Identification';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }

        else if((@$_POST['medium'] != '1') and (@$_POST['medium'] != '2') )
        {
            $allinputdata['excep'] = 'Please Select Your medium';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if((@$_POST['nationality'] != '1') and (@$_POST['nationality'] != '2') )
        {
            $allinputdata['excep'] = 'Please Select Your Nationality';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if((@$_POST['gend'] != '1' && @$_POST['isotherbrd'] != '1' ) and (@$_POST['gend'] != '2' &&  @$_POST['isotherbrd'] != '1'))
        {
            $allinputdata['excep'] = 'Please Select Your Gender';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if((@$_POST['hafiz']!= '1') and (@$_POST['hafiz']!= '2'))
        {
            $allinputdata['excep'] = 'Please Select Your Hafiz-e-Quran option';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if((@$_POST['religion'] != '1') and (@$_POST['religion'] != '2'))
        {
            $allinputdata['excep'] = 'Please Select Your religion';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if((@$_POST['UrbanRural'] != '1') and (@$_POST['UrbanRural'] != '2'))
        {
            $allinputdata['excep'] = 'Please Select Your Residency';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if(@$_POST['address'] =='')
        {
            $allinputdata['excep'] = 'Please Enter Your Address';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if(@$_POST['std_group'] == 0)
        {
            $allinputdata['excep'] = 'Please Select Your Study Group';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }

        else if((@$_POST['sub7p2'] ==20) && (@$_POST['sub8p2']==21))
        {
            $allinputdata['excep'] = 'Double History is not Allowed Please choose a different Subject';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }
        else if((@$_POST['sub8p2'] ==20) && (@$_POST['sub7p2']==21))
        {
            $allinputdata['excep'] = 'Double History is not Allowed Please choose a different Subject';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            redirect('Admission/'.$viewName);
            return;

        }

        else if(@$_POST['exam_type'] == 1)
        {
          if(@$_POST['sub1p2'] ==0 && @$_POST['sub2p2'] ==0 && @$_POST['sub3p2'] ==0 && @$_POST['sub4p2'] ==0 && @$_POST['sub5p2'] ==0 && @$_POST['sub6p2'] ==0 && @$_POST['sub7p2'] ==0 && @$_POST['sub8p2'] ==0)
        {
                $allinputdata['excep'] = 'Please Select Part-II Subjects ';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;
        }
        }
        else if(@$_POST['exam_type'] == 2 &&  (@$allinputdata['grp_cd'] != 4))
        { //DebugBreak();
            if(@$_POST['sub1p2'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 1';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub2p2'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 2';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;
            }
            else if(@$_POST['sub3p2'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 3';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub4p2'] == 0 && @$_POST['std_group'] != 4)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 4';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub5p2'] == 0 && @$_POST['std_group'] != 4)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 5';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub6p2'] == 0 && @$_POST['std_group'] != 4)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 6';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub7p2'] == 0 && @$_POST['std_group'] != 4)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 7';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub8p2'] == 0 && @$_POST['std_group'] != 4)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 8';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if((@$_POST['sub6'] == 19 || @$_POST['sub6p2'] == 19) && (@$_POST['sub7'] == 20 || @$_POST['sub7p2'] == 20) ||  (@$_POST['sub6'] == 20 || @$_POST['sub6p2'] == 20) && (@$_POST['sub7'] == 19 || @$_POST['sub7p2'] == 19))

            {
                $allinputdata['excep'] = 'Please Select One Subject from Advanced Islamic Studies / Islamic History';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }

        }
         else if((@$_POST['exam_type']==16 && @$_POST['category']==2) || @$_POST['exam_type'] == 15)
        {
            if( (@$_POST['sub5'] == 0 && @$_POST['sub5p2'] == 0) && (@$_POST['sub6'] == 0 && @$_POST['sub6p2'] == 0) && (@$_POST['sub7'] == 0 && @$_POST['sub7p2'] == 0)  )
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 6';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
        }

    }
    function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen($output_file, "wb"); 

    $data = explode(',', $base64_string);

    fwrite($ifp, base64_decode($data[1])); 
    fclose($ifp); 

    return $output_file; 
}
}
?>
