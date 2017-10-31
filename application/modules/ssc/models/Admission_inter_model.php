<?php

class Admission_inter_model extends CI_Model 
{
    public function __construct()    
    {

        $this->load->database(); 



    }
    public function getStudentsData($data){
        //sp_form_data
        //SELECT * FROM  fl_dataforMa15 WHERE  (isSubmit is null or isSubmit= 0) and class = 9 and iyear = 2014 and sch_cd = ".$user->inst_cd
      // DebugBreak();
        $inst_cd = $data['Inst_Id'];
        $gender = $data['gender'];
        $query = $this->db->query("Admission_online..SP_SELECT_IS2016_TEST $inst_cd,11,2015,1,$gender");
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
    public function Incomplete_inst_info_INSERT($allinfo)
    {
        //  //DebugBreak();
        $data = array(

            'Inst_cd' => $allinfo['Inst_Id'] ,
            'emis_code' => $allinfo['Info_emis'] ,
            'email' => strtoupper($allinfo['info_email']) ,
            'LandLine' => $allinfo['info_phone'] ,
            'MobNo' => $allinfo['info_cellNo'] ,
            'dist_cd' => $allinfo['info_dist'] ,
            'teh_cd' => $allinfo['info_teh'] ,
            'zone_cd' => $allinfo['info_zone'] ,

        );

        $this->db->insert('tblInstitutes_all_Info', $data); 
        return true;
    }
    public function get_zone()
    {

        //$this->db->select('zone_cd','zone_name');
        //$this->db->order_by("formno", "DESC"); myear = 2016 and class = 10 and sess = 1 
        $query = $this->db->get_where('matric_new..tblZones', array('myear' => '2016','class'=>12,'sess'=>2));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();

        }



    }
    public function Dashboard($inst_cd)
    {

        // //DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $query = $this->db->query("Admission_online..Dashboard_adm_10th $inst_cd");



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
    public function Profile_info($inst_cd)
    {

        // //DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $query = $this->db->query("Registration..Profile_info $inst_cd");



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
    public function Profile_UPDATE($allinputdata)
    {

        // //DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $isGovt = $allinputdata['isGovt'];
        $Profile_email = $allinputdata['Profile_email'];
        $Profile_password = $allinputdata['Profile_password'];
        $Profile_phone = $allinputdata['Profile_phone'];
        $Profile_cell = $allinputdata['Profile_cell'];
        $isInserted = $allinputdata['isInserted'];
        $Inst_Id = $allinputdata['Inst_Id'];
        $emis = $allinputdata['emis'];
        $query = $this->db->query("Registration..Profile_UPDATE $Inst_Id,$isInserted,$isGovt,'$Profile_email','$Profile_password','$Profile_phone','$Profile_cell','$emis'");
        return  true;

    }
    public function Insert_NewEnorlement($data)//$father_name,$bay_form,$father_cnic,$dob,$mob_number)  
    {
        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        //$Dob = $data['Dob'];
        $CellNo = $data['MobNo'];
        $medium = $data['med'];
        $Inst_Rno = $data['classRno'];
        $MarkOfIden =strtoupper($data['markOfIden']);
        $Speciality = $data['Spec'];
        $nat = $data['nat'];
        $sex = $data['sex'];
        $IsHafiz = $data['Ishafiz'];
        $rel = $data['rel'];
        $addr =strtoupper($data['addr']) ;
       /* if(($data['grp_cd'] == 1) or ($data['grp_cd'] == 7) or ($data['grp_cd'] == 8) )
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
        }*/
        $sub1= $data['sub1p2'];
        $sub2 = $data['sub2p2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4p2'];
        $sub5 = $data['sub5p2'];
        $sub6 = $data['sub6p2'];
        $sub7 = $data['sub7p2'];
        $sub8 = $data['sub8p2'];
        $sub5a =$data['sub5p2'];
        $sub6a =$data['sub6p2'];
        $sub7a =$data['sub7p2'];
        $sub1ap1 = $data['sub1ap1'];
        $sub2ap1 = $data['sub2ap1'];
        $sub3ap1 = $data['sub3ap1'];
        $sub4ap1 = $data['sub4ap1'];
        $sub5ap1 = $data['sub5ap1'];
        $sub6ap1 = $data['sub6ap1'];
        $sub7ap1 = $data['sub7ap1'];
       // $sub8ap1 = $data['sub8ap1'];
        $UrbanRural = $data['ruralOrurban'];
        $Inst_cd = $data['Inst_cd'];
        $formno = $data['FormNo'];
        $RegGrp = $data['grp_cd'];
        $grp_cd = $data['grp_cd'];
        $cat09 =  $data['cat09'];
        $cat10 =  $data['cat10'];
        $sub1ap2 =  $data['sub1ap2'];
        $sub2ap2 =  $data['sub2ap2'];
       // $sub3ap2 =  $data['sub3ap2'];
        $sub4ap2 =  $data['sub4ap2'];
        $sub5ap2 =  $data['sub5ap2'];
        $sub6ap2 =  $data['sub6ap2'];
        $sub7ap2 =  $data['sub7ap2'];
        $sub8ap2 =  $data['sub8ap2'];
        $oldrno =  $data['rno'];
        $oldyear =  $data['Iyear'];
        $oldsess =  $data['sess'];
        $Brd_cd =  $data['Brd_cd'];
        $pvtinfo_dist = $data['pvtinfo_dist'];
        $pvtinfo_teh = $data['pvtinfo_teh'];
        $pvtZone = $data['pvtZone'];
        $isupdate = $data['isupdate'];
        if($isupdate==1)
        {
          $oldrno =  $data['oldRno'];
        }
    //  DebugBreak();
       $query = $this->db->query("Admission_online..ISAdm2016_regular_sp_insert '$formno',12,2016,2,'$name','$fname','$BForm','$FNIC','$CellNo',$medium,'$Inst_Rno','".$MarkOfIden."',$Speciality,$nat,$sex,$rel,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$sub8,1,$oldrno,$oldyear,$oldsess,$IsHafiz,$Inst_cd,$UrbanRural,$RegGrp,$cat09,$cat10,$sub1ap2,$sub2ap2,$sub4ap2,$sub5ap2,$sub6ap2,$sub7ap2,$sub8ap2,$Brd_cd,$sub5a,$sub6a,$sub7a,$pvtinfo_dist,$pvtinfo_teh,$pvtZone,$isupdate");
       // return true;
        
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            $result = $query->result_array();
       
        if($result == true)
        {
        return true;    
        }
        else{
            return false;    
        }
        
    }
    }
    public function EditEnrolement($inst_cd)
    {

         ////DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        //sp_get_regInfo_spl_case

        $query = $this->db->query("Admission_online..sp_get_regInfo_all_inter $inst_cd,12,2016,2");    

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
            // $q1 = array('stdinfo'=>$query->result_array()) ;
            //            for($i= 0; $i<$rowcount; $i++){
            //            $q1['stdinfo'][$i]['sub1'];
            //            }
            //            $q1['stdinfo']['sub1'];
            //            $q2 = $this->db->query("select SUB_ABR from tblsubject_newschm where SUB_CD in (1,2,3,4,5)");
            //            $q2 = array('stdinfo_sub'=>$q2->result_array()) ;
            //            $query = array('stdinfo_reg'=>$q1,'stdinfo_sub'=>$q2);


        }
        else
        {
            return  false;
        }
    }
     public function EditEnrolement_singleForm($formno)
    {

         ////DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        //sp_get_regInfo_spl_case

        $query = $this->db->query("Admission_online..sp_get_regInfo_inter '$formno',12,2016,2");    

        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
            // $q1 = array('stdinfo'=>$query->result_array()) ;
            //            for($i= 0; $i<$rowcount; $i++){
            //            $q1['stdinfo'][$i]['sub1'];
            //            }
            //            $q1['stdinfo']['sub1'];
            //            $q2 = $this->db->query("select SUB_ABR from tblsubject_newschm where SUB_CD in (1,2,3,4,5)");
            //            $q2 = array('stdinfo_sub'=>$q2->result_array()) ;
            //            $query = array('stdinfo_reg'=>$q1,'stdinfo_sub'=>$q2);


        }
        else
        {
            return  false;
        }
    }
    public function ReleaseBatch_INSERT($allinputdata){
        // //DebugBreak();
         $Inst_cd = $allinputdata['Inst_Id'];
         $batchid = $allinputdata['batchId'];
         $reason = $allinputdata['reason'];
         $branch = $allinputdata['branch'];
         $challan = $allinputdata['challan'];
         $amount = $allinputdata['amount'];
         $date = $allinputdata['date'];
         
          $query = $this->db->query("Admission_online..ReleaseBatch_INSERT $Inst_cd,$batchid,'$reason','$branch',$challan,$amount,'$date'");
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
        return true;
    }
    public function EditEnrolement_data($formno,$year,$inst_cd)
    {
           //  //DebugBreak();
        
        $query = $this->db->get_where('Admission_online..tblAdmissionDataForHSSC',  array('rno' => $formno,'class'=>11,'iyear'=>$year,'sess'=>1));     
         
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
    public function Delete_NewEnrolement($formno)
    {
        $data=array('isDeleted'=>1);
        $this->db->where('formNo',$formno);
        $this->db->update('Admission_online..MSAdm2016',$data);
        return true;

    }
    public function GetFormNo($Inst_Id)
    {
        // //DebugBreak();
        $this->db->select('formno');
        $this->db->order_by("formno", "DESC");
        $formno = $this->db->get_where('Admission_online..ISAdm2016', array('coll_cd' => $Inst_Id));
        $rowcount = $formno->num_rows();

        if($rowcount == 0 )
        {
            $formno =  ($Inst_Id.'0001' );
            return $formno;
        }
        else
        {
            $row  = $formno->result_array();
            $formno = $row[0]['formno']+1;
            return $formno;
        }

    }
    public function GetFormNo_pvt()
    {
        // //DebugBreak();
        $this->db->select('formno');
        $this->db->order_by("formno", "DESC");
        $formno = $this->db->get_where('Admission_online..ISAdm2016', array('regPvt' => 2));
        $rowcount = $formno->num_rows();

        if($rowcount == 0 )
        {
            $formno =  (formnovalid );
            return $formno;
        }
        else
        {
            $row  = $formno->result_array();
            $formno = $row[0]['formno']+1;
            return $formno;
        }

    }
    
    public function user_info($User_info_data)
    {
        // //DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        $RegGrp = $User_info_data['RegGrp'];
        $spl_cd = $User_info_data['spl_case'];

        // $forms_id = $User_info_data['forms_id'];
        $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            if($spl_cd == "0")
            {
                $q1         = $this->db->query("select * from Admission_online..MSAdm2016 where Sch_cd =$Inst_cd and (isdeleted = 0 or isdeleted is null) and (batch_id = 0 or batch_id is null) and RegGrp =$RegGrp");
                //$q1         = $this->db->get_where('Admission_online..MSAdm2016',array('Sch_cd'=>$Inst_cd,'IsDeleted'=>0,'Batch_ID'=>0,'RegGrp'=>$RegGrp));    
            }
            else{
                $q1         = $this->db->query("select * from Admission_online..MSAdm2016 where Sch_cd =$Inst_cd and (isdeleted = 0 or isdeleted is null) and(batch_id = 0 or batch_id is null) and  Spec =$spl_cd");
                //$q1         = $this->db->get_where('Admission_online..MSAdm2016',array('Sch_cd'=>$Inst_cd,'IsDeleted'=>0,'Batch_ID'=>0,'Spec'=>$spl_cd));    
            }

            $result_1 ;
            $nrowcount = $q1->num_rows();
            if($nrowcount > 0)
            {
                $result_1 = $q1->result_array();
            }
            else{
                return false;
            }
            $q2         = $this->db->get_where('Registration..RuleFee_Reg_Nineth',array('Rule_Fee_ID'=>1));
            $resultarr = array("info"=>$query->result_array(),"fee"=>$result_1,"rule_fee"=>$q2->result_array());
            return  $resultarr;
        }
        else
        {
            return  false;
        }
    }
    public function readmission_check($User_info_data)
    {
        // //DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        $RollNo = $User_info_data['RollNo'];
        $spl_cd = $User_info_data['spl_case'];

        // $forms_id = $User_info_data['forms_id'];
        $query = $this->db->get_where('matric_new..tblbiodata',  array('rno' => $RollNo,'spl_cd' => 17,'Sch_cd'=>$Inst_cd,'class'=>9,'Iyear'=>2016,'sess'=>1));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            $result_1 = $query->result_array();
           
            return  $result_1;
        }
        else
        {
            return  false;
        }
    }
    public function user_info_Formwise($User_info_data)
    {
        // //DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        $forms_id = $User_info_data['forms_id'];
        $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            $q1         = $this->db->query("select * from Admission_online..ISAdm2016 where coll_cd =$Inst_cd and (isdeleted = 0 or isdeleted is null) and  FormNo in($forms_id)");
            // $this->db->from('Registration..MA_P1_Reg_Adm2016');
            //$this->db->where(array('Sch_cd'=>$Inst_cd,'IsDeleted'=>0,'Batch_ID'=>0));
            // $this->db->where_in('formNo',$forms_id);


            //$q1         = $this->db->where_in('Registration..MA_P1_Reg_Adm2016',array('Sch_cd'=>$Inst_cd,'IsDeleted'=>0,'Batch_ID'=>0,'formno'=>$forms_id));
            //$q1 = $this->db->get();
            //$result_1 = $q1->result_array();
            $nrowcount = $q1->num_rows();
            if($nrowcount > 0)
            {
                $result_1 = $q1->result_array();
            }
            $q2         = $this->db->get_where('Admission_Online..RuleFeeAdm',array('Rule_Fee_ID'=>$User_info_data['rule_fee']));
            $resultarr = array("info"=>$query->result_array(),"fee"=>$result_1,"rule_fee"=>$q2->result_array());
            return  $resultarr;
        }
        else
        {
            return  false;
        }
    }
       public function getrulefee(){
        //SELECT * FROM  fl_dataforMa15 WHERE  (isSubmit is null or isSubmit= 0) and class = 9 and iyear = 2014 and sch_cd = ".$user->inst_cd
           $date =  date('Y-m-d') ;
          // DebugBreak();
        $query = $this->db->get_where('Admission_Online..RuleFeeAdm', array('class' => 12,'sess' => 2, 'Start_Date <='=>$date,'End_Date >='=>$date));
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
     public function Print_challan_Form($fetch_data)
    {
        $Inst_cd = $fetch_data['Inst_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];
      
     // DebugBreak();
        $query = $this->db->query("Admission_online..sp_get_Admission_matric_regular_Batch_challan $Inst_cd,$Batch_Id");
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
   /* public function getreulefee($ruleID)
    {
        $ruleID = 1;
        $q2         = $this->db->get_where('Registration..RuleFee_Reg_Nineth',array('Rule_Fee_ID'=>$ruleID));
        $resultarr = $q2->result_array();
    }*/
    public function Batch_Insertion($data)
    {
     // DebugBreak();

        $inst_cd = $data['inst_cd'];
        $total_fee = $data['total_fee'];
        $processing_fee = $data['proces_fee'];
        $reg_fee = $data['reg_fee'];
        $fine = $data['fine'];
        $TotalRegFee = $data['TotalRegFee'];
        $TotalLatefee = $data['TotalLatefee'];
        $Totalprocessing_fee = $data['Totalprocessing_fee'];
        $forms_id = $data['forms_id'];
        $todaydate = $data['todaydate'];
        $total_std = $data['total_std'];
        //        EXEC Batch_Create @Inst_Cd = ".$user->inst_cd.",@UserId = ".$user->get_currentUser_ID()."@Amount = ".$tot_fee.",@Total_ProcessingFee = ".$prs_fee.",@Total_RegistrationFee = ".$reg_fee.",@Total_LateRegistrationFee =".$late_fee.",@Total_LateAdmissionFee = 0,@Valid_Date = '$today',@form_ids = '$forms_id'"
        $query = $this->db->query("Admission_online..Batch_Create_12th_2016 $inst_cd,$reg_fee,$fine,$processing_fee,$total_std,$total_fee,$TotalRegFee,$Totalprocessing_fee,$TotalLatefee,'$todaydate','$forms_id'");
    }
    public function Batch_List($data)
    {
        ////DebugBreak();
        $inst_cd = $data['Inst_Id'];
        $q2         = $this->db->get_where('Admission_online..fl_reg_batch_test_inter',array('Inst_Cd'=>$inst_cd,'Is_Delete'=>0));
        $result = $q2->result_array();
        return $result;
    }
    public function return_pdf($fetch_data)
    {
        // //DebugBreak();
        $Inst_cd = $fetch_data['Inst_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];
        $query = $this->db->query("Admission_online..sp_get_reg_return_formInfo $Inst_cd,$Batch_Id");
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
    public function Print_Form_Groupwise($fetch_data)
    {
        $Inst_cd = $fetch_data['Inst_cd'];
        $Grp_cd = $fetch_data['grp_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];
        $query = $this->db->query("Admission_online..sp_get_reg_Print_Form_Inter_II $Inst_cd,$Grp_cd,$Batch_Id");
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
    public function Print_Form_Formnowise($fetch_data)
    {
        //  //DebugBreak();
        $Inst_cd = $fetch_data['Inst_cd'];
        $start_formno = $fetch_data['start_formno'];
        $end_formno = $fetch_data['end_formno'];
        $Batch_Id = $fetch_data['Batch_Id'];
        $query = $this->db->query("Admission_online..sp_get_reg_Print_Form_formnowise_Inter_II $Inst_cd,'$start_formno','$end_formno',$Batch_Id");
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
    public function Print_Form_Batchwise($fetch_data)
    {
        //  //DebugBreak();
        $Inst_cd = $fetch_data['Inst_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];
        $query = $this->db->query("Admission_online..sp_get_reg_Print_Form_batchidwise_Inter_II $Inst_cd,$Batch_Id");
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
    public function revenue_pdf($fetch_data)
    {
        ////DebugBreak();

        $Inst_cd = $fetch_data['Inst_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];

        $this->db->select('name, Fname, IsReAdm,AdmFee,AdmProcessFee,AdmFineFee,AdmTotalFee');
        $this->db->from('Admission_online..ISAdm2016');
        $this->db->where(array('coll_cd' => $Inst_cd,'Batch_ID'=>$Batch_Id));
        $result_1 = $this->db->get()->result();
        //$query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',  array('Sch_cd' => $Inst_cd,'Batch_ID'=>$Batch_Id));
        //$rowcount = $query->num_rows();
        //if($rowcount > 0)
        //{
        //$q = $query->result_array();
        $query_1 = $this->db->get_where('Admission_online..fl_reg_batch_test_inter',  array('Inst_Cd' => $Inst_cd,'Batch_ID'=>$Batch_Id));
        $rowcount = $query_1->num_rows();
        if($rowcount > 0){
            $query_1 = $query_1->result_array();

            return $result = array('stdinfo'=>$result_1, 'batch_info'=>$query_1);    
            //  }

        }
        else
        {
            return  false;
        }
    }
    public function Spl_case_std_list($myinfo)
    {

        ////DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        //sp_get_regInfo_spl_case
        $inst_cd = $myinfo['Inst_cd'];
        $spl_cd = $myinfo['spl_cd'];
        $grp_selected = $myinfo['grp_selected'];
        if($grp_selected == FALSE)
        {
            if($spl_cd == FALSE || ($spl_cd == "3"))
            {
                $query = $this->db->query("Admission_online..sp_get_regInfo_all_inter $inst_cd,12,2016,2");    
            }

            else
            {
                $query = $this->db->query("Admission_online..sp_get_regInfo_spl_case_inter $inst_cd,12,2016,2,$spl_cd");    
            }    
        }
        else
        {
            $query = $this->db->query("Admission_online..sp_get_regInfo_Groupwise_inter $inst_cd,12,2016,2,$grp_selected");    
        }




        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
            // $q1 = array('stdinfo'=>$query->result_array()) ;
            //            for($i= 0; $i<$rowcount; $i++){
            //            $q1['stdinfo'][$i]['sub1'];
            //            }
            //            $q1['stdinfo']['sub1'];
            //            $q2 = $this->db->query("select SUB_ABR from tblsubject_newschm where SUB_CD in (1,2,3,4,5)");
            //            $q2 = array('stdinfo_sub'=>$q2->result_array()) ;
            //            $query = array('stdinfo_reg'=>$q1,'stdinfo_sub'=>$q2);


        }
        else
        {
            return  false;
        }
    }
    public function bay_form_comp($bayformno)
    {
        $query = $this->db->get_where('Admission_online..MSAdm2016',  array('BForm' => $bayformno,'IsDeleted'=>0));
        $rowcount = $query->num_rows();
        if ($rowcount > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function bay_form_fnic_dob_comp($bayformno,$fnic,$dob)
    {
        $query = $this->db->get_where('Admission_online..MSAdm2016',  array('BForm' => $bayformno,'FNIC' => $fnic,'Dob' => $dob,'IsDeleted'=>0));
        $rowcount = $query->num_rows();
        if ($rowcount > 0){
            return true;
        }
        else{
            return false;
        }
    }

}
?>
