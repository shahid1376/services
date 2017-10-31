<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privateslips extends CI_Controller {


    public function index()
    {
        $this->clear_cache();
        $this->clear_all_cache();
        $this->load->helper('url');
        $data = array(
            'message' => '',
        );
        $this->load->view('Privateslips/10thclass.php',$data);
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
    public function rollnumberslip9th()
    {
        $this->load->helper('url');
        $data = array(
            'message' => '',
        );
        $this->load->view('Privateslips/9thpvtSlip.php',$data);

    }
    public function interslip()
    {
        $this->load->helper('url');
        $data = array(
            'message' => '',
        );
        $this->load->view('Privateslips/12thclass.php',$data);

    }
    public function interslipPart1()
    {
        $this->load->helper('url');
        $data = array(
            'message' => '',
        );
        $this->load->view('Privateslips/11thpvtSlip.php',$data);

    }
    public function GetpvtRSlip()
    {
       // DebugBreak()  ;
        $this->load->helper('url');
        $sess  = mSession;
        $class = mClass;
        $year  = mYear;
        $stdName = $_POST["std_name"];
        $Fname =   $_POST["fath_name"];
        $Fnic = $_POST["fnic"];
        $FormNo = $_POST["form_no"];
        $rno = $_POST["cur_exm_roll_no"];

        $this->load->model('RollNoSlip_model');
        $studeninfo = array('data'=>$this->RollNoSlip_model->getPVT10thrslip($stdName,$Fname,$Fnic,$rno,$FormNo,$class,$year,$sess));


        if($studeninfo['data'] == 0)
        {
            $datamsg = array(
                'message' => 'Record Not Found',
            );  
            $this->load->view('Privateslips/10thClass.php',$datamsg);
        }
        else
        {
            $rno = $studeninfo['data']['info'][0]['Rno'];

            //$filepath = 'assets/'.$studeninfo['data']['info'][0]['picpath'];
            $filepath = 'assets/img/download.jpg';
            $isexists = file_exists($filepath);
            if(!$isexists)
            {
                $datamsg = array(
                    'message' => 'Picture Not Exists.',
                );  
                $this->load->view('Privateslips/10thClass.php',$datamsg);
            }
            else{
                $temp = "$rno@$class@$sess@$year";
                // $image =  $this->set_barcode($temp);
                $studeninfo['data']['info'][0]['barcode'] = $temp;
                $this->load->library('PDFFWithOutPage');
                $pdf=new PDFFWithOutPage('P','in',"A4");   
                $pdf->SetAutoPageBreak(true,2);
                $pdf->AddPage();
                //$html = $this->load->view('Privateslips/MatricRollNo', $studeninfo['data']['info'][0], true);   
                $this->makepdf($pdf, $studeninfo['data']['info'][0]);
                // $pdf->writeHTML($html, true, false, true, false, ''); 

                $pdf->Output($rno.'.pdf', 'I');  
            }

        }

    }
    public function Getpvt12RSlip()
    {
        //  DebugBreak()  ;
        $this->load->helper('url');
        $sess=2;
        $class =12;
        $year=2016;
        $stdName = $_POST["std_name"];
        $Fname =   $_POST["fath_name"];
        $Fnic = $_POST["fnic"];
        $FormNo = $_POST["form_no"];
        $rno = $_POST["cur_exm_roll_no"];

        $this->load->model('RollNoSlip_model');
        $studeninfo = array('data'=>$this->RollNoSlip_model->getPVT12thrslip($stdName,$Fname,$Fnic,$rno,$FormNo,$class,$year,$sess));


        if($studeninfo['data'] == 0)
        {
            $datamsg = array(
                'message' => 'Record Not Found',
            );  
            $this->load->view('Privateslips/12thClass.php',$datamsg);
        }
        else
        {
            $rno = $studeninfo['data']['info'][0]['Rno'];

            $filepath = 'assets/'.$studeninfo['data']['info'][0]['picpath'];
            //$filepath =  "assets/img/download.jpg";  
            $isexists = file_exists($filepath);
            if(!$isexists)
            {
                $datamsg = array(
                    'message' => 'Picture Not Exists.',
                );  
                $this->load->view('Privateslips/12thClass.php',$datamsg);
            }
            else{
                $temp = "$rno@$class@$sess@$year";
                // $image =  $this->set_barcode($temp);
                $studeninfo['data']['info'][0]['barcode'] = $temp;
                $this->load->library('PDFF');
                $pdf=new PDFF('P','in',"A4");   
                $pdf->SetAutoPageBreak(true,2);
                $pdf->AddPage();
                //$html = $this->load->view('Privateslips/MatricRollNo', $studeninfo['data']['info'][0], true);   
                $this->makepdf12class($pdf, $studeninfo['data']['info'][0]);
                // $pdf->writeHTML($html, true, false, true, false, ''); 

                $pdf->Output($rno.'.pdf', 'I');  
            }

        }

    }
    private function makepdf($pdf,$info)
    {
        if($info['Session'] ==1) $Session= 'ANNUAL'; else $Session='SUPPLEMENTARY';
        if($info['errmessage'] == null) $errmessage = '(PROVISIONALLY)'; else{ $errmessage = ' (PROVISIONALLY OBJECTION SLIP)';};
        // $errmessage = '(PROVISIONALLY)';

        if($info['grp_cd'] == 1)  $grp_cd = 'SCIENCE'; else if($info['grp_cd'] == 2) $grp_cd='GENERAL';else if($info['grp_cd'] == 4) $grp_cd='AAMA GROUP'; else if($info['grp_cd'] == 5) $grp_cd='DEAF & DEFECTIVE';
            if($info['Gender']==1) $Gender= 'MALE'; else if($info['Gender']==2) $Gender= 'FEMALE';
            $filepath = $info['picpath'];
        // $filepath = 'assets/img/download.jpg';


        $fontSize = 8; 
        $marge    = .42;   // between barcode and hri in pixel
        $bx        = 143.97;  // barcode center
        $by        = 18.75;  // barcode center
        $height   = 5.65;   // barcode height in 1D ; module size in 2D
        $width    = .219;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $code     = '222020';     // barcode (CP852 encoding for Polish and other Central European languages)
        $type     = 'code128';
        $black    = '000000'; // color in hex
        $Y = 3;
        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(22.2,7.2);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");
        // $pdf->SetFont('Arial','R',10);
        $pdf->SetFont('Arial','',9.4);
        $pdf->SetXY(26.2,10.9);
        $pdf->Cell(0, 0.2, "ROLL NUMBER SLIP (WITH DATE SHEET) FOR S.S.C $Session EXAMINATION, ".$info["Year"], 0.25, "C");  

        $pdf->Image("assets/img/icon2.png",5.0,3.0, 20.65,18.65, "PNG");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(68,15.2);
        $pdf->Cell(0, 0.2, $errmessage, 0.25, "C"); 



        $pdf->SetXY(40.2,21.2);
        $Barcode = $info['barcode'];

        $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

        $len = $pdf->GetStringWidth($bardata['hri']);
        Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);

        // $pdf->Image("assets/pdfs/".$info['barcode'],126.0,15.1, 43.65,5.65, "PNG");  

        if($info['schm'] ==  3)
        {
            $schm = 'OLD';
        }
        else if($info['schm'] ==  4)
        {
            $schm = 'NEW';
        }

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(138.0,26.1);
        $pdf->Cell(0, 0.2, $grp_cd, 0.25, "C");

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(133.0,31.1);
        $pdf->Cell(29.5,6.2,'',1,0,'C',0); 
        $pdf->SetXY(135.0,34.1);
        $pdf->Cell(0, 0.2, "SCHEME $schm", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(175,13.2);
        $pdf->Cell(0, 0.2, "FormNo:".$info['formno'], 0.25, "C");

        /*  $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(185.2,13.2);
        $pdf->Cell(0, 0.2, $info['formno'], 0.25, "C");*/


        $pdf->SetXY(40.2,21.2);
        //  DebugBreak();
        // $filepath = str_replace('OldPics/', '', $filepath);
        
        $pdf->Image($filepath,173.0,15.1, 30.65,30.65, "jpg");  
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(182.2,48.2);
        $pdf->Cell(0, 0.2, $Gender, 0.25, "C");


        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,21.2);
        $pdf->Cell(0, 0.2, "ROLL NO.               :", 0.25, "C");


        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(40.9,14.2+ $Y);
        $pdf->Cell(14.5,6.2,'',1,0,'C',0); 
        $pdf->SetXY(40.8,17.4+ $Y);
        $pdf->Cell(0, 0.2, $info['Rno'], 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,23.2 + + $Y);
        $pdf->Cell(0, 0.2, "NAME                      :", 0.25, "C");


        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,23.2+ $Y);
        $pdf->Cell(0, 0.2, $info['Name'], 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,28.2+ $Y);
        $pdf->Cell(0, 0.2, "FATHER'S NAME    :", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,28.2+ $Y);
        $pdf->Cell(0, 0.2, $info['FathersName'], 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,33.2+ $Y);
        $pdf->Cell(0, 0.2, "DATE OF BIRTH     :", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,33.2+ $Y);
        $pdf->Cell(0, 0.2, $info['DOB'], 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,38.2+ $Y);
        $pdf->Cell(0, 0.2, "CENTRE                  :", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(40.2,36.2+ $Y);
        $pdf->MultiCell(130, 5, $info['cent_cd'].'-'.$info['Cent_Name'],0);

        $isthird = 0;
        $ispratical = 0;
        $ispart1 = 0;
        $countter = 0;
        $part2sub = '';
        $part2html = '';
        $countter9 = 0;
        $part1sub = '';
        $part1html = '';
        $noteimageheight =66; 
        if($info['errmessage'] == null) 
        {
            if(@$info['slips'][0]['subp2count']>0) {

                $xx= 46.2+ $Y;
                $boxWidth = 150.0;
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(10.2,50.2+ $Y);
                $pdf->SetFillColor(240,240,240);
                $pdf->Cell($boxWidth,5,'THEORY PART - II',1,0,'C',1);
                $pdf->SetFillColor(255,255,255);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(10.2,55.2+ $Y);
                $pdf->Cell(8,5,'Sr#',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(18.2,55.2+ $Y);
                $pdf->Cell(85,5,'SUBJECT(S)',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(100,55.2+ $Y);
                $pdf->Cell(20,5,'DATE',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(120.1,55.2+ $Y);
                $pdf->Cell(20,5,'DAY',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(140,55.2+ $Y);
                $pdf->Cell(20,5,'TIME',1,0,'C',1);


                for($k = 0; $k<$info['slips'][0]['subp2count']; $k++) { 
                    if($info['slips'][$k]['class'] == 10) {
                        $countter++;
                        $Y = $Y + 4;

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(10.2,55.2+ $Y);
                        $pdf->Cell(8,5,$countter,1,0,'C',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(18.2,55.2+ $Y);
                        $pdf->Cell(85,5,$info['slips'][$k]['sub_Name'],1,0,'L',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(100,55.2+ $Y);
                        $pdf->Cell(20,5,$info['slips'][$k]['Date2'],1,0,'C',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(120.1,55.2+ $Y);
                        $pdf->Cell(20,5,$info['slips'][$k]['Day'],1,0,'C',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(140,55.2+ $Y);
                        $pdf->Cell(20,5,$info['slips'][$k]['TIME'],1,0,'C',1);

                    }
                }
            }
            // THEOROR PART I SUBJECT TABLE

            if(@$info['slips'][$countter]['subp1count'] > 0)
            {

                $ispart1 =1;
                $boxWidth = 150.0;
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(10.2,62.2+ $Y);
                $pdf->SetFillColor(240,240,240);
                $pdf->Cell($boxWidth,5,'THEORY PART - I',1,0,'C',1);
                $pdf->SetFillColor(255,255,255);
                $Y = $Y + 12;
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(10.2,55.2+ $Y);
                $pdf->Cell(8,5,'Sr#',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(18.2,55.2+ $Y);
                $pdf->Cell(85,5,'SUBJECT(S)',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(100,55.2+ $Y);
                $pdf->Cell(20,5,'DATE',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(120.1,55.2+ $Y);
                $pdf->Cell(20,5,'DAY',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(140,55.2+ $Y);
                $pdf->Cell(20,5,'TIME',1,0,'C',1);

                if(@$info['slips'][$countter]['subp1count'] >4)
                    $noteimageheight = $noteimageheight+13;
                for($l = 0; $l<$info['slips'][$countter]['subp1count']; $l++) { 
                    if($info['slips'][$l+$countter]['class'] == 9) {
                        $countter9++;

                        $Y = $Y + 4;

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(10.2,55.2+ $Y);
                        $pdf->Cell(8,5,$countter9,1,0,'C',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(18.2,55.2+ $Y);
                        $pdf->Cell(85,5,$info['slips'][$l+$countter]['sub_Name'],1,0,'L',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(100,55.2+ $Y);
                        $pdf->Cell(20,5,$info['slips'][$l+$countter]['Date2'],1,0,'C',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(120.1,55.2+ $Y);
                        $pdf->Cell(20,5,$info['slips'][$l+$countter]['Day'],1,0,'C',1);

                        $pdf->SetFont('Arial','',8);
                        $pdf->SetXY(140,55.2+ $Y);
                        $pdf->Cell(20,5, $info['slips'][$l+$countter]['TIME'],1,0,'C',1);


                    }
                }

            }
            else
            {
                // DebugBreak();

                $Y = 18+ $Y;
            }

            if(@$info['slips'][$countter]['subp1count'] +@$info['slips'][0]['subp2count'] <= 4)
            {
                $Y = 28+ $Y;
            }


            // INSTRUCTION PICTURE 
            $pdf->SetXY(40.2,21.2);
            $pdf->Image("assets/img/Note.jpg",165.0,50.1, 40.65,$noteimageheight, "JPG");  

            // PRACTICAL BOX
            $tprcount = $countter+$countter9;
            $prcount = 0;
            $pathtml = '';
            $partsubhtml = '';
            if(@$info['slips'][$tprcount]['prcount'] > 0)
            {

                $ispratical =1;
                $boxWidth = 195.0;
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(10.2,65.2+ $Y);
                $pdf->SetFillColor(240,240,240);
                $pdf->Cell($boxWidth,5,'PRACTICAL PART - II',1,0,'C',1);
                $pdf->SetFillColor(255,255,255);
                $Y = $Y + 15;
                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(10.2,55.2+ $Y);
                $pdf->Cell(8,5,'Sr#',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(18.2,55.2+ $Y);
                $pdf->Cell(54,5,'Subject(S)',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(72.2,55.2+ $Y);
                $pdf->Cell(94,5,'Laboratory',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(166.2,55.2+ $Y);
                $pdf->Cell(15,5,'Date',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(181.3,55.2+ $Y);
                $pdf->Cell(14,5,'Time',1,0,'C',1);

                $pdf->SetFont('Arial','B',8);
                $pdf->SetXY(195.1,55.2+ $Y);
                $pdf->Cell(10,5,'Batch',1,0,'C',1);
                $isthird = 0;
                $pdf->SetWidths(array(8,54,94,15,14,10));
                $pdf->SetFont('Arial','',7);
                $isprlen = 0;
                for($l = 0; $l<$info['slips'][$tprcount]['prcount']; $l++) 
                { 
                    $prcount++;
                    if($l ==0)
                    {
                        $Y = $Y +5;
                    }
                    else
                    {
                        $lablen = strlen($info['slips'][$l+$tprcount]['lab_Name']);
                        // DebugBreak();
                        if($lablen>65 && $lablen<110)
                        {
                            $Y = $Y + 8;
                            $isprlen = 1;
                        }
                        else if($lablen>110)
                        {
                            $Y = $Y + 12; 
                            $isthird =1; 
                            $isprlen =1;
                        }
                        else
                        {
                            if($isprlen == 0)
                                $Y = $Y +4;   
                            else
                                $Y = $Y +8;   
                        }

                    }
                    $pdf->SetXY(10.2,55.2+ $Y);
                    $pdf->Row(array($prcount,$info['slips'][$l+$tprcount]['sub_Name'],$info['slips'][$l+$tprcount]['lab_Name'],$info['slips'][$l+$tprcount]['Date2'],$info['slips'][$l+$tprcount]['TIME'],$info['slips'][$l+$tprcount]['batch']));

                }
            }


            if($isthird ==1)
                $Y = $Y+10;
            else 
                $Y = $Y+5;

            if($ispratical == 0)
            {
                $Y = 30+ $Y;  
            }
            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(10.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "Official Name:", 0.25, "C");

            $pdf->SetFont('Arial','BU',7);
            $pdf->SetXY(30.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, $info['emp_cd'].'-'.$info['emp_name'], 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(90.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "Candidate's Signature: ", 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(125.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "___________________ ", 0.25, "C");

            /*$pdf->SetFont('Arial','',9);
            $pdf->SetXY(10.2,68.2 + $Y);
            $pdf->Cell(0, 0.2, "Serial No:", 0.25, "C");

            $pdf->SetFont('Arial','BU',7);
            $pdf->SetXY(30.2,68.2 + $Y);
            $pdf->Cell(0, 0.2, $info['SrNo'], 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(90.2,68.2 + $Y);
            $pdf->Cell(0, 0.2, "Bind No: ".$info['BindNo'], 0.25, "C");     */
            
            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(165.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "Printing Date:", 0.25, "C");

            $pdf->SetFont('Arial','U',9);
            $pdf->SetXY(185.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, date('d-m-Y'), 0.25, "C");

            if($ispart1 == 0 && $isthird==0 )
            {
                $Y = 15+ $Y; 
            }

            // Roll no. box
            $rnostr = $info['Rno'];
            $rnostr1 = substr($rnostr,0,1);
            $rnostr2 = substr($rnostr,1,1);
            $rnostr3 = substr($rnostr,2,1);
            $rnostr4 = substr($rnostr,3,1);
            $rnostr5 = substr($rnostr,4,1);
            $rnostr6 = substr($rnostr,5,1);
            $boxWidth = 48;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,70+ $Y);

            $pdf->Cell($boxWidth,5,'ROLL NO',1,0,'C',1);
            $pdf->SetFillColor(255,255,255);
            $Y = $Y + 20;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell(8,6,$rnostr1,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(18,55+ $Y);
            $pdf->Cell(8,6,$rnostr2,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(26,55+ $Y);
            $pdf->Cell(8,6,$rnostr3,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell(8,6,$rnostr4,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell(8,6,$rnostr5,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell(8,6,$rnostr6,1,0,'C',1);


            $bubble0ps1 = '0.JPG';
            $bubble0ps2 = '0.JPG';
            $bubble0ps3 = '0.JPG';
            $bubble0ps4 = '0.JPG';
            $bubble0ps5 = '0.JPG';
            $bubble0ps6 = '0.JPG';

            $bubble1ps1 = '1.JPG';
            $bubble1ps2 = '1.JPG';
            $bubble1ps3 = '1.JPG';
            $bubble1ps4 = '1.JPG';
            $bubble1ps5 = '1.JPG';
            $bubble1ps6 = '1.JPG';

            $bubble2ps1 = '2.JPG';
            $bubble2ps2 = '2.JPG';
            $bubble2ps3 = '2.JPG';
            $bubble2ps4 = '2.JPG';
            $bubble2ps5 = '2.JPG';
            $bubble2ps6 = '2.JPG';

            $bubble3ps1 = '3.JPG';
            $bubble3ps2 = '3.JPG';
            $bubble3ps3 = '3.JPG';
            $bubble3ps4 = '3.JPG';
            $bubble3ps5 = '3.JPG';
            $bubble3ps6 = '3.JPG';

            $bubble4ps1 = '4.JPG';
            $bubble4ps2 = '4.JPG';
            $bubble4ps3 = '4.JPG';
            $bubble4ps4 = '4.JPG';
            $bubble4ps5 = '4.JPG';
            $bubble4ps6 = '4.JPG';

            $bubble5ps1 = '5.JPG';
            $bubble5ps2 = '5.JPG';
            $bubble5ps3 = '5.JPG';
            $bubble5ps4 = '5.JPG';
            $bubble5ps5 = '5.JPG';
            $bubble5ps6 = '5.JPG';

            $bubble6ps1 = '6.JPG';
            $bubble6ps2 = '6.JPG';
            $bubble6ps3 = '6.JPG';
            $bubble6ps4 = '6.JPG';
            $bubble6ps5 = '6.JPG';
            $bubble6ps6 = '6.JPG';

            $bubble7ps1 = '7.JPG';
            $bubble7ps2 = '7.JPG';
            $bubble7ps3 = '7.JPG';
            $bubble7ps4 = '7.JPG';
            $bubble7ps5 = '7.JPG';
            $bubble7ps6 = '7.JPG';

            $bubble8ps1 = '8.JPG';
            $bubble8ps2 = '8.JPG';
            $bubble8ps3 = '8.JPG';
            $bubble8ps4 = '8.JPG';
            $bubble8ps5 = '8.JPG';
            $bubble8ps6 = '8.JPG';

            $bubble9ps1 = '9.JPG';
            $bubble9ps2 = '9.JPG';
            $bubble9ps3 = '9.JPG';
            $bubble9ps4 = '9.JPG';
            $bubble9ps5 = '9.JPG';
            $bubble9ps6 = '9.JPG';

            //region for 0 bubbling 
            if($rnostr1 == 0) {
                $bubble0ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 0)
            {
                $bubble0ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 0)
            {
                $bubble0ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 0)
            {
                $bubble0ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 0)
            {
                $bubble0ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 0)
            {
                $bubble0ps6 = 'bubble.JPG';
            }
            //endregion 

            // for 1 bubbling
            if($rnostr1 == 1) {
                $bubble1ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 1)
            {
                $bubble1ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 1)
            {
                $bubble1ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 1)
            {
                $bubble1ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 1)
            {
                $bubble1ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 1)
            {
                $bubble1ps6 = 'bubble.JPG';
            }
            // end bubbling 1 

            // for 2 bubbling
            if($rnostr1 == 2) {
                $bubble2ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 2)
            {
                $bubble2ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 2)
            {
                $bubble2ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 2)
            {
                $bubble2ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 2)
            {
                $bubble2ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 2)
            {
                $bubble2ps6 = 'bubble.JPG';
            }
            // end bubbling 2 

            // for 3 bubbling
            if($rnostr1 == 3) {
                $bubble3ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 3)
            {
                $bubble3ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 3)
            {
                $bubble3ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 3)
            {
                $bubble3ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 3)
            {
                $bubble3ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 3)
            {
                $bubble3ps6 = 'bubble.JPG';
            }
            // end bubbling 3 


            // for 4 bubbling
            if($rnostr1 == 4) {
                $bubble4ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 4)
            {
                $bubble4ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 4)
            {
                $bubble4ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 4)
            {
                $bubble4ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 4)
            {
                $bubble4ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 4)
            {
                $bubble4ps6 = 'bubble.JPG';
            }
            // end bubbling 4 

            // for 5 bubbling
            if($rnostr1 == 5) {
                $bubble5ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 5)
            {
                $bubble5ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 5)
            {
                $bubble5ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 5)
            {
                $bubble5ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 5)
            {
                $bubble5ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 5)
            {
                $bubble5ps6 = 'bubble.JPG';
            }
            // end bubbling 5 

            // for 6 bubbling
            if($rnostr1 == 6) {
                $bubble6ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 6)
            {
                $bubble6ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 6)
            {
                $bubble6ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 6)
            {
                $bubble6ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 6)
            {
                $bubble6ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 6)
            {
                $bubble6ps6 = 'bubble.JPG';
            }
            // end bubbling 6 


            // for 7 bubbling
            if($rnostr1 == 7) {
                $bubble7ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 7)
            {
                $bubble7ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 7)
            {
                $bubble7ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 7)
            {
                $bubble7ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 7)
            {
                $bubble7ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 7)
            {
                $bubble7ps6 = 'bubble.JPG';
            }
            // end bubbling 7 

            // for 8 bubbling
            if($rnostr1 == 8) {
                $bubble8ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 8)
            {
                $bubble8ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 8)
            {
                $bubble8ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 8)
            {
                $bubble8ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 8)
            {
                $bubble8ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 8)
            {
                $bubble8ps6 = 'bubble.JPG';
            }
            // end bubbling 8 

            // for 9 bubbling
            if($rnostr1 == 9) {
                $bubble9ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 9)
            {
                $bubble9ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 9)
            {
                $bubble9ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 9)
            {
                $bubble9ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 9)
            {
                $bubble9ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 9)
            {
                $bubble9ps6 = 'bubble.JPG';
            }

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );


            $pdf->Image("assets/img/256(10thPrivate)Final.JPG",60.0, $Y-12, 147.65,72.65, "JPG");  
            $pdf->Image("assets/img/isnt1_converted.png",75.0, $Y+59, 130.65,9, "png"); 
            // $pdf->Image("assets/img/headsign.jpg",10.0,258, 72,24, "JPG");  
            //  $pdf->Image("assets/img/headsign.jpg",10.0,267, 82,15, "JPG");  

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,266);
            $pdf->Cell( 0,0, 'Bind - Sr No: '.$info['BindNo'].' - '.$info['SrNo'], 0, 0, 'C', false );
            
            $pdf->Image(CESIGN,170.0,258.5, 30,30, "PNG"); 
            $pdf->Image("assets/img/NoteForMatric_II.jpg",10.0,268, 140,22, "JPG"); 
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(158,289);
            $pdf->Cell(0, 0.1, "CONTROLLER OF EXAMINATIONS", 0.25, "C");
        }
        else
        {
            $message = 'Slip is not issued due to '.$info['errmessage'];
            $pdf->SetFont('Arial','B',16);

            $pdf->SetTextColor(255 ,0,0);
            $pdf->SetXY(20,60);
            $pdf->MultiCell(195, 6,$message, 0, "L",0);   
        }

    }
    private function makepdf12class($pdf,$info)
    {
        if($info['Session'] ==1) $Session= 'ANNUAL'; else $Session='SUPPLY';
        //if($info['errmessage'] == null) $errmessage = '(PROVISIONALLY)'; else{ $errmessage = ' (PROVISIONALLY OBJECTION SLIP)';};
        $errmessage = '(PROVISIONALLY)';

        if($info['grp_cd'] == 1)  $grp_cd = 'PRE-MEDICAL';
        else if($info['grp_cd'] == 2) $grp_cd='PRE-ENGINEERING';
            else if($info['grp_cd'] == 3) $grp_cd='HUMANITIES';
                else if($info['grp_cd'] == 4) $grp_cd='GENERAL SCIENCE';
                    else if($info['grp_cd'] == 5) $grp_cd='COMMERCE';
                        else if($info['grp_cd'] == 6) $grp_cd='ISLAMIC STUDIES';
                            else if($info['grp_cd'] == 7) $grp_cd='HOME ECONOMICS';
                                else if($info['grp_cd'] == 8) $grp_cd='MEDICAL TECHNOLGY';
                                    else if($info['grp_cd'] == 9) $grp_cd='ALOOM-E-SHARQIA';
                                        else if($info['grp_cd'] == 10) $grp_cd='KHASA';
                                            else if($info['grp_cd'] == 11) $grp_cd='FAZAL';

                                                if($info['Scheme']==1){
            $scheme = 'NEW';
        }
        else if($info['Scheme']==2){
            $scheme = 'OLD';
        }
        if($info['grp_cd'] == 'PRE-MEDICAL')
        {
            $xvalue = 136.0;
        }
        else if($info['grp_cd'] == 'PRE-ENGINEERING')
        {
            $xvalue = 132.0;
        }
        else if($info['grp_cd'] == 'HUMANITIES')
        {
            $xvalue = 136.0;
        }
        else if($info['grp_cd'] == 'GENERAL SCIENCE')
        {
            $xvalue = 132.0;
        }
        else if($info['grp_cd'] == 'COMMERCE')
        {
            $xvalue = 137.0;
        }
        else if($info['grp_cd'] == 'ISLAMIC STUDIES'){
            $xvalue = 132.0;
        }
        else if($info['grp_cd'] == 'HOME ECONOMICS'){
            $xvalue = 132.0;
        }
        if($info['Gender']==1) $Gender= 'MALE'; else if($info['Gender']==2) $Gender= 'FEMALE';
            $filepath = base_url().'assets/'.$info['picpath'];
        //   $filepath = 'assets/img/download.jpg';

        $fontSize = 8; 
        $marge    = .42;   // between barcode and hri in pixel
        $bx        = 143.97;  // barcode center
        $by        = 18.75;  // barcode center
        $height   = 5.75;   // barcode height in 1D ; module size in 2D
        $width    = .24;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $code     = '222020';     // barcode (CP852 encoding for Polish and other Central European languages)
        $type     = 'code128';
        $black    = '000000'; // color in hex
        $Y = 3;

        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(22.2,7.2);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");
        // $pdf->SetFont('Arial','R',10);
        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(26.2,10.9);
        $pdf->Cell(0, 0.2, "ROLL NUMBER SLIP (WITH DATE SHEET) FOR INTER PART-II $Session EXAMINATION, ".$info["Year"], 0.25, "C");  

        $pdf->Image("assets/img/icon2.png",5.0,3.0, 20.65,18.65, "PNG");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(68,15.2);
        $pdf->Cell(0, 0.2, $errmessage, 0.25, "C"); 



        $pdf->SetXY(40.2,21.2);

        $Barcode = $info['barcode'];

        $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

        $len = $pdf->GetStringWidth($bardata['hri']);
        Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
        //  $pdf->Image("assets/pdfs/".$info['barcode'],126.0,15.1, 43.65,5.65, "PNG");  

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(138.0,26.1);
        $pdf->Cell(0, 0.2, $grp_cd, 0.25, "C");

        /* $pdf->SetFont('Arial','',10);
        $pdf->SetXY(133.0,31.1);
        $pdf->Cell(29.5,6.2,'',1,0,'C',0); 
        $pdf->SetXY(133.0,34.1);
        $pdf->Cell(0, 0.2, "SCHEME = ".$scheme, 0.25, "C");
        */
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(172.2,13.2);
        $pdf->Cell(0, 0.2, "FormNo: ", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(185.2,13.2);
        $pdf->Cell(0, 0.2, $info['formno'], 0.25, "C");


        $pdf->SetXY(40.2,21.2);
        $pdf->Image($filepath,173.0,15.1, 30.65,30.65, "jpg");  

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(182.2,48.2);
        $pdf->Cell(0, 0.2, $Gender, 0.25, "C");


        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,21.2);
        $pdf->Cell(0, 0.2, "ROLL NO.               :", 0.25, "C");


        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(40.9,14.2+ $Y);
        $pdf->Cell(14.5,6.2,'',1,0,'C',0); 
        $pdf->SetXY(40.8,17.4+ $Y);
        $pdf->Cell(0, 0.2, $info['Rno'], 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,23.2 + + $Y);
        $pdf->Cell(0, 0.2, "NAME                      :", 0.25, "C");


        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,23.2+ $Y);
        $pdf->Cell(0, 0.2, $info['Name'], 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,28.2+ $Y);
        $pdf->Cell(0, 0.2, "FATHER'S NAME    :", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,28.2+ $Y);
        $pdf->Cell(0, 0.2, $info['FathersName'], 0.25, "C");

        /*$pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,33.2+ $Y);
        $pdf->Cell(0, 0.2, "DATE OF BIRTH     :", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,33.2+ $Y);
        $pdf->Cell(0, 0.2, $info['DOB'], 0.25, "C");*/

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,38.2+ $Y);
        $pdf->Cell(0, 0.2, "CENTRE                  :", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(40.2,36.2+ $Y);
        $pdf->MultiCell(130, 5, $info['cent_cd'].'-'.$info['Cent_Name'],0);

        $isthird = 0;
        $ispratical = 0;
        $ispart1 = 0;
        $countter = 0;
        $part2sub = '';
        $part2html = '';
        $countter9 = 0;
        $part1sub = '';
        $part1html = '';
        $noteimageheight =66; 
        // DebugBreak();
        if(@$info['slips'][0]['subp2count']>0) {

            $xx= 46.2+ $Y;
            $boxWidth = 150.0;
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(10.2,50.2+ $Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell($boxWidth,5,'THEORY = PART - II',1,0,'C',1);
            $pdf->SetFillColor(255,255,255);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(10.2,55.2+ $Y);
            $pdf->Cell(8,5,'Sr#',1,0,'C',1);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(18.2,55.2+ $Y);
            $pdf->Cell(85,5,'SUBJECT(S)',1,0,'C',1);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(100,55.2+ $Y);
            $pdf->Cell(20,5,'DATE',1,0,'C',1);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(120.1,55.2+ $Y);
            $pdf->Cell(20,5,'DAY',1,0,'C',1);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(140,55.2+ $Y);
            $pdf->Cell(20,5,'TIME',1,0,'C',1);


            for($k = 0; $k<$info['slips'][0]['subp2count']; $k++) { 
                if($info['slips'][$k]['class'] == 12) {
                    $countter++;
                    $Y = $Y + 4;

                    $pdf->SetFont('Arial','',8);
                    $pdf->SetXY(10.2,55.2+ $Y);
                    $pdf->Cell(8,5,$countter,1,0,'C',1);

                    $pdf->SetFont('Arial','',8);
                    $pdf->SetXY(18.2,55.2+ $Y);
                    $pdf->Cell(85,5,$info['slips'][$k]['sub_Name'],1,0,'L',1);

                    $pdf->SetFont('Arial','',8);
                    $pdf->SetXY(100,55.2+ $Y);
                    $pdf->Cell(20,5,$info['slips'][$k]['Date2'],1,0,'C',1);

                    $pdf->SetFont('Arial','',8);
                    $pdf->SetXY(120.1,55.2+ $Y);
                    $pdf->Cell(20,5,$info['slips'][$k]['Day'],1,0,'C',1);

                    $pdf->SetFont('Arial','',8);
                    $pdf->SetXY(140,55.2+ $Y);
                    $pdf->Cell(20,5,$info['slips'][$k]['TIME'],1,0,'C',1);

                }
            }
        }
        // THEOROR PART I SUBJECT TABLE

        if(@$info['slips'][$countter]['subp1count'] > 0)
        {

            $ispart1 =1;
            $boxWidth = 150.0;
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(10.2,62.2+ $Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell($boxWidth,5,'THEORY = PART - I',1,0,'C',1);
            $pdf->SetFillColor(255,255,255);
            $Y = $Y + 12;
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(10.2,55.2+ $Y);
            $pdf->Cell(8,5,'Sr#',1,0,'C',1);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(18.2,55.2+ $Y);
            $pdf->Cell(85,5,'SUBJECT(S)',1,0,'C',1);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(100,55.2+ $Y);
            $pdf->Cell(20,5,'DATE',1,0,'C',1);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(120.1,55.2+ $Y);
            $pdf->Cell(20,5,'DAY',1,0,'C',1);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(140,55.2+ $Y);
            $pdf->Cell(20,5,'TIME',1,0,'C',1);

            if(@$info['slips'][$countter]['subp1count'] >4)
                $noteimageheight = $noteimageheight+13;
            for($l = 0; $l<$info['slips'][$countter]['subp1count']; $l++) { 
                if($info['slips'][$l+$countter]['class'] == 11) {
                    $countter9++;

                    $Y = $Y + 4;

                    $pdf->SetFont('Arial','',8);
                    $pdf->SetXY(10.2,55.2+ $Y);
                    $pdf->Cell(8,5,$countter9,1,0,'C',1);

                    $pdf->SetFont('Arial','',8);
                    $pdf->SetXY(18.2,55.2+ $Y);
                    $pdf->Cell(85,5,$info['slips'][$l+$countter]['sub_Name'],1,0,'L',1);

                    $pdf->SetFont('Arial','',8);
                    $pdf->SetXY(100,55.2+ $Y);
                    $pdf->Cell(20,5,$info['slips'][$l+$countter]['Date2'],1,0,'C',1);

                    $pdf->SetFont('Arial','',8);
                    $pdf->SetXY(120.1,55.2+ $Y);
                    $pdf->Cell(20,5,$info['slips'][$l+$countter]['Day'],1,0,'C',1);

                    $pdf->SetFont('Arial','',8);
                    $pdf->SetXY(140,55.2+ $Y);
                    $pdf->Cell(20,5, $info['slips'][$l+$countter]['TIME'],1,0,'C',1);


                }
            }

        }
        else
        {
            // DebugBreak();

            $Y = 18+ $Y;
        }
        $Y = 6+ $Y;
        // INSTRUCTION PICTURE 
        $pdf->SetXY(40.2,21.2);
        $pdf->Image("assets/img/Note.jpg",165.0,50.1, 40.65,$noteimageheight, "JPG");  

        $subcnt = @$info['slips'][0]['subp2count'] +@$info['slips'][$countter]['subp1count'];
        if($subcnt<=4)
        {
            $Y = 20+ $Y; 
        }

        // PRACTICAL BOX
        $tprcount = $countter+$countter9;
        $prcount = 0;
        $pathtml = '';
        $partsubhtml = '';
        if(@$info['slips'][$tprcount]['prcount'] > 0)
        {

            $Y = $Y + 1;
            $ispratical =1;
            $boxWidth = 195.0;
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(10.2,65.2+ $Y);
            $pdf->SetFillColor(240,240,240);
            $pdf->Cell($boxWidth,5,'PRACTICAL = PART - II',1,0,'C',1);
            $pdf->SetFillColor(255,255,255);
            $Y = $Y + 15;
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(10.2,55.2+ $Y);
            $pdf->Cell(8,5,'Sr#',1,0,'C',1);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(18.2,55.2+ $Y);
            $pdf->Cell(54,5,'Subject(S)',1,0,'C',1);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(72.2,55.2+ $Y);
            $pdf->Cell(94,5,'Laboratory',1,0,'C',1);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(166.2,55.2+ $Y);
            $pdf->Cell(15,5,'Date',1,0,'C',1);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(181.3,55.2+ $Y);
            $pdf->Cell(14,5,'Time',1,0,'C',1);

            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(195.1,55.2+ $Y);
            $pdf->Cell(10,5,'Batch',1,0,'C',1);
            $isthird = 0;
            $pdf->SetWidths(array(8,54,94,15,14,10));
            $pdf->SetFont('Arial','',7);
            for($l = 0; $l<$info['slips'][$tprcount]['prcount']; $l++) 
            { 
                $prcount++;
                if($l ==0)
                {
                    $Y = $Y +5;
                }
                else
                {
                    $lablen = strlen($info['slips'][$l+$tprcount]['lab_Name']);
                    // DebugBreak();
                    if($lablen>65 && $lablen<110)
                    {
                        $Y = $Y + 10.0;
                    }
                    else if($lablen>110)
                    {
                        $Y = $Y + 15.0; 
                        $isthird =1; 
                    }
                    else
                    {
                        $Y = $Y +5;   
                    }

                }
                $pdf->SetXY(10.2,55.2+ $Y);
                $pdf->Row(array($prcount,$info['slips'][$l+$tprcount]['sub_Name'],$info['slips'][$l+$tprcount]['lab_Name'],$info['slips'][$l+$tprcount]['Date2'],$info['slips'][$l+$tprcount]['TIME'],$info['slips'][$l+$tprcount]['batch']));


            }
        }


        if($isthird ==1)
            $Y = $Y+10;
        else 
            $Y = $Y+5;

        if($ispratical == 0)
        {
            $Y = 30+ $Y;  
        }
        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,65.2 + $Y);
        $pdf->Cell(0, 0.2, "Official Name:", 0.25, "C");

        $pdf->SetFont('Arial','BU',7);
        $pdf->SetXY(30.2,65.2 + $Y);
        $pdf->Cell(0, 0.2, $info['emp_cd'].'-'.$info['emp_name'], 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(90.2,65.2 + $Y);
        $pdf->Cell(0, 0.2, "Candidate's Signature: ", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(125.2,65.2 + $Y);
        $pdf->Cell(0, 0.2, "___________________ ", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(165.2,65.2 + $Y);
        $pdf->Cell(0, 0.2, "Printing Date:", 0.25, "C");

        $pdf->SetFont('Arial','U',9);
        $pdf->SetXY(185.2,65.2 + $Y);
        $pdf->Cell(0, 0.2, date('d-m-Y'), 0.25, "C");

        if($ispart1 == 0 && $isthird==0 )
        {
            $Y = 15+ $Y; 
        }

        // Roll no. box
        $rnostr = $info['Rno'];
        $rnostr1 = substr($rnostr,0,1);
        $rnostr2 = substr($rnostr,1,1);
        $rnostr3 = substr($rnostr,2,1);
        $rnostr4 = substr($rnostr,3,1);
        $rnostr5 = substr($rnostr,4,1);
        $rnostr6 = substr($rnostr,5,1);
        $boxWidth = 48;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10,70+ $Y);

        $pdf->Cell($boxWidth,5,'ROLL NO',1,0,'C',1);
        $pdf->SetFillColor(255,255,255);
        $Y = $Y + 20;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10,55+ $Y);
        $pdf->Cell(8,6,$rnostr1,1,0,'C',1);

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(18,55+ $Y);
        $pdf->Cell(8,6,$rnostr2,1,0,'C',1);

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(26,55+ $Y);
        $pdf->Cell(8,6,$rnostr3,1,0,'C',1);

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(34,55+ $Y);
        $pdf->Cell(8,6,$rnostr4,1,0,'C',1);

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(42,55+ $Y);
        $pdf->Cell(8,6,$rnostr5,1,0,'C',1);

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(50,55+ $Y);
        $pdf->Cell(8,6,$rnostr6,1,0,'C',1);


        $bubble0ps1 = '0.JPG';
        $bubble0ps2 = '0.JPG';
        $bubble0ps3 = '0.JPG';
        $bubble0ps4 = '0.JPG';
        $bubble0ps5 = '0.JPG';
        $bubble0ps6 = '0.JPG';

        $bubble1ps1 = '1.JPG';
        $bubble1ps2 = '1.JPG';
        $bubble1ps3 = '1.JPG';
        $bubble1ps4 = '1.JPG';
        $bubble1ps5 = '1.JPG';
        $bubble1ps6 = '1.JPG';

        $bubble2ps1 = '2.JPG';
        $bubble2ps2 = '2.JPG';
        $bubble2ps3 = '2.JPG';
        $bubble2ps4 = '2.JPG';
        $bubble2ps5 = '2.JPG';
        $bubble2ps6 = '2.JPG';

        $bubble3ps1 = '3.JPG';
        $bubble3ps2 = '3.JPG';
        $bubble3ps3 = '3.JPG';
        $bubble3ps4 = '3.JPG';
        $bubble3ps5 = '3.JPG';
        $bubble3ps6 = '3.JPG';

        $bubble4ps1 = '4.JPG';
        $bubble4ps2 = '4.JPG';
        $bubble4ps3 = '4.JPG';
        $bubble4ps4 = '4.JPG';
        $bubble4ps5 = '4.JPG';
        $bubble4ps6 = '4.JPG';

        $bubble5ps1 = '5.JPG';
        $bubble5ps2 = '5.JPG';
        $bubble5ps3 = '5.JPG';
        $bubble5ps4 = '5.JPG';
        $bubble5ps5 = '5.JPG';
        $bubble5ps6 = '5.JPG';

        $bubble6ps1 = '6.JPG';
        $bubble6ps2 = '6.JPG';
        $bubble6ps3 = '6.JPG';
        $bubble6ps4 = '6.JPG';
        $bubble6ps5 = '6.JPG';
        $bubble6ps6 = '6.JPG';

        $bubble7ps1 = '7.JPG';
        $bubble7ps2 = '7.JPG';
        $bubble7ps3 = '7.JPG';
        $bubble7ps4 = '7.JPG';
        $bubble7ps5 = '7.JPG';
        $bubble7ps6 = '7.JPG';

        $bubble8ps1 = '8.JPG';
        $bubble8ps2 = '8.JPG';
        $bubble8ps3 = '8.JPG';
        $bubble8ps4 = '8.JPG';
        $bubble8ps5 = '8.JPG';
        $bubble8ps6 = '8.JPG';

        $bubble9ps1 = '9.JPG';
        $bubble9ps2 = '9.JPG';
        $bubble9ps3 = '9.JPG';
        $bubble9ps4 = '9.JPG';
        $bubble9ps5 = '9.JPG';
        $bubble9ps6 = '9.JPG';

        //region for 0 bubbling 
        if($rnostr1 == 0) {
            $bubble0ps1 = 'bubble.JPG'; 
        }
        if($rnostr2 == 0)
        {
            $bubble0ps2 = 'bubble.JPG';
        }
        if($rnostr3 == 0)
        {
            $bubble0ps3 = 'bubble.JPG';
        }
        if($rnostr4 == 0)
        {
            $bubble0ps4 = 'bubble.JPG';
        }
        if($rnostr5 == 0)
        {
            $bubble0ps5 = 'bubble.JPG';
        }
        if($rnostr6 == 0)
        {
            $bubble0ps6 = 'bubble.JPG';
        }
        //endregion 

        // for 1 bubbling
        if($rnostr1 == 1) {
            $bubble1ps1 = 'bubble.JPG'; 
        }
        if($rnostr2 == 1)
        {
            $bubble1ps2 = 'bubble.JPG';
        }
        if($rnostr3 == 1)
        {
            $bubble1ps3 = 'bubble.JPG';
        }
        if($rnostr4 == 1)
        {
            $bubble1ps4 = 'bubble.JPG';
        }
        if($rnostr5 == 1)
        {
            $bubble1ps5 = 'bubble.JPG';
        }
        if($rnostr6 == 1)
        {
            $bubble1ps6 = 'bubble.JPG';
        }
        // end bubbling 1 

        // for 2 bubbling
        if($rnostr1 == 2) {
            $bubble2ps1 = 'bubble.JPG'; 
        }
        if($rnostr2 == 2)
        {
            $bubble2ps2 = 'bubble.JPG';
        }
        if($rnostr3 == 2)
        {
            $bubble2ps3 = 'bubble.JPG';
        }
        if($rnostr4 == 2)
        {
            $bubble2ps4 = 'bubble.JPG';
        }
        if($rnostr5 == 2)
        {
            $bubble2ps5 = 'bubble.JPG';
        }
        if($rnostr6 == 2)
        {
            $bubble2ps6 = 'bubble.JPG';
        }
        // end bubbling 2 

        // for 3 bubbling
        if($rnostr1 == 3) {
            $bubble3ps1 = 'bubble.JPG'; 
        }
        if($rnostr2 == 3)
        {
            $bubble3ps2 = 'bubble.JPG';
        }
        if($rnostr3 == 3)
        {
            $bubble3ps3 = 'bubble.JPG';
        }
        if($rnostr4 == 3)
        {
            $bubble3ps4 = 'bubble.JPG';
        }
        if($rnostr5 == 3)
        {
            $bubble3ps5 = 'bubble.JPG';
        }
        if($rnostr6 == 3)
        {
            $bubble3ps6 = 'bubble.JPG';
        }
        // end bubbling 3 


        // for 4 bubbling
        if($rnostr1 == 4) {
            $bubble4ps1 = 'bubble.JPG'; 
        }
        if($rnostr2 == 4)
        {
            $bubble4ps2 = 'bubble.JPG';
        }
        if($rnostr3 == 4)
        {
            $bubble4ps3 = 'bubble.JPG';
        }
        if($rnostr4 == 4)
        {
            $bubble4ps4 = 'bubble.JPG';
        }
        if($rnostr5 == 4)
        {
            $bubble4ps5 = 'bubble.JPG';
        }
        if($rnostr6 == 4)
        {
            $bubble4ps6 = 'bubble.JPG';
        }
        // end bubbling 4 

        // for 5 bubbling
        if($rnostr1 == 5) {
            $bubble5ps1 = 'bubble.JPG'; 
        }
        if($rnostr2 == 5)
        {
            $bubble5ps2 = 'bubble.JPG';
        }
        if($rnostr3 == 5)
        {
            $bubble5ps3 = 'bubble.JPG';
        }
        if($rnostr4 == 5)
        {
            $bubble5ps4 = 'bubble.JPG';
        }
        if($rnostr5 == 5)
        {
            $bubble5ps5 = 'bubble.JPG';
        }
        if($rnostr6 == 5)
        {
            $bubble5ps6 = 'bubble.JPG';
        }
        // end bubbling 5 

        // for 6 bubbling
        if($rnostr1 == 6) {
            $bubble6ps1 = 'bubble.JPG'; 
        }
        if($rnostr2 == 6)
        {
            $bubble6ps2 = 'bubble.JPG';
        }
        if($rnostr3 == 6)
        {
            $bubble6ps3 = 'bubble.JPG';
        }
        if($rnostr4 == 6)
        {
            $bubble6ps4 = 'bubble.JPG';
        }
        if($rnostr5 == 6)
        {
            $bubble6ps5 = 'bubble.JPG';
        }
        if($rnostr6 == 6)
        {
            $bubble6ps6 = 'bubble.JPG';
        }
        // end bubbling 6 


        // for 7 bubbling
        if($rnostr1 == 7) {
            $bubble7ps1 = 'bubble.JPG'; 
        }
        if($rnostr2 == 7)
        {
            $bubble7ps2 = 'bubble.JPG';
        }
        if($rnostr3 == 7)
        {
            $bubble7ps3 = 'bubble.JPG';
        }
        if($rnostr4 == 7)
        {
            $bubble7ps4 = 'bubble.JPG';
        }
        if($rnostr5 == 7)
        {
            $bubble7ps5 = 'bubble.JPG';
        }
        if($rnostr6 == 7)
        {
            $bubble7ps6 = 'bubble.JPG';
        }
        // end bubbling 7 

        // for 8 bubbling
        if($rnostr1 == 8) {
            $bubble8ps1 = 'bubble.JPG'; 
        }
        if($rnostr2 == 8)
        {
            $bubble8ps2 = 'bubble.JPG';
        }
        if($rnostr3 == 8)
        {
            $bubble8ps3 = 'bubble.JPG';
        }
        if($rnostr4 == 8)
        {
            $bubble8ps4 = 'bubble.JPG';
        }
        if($rnostr5 == 8)
        {
            $bubble8ps5 = 'bubble.JPG';
        }
        if($rnostr6 == 8)
        {
            $bubble8ps6 = 'bubble.JPG';
        }
        // end bubbling 8 

        // for 9 bubbling
        if($rnostr1 == 9) {
            $bubble9ps1 = 'bubble.JPG'; 
        }
        if($rnostr2 == 9)
        {
            $bubble9ps2 = 'bubble.JPG';
        }
        if($rnostr3 == 9)
        {
            $bubble9ps3 = 'bubble.JPG';
        }
        if($rnostr4 == 9)
        {
            $bubble9ps4 = 'bubble.JPG';
        }
        if($rnostr5 == 9)
        {
            $bubble9ps5 = 'bubble.JPG';
        }
        if($rnostr6 == 9)
        {
            $bubble9ps6 = 'bubble.JPG';
        }

        $Y = $Y + 6;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = 6;
        $imagex = 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(12 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(14 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(34,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(42,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(50,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $Y = $Y + 6;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = 6;
        $imagex = 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(12 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(14 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(34,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(42,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(50,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $Y = $Y + 6;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = 6;
        $imagex = 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(12 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(14 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(34,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(42,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(50,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $Y = $Y + 6;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = 6;
        $imagex = 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(12 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(14 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(34,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(42,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(50,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $Y = $Y + 6;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = 6;
        $imagex = 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(12 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(14 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(34,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(42,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(50,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $Y = $Y + 6;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = 6;
        $imagex = 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(12 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(14 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(34,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(42,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(50,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $Y = $Y + 6;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = 6;
        $imagex = 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(12 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(14 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(34,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(42,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(50,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $Y = $Y + 6;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = 6;
        $imagex = 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(12 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(14 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(34,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(42,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(50,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $Y = $Y + 6;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = 6;
        $imagex = 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(12 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(14 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(34,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(42,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(50,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $Y = $Y + 6;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = 6;
        $imagex = 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(12 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(14 + $cellx,55+ $Y);
        //$pdf->Cell(8,5,'4',1,0,'C',1);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(34,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(42,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

        $cellx = $cellx +6;
        $imagex = $imagex + 8;
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(50,55+ $Y);
        $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );


        $pdf->Image("assets/img/256(10thPrivate)Final.JPG",60.0, $Y-12, 147.65,72.65, "JPG");  
        $pdf->Image("assets/img/isnt1_converted.png",45.0, $Y+63, 160.65,9, "png");  
        // $pdf->Image("assets/img/headsign.jpg",10.0,258, 72,24, "JPG");  
        //  $pdf->Image("assets/img/headsign.jpg",10.0,267, 82,15, "JPG");  

        // 
        $pdf->Image("assets/img/Note3.jpg",10.0,262, 145,23, "JPG"); 
        $pdf->SetFont('Arial','',8);
        $pdf->Image(CESIGN,170.0,258, 30,30, "PNG");  
        $pdf->SetXY(160,288);
        $pdf->Cell(0, 0.2, "CONTROLLER OF EXAMINATIONS", 0.25, "C");


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
        $store_image = imagepng($file,"./assets/pdfs/{$code}.png");
        return $code.'.png';

    }
    public function Get9thpvtRSlip()
    {
        // DebugBreak()  ;
        $this->load->helper('url');
        $sess=Session;
        $class =9;
        $year=Year;
        $stdName = $_POST["std_name"];
        $Fname =   $_POST["fath_name"];
        $Fnic = $_POST["fnic"];
        $FormNo = $_POST["form_no"];
        $rno = $_POST["cur_exm_roll_no"];

        $this->load->model('RollNoSlip_model');
        $studeninfo = array('data'=>$this->RollNoSlip_model->getPVT9thrslip($stdName,$Fname,$Fnic,$rno,$FormNo,$class,$year,$sess));
        if($studeninfo['data'] == 0)
        {
            $datamsg = array(
                'message' => 'Record Not Found',
            );  
            $this->load->view('Privateslips/9thpvtSlip.php',$datamsg);
        }
        else
        {
            $rno = $studeninfo['data']['info'][0]['Rno'];

            //   echo '<pre>'; print_r($studeninfo['data']['info']); eixt();
            $filepath = $studeninfo['data']['info'][0]['picpath'];

            // echo $filepath;
            // exit();

            //  $filepath = 'assets/img/download.jpg';
            $isexists = file_exists($filepath);
            if(!$isexists)
            {
                $datamsg = array(
                    'message' => 'Picture Not Exists.',
                );  
                $this->load->view('Privateslips/9thpvtSlip.php',$datamsg);
            }
            else{
                $temp = "$rno@$class@$sess@$year";
                // $image =  $this->set_barcode($temp);
                $studeninfo['data']['info'][0]['barcode'] = $temp;
                $this->load->library('PDFFWithOutPage');
                $pdf=new PDFFWithOutPage('P','in',"A4");   
                $pdf->SetAutoPageBreak(true,2);

                $pdf->AddPage();
                //$html = $this->load->view('Privateslips/MatricRollNo', $studeninfo['data']['info'][0], true);   
                $this->makepdf9thclass($pdf, $studeninfo['data']['info'][0]);
                // $pdf->writeHTML($html, true, false, true, false, '');  
                $pdf->Output($rno.'.pdf', 'I');  
            }


        }



    }
    private function makepdf9thclass($pdf,$info)
    {

        if($info['Session'] ==1) $Session= 'ANNUAL'; else $Session='SUPPLY';
        if($info['errmessage'] == null || $info['errmessage'] == '') {$errmessage = '(PROVISIONALLY)' ;} else{ $errmessage = '(PROVISIONALLY OBJECTION SLIP)';};
        $errmessage = '(PROVISIONALLY)';

        if($info['grp_cd'] == 1)  $grp_cd = 'SCIENCE'; else if($info['grp_cd'] == 2) $grp_cd='GENERAL' ;else if($info['grp_cd'] == 5) $grp_cd='DEAF & DEFECTIVE';;
        if($info['Gender']==1) $Gender= 'MALE'; else if($info['Gender']==2) $Gender= 'FEMALE';
            $filepath = $info['picpath'];
        // $filepath = 'assets/img/download.jpg';



        $fontSize = 8; 
        $marge    = .42;   // between barcode and hri in pixel
        $bx        = 143.97;  // barcode center
        $by        = 18.75;  // barcode center
        $height   = 5.65;   // barcode height in 1D ; module size in 2D
        $width    = .219;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $code     = '222020';     // barcode (CP852 encoding for Polish and other Central European languages)
        $type     = 'code128';
        $black    = '000000'; // color in hex
        $Y = 3;
        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(22.2,7.2);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");
        // $pdf->SetFont('Arial','R',10);
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(26.2,10.9);
        $pdf->Cell(0, 0.2, "ROLL NUMBER SLIP (WITH DATE SHEET) FOR 9th $Session EXAMINATION, ".$info["Year"], 0.25, "C");  

        $pdf->Image("assets/img/icon2.png",5.0,3.0, 20.65,18.65, "PNG");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(73,15.2);
        $pdf->Cell(0, 0.2, $errmessage, 0.25, "C"); 

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(65,18.8);
        $pdf->Cell(0, 0.2, '(FOR PRIVATE CANDIDATES)', 0.25, "C"); 

        $pdf->SetXY(40.2,21.2);
        // $pdf->Image("uploads/pdfs/".$info['barcode'],126.0,15.1, 43.65,5.65, "PNG");  
        $Barcode = $info['barcode'];

        $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

        $len = $pdf->GetStringWidth($bardata['hri']);
        Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);



        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(138.0,26.1);
        $pdf->Cell(0, 0.2, $grp_cd, 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(172.2,13.2);
        $pdf->Cell(0, 0.2, "FormNo: ", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(185.2,13.2);
        $pdf->Cell(0, 0.2, $info['formno'], 0.25, "C");


        $pdf->SetXY(40.2,21.2);
        $pdf->Image($filepath,173.0,15.1, 30.65,30.65, "jpg");  

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(182.2,48.2);
        $pdf->Cell(0, 0.2, $Gender, 0.25, "C");


        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,21.2);
        $pdf->Cell(0, 0.2, "ROLL NO.               :", 0.25, "C");


        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(40.9,14.2+ $Y);
        $pdf->Cell(14.5,6.2,'',1,0,'C',0); 
        $pdf->SetXY(40.8,17.4+ $Y);
        $pdf->Cell(0, 0.2, $info['Rno'], 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,23.2 + + $Y);
        $pdf->Cell(0, 0.2, "NAME                      :", 0.25, "C");


        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,23.2+ $Y);
        $pdf->Cell(0, 0.2, $info['Name'], 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,28.2+ $Y);
        $pdf->Cell(0, 0.2, "FATHER'S NAME    :", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,28.2+ $Y);
        $pdf->Cell(0, 0.2, $info['FathersName'], 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,33.2+ $Y);
        $pdf->Cell(0, 0.2, "DATE OF BIRTH     :", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,33.2+ $Y);
        $pdf->Cell(0, 0.2, $info['DOB'], 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,38.2+ $Y);
        $pdf->Cell(0, 0.2, "CENTER                  :", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(40.2,36.2+ $Y);
        $pdf->MultiCell(130, 5, $info['cent_cd'].'-'.$info['Cent_Name'],0);

        $countter = 0;
        $countter9 = 0;
        $noteimageheight =62; 
        if($info['errmessage'] == null) 
        {
            // THEOROR PART I SUBJECT TABLE
            if(@$info['slips'][$countter]['subp1count'] > 0)
            {
                $boxWidth = 150.0;
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(10.2,54.2+ $Y);
                $pdf->SetFillColor(240,240,240);
                $pdf->Cell($boxWidth,8,'THEORY PART - I',1,0,'C',1);
                $pdf->SetFillColor(255,255,255);
                //Table cell Global varibales;
                $Y = $Y + 7.2;
                $cellheight = 7;
                $font = 8;

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(10.2,55.2+ $Y);
                $pdf->Cell(8,$cellheight,'Sr#',1,0,'C',1);

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(18.2,55.2+ $Y);
                $pdf->Cell(85,$cellheight,'SUBJECT(S)',1,0,'C',1);

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(100,55.2+ $Y);
                $pdf->Cell(20,$cellheight,'DATE',1,0,'C',1);

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(120.1,55.2+ $Y);
                $pdf->Cell(20,$cellheight,'DAY',1,0,'C',1);

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(140,55.2+ $Y);
                $pdf->Cell(20,$cellheight,'TIME',1,0,'C',1);

                if(@$info['slips'][$countter]['subp1count'] >4)
                    $noteimageheight = $noteimageheight+13;
                for($l = 0; $l<$info['slips'][$countter]['subp1count']; $l++) { 
                    if($info['slips'][$l+$countter]['class'] == 9) {
                        $countter9++;

                        $Y = $Y + $cellheight;

                        $pdf->SetFont('Arial','',$font);
                        $pdf->SetXY(10.2,55.2+ $Y);
                        $pdf->Cell(8,$cellheight,$countter9,1,0,'C',1);

                        $pdf->SetFont('Arial','',$font);
                        $pdf->SetXY(18.2,55.2+ $Y);
                        $pdf->Cell(85,$cellheight,$info['slips'][$l+$countter]['sub_Name'],1,0,'L',1);

                        $pdf->SetFont('Arial','',$font);
                        $pdf->SetXY(100,55.2+ $Y);
                        $pdf->Cell(20,$cellheight,$info['slips'][$l+$countter]['Date2'],1,0,'C',1);

                        $pdf->SetFont('Arial','',$font);
                        $pdf->SetXY(120.1,55.2+ $Y);
                        $pdf->Cell(20,$cellheight,$info['slips'][$l+$countter]['Day'],1,0,'C',1);

                        $pdf->SetFont('Arial','',$font);
                        $pdf->SetXY(140,55.2+ $Y);
                        $pdf->Cell(20,$cellheight, $info['slips'][$l+$countter]['TIME'],1,0,'C',1);


                    }
                }

            }
            else
            {
                $Y = 18+ $Y;
            }
            // INSTRUCTION PICTURE 
            $pdf->SetXY(40.2,21.2);
            $pdf->Image("assets/img/Note.jpg",165.0,57.1, 40.65,$noteimageheight, "JPG");  

            $Y = 8+ $Y;

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(10.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "Official Name:", 0.25, "C");

            $pdf->SetFont('Arial','BU',7);
            $pdf->SetXY(30.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, $info['emp_cd'].'-'.$info['emp_name'], 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(90.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "Candidate's Signature: ", 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(125.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "___________________ ", 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(165.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "Printing Date:", 0.25, "C");

            $pdf->SetFont('Arial','U',9);
            $pdf->SetXY(185.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, date('d-m-Y'), 0.25, "C");

            $Y = 5+ $Y;
            // Roll no. box
            $rnostr = $info['Rno'];
            $rnostr1 = substr($rnostr,0,1);
            $rnostr2 = substr($rnostr,1,1);
            $rnostr3 = substr($rnostr,2,1);
            $rnostr4 = substr($rnostr,3,1);
            $rnostr5 = substr($rnostr,4,1);
            $rnostr6 = substr($rnostr,5,1);
            $boxWidth = 48;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,70+ $Y);

            $pdf->Cell($boxWidth,5,'ROLL NO',1,0,'C',1);
            $pdf->SetFillColor(255,255,255);
            $Y = $Y + 20;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell(8,6,$rnostr1,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(18,55+ $Y);
            $pdf->Cell(8,6,$rnostr2,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(26,55+ $Y);
            $pdf->Cell(8,6,$rnostr3,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell(8,6,$rnostr4,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell(8,6,$rnostr5,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell(8,6,$rnostr6,1,0,'C',1);


            $bubble0ps1 = '0.JPG';
            $bubble0ps2 = '0.JPG';
            $bubble0ps3 = '0.JPG';
            $bubble0ps4 = '0.JPG';
            $bubble0ps5 = '0.JPG';
            $bubble0ps6 = '0.JPG';

            $bubble1ps1 = '1.JPG';
            $bubble1ps2 = '1.JPG';
            $bubble1ps3 = '1.JPG';
            $bubble1ps4 = '1.JPG';
            $bubble1ps5 = '1.JPG';
            $bubble1ps6 = '1.JPG';

            $bubble2ps1 = '2.JPG';
            $bubble2ps2 = '2.JPG';
            $bubble2ps3 = '2.JPG';
            $bubble2ps4 = '2.JPG';
            $bubble2ps5 = '2.JPG';
            $bubble2ps6 = '2.JPG';

            $bubble3ps1 = '3.JPG';
            $bubble3ps2 = '3.JPG';
            $bubble3ps3 = '3.JPG';
            $bubble3ps4 = '3.JPG';
            $bubble3ps5 = '3.JPG';
            $bubble3ps6 = '3.JPG';

            $bubble4ps1 = '4.JPG';
            $bubble4ps2 = '4.JPG';
            $bubble4ps3 = '4.JPG';
            $bubble4ps4 = '4.JPG';
            $bubble4ps5 = '4.JPG';
            $bubble4ps6 = '4.JPG';

            $bubble5ps1 = '5.JPG';
            $bubble5ps2 = '5.JPG';
            $bubble5ps3 = '5.JPG';
            $bubble5ps4 = '5.JPG';
            $bubble5ps5 = '5.JPG';
            $bubble5ps6 = '5.JPG';

            $bubble6ps1 = '6.JPG';
            $bubble6ps2 = '6.JPG';
            $bubble6ps3 = '6.JPG';
            $bubble6ps4 = '6.JPG';
            $bubble6ps5 = '6.JPG';
            $bubble6ps6 = '6.JPG';

            $bubble7ps1 = '7.JPG';
            $bubble7ps2 = '7.JPG';
            $bubble7ps3 = '7.JPG';
            $bubble7ps4 = '7.JPG';
            $bubble7ps5 = '7.JPG';
            $bubble7ps6 = '7.JPG';

            $bubble8ps1 = '8.JPG';
            $bubble8ps2 = '8.JPG';
            $bubble8ps3 = '8.JPG';
            $bubble8ps4 = '8.JPG';
            $bubble8ps5 = '8.JPG';
            $bubble8ps6 = '8.JPG';

            $bubble9ps1 = '9.JPG';
            $bubble9ps2 = '9.JPG';
            $bubble9ps3 = '9.JPG';
            $bubble9ps4 = '9.JPG';
            $bubble9ps5 = '9.JPG';
            $bubble9ps6 = '9.JPG';

            //region for 0 bubbling 
            if($rnostr1 == 0) {
                $bubble0ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 0)
            {
                $bubble0ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 0)
            {
                $bubble0ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 0)
            {
                $bubble0ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 0)
            {
                $bubble0ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 0)
            {
                $bubble0ps6 = 'bubble.JPG';
            }
            //endregion 

            // for 1 bubbling
            if($rnostr1 == 1) {
                $bubble1ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 1)
            {
                $bubble1ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 1)
            {
                $bubble1ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 1)
            {
                $bubble1ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 1)
            {
                $bubble1ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 1)
            {
                $bubble1ps6 = 'bubble.JPG';
            }
            // end bubbling 1 

            // for 2 bubbling
            if($rnostr1 == 2) {
                $bubble2ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 2)
            {
                $bubble2ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 2)
            {
                $bubble2ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 2)
            {
                $bubble2ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 2)
            {
                $bubble2ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 2)
            {
                $bubble2ps6 = 'bubble.JPG';
            }
            // end bubbling 2 

            // for 3 bubbling
            if($rnostr1 == 3) {
                $bubble3ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 3)
            {
                $bubble3ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 3)
            {
                $bubble3ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 3)
            {
                $bubble3ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 3)
            {
                $bubble3ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 3)
            {
                $bubble3ps6 = 'bubble.JPG';
            }
            // end bubbling 3 


            // for 4 bubbling
            if($rnostr1 == 4) {
                $bubble4ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 4)
            {
                $bubble4ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 4)
            {
                $bubble4ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 4)
            {
                $bubble4ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 4)
            {
                $bubble4ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 4)
            {
                $bubble4ps6 = 'bubble.JPG';
            }
            // end bubbling 4 

            // for 5 bubbling
            if($rnostr1 == 5) {
                $bubble5ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 5)
            {
                $bubble5ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 5)
            {
                $bubble5ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 5)
            {
                $bubble5ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 5)
            {
                $bubble5ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 5)
            {
                $bubble5ps6 = 'bubble.JPG';
            }
            // end bubbling 5 

            // for 6 bubbling
            if($rnostr1 == 6) {
                $bubble6ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 6)
            {
                $bubble6ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 6)
            {
                $bubble6ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 6)
            {
                $bubble6ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 6)
            {
                $bubble6ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 6)
            {
                $bubble6ps6 = 'bubble.JPG';
            }
            // end bubbling 6 


            // for 7 bubbling
            if($rnostr1 == 7) {
                $bubble7ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 7)
            {
                $bubble7ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 7)
            {
                $bubble7ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 7)
            {
                $bubble7ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 7)
            {
                $bubble7ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 7)
            {
                $bubble7ps6 = 'bubble.JPG';
            }
            // end bubbling 7 

            // for 8 bubbling
            if($rnostr1 == 8) {
                $bubble8ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 8)
            {
                $bubble8ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 8)
            {
                $bubble8ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 8)
            {
                $bubble8ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 8)
            {
                $bubble8ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 8)
            {
                $bubble8ps6 = 'bubble.JPG';
            }
            // end bubbling 8 

            // for 9 bubbling
            if($rnostr1 == 9) {
                $bubble9ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 9)
            {
                $bubble9ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 9)
            {
                $bubble9ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 9)
            {
                $bubble9ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 9)
            {
                $bubble9ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 9)
            {
                $bubble9ps6 = 'bubble.JPG';
            }

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $pdf->Image("assets/img/256(10thPrivate)Final.JPG",60.0, $Y-14, 147.65,78.65, "JPG");  


            $pdf->Image("assets/img/isnt1_converted.png",45.0, $Y+65, 160.65,7, "png");  

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,78+ $Y);
            $pdf->Cell( 0,0, 'Bind - Sr No: '.$info['BindNo'].' - '.$info['SrNo'], 0, 0, 'C', false );


            $pdf->Image(CESIGN,170.0,234, 30,30, "PNG"); 
            $pdf->Image("assets/img/NoteForMatric_I.jpg",10.0,243, 145,30, "JPG"); 
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(158,267);
            $pdf->Cell(0, 0.2, "CONTROLLER OF EXAMINATIONS", 0.25, "C");     
        }

        else
        {
            $message = 'Slip is not issued due to '.$info['errmessage'];
            $pdf->SetFont('Arial','B',16);

            $pdf->SetTextColor(255 ,0,0);
            $pdf->SetXY(20,60);
            $pdf->MultiCell(195, 6,$message, 0, "L",0);   
        }
    }
    public function Get11thpvtRSlip()
    {
        //DebugBreak()  ;
        $this->load->helper('url');
        $sess=1;
        $class =11;
        $year=2016;
        $stdName = $_POST["std_name"];
        $Fname =   $_POST["fath_name"];
        $Fnic = $_POST["fnic"];
        $FormNo = $_POST["form_no"];
        $rno = $_POST["cur_exm_roll_no"];

        $this->load->model('RollNoSlip_model');
        $studeninfo = array('data'=>$this->RollNoSlip_model->getPVT11thrslip($stdName,$Fname,$Fnic,$rno,$FormNo,$class,$year,$sess));
        if($studeninfo['data'] == 0)
        {
            $datamsg = array(
                'message' => 'Record Not Found',
            );  
            $this->load->view('Privateslips/11thpvtSlip.php',$datamsg);
        }
        else
        {
            $rno = $studeninfo['data']['info'][0]['Rno'];

            // $filepath = 'assets/'.$studeninfo['data']['info'][0]['picpath'];

            //  DebugBreak();
            $filepath = 'assets/img/download.jpg';
            $isexists = file_exists($filepath);
            if(!$isexists)
            {
                $datamsg = array(
                    'message' => 'Picture Not Exists.',
                );  
                $this->load->view('Privateslips/11thpvtSlip.php',$datamsg);
            }
            else{
                $temp = "$rno@$class@$sess@$year";
                $image =  $this->set_barcode($temp);
                $studeninfo['data']['info'][0]['barcode'] = $image;
                $this->load->library('PDFF');
                $pdf=new PDFF('P','in',"A4");   
                $pdf->SetAutoPageBreak(true,2);

                $pdf->AddPage();
                //$html = $this->load->view('Privateslips/MatricRollNo', $studeninfo['data']['info'][0], true);   
                $this->makepdf11thclass($pdf, $studeninfo['data']['info'][0]);
                // $pdf->writeHTML($html, true, false, true, false, '');  
                $pdf->Output($rno.'.pdf', 'I');  
            }


        }



    }
    private function makepdf11thclass($pdf,$info)
    {

        if($info['Session'] ==1) $Session= 'ANNUAL'; else $Session='SUPPLY';
        if($info['errmessage'] == null)  $errmessage = '(PROVISIONALLY)'; else{ $errmessage = ' (PROVISIONALLY OBJECTION SLIP)';};
        // else

        if($info['grp_cd'] == 1)  $grp_cd = 'PRE-MEDICAL';
        else if($info['grp_cd'] == 2) $grp_cd='PRE-ENGINEERING';
            else if($info['grp_cd'] == 3) $grp_cd='HUMANITIES';
                else if($info['grp_cd'] == 4) $grp_cd='GENERAL SCIENCE';
                    else if($info['grp_cd'] == 5) $grp_cd='COMMERCE';
                        else if($info['grp_cd'] == 6) $grp_cd='ISLAMIC STUDIES';
                            else if($info['grp_cd'] == 7) $grp_cd='HOME ECONOMICS';
                                else if($info['grp_cd'] == 8) $grp_cd='MEDICAL TECHNOLGY';
                                    else if($info['grp_cd'] == 9) $grp_cd='ALOOM-E-SHARQIA';
                                        else if($info['grp_cd'] == 10) $grp_cd='KHASA';
                                            else if($info['grp_cd'] == 11) $grp_cd='FAZAL';
                                                if($info['Gender']==1) $Gender= 'MALE'; else if($info['Gender']==2) $Gender= 'FEMALE';
            $filepath = 'assets/'.$info['picpath'];
        //$filepath = 'assets/img/download.jpg';


        $fontSize = 8; 
        $marge    = .4;   // between barcode and hri in pixel
        $bx        = 3.97;  // barcode center
        $by        = .75;  // barcode center
        $height   = 0.35;   // barcode height in 1D ; module size in 2D
        $width    = .0135;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $code     = '222020';     // barcode (CP852 encoding for Polish and other Central European languages)
        $type     = 'code128';
        $black    = '000000'; // color in hex
        $Y = 3;
        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(22.2,7.2);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");
        // $pdf->SetFont('Arial','R',10);
        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(26.2,10.9);
        $pdf->Cell(0, 0.2, "ROLL NUMBER SLIP (WITH DATE SHEET) FOR INTER PART-I $Session EXAMINATION, ".$info["Year"], 0.25, "C");  

        $pdf->Image("assets/img/icon2.png",5.0,3.0, 20.65,18.65, "PNG");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(68,15.2);
        $pdf->Cell(0, 0.2, $errmessage, 0.25, "C"); 

        $pdf->SetXY(40.2,21.2);
        $pdf->Image("assets/pdfs/".$info['barcode'],126.0,15.1, 43.65,5.65, "PNG");  

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(138.0,26.1);
        $pdf->Cell(0, 0.2, $grp_cd, 0.25, "C");

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(133.0,31.1);
        $pdf->Cell(29.5,6.2,'',1,0,'C',0); 
        $pdf->SetXY(133.0,34.1);
        $pdf->Cell(0, 0.2, "SCHEME = NEW", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(172.2,13.2);
        $pdf->Cell(0, 0.2, "FormNo: ", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(185.2,13.2);
        $pdf->Cell(0, 0.2, $info['formno'], 0.25, "C");


        $pdf->SetXY(40.2,21.2);
        $pdf->Image($filepath,173.0,15.1, 30.65,30.65, "jpg");  

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(182.2,48.2);
        $pdf->Cell(0, 0.2, $Gender, 0.25, "C");


        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,21.2);
        $pdf->Cell(0, 0.2, "ROLL NO.               :", 0.25, "C");


        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(40.9,14.2+ $Y);
        $pdf->Cell(14.5,6.2,'',1,0,'C',0); 
        $pdf->SetXY(40.8,17.4+ $Y);
        $pdf->Cell(0, 0.2, $info['Rno'], 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,23.2 + + $Y);
        $pdf->Cell(0, 0.2, "NAME                      :", 0.25, "C");


        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,23.2+ $Y);
        $pdf->Cell(0, 0.2, $info['Name'], 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,28.2+ $Y);
        $pdf->Cell(0, 0.2, "FATHER'S NAME    :", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,28.2+ $Y);
        $pdf->Cell(0, 0.2, $info['FathersName'], 0.25, "C");

        /* $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,33.2+ $Y);
        $pdf->Cell(0, 0.2, "DATE OF BIRTH     :", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(40.2,33.2+ $Y);
        $pdf->Cell(0, 0.2, $info['DOB'], 0.25, "C");*/

        if($info['errmessage'] == null) 
        {
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10.2,38.2+ $Y);
            $pdf->Cell(0, 0.2, "CENTRE                  :", 0.25, "C");

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(40.2,36.2+ $Y);
            $pdf->MultiCell(130, 5, $info['cent_cd'].'-'.$info['Cent_Name'],0);

            $countter = 0;
            $countter9 = 0;
            $noteimageheight =62; 
            // THEOROR PART I SUBJECT TABLE
            if(@$info['slips'][$countter]['subp1count'] > 0)
            {
                $boxWidth = 150.0;
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(10.2,54.2+ $Y);
                $pdf->SetFillColor(240,240,240);
                $pdf->Cell($boxWidth,8,'PART - I',1,0,'C',1);
                $pdf->SetFillColor(255,255,255);
                //Table cell Global varibales;
                $Y = $Y + 7.2;
                $cellheight = 7;
                $font = 8;

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(10.2,55.2+ $Y);
                $pdf->Cell(8,$cellheight,'Sr#',1,0,'C',1);

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(18.2,55.2+ $Y);
                $pdf->Cell(85,$cellheight,'SUBJECT(S)',1,0,'C',1);

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(100,55.2+ $Y);
                $pdf->Cell(20,$cellheight,'DATE',1,0,'C',1);

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(120.1,55.2+ $Y);
                $pdf->Cell(20,$cellheight,'DAY',1,0,'C',1);

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(140,55.2+ $Y);
                $pdf->Cell(20,$cellheight,'TIME',1,0,'C',1);

                if(@$info['slips'][$countter]['subp1count'] >4)
                    $noteimageheight = $noteimageheight+13;
                for($l = 0; $l<$info['slips'][$countter]['subp1count']; $l++) { 
                    if($info['slips'][$l+$countter]['class'] == 11) {
                        $countter9++;

                        $Y = $Y + $cellheight;

                        $pdf->SetFont('Arial','',$font);
                        $pdf->SetXY(10.2,55.2+ $Y);
                        $pdf->Cell(8,$cellheight,$countter9,1,0,'C',1);

                        $pdf->SetFont('Arial','',$font);
                        $pdf->SetXY(18.2,55.2+ $Y);
                        $pdf->Cell(85,$cellheight,$info['slips'][$l+$countter]['sub_Name'],1,0,'L',1);

                        $pdf->SetFont('Arial','',$font);
                        $pdf->SetXY(100,55.2+ $Y);
                        $pdf->Cell(20,$cellheight,$info['slips'][$l+$countter]['Date2'],1,0,'C',1);

                        $pdf->SetFont('Arial','',$font);
                        $pdf->SetXY(120.1,55.2+ $Y);
                        $pdf->Cell(20,$cellheight,$info['slips'][$l+$countter]['Day'],1,0,'C',1);

                        $pdf->SetFont('Arial','',$font);
                        $pdf->SetXY(140,55.2+ $Y);
                        $pdf->Cell(20,$cellheight, $info['slips'][$l+$countter]['TIME'],1,0,'C',1);


                    }
                }

            }
            else
            {
                $Y = 18+ $Y;
            }
            // INSTRUCTION PICTURE 
            $pdf->SetXY(40.2,21.2);
            $pdf->Image("assets/img/Note_inter.jpg",165.0,57.1, 40.65,$noteimageheight, "JPG");  

            $Y = 18+ $Y;

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(10.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "Official Name:", 0.25, "C");

            $pdf->SetFont('Arial','BU',7);
            $pdf->SetXY(30.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, $info['emp_cd'].'-'.$info['emp_name'], 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(90.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "Candidate's Signature: ", 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(125.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "___________________ ", 0.25, "C");

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(165.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, "Printing Date:", 0.25, "C");

            $pdf->SetFont('Arial','U',9);
            $pdf->SetXY(185.2,65.2 + $Y);
            $pdf->Cell(0, 0.2, date('d-m-Y'), 0.25, "C");

            $Y = 5+ $Y;
            // Roll no. box
            $rnostr = $info['Rno'];
            $rnostr1 = substr($rnostr,0,1);
            $rnostr2 = substr($rnostr,1,1);
            $rnostr3 = substr($rnostr,2,1);
            $rnostr4 = substr($rnostr,3,1);
            $rnostr5 = substr($rnostr,4,1);
            $rnostr6 = substr($rnostr,5,1);
            $boxWidth = 48;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,70+ $Y);

            $pdf->Cell($boxWidth,5,'ROLL NO',1,0,'C',1);
            $pdf->SetFillColor(255,255,255);
            $Y = $Y + 20;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell(8,6,$rnostr1,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(18,55+ $Y);
            $pdf->Cell(8,6,$rnostr2,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(26,55+ $Y);
            $pdf->Cell(8,6,$rnostr3,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell(8,6,$rnostr4,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell(8,6,$rnostr5,1,0,'C',1);

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell(8,6,$rnostr6,1,0,'C',1);


            $bubble0ps1 = '0.JPG';
            $bubble0ps2 = '0.JPG';
            $bubble0ps3 = '0.JPG';
            $bubble0ps4 = '0.JPG';
            $bubble0ps5 = '0.JPG';
            $bubble0ps6 = '0.JPG';

            $bubble1ps1 = '1.JPG';
            $bubble1ps2 = '1.JPG';
            $bubble1ps3 = '1.JPG';
            $bubble1ps4 = '1.JPG';
            $bubble1ps5 = '1.JPG';
            $bubble1ps6 = '1.JPG';

            $bubble2ps1 = '2.JPG';
            $bubble2ps2 = '2.JPG';
            $bubble2ps3 = '2.JPG';
            $bubble2ps4 = '2.JPG';
            $bubble2ps5 = '2.JPG';
            $bubble2ps6 = '2.JPG';

            $bubble3ps1 = '3.JPG';
            $bubble3ps2 = '3.JPG';
            $bubble3ps3 = '3.JPG';
            $bubble3ps4 = '3.JPG';
            $bubble3ps5 = '3.JPG';
            $bubble3ps6 = '3.JPG';

            $bubble4ps1 = '4.JPG';
            $bubble4ps2 = '4.JPG';
            $bubble4ps3 = '4.JPG';
            $bubble4ps4 = '4.JPG';
            $bubble4ps5 = '4.JPG';
            $bubble4ps6 = '4.JPG';

            $bubble5ps1 = '5.JPG';
            $bubble5ps2 = '5.JPG';
            $bubble5ps3 = '5.JPG';
            $bubble5ps4 = '5.JPG';
            $bubble5ps5 = '5.JPG';
            $bubble5ps6 = '5.JPG';

            $bubble6ps1 = '6.JPG';
            $bubble6ps2 = '6.JPG';
            $bubble6ps3 = '6.JPG';
            $bubble6ps4 = '6.JPG';
            $bubble6ps5 = '6.JPG';
            $bubble6ps6 = '6.JPG';

            $bubble7ps1 = '7.JPG';
            $bubble7ps2 = '7.JPG';
            $bubble7ps3 = '7.JPG';
            $bubble7ps4 = '7.JPG';
            $bubble7ps5 = '7.JPG';
            $bubble7ps6 = '7.JPG';

            $bubble8ps1 = '8.JPG';
            $bubble8ps2 = '8.JPG';
            $bubble8ps3 = '8.JPG';
            $bubble8ps4 = '8.JPG';
            $bubble8ps5 = '8.JPG';
            $bubble8ps6 = '8.JPG';

            $bubble9ps1 = '9.JPG';
            $bubble9ps2 = '9.JPG';
            $bubble9ps3 = '9.JPG';
            $bubble9ps4 = '9.JPG';
            $bubble9ps5 = '9.JPG';
            $bubble9ps6 = '9.JPG';

            //region for 0 bubbling 
            if($rnostr1 == 0) {
                $bubble0ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 0)
            {
                $bubble0ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 0)
            {
                $bubble0ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 0)
            {
                $bubble0ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 0)
            {
                $bubble0ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 0)
            {
                $bubble0ps6 = 'bubble.JPG';
            }
            //endregion 

            // for 1 bubbling
            if($rnostr1 == 1) {
                $bubble1ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 1)
            {
                $bubble1ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 1)
            {
                $bubble1ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 1)
            {
                $bubble1ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 1)
            {
                $bubble1ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 1)
            {
                $bubble1ps6 = 'bubble.JPG';
            }
            // end bubbling 1 

            // for 2 bubbling
            if($rnostr1 == 2) {
                $bubble2ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 2)
            {
                $bubble2ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 2)
            {
                $bubble2ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 2)
            {
                $bubble2ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 2)
            {
                $bubble2ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 2)
            {
                $bubble2ps6 = 'bubble.JPG';
            }
            // end bubbling 2 

            // for 3 bubbling
            if($rnostr1 == 3) {
                $bubble3ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 3)
            {
                $bubble3ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 3)
            {
                $bubble3ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 3)
            {
                $bubble3ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 3)
            {
                $bubble3ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 3)
            {
                $bubble3ps6 = 'bubble.JPG';
            }
            // end bubbling 3 


            // for 4 bubbling
            if($rnostr1 == 4) {
                $bubble4ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 4)
            {
                $bubble4ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 4)
            {
                $bubble4ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 4)
            {
                $bubble4ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 4)
            {
                $bubble4ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 4)
            {
                $bubble4ps6 = 'bubble.JPG';
            }
            // end bubbling 4 

            // for 5 bubbling
            if($rnostr1 == 5) {
                $bubble5ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 5)
            {
                $bubble5ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 5)
            {
                $bubble5ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 5)
            {
                $bubble5ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 5)
            {
                $bubble5ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 5)
            {
                $bubble5ps6 = 'bubble.JPG';
            }
            // end bubbling 5 

            // for 6 bubbling
            if($rnostr1 == 6) {
                $bubble6ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 6)
            {
                $bubble6ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 6)
            {
                $bubble6ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 6)
            {
                $bubble6ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 6)
            {
                $bubble6ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 6)
            {
                $bubble6ps6 = 'bubble.JPG';
            }
            // end bubbling 6 


            // for 7 bubbling
            if($rnostr1 == 7) {
                $bubble7ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 7)
            {
                $bubble7ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 7)
            {
                $bubble7ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 7)
            {
                $bubble7ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 7)
            {
                $bubble7ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 7)
            {
                $bubble7ps6 = 'bubble.JPG';
            }
            // end bubbling 7 

            // for 8 bubbling
            if($rnostr1 == 8) {
                $bubble8ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 8)
            {
                $bubble8ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 8)
            {
                $bubble8ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 8)
            {
                $bubble8ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 8)
            {
                $bubble8ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 8)
            {
                $bubble8ps6 = 'bubble.JPG';
            }
            // end bubbling 8 

            // for 9 bubbling
            if($rnostr1 == 9) {
                $bubble9ps1 = 'bubble.JPG'; 
            }
            if($rnostr2 == 9)
            {
                $bubble9ps2 = 'bubble.JPG';
            }
            if($rnostr3 == 9)
            {
                $bubble9ps3 = 'bubble.JPG';
            }
            if($rnostr4 == 9)
            {
                $bubble9ps4 = 'bubble.JPG';
            }
            if($rnostr5 == 9)
            {
                $bubble9ps5 = 'bubble.JPG';
            }
            if($rnostr6 == 9)
            {
                $bubble9ps6 = 'bubble.JPG';
            }

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble0ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble1ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble2ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble3ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble4ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble5ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble6ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble7ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble8ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $Y = $Y + 6;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(10,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps1,12,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = 6;
            $imagex = 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(12 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps2,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(14 + $cellx,55+ $Y);
            //$pdf->Cell(8,5,'4',1,0,'C',1);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps3,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;

            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(34,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps4,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(42,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps5,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $cellx = $cellx +6;
            $imagex = $imagex + 8;
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY(50,55+ $Y);
            $pdf->Cell( 8,6, $pdf->Image('assets/img/'.$bubble9ps6,12 + $imagex,56+$Y, 4,4, "JPG"), 1, 0, 'C', false );

            $pdf->Image("assets/img/256(10thPrivate)Final.JPG",60.0, $Y-14, 147.65,78.65, "JPG");  

            $pdf->Image("assets/img/Note00.jpg",10.0,243, 145,30, "JPG"); 
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(160,267);
            $pdf->Cell(0, 0.2, "CONTROLLER OF EXAMINATIONS", 0.25, "C");     
        }
        else
        {
            if($info['errmessage'] == 'RLE')
            {
                $info['errmessage'] = 'Eligibility';
            }
            $message = 'Slip is not issued due to '.$info['errmessage'].'. Please Contact to Inter Part-I Branch at B.I.S.E Gujranwala.';
            $pdf->SetFont('Arial','B',14);
            $pdf->SetXY(20,60);
            $pdf->SetTextColor(255 ,0,0);
            $pdf->MultiCell(170, 6, $message, 0, "L",0);
            //  $pdf->Cell(0, 0.2,$message, 0.25, "C");   
        }



    }
}
