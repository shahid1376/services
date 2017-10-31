<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admission_9th extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');   
    }

    public function index(){
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
        $this->load->view('common/commonheader9th.php');
        $mydata = array('error'=>$error);
        $this->load->view('Admission/9th/matric_default.php',$mydata);
        $this->load->view('common/homepagefooter.php');
    }

    function GetSpeciality($spclty){
        if ($spclty == 0 )
            return('NONE');
        else if ($spclty == 2 )
            return('BOARD EMPLOYEE CHILD');
            else if ($spclty == 1 )
                return('DISABLE');


    }

    private function set_barcode($code){
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

    public function checkFormNo_then_download(){

        $formno_seg = $this->uri->segment(3);
        $dob_seg = $this->uri->segment(4);
        if($formno_seg !=0 && $dob_seg != ''){
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
        $pdf->Image(base_url()."assets/img/ExamCenter.jpg",4.5,2.85+$Y, 2.78,0.15, "jpeg");        
        $pdf->Image(base_url()."assets/img/10th.png",7.30,0.25, 0.30,0.30, "PNG");    

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
        $pdf->Image(base_url().PRIVATE_IMAGE_PATH.$data['PicPath'],6.5, 1.15+$Y, 0.95, 1.0, "JPG");
        $pdf->Image(base_url()."assets/img/logo2.png",0.4, 0.2, 0.65, 0.65, "PNG");
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
            case '4':
                $grp_name = 'AMA';
                break;
            case '5':
                $grp_name = 'Deaf and Dumb';
                break;
            default:
                $grp_name = "No Group Selected.";
        }
        $pdf->SetXY(1.8,1.28+$Y);
        $pdf->SetFont('Arial','bU',10);
        $pdf->Cell( 0.5,0.7,$grp_name." GROUP",0,'L');
        //--------------------------- 1st line 
        $pdf->SetXY(0.5,1.55+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Form No:",0,'L');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.5,1.55+$Y);
        $pdf->Cell( 0.5,0.5,$data['formNo'],0,'L');


        $chkcat09 = ($data['mi_type']!= 2?$this->getCatName($data['cat09']):'Aditional') ;

        $chkcat10 = ($data['mi_type']!= 2?$this->getCatName($data['cat10']):'Aditional');

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
        $cand_Nofif_part1 =$data['Prev_result1'];
        $str = '';
        if($data['cat09']==2 || $data['cat10']==2)
        {
            
            if($data['Prev_chance']==1)
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
            if($data['Prev_chance']==2)
            {
                if($data['cat09']==2 && $data['cat10']==2)
                {
                
                $str = "A-17 [P-I $cand_Nofif_part1,P-II $cand_Notif]";    
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
            else
            if($data['Prev_chance']==3)
            {
                if($data['cat09']==2 && $data['cat10']==2)
                {
                
                $str = " S-16 [P-I $cand_Nofif_part1,P-II $cand_Notif]";    
                }
                else if($data['cat09']==2 && $data['cat10'] !=2)
                {
                $str = "S-16 [P-I $cand_Nofif_part1]";        
                }
                else if($data['cat09'] !=2 && $data['cat10']==2)
                {
                    $str = "S-16 [P-II $cand_Notif]";        
                }
            }
            if($data['Prev_chance']==4)
            {
                $str ="";
            }    
        }
        //if()
       
        $pdf->Cell(0.5,0.5,$data["oldRno"]." ( $LastSess,  $yearOfLastAp )  $str",0,'L');

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
        $pdf->SetXY(6.8,2.53+$Y);                                               
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
        $xx= 0.5;
        $yy = $Y-0.2;
        $boxWidth = 2.6;
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY($xx,3.8+$yy);
        $pdf->SetFillColor(240,240,240);
        $pdf->Cell($boxWidth,0.2,'Part I Subjects',1,0,'C',1);
        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub1Ap1'] != 1 ? '':   '    '.'1. '. $this->GetSubNameHere($data['sub1']),1,0,'L',1);

        $pdf->Image(base_url().'assets/img/crossed.jpg',6.2,5.35+$yy, 1.3,0.15, "jpeg");  
        $pdf->SetXY(6.1,3.8+$yy);
        $pdf->Cell(1.4,1.5,'',1,0,'C',0); 
        $pdf->SetXY(6.3,3.8+$yy);
        $pdf->MultiCell(1.1,0.2, 'Paste Recent Photograph & Must Be Cross Attested by the Head/Deputy Head of Institution',0,'C'); 

        $pdf->SetXY(6.1,6.18+$yy);
        $pdf->Cell(1.4,0.65,'',1,0,'C',0); 
        $pdf->SetXY(6.1,6.69+$yy);
        $pdf->SetFont('Arial','',6);
        $pdf->MultiCell(1.4,0.1, 'Candidate Thumb Impression',0,'C');

        //   DebugBreak();

        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub2Ap1'] != 1 ? '':   '    '.'2. '. $this->GetSubNameHere($data['sub2']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub3Ap1'] != 1 ? '':   '    '.'3. '. $this->GetSubNameHere($data['sub3']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.6+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub8ap1'] != 1 ? '':   '    '.'4. '. $this->GetSubNameHere($data['sub8']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,4.8+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub4Ap1'] != 1 ? '':   '    '.'5. '. $this->GetSubNameHere($data['sub4']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,5.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub5Ap1'] != 1 ? '':   '    '.'6. '. $this->GetSubNameHere($data['sub5']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);                                                                     
        $pdf->SetXY($xx,5.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub6Ap1'] != 1 ? '':   '    '.'7. '. $this->GetSubNameHere($data['sub6']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xx,5.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub7Ap1'] != 1 ? '':   '    '.'8. '. $this->GetSubNameHere($data['sub7']),1,0,'L',1);

        $xangle = 3.0;

        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY($xangle,3.8+$yy);
        $pdf->SetFillColor(240,240,240);
        $pdf->Cell($boxWidth,0.2,'Part II Subjects',1,0,'C',1);    
        $pdf->SetFillColor(255,255,255);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub1Ap2'] != 1 ? '':  '    '.'1. '.  $this->GetSubNameHere($data['sub1']),1,0,'L',1);
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub2Ap2'] != 1 ? '':  '    '.'2. '.  $this->GetSubNameHere($data['sub2']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub3ap2'] != 1 ? '':  '    '.'3. '.  $this->GetSubNameHere($data['sub3']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.6+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub8Ap2'] != 1 ? '':  '    '.'4. '.  $this->GetSubNameHere($data['sub8']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,4.8+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub4Ap2'] != 1 ? '':  '    '.'5. '.  $this->GetSubNameHere($data['sub4']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,5.0+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub5Ap2'] != 1 ? '':  '    '.'6. '.  $this->GetSubNameHere($data['sub5']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,5.2+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub6Ap2'] != 1 ? '':  '    '.'7. '.  $this->GetSubNameHere($data['sub6']),1,0,'L',1);

        $pdf->SetFont('Arial','',7);
        $pdf->SetXY($xangle,5.4+$yy);
        $pdf->Cell($boxWidth,0.2,$data['sub7Ap2'] != 1 ? '':  '    '.'8. '.  $this->GetSubNameHere($data['sub7']),1,0,'L',1);

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
        $pdf->SetXY(3.5,3.05+$Y);
        $pdf->Cell(4,0.50,'',1,0,'C',0); 

        $pdf->Image(base_url().'assets/img/admission_form.jpg',4.07,1.9, 2.38,0.20, "jpeg");

        $pdf->SetXY(3.2,5.75+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell(0.2,0.5,"Stamp/Signature",0,'R');
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
        $pdf->Cell( 0.5,0.5,"Bank Challan No. ".$data['chalanno'],0,'L');

        $Y = $Y - 0.5;
        $pdf->SetXY(0.2, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Admission Fee ",0,'L');

        $todayd = date("d-m-Y");
        $fdate = date("d-m-Y",strtotime($data['edate']));
        $formarr[] = 62249;
        $isfee = -1;
        for($i = 0 ; $i< count($formarr) ;  $i++ )
        {
          if($formno == $formarr[$i])
          {
              $isfee = 1;
          }  
        }
        
        //DebugBreak();
       if($isfee == 1)
       {
          $data['AdmFee'] = 1300;

           $data['AdmTotalFee'] = $data['AdmFee']  + $data['AdmProcessFee'];  
           $this->Admission_model->updatefee($formno,$data['AdmFee'],$data['AdmTotalFee']); 
       }
      else if($todayd>$fdate && $data['cDate'] == null )
       {
           $data['AdmFee'] = $this->GetFeeWithdue($data['AdmFee']);

           $data['AdmTotalFee'] = $data['AdmFee']  + $data['AdmProcessFee'];  
           $this->Admission_model->updatefee($formno,$data['AdmFee'],$data['AdmTotalFee']);
       }
       else if($data['cDate'] != null )
       {
           $fdate = date("d-m-Y",strtotime($data['cDate']));   

           if($todayd>=$fdate)
           {
               $data['AdmFee'] = $this->GetFeeWithdue($data['AdmFee']);

               $data['AdmTotalFee'] = $data['AdmFee']  + $data['AdmProcessFee'];  
               $this->Admission_model->updatefee($formno,$data['AdmFee'],$data['AdmTotalFee']);  
           }
       }
        

        $pdf->SetXY(1.2, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,$data['AdmFee'].'/-',0,'L');


        $pdf->SetXY(1.8, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Late Fee ",0,'L');


        $pdf->SetXY(2.59, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,'0/-',0,'L');

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
        $pdf->Cell( 0.5,0.5,'0 /-',0,'L');

        $pdf->SetXY(6.8, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Registration Fee ",0,'L');
        $pdf->SetXY(7.59, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,'0/-',0,'L');

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

        $pdf->Image(base_url().'assets/img/cutter.jpg',0.2,6.50, 9.2,0.09, "jpeg"); 

        $Y = $Y + 1.68;

        $pdf->SetXY(0.2,6.1+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Board Copy: (Along with Scroll)",0,'L');

        $pdf->SetXY(1.2,6.0+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA (SSC ".$session." Examination ,".Year." )",0,'C');

        $pdf->SetXY(0.2,6.4+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$this->GetDueDate(),1,0,'C',1); 

        $bx = 6.8;
        $by = 6.1;
        $pdf->Image(base_url()."assets/img/10th.png",7.58,6.2+$Y, 0.30,0.30, "PNG");  

        $pdf->Image(BARCODE_PATH.$image,5.75, 6.8  ,1.8,0.20,"PNG");

        $pdf->SetXY(0.2,6.46+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(3.2,6.46+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"CMD Account No. 00427900072103",0,'L');

        $pdf->SetXY(5.2,6.46+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Bank Challan No. ".$data['chalanno'],0,'L');

        $Y = $Y - 0.5;
        $pdf->SetXY(0.2, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Admission Fee ",0,'L');


        $pdf->SetXY(1.2, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5, $data['AdmFee'].'/-',0,'L');


        $pdf->SetXY(1.8, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Late Fee ",0,'L');


        $pdf->SetXY(2.59, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,'0/-',0,'L');

        $pdf->SetXY(3.2, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Processing + Form Fee ",0,'L');
        $pdf->SetXY(4.6, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,$data['AdmProcessFee'].'/-',0,'L');

        $pdf->SetXY(5.42, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Certificate Fee ",0,'L');
        $pdf->SetXY(6.3, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,'0/-',0,'L');

        $pdf->SetXY(6.8, 7.09+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Registration Fee ",0,'L');
        $pdf->SetXY(7.59, 7.09+$Y); 
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,'0/-',0,'L');

        $pdf->SetXY(0.2, 7.19+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Total Amount Rs.",0,'L');

        $pdf->SetXY(1.2, 7.19+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,$data['AdmTotalFee'].'/-',0,'L');


        $pdf->SetXY(1.8, 7.19+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Amount in Words:",0,'L');


        $pdf->SetXY(2.6, 7.19+$Y);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');


        $pdf->SetXY(5.3, 7.29+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');

        $pdf->SetXY(0,5.0+3.0+$Y);
        $pdf->SetFont('Arial','',10);

        $pdf->Image(base_url().'assets/img/cutter.jpg',0.2,7.70, 9.2,0.09, "jpeg");  

        $Y = $Y - 0.39;

        $pdf->SetXY(1.2,8.1+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA (SSC ".$session." Examination ,".Year." )",0,'C');


        $bx = 6.8;
        $by = 8.1;

        $pdf->SetXY(3.2,8.3+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(0.2,8.20+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Bank Copy:  (To be retained with HBL) ",0,'L');


        $pdf->SetXY(0.2,8.5+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$this->GetDueDate(),1,0,'C',1); 

        $pdf->Image(BARCODE_PATH.$image,5.75, 8.5+$Y  ,1.8,0.20,"PNG");

        $pdf->Image(base_url()."assets/img/10th.png",7.58,8.3+$Y, 0.30,0.30, "PNG");  

        $pdf->SetXY(0.5,8.65+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.0,8.65+$Y);
        $pdf->Cell(0.5,0.5,$data["name"],0,'L');
        //--------------------------- FATHER NAME 

        $pdf->SetXY(3.2, 8.65+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Father's Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.2,8.65+$Y);
        $pdf->Cell(0.5,0.5,$data["Fname"],0,'L');


        $pdf->SetXY(0.5, 8.79+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Total Amount Rs.",0,'L');

        $pdf->SetXY(1.35, 8.79+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,$data['AdmTotalFee'].'/-',0,'L');


        $pdf->SetXY(1.85, 8.79+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Amount in Words:",0,'L');

        $pdf->SetXY(2.68, 8.79+$Y);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');

        $pdf->Image(base_url().'assets/img/BankCopy.jpg',0.25,8.80, 7.4,0.25, "jpeg");   

        $pdf->SetXY(0.5, 8.55+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,"CMD Account No. 00427900072103",0,'L');


        $pdf->SetXY(3.2, 8.55+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,"Bank Challan No. ".$data['chalanno'],0,'L');


        $pdf->SetXY(5.3, 8.9+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');

        $pdf->SetXY(0,5.0+3.0+$Y);
        $pdf->SetFont('Arial','',10);
        // //DebugBreak();
        $pdf->Image(base_url().'assets/img/cutter.jpg',0.2,9.1, 8.3,0.09, "jpeg");  

        $Y = $Y - 0.09;
        //


        $pdf->SetXY(1.2,9.6+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA (SSC ".$session." Examination ,".Year." )",0,'C');

        $bx = 6.8;
        $by = 9.5;


        $pdf->SetXY(3.2,9.8+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Printing Date: " .date('d-M-Y h:i A'),0,'L');

        $pdf->SetXY(0.2,9.65+$Y);
        $pdf->SetFillColor(0,0,0);                                     
        $pdf->SetFont('Arial','BI',7);
        $pdf->Cell(0.2,0.5,"Candidate Copy",0,'L');


        $pdf->SetXY(0.2,10.0+$Y);
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell($boxWidth,0.2,'Due Date: '.$this->GetDueDate(),1,0,'C',1); 

        $pdf->Image(BARCODE_PATH.$image,5.75, 10.0+$Y  ,1.8,0.20,"PNG");

        $pdf->Image(base_url()."assets/img/10th.png",7.58,9.8+$Y, 0.30,0.30, "PNG");  

        $pdf->SetXY(0.5,10.2+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Form No:",0,'L');

        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.0,10.2+$Y);
        $pdf->Cell( 0.5,0.5,$data['formNo'],0,'L');




        $pdf->Image(base_url().PRIVATE_IMAGE_PATH.$data['PicPath'],6.5, 10.3+$Y, 0.95, 1.0, "JPG");
        $pdf->SetFont('Arial','',8);


        $pdf->SetXY(0.5,10.35+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(1.0,10.35+$Y);
        $pdf->Cell(0.5,0.5,$data["name"],0,'L');
        //--------------------------- FATHER NAME 

        $pdf->SetXY(3.2, 10.35+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Father's Name:",0,'L');
        $pdf->SetFont('Arial','B',$FontSize);
        $pdf->SetXY(4.0,10.35+$Y);
        $pdf->Cell(0.5,0.5,$data["Fname"],0,'L');


        $pdf->SetXY(0.5, 10.49+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Total Amount Rs.",0,'L');

        $pdf->SetXY(1.35, 10.49+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,$data['AdmTotalFee'].'/-',0,'L');


        $pdf->SetXY(0.5, 10.59+$Y);
        $pdf->SetFont('Arial','',$FontSize);
        $pdf->Cell( 0.5,0.5,"Proposed Exam Area:",0,'L');

        $pdf->SetXY(1.48, 10.59+$Y);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell( 0.5,0.5,$data['Zone_cd']." - ".$data['zone_name'],0,'L');

        $pdf->Image(base_url().'assets/img/CandidateCopy.jpg',0.27,10.86, 7.58,0.60, "jpeg");  


        $pdf->SetXY(0.5, 10.05+$Y);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,"CMD Account No. 00427900072103",0,'L');


        $pdf->SetXY(3.5, 10.05+$Y);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','b',8);
        $pdf->Cell( 0.5,0.5,"Bank Challan No. ".$data['chalanno'],0,'L');


        $pdf->SetXY(3.4, 10.7+$Y);
        $pdf->SetFont('Arial','b',$FontSize);
        $pdf->Cell( 0.5,0.5,"Manager/Cashier:___________________________ ",0,'L');


        $filename="Admission_Forms_".$data['formNo']."_"   .  ".pdf";
        $pdf->Output($filename, 'I');

    }

     function GetFeeWithdue($fee){

        $dueDate='';
        $single_date= '08-08-2016';  $double_date= '15-08-2016';  $tripple_date= '22-08-2016';
        $today = date("d-m-Y");

        if(strtotime($today) <= strtotime($single_date)) 
        {
            $dueDate = $fee;
        }
        else if( $today <= $double_date )
        {
            $dueDate = $fee*2;
        }
        else if( $today <= $tripple_date )
        {
           $fee = $fee/2;
           $dueDate = $fee*3;
         }
        else if($today > $tripple_date )
        {
            $now = time(); // or your date as well
            $your_date = strtotime($tripple_date);
            $datediff = $now - $your_date;
            $days = floor($datediff/(60*60*24));
            
            $fine = $days*500;
            $fee = $fee/3;
            $dueDate = $fee*3 + $fine;
        }
        return $dueDate;

    }
    
    
    function GetDueDate(){
        $dueDate='';
        $single_date= '08-08-2016';  $double_date= '15-08-2016';  $tripple_date= '22-08-2016';
        $today = date("d-m-Y");

        if(strtotime($today) <= strtotime($single_date)) 
        {
            $dueDate = $single_date;
        }
        else if( $today <= $double_date )
        {
            $dueDate = $double_date;
        }
        else if( $today <= $tripple_date )
        {
            $dueDate = $tripple_date;
        }
        else if($today > $tripple_date )
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

    function getCatName($cat){
        if ($cat==1) return "Full Appear";
        else if ($cat ==2) return "Re-Appear";
            else if ($cat ==3 or $cat == 7) return "Marks Improve";
                else if ($cat ==5 ) return "Additional";
                    else return -1;
    }

    
    public function makefee($cat,$Speciality,$sub7,$sub8,$grp_cd,$per_grp){

        //DebugBreak();

        $AdmFee = '';
        $cat09 = $cat['cat09'];
        $cat10 = $cat['cat10'];
        $sub7isprac =  $this->practicalsubjects($sub7);
        $sub7isprac2 =  $this->practicalsubjects($sub7p2);
        $sub8isprac =  $this->practicalsubjects($sub8);
        $sub8isprac2 =  $this->practicalsubjects($sub8p2);

        if($Speciality != 0 || $Speciality == 1 || $Speciality == 2)
        {
            $AdmFee = 0;
        }

        if($Speciality == 0 && ($grp_cd == 1 || $per_grp) && ($cat09 !=0 &&  $cat10 == 0))
        {
            $AdmFee = 700;    
        }
        if($Speciality == 0 && $grp_cd == 1 && ($sub1ap2 == 1 || $sub2ap2 == 1 || $sub3ap2 == 1 || $sub4ap2 == 1 || $sub5ap2 == 1 || $sub6ap2 == 1 || $sub7ap2 == 1 || $sub8ap2 == 1)){
            $AdmFee = 700;    
        }
        if($Speciality == 0 && $grp_cd == 1 && ($sub1ap2 == 1 || $sub2ap2 == 1 || $sub3ap2 == 1 || $sub4ap2 == 1 || $sub5ap2 == 1 || $sub6ap2 == 1 || $sub7ap2 == 1 || $sub8ap2 == 1) 
            &&($sub1ap1 == 1 || $sub2ap1 == 1 || $sub3ap1 == 1 || $sub4ap1 == 1 || $sub5ap1 == 1 || $sub6ap1 == 1 || $sub7ap1 == 1 || $sub8ap1 == 1)){
            $AdmFee = 1300;    
        }
        if(
            $Speciality == 0 && $grp_cd == 2 && ($sub7isprac == 1)
            &&($sub1ap1 == 1 || $sub2ap1 == 1 || $sub3ap1 == 1 || $sub4ap1 == 1 || $sub5ap1 == 1 || $sub6ap1 == 1 || $sub7ap1 == 1 || $sub8ap1 == 1)){
            $AdmFee = 700;    
        }

        if(
            $Speciality == 0 && $grp_cd == 2 && ($sub7ap2 == 1)
            &&($sub1ap2 == 1 || $sub2ap2 == 1 || $sub3ap2 == 1 || $sub4ap2 == 1 || $sub5ap2 == 1 || $sub6ap2 == 1 || $sub7ap2 == 1 || $sub8ap2 == 1)){
            $AdmFee = 700;    
        }

        if(
            $Speciality == 0 && $grp_cd == 2 && ($sub8isprac == 1)
            &&($sub1ap1 == 1 || $sub2ap1 == 1 || $sub3ap1 == 1 || $sub4ap1 == 1 || $sub5ap1 == 1 || $sub6ap1 == 1 || $sub7ap1 == 1 || $sub8ap1 == 1)
        ){
            $AdmFee = 700;    
        }

        if(
            $Speciality == 0 && $grp_cd == 2 && ($sub8isprac2 == 1)
            &&($sub1ap2 == 1 || $sub2ap2 == 1 || $sub3ap2 == 1 || $sub4ap2 == 1 || $sub5ap2 == 1 || $sub6ap2 == 1 || $sub7ap2 == 1 || $sub8ap2 == 1)
        ){
            $AdmFee = 700;    
        }

        if(
            $Speciality == 0 && $grp_cd == 2 && ($sub7isprac == 0)
            &&($sub1ap1 == 1 || $sub2ap1 == 1 || $sub3ap1 == 1 || $sub4ap1 == 1 || $sub5ap1 == 1 || $sub6ap1 == 1 || $sub7ap1 == 1 || $sub8ap1 == 1)
        ){
            $AdmFee = 650;    
        }  

        if(
            $Speciality == 0 && $grp_cd == 2 
            && ($sub7isprac2 == 0)
            &&($sub1ap2 == 1 || $sub2ap2 == 1 || $sub3ap2 == 1 || $sub4ap2 == 1 || $sub5ap2 == 1 || $sub6ap2 == 1 || $sub7ap2 == 1 || $sub8ap2 == 1)){
            $AdmFee = 650;    
        }

        if(
            $Speciality == 0 && $grp_cd == 2 
            && ($sub8isprac == 0)
            &&($sub1ap1 == 1 || $sub2ap1 == 1 || $sub3ap1 == 1 || $sub4ap1 == 1 || $sub5ap1 == 1 || $sub6ap1 == 1 || $sub7ap1 == 1 || $sub8ap1 == 1)
        ){
            $AdmFee = 650;    
        }

        if(
            $Speciality == 0 && $grp_cd == 2 
            && ($sub8isprac2 == 0)
            &&($sub1ap2 == 1 || $sub2ap2 == 1 || $sub3ap2 == 1 || $sub4ap2 == 1 || $sub5ap2 == 1 || $sub6ap2 == 1 || $sub7ap2 == 1 || $sub8ap2 == 1)
        ){
            $AdmFee = 650;    
        }

        if($Speciality == 0 && $grp_cd == 2 
            &&($sub7isprac == 0)
            && ($sub8isprac == 0)
            && ($sub7isprac2 == 0)
            && ($sub8isprac2 == 0)
            &&($sub1ap1 == 1 || $sub2ap1 == 1 || $sub3ap1 == 1 || $sub4ap1 == 1 || $sub5ap1 == 1 || $sub6ap1 == 1 || $sub7ap1 == 1 || $sub8ap1 == 1)
            &&($sub1ap2 == 1 || $sub2ap2 == 1 || $sub3ap2 == 1 || $sub4ap2 == 1 || $sub5ap2 == 1 || $sub6ap2 == 1 || $sub7ap2 == 1 || $sub8ap2 == 1)){
            $AdmFee = 1200;    
        }

        if($Speciality == 0 && $grp_cd == 2 
            &&($sub7isprac == 1)
            && ($sub8isprac == 1)
            && ($sub7isprac2 == 1)
            && ($sub8isprac2 == 1)
            &&($sub1ap1 == 1 || $sub2ap1 == 1 || $sub3ap1 == 1 || $sub4ap1 == 1 || $sub5ap1 == 1 || $sub6ap1 == 1 || $sub7ap1 == 1 || $sub8ap1 == 1)
            &&($sub1ap2 == 1 || $sub2ap2 == 1 || $sub3ap2 == 1 || $sub4ap2 == 1 || $sub5ap2 == 1 || $sub6ap2 == 1 || $sub7ap2 == 1 || $sub8ap2 == 1)){
            $AdmFee = 1300;    
        }
        if($grp_cd == 5){
            $AdmFee = 0;    
        }

        return $AdmFee;
    }

    private function makecat($cattype, $exam_type,$marksImp,$is9th){


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

      //   DebugBreak();

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
            $data = array('dob'=>$dob,'mrno'=>$mrollno,'class'=>$oldClass,'year'=>$year,'session'=>$session,'board'=>$board);
            $data = $this->Admission_model->Pre_Matric_data($data);
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

            $exam_type = $data[0]['exam_type'];
            $specialcode = $data[0]['spl_cd'];
            $specialcase = $data[0]['result2'];
            $nxtrnosessyear = $data[0]['NextRno_Sess_Year'];

            if(($exam_type == 16 || $exam_type == 15) && ($cattype == 1 || $cattype == 2)){
                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/AdmissionForm.php',  array('data'=>$data, 'cattype'=>$cattype));
                $this->load->view('common/commonfooter.php'); 
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
                $this->load->view('common/commonfooter.php');
            }
        }

        else{          
            $dob     = $_POST["dob"];
            $mrollno = $_POST["oldRno"];
            $oldClass= $_POST["oldClass"];
            $year    = $_POST["oldYear"];
            $session = $_POST["oldSess"];
            $board   = $_POST["oldBrd_cd"];
            @$cattype   = $_POST["CatType"]; 
            $data = array('dob'=>$dob,'mrno'=>$mrollno,'class'=>$oldClass,'year'=>$year,'session'=>$session,'board'=>$board);
            $data = $this->Admission_model->Pre_Matric_data($data);

            //        DebugBreak();

            $error_msg = '';

            if(!$data){
                $error_msg.= '<span style="font-size: 16pt; color:red;">' . 'No Any Student Found Against Your Criteria</span>';            
                $data['error'] = $error_msg;
                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/getinfo.php', $data);
                $this->load->view('common/footer.php');    
                return false;
            }
           // DebugBreak();
            $brd_name=$this->Admission_model->Brd_Name($board);
            $data[0]['brd_name']=$brd_name[0]['Brd_Abr'] ;
            $exam_type = $data[0]['exam_type'];
            $specialcode = $data[0]['spl_cd'];
            $specialcase = $data[0]['result2'];
            $status = $data[0]['status'];
            $grp_cd = $data[0]['grp_cd'];
            $specialcase = $data[0]['result2'];
            $nxtrnosessyear = $data[0]['NextRno_Sess_Year'];

           
            if($exam_type == 16 && ($cattype == 1 || $cattype == 2)){
                $this->load->view('common/commonheader.php');        
                $this->load->view('Admission/Matric/AdmissionForm.php',  array('data'=>$data, 'cattype'=>$cattype));
                $this->load->view('common/commonfooter.php'); 
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
                $this->load->view('common/commonfooter.php');
            }
        }





    }

    public function practicalsubjects($_sub_cd){        
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

    public function NewEnrolment_insert(){


       // DebugBreak();
        $this->load->model('Admission_model');
        $this->load->library('session');
        // $Logged_In_Array = $this->session->all_userdata();
        $userinfo = '';//$Logged_In_Array['logged_in'];
        $userinfo['isselected'] = 2;
        $Inst_Id = 999999;
        $this->commonheader($userinfo);
        $error = array();

        $formno = $this->Admission_model->GetFormNo();
        $dob = @$_POST['dob'];

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

        //  DebugBreak();
        $cattype = @$_POST['category'];
        $examtype = @$_POST['exam_type'];
        $marksImp = @$_POST['ddlMarksImproveoptions'];

      //  DebugBreak();

     
      
        $cat = $this->makecat($cattype, $examtype,$marksImp,$is9th);
        $cat09 = @$cat['cat09'];
        $cat10 = @$cat['cat10'];
        // DebugBreak();
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
            $sub5 = 0;
            $sub5ap1 =0;
            $sub5ap2 = 0;
        }

        $Speciality = $this->input->post('speciality');
        $grp_cd = $this->input->post('std_group');
        $per_grp = $this->input->post('pergrp');

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
        // DebugBreak();
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



        $AdmFee = $this->Admission_model->getrulefee($ispractical);//$this->makefee($cat,$Speciality,$sub7,$sub8,$grp_cd,$per_grp);
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

        if($Speciality > 0)
        {
           $AdmFeeCatWise = 0; 
        }
        $TotalAdmFee = $AdmFee[0]['Processing_Fee'] +$AdmFeeCatWise;
        // DebugBreak();

        $oldsess = @$_POST['oldsess'];
        if($oldsess == 'Annual'){
            $oldsess =  1;    
        }
        else if($oldsess == 'Supplementary'){
            $oldsess =  2;    
        }
        
       $addre =  str_replace("'", "", $this->input->post('address'));
       $data = array(
            'name' =>$this->input->post('cand_name'),
            'Fname' =>$this->input->post('father_name'),
            'BForm' =>$this->input->post('bay_form'),
            'FNIC' =>$this->input->post('father_cnic'),
            'Dob' =>$this->input->post('dob'),
            'MobNo' =>$this->input->post('mob_number'),
            'medium' =>$this->input->post('medium'),
            'Inst_Rno' =>$this->input->post('Inst_Rno'),
            'markOfIden' =>$this->input->post('MarkOfIden'),
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
            'Inst_cd' =>($Inst_Id),
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
            'AdmProcessFee'=>$AdmFee[0]['Processing_Fee'],
            'AdmFee'=>$AdmFeeCatWise,
            'AdmTotalFee'=>$TotalAdmFee,
            'category'=>@$_POST['category'],
            'exam_type'=>@$_POST['exam_type'],
            'spl_cd'=>@$data[0]['spl_cd'],
            'result2'=>@$data[0]['result2'],
            'NextRno_Sess_Year'=>@$data[0]['NextRno_Sess_Year'],
            'picpath'=>@$_POST['pic'],
            'brd_name'=>@$_POST['oldboard']

        );
        //  DebugBreak();
        DebugBreak();
         $target_path = PRIVATE_IMAGE_PATH;
        if (!file_exists($target_path)){

        mkdir($target_path);
        }
          
       // $base_path =  base_url().GET_PRIVATE_IMAGE_PATH_COPY;
        $base_path = GET_PRIVATE_IMAGE_PATH_COPY.@$_POST['pic'];
        $copyimg = $target_path.$formno.'.jpg';
       
        
      if (!(copy($base_path, $copyimg))) 
        {
        $data['excep'] = 'The file you are attempting to upload size is between 4 to 20 Kb.';
        $this->session->set_flashdata('NewEnrolment_error',$data);
        //  echo '<pre>'; print_r($allinputdata['excep']);exit();
        redirect('Admission/Pre_Matric_data/');
        }
        $this->frmvalidation('Pre_Matric_data',$data,0);       
        //DebugBreak();
        $logedIn = $this->Admission_model->Insert_NewEnorlement($data);



        if($logedIn != false)
        {
            $allinputdata = "";
            $allinputdata['excep'] = 'success';
            $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
            $msg = $formno;                                           
            redirect('Admission/'.'formdownloaded/'.$formno.'/'.$dob);
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


    public function matric_default(){
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
        //DebugBreak();
        $this->load->view('common/commonheader9th.php');
        $this->load->view('Admission/Matric/getinfo.php',$spl_cd);
        $this->load->view('common/footer.php');
    }

    public function getzone(){
        //DebugBreak();
        $data = array(
            'tehCode' => $this->input->post('tehCode'),
        );

        $tehCode = $data['tehCode'];
        $this->load->model('Admission_model');
        $value = array('teh'=> $this->Admission_model->getzone($tehCode)) ;
        echo json_encode($value);

    }

    public function getcenter(){
        //DebugBreak();
        $data = array(
            'zoneCode' => $this->input->post('pvtZone'),
            'gen' => $this->input->post('gend'),
        );

        $this->load->model('Admission_model');
        $value = array('center'=> $this->Admission_model->getcenter($data)) ;
        echo json_encode($value);

    }

    public function matricheader(){
        $this->load->view('common/commonheader9th.php'); 
    }

    public function StudentsData()  {    
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $user = $userinfo ;
        $this->load->model('Admission_model'); 

        $stdData = array(
            'data' => $this->Admission_model->getStudentsData($user['logged_in']['Inst_Id'])
        );
        $data = array(
            'isselected' => '3'
        );
        $this->commonheader($data);
        $this->load->view('Admission/Matric/StudentsData.php',$stdData);
        $this->commonfooter(array('files'=>array('validate.NewEnrolment.js')));
    }

    public function uploadFile ($rno, $inst_code, $file_field = null, $check_image = false, $random_name = false, $pic_name, $whitelist_ext, $whitelist_type, $path){
        $out = array('error'=>null);
        if (!$file_field) $out['error'][] = "Please specify a valid form field name";           
        if (!$path)       $out['error'][] = "Please specify a valid upload path";               
        if (count($out['error'])>0) return $out;

        //Make sure that there is a file
        if((!empty($_FILES[$file_field])) && ($_FILES[$file_field]['error'] == 0)) 
        {
            // Get filename
            $file_info = pathinfo($_FILES[$file_field]['name']);
            $name = $file_info['filename'];
            $ext = $file_info['extension'];
            //Check file has the right extension
            if (!in_array($ext, $whitelist_ext)) $out['error'][] = "Invalid file Extension";
            //Check that the file is of the right type
            if (!in_array($_FILES[$file_field]["type"], $whitelist_type)) $out['error'][] = "Invalid file Type";
            //If $check image is set as true
            if ($check_image) 
            {
                if (!getimagesize($_FILES[$file_field]['tmp_name'])) 
                    $out['error'][] = "Uploaded file is not a valid image";
            }

            $newname =  $pic_name.'.'.$ext;
            //Check if file already exists on server
            if (file_exists($path.$newname))
                unlink($path.$newname);
            if (count($out['error'])>0) return $out;
            if (move_uploaded_file($_FILES[$file_field]['tmp_name'], $path.$newname)) 
            {
                //Successfully uploaded file.
                $out['filepath'] = $path;
                $out['filename'] = $newname;
                return $out;
            } 
            else  $out['error'][] = "Server Error!";
        } 
        else 
        {
            $out['error'][] = "No file uploaded";
            return $out;
        }
    }

    public function ReAdmission($rno=0)
    {
        //if(!intval($rno)>0){//directt code here.}
        $this->load->library('session');
        $this->load->model('Admission_model'); 
        $user = $this->session->get_userdata('logged_in'); 
        $inst_code = $user['logged_in']['Inst_Id'];
        $stdRoll = $rno; $error = "";
        $rno = (int)$stdRoll;
        if(isset($_POST['save'])){
            $target_path =  'assets/uploads/' ; // UPLOADS;
            $target_path = 'assets/uploads/'.$inst_code.'/';
            if (!file_exists($target_path)){
                mkdir($target_path, 0777, true);
            }
            $countStudents = $this->Admission_model->countStudents($inst_code);
            $formNo = $inst_code . str_pad(intval($countStudents)+1, 4, "0", STR_PAD_LEFT);

            $new_name = "";
            if(!empty($_FILES['image']['name']))
            {
                $limit_size = 20000;
                $file_size = $_FILES['image']['size'];
                $sizekb = $file_size/1000;
                if($file_size >= $limit_size) 
                { 
                    $error = "Your file size is over limit. Your file size = $sizekb kb File size limit = 20kb. Please try Again!";
                }
                if(empty($error)){
                    $whitelist_ext = array('jpeg', 'jpg', 'gif', 'JPEG', 'JPG');
                    $whitelist_type = array('image/jpeg', 'image/jpg',  'image/JPEG', 'image/JPG');
                    $file = $this->uploadFile($rno, $inst_code, 'image', true, true, $formNo, $whitelist_ext, $whitelist_type, $target_path);

                    if (is_array($file['error'])) 
                    {
                        foreach($file['error'] as $msg) {$error .= "<br />".$msg;}
                        exit($error);
                    } else {
                        $newFileName = $file['filename'];
                        // exit($newFileName);
                        extract($_POST);
                        $data = array(
                            'rno'=>$rno,
                            'class'=>$class,
                            'iYear'=>$iYear,
                            'sess'=>$sess,
                            'regNo'=>$regNo,
                            'formNo'=>$formNo,
                            'strRegNo'=>$strRegNo,
                            'schm'=>$schm,
                            'classRno'=>$classRno,
                            'schGrade'=>$schGrade,
                            'name'=>$name,
                            'fName'=>$fName,
                            'bForm'=>$bForm,
                            'addr'=>$addr,
                            'fNic'=>$fNic,
                            'markOfIden'=>$markOfIden,
                            'rel'=>$rel,
                            'dob'=>$dob,
                            'sex'=>$sex,
                            'med'=>$med,
                            'nat'=>$nat,
                            'isHafiz'=>$isHafiz,
                            'speciality'=>$speciality,
                            'ruralOrUrban'=>$ruralOrUrban,
                            'dist_cd'=>$dist_cd,
                            'teh_cd'=>$teh_cd,
                            'cat09'=>$cat09,
                            'cat10'=>$cat10,
                            'grp_cd'=>$grp_cd,
                            'Sch_cd'=>$inst_code,
                            'sub1Ap1' => $sub1p1,
                            'sub1Ap2' => $sub1p2,
                            'sub2Ap1' => $sub2p1,
                            'sub2Ap2' => $sub2p2, 
                            'sub3Ap1' => $sub3p1,
                            'sub3Ap2' => $sub3p2, 
                            'sub4Ap1' => $sub4p1,
                            'sub4Ap2' => $sub4p2, 
                            'sub5Ap1' => $sub5p1,
                            'sub5Ap2' => $sub5p2, 
                            'sub6Ap1' => $sub6p1,
                            'sub6Ap2' => $sub6p2, 
                            'sub7Ap1' => $sub7p1,
                            'sub7Ap2' => $sub7p2, 
                            'sub8Ap1' => $sub8p1,
                            'sub8Ap2' => $sub8p2, 
                            'mobNo' => $MobNo,
                            'picPath' => $newFileName,
                            'isDeleted' => 0
                        );
                        $this->Admission_model->insertRecord($data);
                    }
                }
            }
        }
        if($rno > 0 ){
            $stdData = array(
                'error' => $error,
                'data' => $this->Admission_model->getAdmissionData($rno, $user['logged_in']['Inst_Id']),
                'subjects' => $this->Admission_model->getSubjects($rno, $user['logged_in']['Inst_Id'])
            );
            $data = array(
                'isselected' => '3'
            );
            $jsFiles = array(
                'files'=>array('validate.NewEnrolment.js'));
            $this->commonheader($data);
            $this->load->view('Admission/9th/ReAdmission.php',$stdData);
            $this->commonfooter($jsFiles);
        }
    }

    public function deleteRecord($rno){
        $rno = intval($rno);
        if($rno > 0){
            $this->load->library('session');
            $this->load->model('Admission_model'); 
            $user = $this->session->get_userdata('logged_in'); 
            $inst_code = $user['logged_in']['Inst_Id'];
            $this->Admission_model->deleteRecord($rno, $inst_code);
            $this->EditForms();
        }
    }

    public function EditForms(){
        $this->load->library('session');
        $this->load->model('Admission_model'); 
        $user = $this->session->get_userdata('logged_in'); 
        $inst_code = $user['logged_in']['Inst_Id'];
        $data = array(
            'data' => $this->Admission_model->getEditFormsList($inst_code),
            'isselected' => '3'
        );
        $this->commonheader($data);
        $this->load->view('Admission/9th/EditForms.php');
        $this->commonfooter();
    }

    public function PrintForm($formNo){
        $this->load->model('Admission_model'); 
        $this->Admission_model->printForm($formNo);
    }

    public function BatchList(){
        $data = array(
            'isselected' => '3'
        );
        $this->commonheader($data);
        $this->load->view('Admission/9th/BatchList.php');
        $this->commonfooter();
    }

    public function ProofReading(){
        $data = array(
            'isselected' => '3'
        );
        $this->commonheader($data);
        $this->load->view('Admission/9th/ProofReading.php');
        $this->commonfooter();
    }

    public function CreateBatch(){
        $this->load->library('session');
        $this->load->model('Admission_model'); 
        $user = $this->session->get_userdata('logged_in'); 
        $inst_code = $user['logged_in']['Inst_Id'];
        $data = array(
            'data' => $this->Admission_model->getEditFormsList($inst_code),
            'isselected' => '3'
        );

        $this->commonheader($data);
        $this->load->view('Admission/9th/CreateBatch.php');
        $this->commonfooter();
    }

    public function FormPrinting(){
        $data = array(
            'isselected' => '3'
        );
        $this->commonheader($data);
        $this->load->view('Admission/9th/FormPrinting.php');
        $this->commonfooter();
    }

    public function formdownloaded(){

        //DebugBreak();

        $msg = $this->uri->segment(3);
        $dob = $this->uri->segment(4);
        $this->load->model('Admission_model');
        $this->load->library('session');
        $myarray = array('msg'=>$msg,'dob'=>$dob);
        $this->load->view('common/commonheader9th.php');
        $this->load->view('Admission/Matric/FormDownloaded.php',$myarray);
        $this->load->view('common/commonfooter.php');
    }

    public function commonheader($data){
        $this->load->view('common/header.php');
        $this->load->view('common/menu.php',$data);
    } 

    public function commonfooter($arrfilePath=array()){
        $data = $arrfilePath;
        $this->load->view('common/footer.php',$data);
    }
   function frmvalidation($viewName,$allinputdata,$isupdate)
    {

        //  DebugBreak();
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
        //(strpos($a, 'are') !== false)


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
        else if((@$_POST['gend'] != '1') and (@$_POST['gend'] != '2'))
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
       
        
        else if(@$_POST['exam_type'] == 2)
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
        else if(@$_POST['exam_type']==16 && @$_POST['category']==2)
        {
                if(@$_POST['sub6'] == 0 ||@$_POST['sub6p2'] == 0 )
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 6';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub7'] == 0 || @$_POST['sub7p2'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 7';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
            else if(@$_POST['sub8'] == 0 || @$_POST['sub8p2'] == 0)
            {
                $allinputdata['excep'] = 'Please Select Part-II Subject 8';
                $this->session->set_flashdata('NewEnrolment_error',$allinputdata);
                redirect('Admission/'.$viewName);
                return;

            }
        }

    }
}