<?php
class Admission_model extends CI_Model 
{
    public function __construct(){

        $this->load->database(); 
    }

    public function countStudents($inst_cd){
        $query = $this->db->get_where('Admission_Online..adm_reg_ma2016', array('sch_cd' => $inst_cd));
        $rowcount = $query->num_rows();
        return $rowcount;
    }
    public function updatefee($formno,$adminfee,$totalfee)
    {
        $data = array(
            'AdmFee' =>$adminfee,
            'AdmTotalFee' =>$totalfee,
            'cDate'=> date('Y-m-d H:i:s')
        );
        $this->db->where('formNo',$formno);
      /*$query = $this->db->update('Admission_Online..MSAdm2016',$data);
         if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }   */
        return true;

    }
    public function Pre_Matric_data($data)
    {

      // DebugBreak();
      
        $rno = $data['mrno'];
        $iyear = $data['year'];
        $sess = $data['session'];
        $brd = $data['board'];

        if($iyear>=2016)
        {

            $query = $this->db->get_where(getinfo, array('Dob'=>$data['dob'],'rno' => $data['mrno'], 'class' => $data['class'], 'Iyear' => $data['year'], 'sess'=>$data['session'],'Brd_cd'=>$data['board']));

            if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
            

        }
        else
        {

            $class= $data['class'];
            $query = $this->db->query("matric_new..Matric_Results $rno,$class,$iyear,$sess");
            if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
            //admission_online..NextAppearance_SSC @rno,@IYear,@Sess

        }

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function checknextrno($rno,$IYear,$Sess,$class)
    {
        $query = $this->db->query("admission_online..NextAppearanceSSC $rno,$class,$IYear,$Sess,'0','0','',1");
         if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            return $query->result_array();
        }
        else
        {
            return  -1;
        }
    }
    public function checkalready($name,$fnic,$dob)
    {
        $query = $this->db->query("admission_online..NextAppearanceSSC 0,0,0,0,'$name','$dob','$fnic',2");
         if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            return $query->result_array();
        }
        else
        {
            return  -1;
        }
    }
    public function Brd_Name($brd_cd)
    {
        $brd_name = $this->db->get_where("matric..tblboard", array('Brd_cd'=>$brd_cd));
         if (!$brd_name) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
        $rowcount = $brd_name->num_rows();
        if($rowcount>0)
        {
            return $brd_name->result_array();    
        }
    }
    public function GetFormNo(){
        // //DebugBreak();
        $this->db->select('formno');
        $this->db->order_by("formno", "DESC");
        $formno =$this->db->get_where(INSERT_TBL,array('regpvt'=>2));
        if (!$formno) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
        $rowcount = $formno->num_rows();
          
        if($rowcount == 0 )
        {
            $formno = formnovalid+1;
            return $formno;
        }
        else
        {
            $row  = $formno->result_array();
            $formno = $row[0]['formno']+1;
            return $formno;
        }

    }

    public function Insert_NewEnorlement($data){    
        //   DebugBreak();
        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $Dob = $data['Dob'];
        $CellNo = $data['MobNo'];
        $medium = $data['medium'];
        // $Inst_Rno = strtoupper(@$data['Inst_Rno']);
        $MarkOfIden =strtoupper(@$data['markOfIden']);
        $Speciality = $data['Speciality'];
        $nat = $data['nat'];
        $sex = $data['sex'];
        $IsHafiz = $data['IsHafiz'];
        $rel = $data['rel'];        
        $addr =strtoupper($data['addr']) ;

        if(($data['grp_cd'] == 1) || ($data['grp_cd'] == 7) || ($data['grp_cd'] == 8) )
        {
            $grp_cd = 1;    
        }
        else if($data['grp_cd'] == 2 )
        {
            $grp_cd = 2;        
        }
        else if($data['grp_cd'] == 5 )
        {
            $grp_cd = 5;        
        }
        else if ($data['grp_cd']==4)
        {
            $grp_cd = 4;        
        }
        $sub1= $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];
        $sub7 = $data['sub7'];
        $sub8 = $data['sub8'];


        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
        $sub8ap1 = $data['sub8ap1'];

        $UrbanRural = $data['RuralORUrban'];
        $Inst_cd = "999999";
        $formno = $data['FormNo'];
        $RegGrp = $data['grp_cd'];
        $sub1ap2 =  $data['sub1ap2'];
        $sub2ap2 =  $data['sub2ap2'];
        $sub3ap2 =  $data['sub3ap2'];
        $sub4ap2 =  $data['sub4ap2'];
        $sub5ap2 =  $data['sub5ap2'];
        $sub6ap2 =  $data['sub6ap2'];
        $sub7ap2 =  $data['sub7ap2'];
        $sub8ap2 =  $data['sub8ap2'];

        $cat09 = $data['cat09'];     
        $cat10 = $data['cat10'];     

        //-------Marks Improve CAT --------\\
        $dist_cd =  $data['dist'];
        $teh_cd =  $data['teh'];
        $zone_cd =  $data['zone'];
        $oldrno =  $data['rno'];
        $oldyear =  $data['Iyear'];
        $oldsess =  $data['sess'];
        $Brd_cd =  @$data['Brd_cd'];
        $isotherbrd =  @$data['isotherbrd'];
        $isFresh =  @$data['isFresh'];
        $AdmFee = @$data['AdmFee'];
        $AdmProcessFee = @$data['AdmProcessFee'];
        $AdmTotalFee = @$data['AdmTotalFee'];
        $regFee = @$data['regFee'];
        $certFee = @$data['certFee'] ;
        $AdmFine = @$data['AdmFine'];
        $pic = @$data['picpath'];
        if($isotherbrd == 1 || $isFresh == 1 )
        {
            $old_class =  9;
        }
        else
        {
            $old_class =  @$data['class'];
        }

        $AdmFee =  1400;
        $preResult =  @$data['preResult'];
        $exam_type =  @$data['exam_type'];
        $strRegNo = @$data['strRegNo'];
        if(@$data['exam_type'] == '')
        {
            $exam_type = 2;
        }
        $iyear = Year;
        $ses_s = Session;
        if($regFee == '')
            $regFee=0 ;

        //  echo  '<pre>';print_r($data);echo '</pre>';exit();
        $query = $this->db->query(Insert_sp." '$formno',10,$iyear,$ses_s,'$name','$fname','$BForm','$FNIC','$Dob','$CellNo',$medium,'".$MarkOfIden."',$Speciality,$nat,$sex,$rel,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$sub8,$sub8ap1,1,$oldrno,$oldyear,$oldsess,$old_class,$IsHafiz,$Inst_cd,$UrbanRural,$RegGrp,$cat09,$cat10,$sub1ap2,$sub2ap2,$sub3ap2,$sub4ap2,$sub5ap2,$sub6ap2,$sub7ap2,$sub8ap2,$dist_cd,$teh_cd,$zone_cd,$Brd_cd,$isotherbrd,'$preResult',$exam_type,$isFresh,$AdmFee,$AdmProcessFee,$AdmTotalFee,$regFee,$certFee,$AdmFine,'$strRegNo','$pic'");    
         if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return -1;
        }
        //return true;
    }

    public function get_spl_name($splcd){
        $query = $this->db->get_where('Admission_online..tblSplCase', array('spl_cd' => $splcd));
        // //DebugBreak();
         if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function getzone($data){

        //DebugBreak();
        $tehcd = $data['tehCode'];
        $gend = $data['gend'];
        $ses_s = Session;
        $iyear = Year;
        //$query = $this->db->get_where('matric_new..tblZones', array('mYear' => 2017,'Class' => 10,'Sess'=>1, 'teh_cd' => $tehcd));
        // //DebugBreak();
        $sess = Session;
        $iyear = Year;
        $where = " mYear = $iyear  AND class = 10 AND  sess = $sess and Flag= 1 AND teh_cd =  $tehcd  AND  (Gender = $gend OR Gender = 3) ";      
        $query = $this->db->query("SELECT * FROM matric_new..tblZones WHERE $where");
         if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function getcenter($data){



        $zone = $data['zoneCode'];
        $gend = $data['gen'];
        $sess = Session;
        $iyear = Year;
        $where = " mYear = $iyear  AND class = 10 AND  sess = $sess AND Zone_cd =  $zone  AND  (cent_Gen = $gend OR cent_Gen = 3) ";      
        $query = $this->db->query("SELECT * FROM matric_new..tblcentre WHERE $where");
          if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
        //$query = $this->db->get_where('matric_new..tblcentre', array('mYear' => 2016,'class' => 10,'sess'=>2, 'Zone_cd' => $zone, 'cent_Gen' => $gend)); 
        //DebugBreak();
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function insertRecord($data){
        // insert new data in adm_reg_ma2016
        $query = $this->db->insert("Admission_Online..adm_reg_ma2016", $data);
        $data2 = array('isSubmit'=>1);
        $this->db->where('rno',$data['rno']);
        $this->db->update("fl_dataforMa15", $data2);
    }

    public function deleteRecord($rno,$inst_cd){
        // insert new data in adm_reg_ma2016
        //$data = array('isDeleted'=>true);
        $this->db->set('isDeleted',true);
        $this->db->where(array('rno'=>$rno,'sch_cd'=>$inst_cd));
        $this->db->update("Admission_Online..adm_reg_ma2016");
        $data = array('isSubmit'=>0);
        $this->db->where('rno',$rno);
        $this->db->update("fl_dataforMa15", $data);
    }

    public function getStudentsData($inst_cd){
        //sp_form_data
        //SELECT * FROM  fl_dataforMa15 WHERE  (isSubmit is null or isSubmit= 0) and class = 9 and iyear = 2014 and sch_cd = ".$user->inst_cd
        $query = $this->db->query('Admission_onlinesp_form_data', array('sch_cd' => $inst_cd,'class' => 9, 'iyear' => 2014, 'isSubmit'=>0));
          if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    public function get_formno_data($formno){

        //DebugBreak();
        $query = $this->db->query(formprint_sp."'$formno'");
          if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  -1;
        }
    }
    public function getuser_info($User_info_data)
    {
        //  DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        $date = $User_info_data['date'];

        $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
         if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            $query2 = $this->db->get_where('Admission_Online..RuleFeeAdm', array('class' => 10,'sess' => Session, 'Start_Date <='=>$date,'End_Date >='=>$date));
            $resultarr = array("info"=>$query->result_array(),"rule_fee"=>$query2->result_array());
            return  $resultarr;
        }
        else
        {
            return  false;
        }
    }
    public function getuser_infoPVT($User_info_data)
    {
        //  DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        $date = $User_info_data['date'];
        $isPratical = $User_info_data['isPratical'];

        $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
         if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            $query2 = $this->db->get_where('Admission_Online..RuleFeeAdm', array('class' => 10,'sess' => Session, 'Start_Date <=' =>$date,'End_Date >='=>$date,'isPrSub'=>$isPratical));
             if (!$query2) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
            $resultarr = array("info"=>$query->result_array(),"rule_fee"=>$query2->result_array());

            $qry =  $this->db->last_query();

            return  $resultarr;
        }
        else
        {
            return  false;
        }
    }
    public function Update_AdmissionFeePvt($data)
    {
        $data['cdate']= date('Y-m-d H:i:s');
        $this->db->where('formNo',$data['formNo']);
        $this->db->update(INSERT_TBL,$data);
        $this->db->select('regFee,AdmFee,AdmProcessFee,AdmFine,AdmTotalFee');
        $query = $this->db->get_where(INSERT_TBL, array('formNo'=>$data['formNo'])); 
        if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }

    }

    public function getAdmissionData($rno, $inst_cd){

        $query = $this->db->get_where('fl_dataforMa15', array('rno' => $rno, 'sch_cd' => $inst_cd,'class' => 9, 'iyear' => 2014, 'isSubmit'=>0));
        if (!$query) 
            {
                // if query returns null
            $errNo   = $this->db->error();
            return;
            }
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->row_array();
        }
        else
        {
            return  false;
        }
    }
    public function getrulefee($isPrSub){
       //  DebugBreak();
        $date =  date('Y-m-d') ;
        //  $query = $this->db->get_where('Admission_Online..RuleFeeAdm', array('class' => 10,'sess' => 2, 'isPrSub' => $isPrSub, 'Start_Date <='=>$date,'End_Date >='=>$date));
        $query = $this->db->get_where('Admission_Online..RuleFeeAdm', array('class' => 10,'sess' => Session, 'isPrSub' => $isPrSub, 'Start_Date <='=>$date,'End_Date >='=>$date));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    public function getrulefee_singFee($isPrSub){
       //  DebugBreak();
        $date =  date('Y-m-d',strtotime(SingleDateFee9th)) ;
        //  $query = $this->db->get_where('Admission_Online..RuleFeeAdm', array('class' => 10,'sess' => 2, 'isPrSub' => $isPrSub, 'Start_Date <='=>$date,'End_Date >='=>$date));
        $query = $this->db->get_where('Admission_Online..RuleFeeAdm', array('class' => 10,'sess' => Session, 'isPrSub' => $isPrSub, 'Start_Date <='=>$date,'End_Date >='=>$date));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }
    public function getEditFormsList($inst_cd){
        //SELECT * FROM  fl_dataforMa15 WHERE  (isSubmit is null or isSubmit= 0) and class = 9 and iyear = 2014 and sch_cd = ".$user->inst_cd
        $query = $this->db->get_where('Admission_Online..adm_reg_ma2016', array('sch_cd' => $inst_cd,'class' => 9, 'iyear' => 2014, 'isDeleted'=>false));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }
    }

    function GetMSubName($_sub_cd) {
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
                                                                                                                                                                                                                                                                                                                                                                                    return $ret_val ;             
    }

    public function getSelected($row, $status){
        if ($row == $status) {
            return 'selected="selected"';
        }
    }

    public function getSubjects($rno, $inst_cd){
        //SELECT * FROM ".DB_PREFIX."dataforMa15 WHERE class= 9 and iYear = 2014 and rno = $rno and sch_cd= ".$user->inst_cd
        $query = $this->db->get_where('fl_dataforMa15', array('rno' => $rno, 'sch_cd' => $inst_cd,'class' => 9, 'iyear' => 2014));


        //exit(print_r($query->result_array()));
        $rr = $query->result_array()[0];

        $examtype = $rr['exam_type'];
        $grp_cd = $rr['grp_cd'];
        $catp1 = $rr['catp1'];
        $catp2 = $rr['catp2'];
        $is_pakistani = $rr['nat'];


        if($examtype ==5 || $examtype ==2) 
        {
            if( !($catp1==4 or $catp2==4)) 
            {
                $result = '<div class="control-group"><div class="controls controls-row"><table width="100%">';	
                //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub1__ 1st Row
                $result .= ' <tr>
                <td colspan="2">
                <select id="sub1p1"  class="dropdown span12" name="sub1p1">';

                if($rr["sub1pf1"]== 1)
                {
                    $result  .= '<option value="0">NONE</option>';
                }
                else
                {
                    $result  .= '<option value="'.$rr["sub1"].'" ' . $this->getSelected($rr["sub1"],$rr["sub1"]).'>'.$this->GetMSubName( $rr["sub1"]).'</option>';	
                    if($rr["sub1st1"]!= 2)
                        $result  .= '<option value="0">NONE</option>';

                }											
                $result .= ' 	</select>	</td>

                <td colspan="2">
                <select id="sub1p2"  class="dropdown span8" name="sub1p2">';
                $result  .= '<option value="'.$rr["sub1"].'" '.$this->getSelected($rr["sub1"],$rr["sub1"]).'>'.$this->GetMSubName( $rr["sub1"]).'</option>';										   
                $result .= ' 	   </select>					   
                </td>
                </tr>';
                //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub2__  2nd Row	
                $result .= '	<tr>
                <td colspan="2">
                <select id="sub2p1"  class="dropdown span12" name="sub2p1">';
                if($rr["sub2pf1"]== 1)
                {
                    $result  .= '<option value="0">NONE</option>';
                }
                else
                {
                    $result  .= '<option value="'.$rr["sub2"].'" '.$this->getSelected($rr["sub2"],$rr["sub2"]).'>'.$this->GetMSubName( $rr["sub2"]).'</option>';	
                    if($rr["sub2st1"]!= 2)
                        $result  .= '<option value="0">NONE</option>';	
                }
                $result .= '</select>					   
                </td>
                <td colspan="2">
                <select id="sub2p2"  class="dropdown span8" name="sub2p2">
                <option value="'.$rr["sub2"].'" '.$this->getSelected($rr["sub2"],$rr["sub2"]).'>'.$this->GetMSubName( $rr["sub2"]).'</option>
                </select>					   
                </td>
                </tr>';
                //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub3__  3rd Row
                $result .= '<tr>
                <td colspan="2">
                <select id="sub3p1"  class="dropdown span12" name="sub3p1">';
                if($rr["sub3pf1"]== 1)
                {
                    $result  .= '<option value="0">NONE</option>';
                }
                else
                {
                    $result  .= '<option value="'.$rr["sub3"].'" '.$this->getSelected($rr["sub3"],$rr["sub3"]).'>'.$this->GetMSubName( $rr["sub3"]).'</option>';	
                    if($rr["sub3st1"]!= 2)
                        $result  .= '<option value="0">NONE</option>';	
                }

                $result .= '	</select>					   
                </td>
                <td colspan="2">
                <select id="sub3p2"  class="dropdown span8" name="sub3p2">
                <option value="'.$rr["sub3"].'" '.$this->getSelected($rr["sub3"],$rr["sub3"]).'>'.$this->GetMSubName( $rr["sub3"]).'</option>
                </select>					   
                </td>
                </tr>';
                //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub8__   8th Row
                $result .= '<tr>
                <td colspan="2">
                <select id="sub8p1"  class="dropdown span12" name="sub8p1">';
                if($rr["sub8pf1"]== 1)
                {
                    $result  .= '<option value="0">NONE</option>';
                }
                else
                {
                    $result  .= '<option value="'.$rr["sub8"].'" '.$this->getSelected($rr["sub8"],$rr["sub8"]).'>'.$this->GetMSubName( $rr["sub8"]).'</option>';												 
                    if($rr["sub8st1"]!= 2)
                        $result  .= '<option value="0">NONE</option>';	
                }
                $result .= '</select>
                </td>
                <td colspan="2">
                <select id="sub8p2"  class="dropdown span8" name="sub8p2">
                <option value="'.$rr["sub8"].'" '.$this->getSelected($rr["sub8"],$rr["sub8"]).'>'.$this->GetMSubName( $rr["sub8"]).'</option>
                </select>					   
                </td>
                </tr>';							
                //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub4__  4th Row 
                $result .= '<tr>
                <td colspan="2">
                <select id="sub4p1"  class="dropdown span12" name="sub4p1">';
                if($rr["sub4pf1"]== 1)
                {
                    $result  .= '<option value="0">NONE</option>';
                }
                else
                {
                    $result  .= '<option value="'.$rr["sub4"].'" '.$this->getSelected($rr["sub4"],$rr["sub4"]).'>'.$this->GetMSubName( $rr["sub4"]).'</option>';												 
                    if($rr["sub4st1"]!= 2)
                        $result  .= '<option value="0">NONE</option>';	
                }
                $result .= '</select>
                </td>
                <td colspan="2">
                <select id="sub4p2"  class="dropdown span8" name="sub4p2">
                <option value="'.$rr["sub4"].'" '.$this->getSelected($rr["sub4"],$rr["sub4"]).'>'.$this->GetMSubName( $rr["sub4"]).'</option>
                </select>					   
                </td>
                </tr>';
                //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub5__   5th Row 
                $result .= '<tr>
                <td colspan="2">
                <select id="sub5p1"  class="dropdown span12" name="sub5p1">';
                if($rr["sub5pf1"]== 1)
                {
                    $result  .= '<option value="0">NONE</option>';
                }
                else
                {
                    $result  .= '<option value="'.$rr["sub5"].'" '.$this->getSelected($rr["sub5"],$rr["sub5"]).'>'.$this->GetMSubName( $rr["sub5"]).'</option>';												 
                    if($rr["sub5st1"]!= 2)
                        $result  .= '<option value="0">NONE</option>';	
                } 
                $result .= '</select>					   
                </td>
                <td colspan="2">
                <select id="sub5p2"  class="dropdown span8" name="sub5p2">
                <option value="'.$rr["sub5"].'" '.$this->getSelected($rr["sub5"],$rr["sub5"]).'>'.$this->GetMSubName( $rr["sub5"]).'</option>
                </select>					   
                </td>
                </tr>'; 

                //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub6__   6th Row 
                $result .= '<tr>
                <td colspan="2">
                <select id="sub6p1"  class="dropdown span12" name="sub6p1">';
                if($rr["sub6pf1"]== 1)
                {
                    $result  .= '<option value="0">NONE</option>';
                }
                else
                {
                    $result  .= '<option value="'.$rr["sub6"].'" '.$this->getSelected($rr["sub6"],$rr["sub6"]).'>'.$this->GetMSubName( $rr["sub6"]).'</option>';	
                    if($rr["sub6st1"]!= 2)
                        $result  .= '<option value="0">NONE</option>';	
                }
                $result .= '</select>							   
                </td>
                <td colspan="2">
                <select id="sub6p2"  class="dropdown span8" name="sub6p2">
                <option value="'.$rr["sub6"].'" '.$this->getSelected($rr["sub6"],$rr["sub6"]).'>'.$this->GetMSubName( $rr["sub6"]).'</option>
                </select>					   
                </td>
                </tr>';
                //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ sub7__   7th Row 
                $result .= '<tr>
                <td colspan="2">
                <select id="sub7p1"  class="dropdown span12" name="sub7p1">';
                if($rr["sub7pf1"]== 1)
                {
                    $result  .= '<option value="0">NONE</option>';
                }
                else
                {
                    $result  .= '<option value="'.$rr["sub7"].'" '.$this->getSelected($rr["sub7"],$rr["sub7"]).'>'.$this->GetMSubName( $rr["sub7"]).'</option>';	
                    if($rr["sub7st1"]!= 2)
                        $result  .= '<option value="0">NONE</option>';	
                }
                $result .= '</select>						   
                </td>
                <td colspan="2">
                <select id="sub7p2"  class="dropdown span8" name="sub7p2">
                <option value="'.$rr["sub7"].'" '.$this->getSelected($rr["sub7"],$rr["sub7"]).'>'.$this->GetMSubName( $rr["sub7"]).'</option>
                </select>					   
                </td>
                </tr>';
                //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ End of Subjects Table 								
                $result .= '</table></div></div>';
            }
            //========================== for AAMA KHASA 
        } elseif ($examtype ==8)
            $result='<h1>Appeared in Next Session with Rno-Sess-Year=> '.$rr['nextRno1'].'-'. ($rr['nextSess1']==1?'An':'Sup').'-'.$rr['nextYear1']. '</h1>';
        //================== End AAMA khasa
        return $result;	
    }
}
?>
