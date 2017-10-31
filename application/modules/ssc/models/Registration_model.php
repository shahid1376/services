<?php

class Registration_model extends CI_Model 
{
    public function __construct()    
    {

        $this->load->database(); 



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
        $query = $this->db->get_where('matric_new..tblZones', array('myear' => regyear,'class'=>10,'sess'=>1));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();

        }
    }
    
     public function IsFeeded($data)
     {
       // DebugBreak();
        $rno =  $data['RollNo'];
        $sess = 1;
        $iyear =regyear;
        //$brd = $data['board'];
      //  DebugBreak();
        $query = $this->db->get_where(tblreg9th, array('oldRno_reg' => "$rno",'IsDeleted'=>NULL));
        // DebugBreak();
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            $result = $query->result_array();
            //$result_sch = $result;
            $query1 = $this->db->get_where("admission_online..tblinstitutes_all", array('Inst_cd' => $result[0]['Sch_cd']));
            $rowcount_ = $query->num_rows();
            if($rowcount_ > 0)
            {
            $result__ = $query1->result_array();
            $returnthis = array("SchInfo"=>$result__,"StdInfo"=>$result );
            return  $returnthis;
            }
        }
        else
        {
            return  false;
        }
    }
   
    
    public function Dashboard($inst_cd)
    {

        // //DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $query = $this->db->query("Registration..DashboardReg9th $inst_cd");



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
   

    public function Insert_NewEnorlement($data)//$father_name,$bay_form,$father_cnic,$dob,$mob_number)  
    {
        //  //DebugBreak();
        $name = strtoupper(trim($data['name']));
        $fname =strtoupper(trim($data['Fname']));
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $Dob = $data['Dob'];
        $CellNo = $data['CellNo'];
        $medium = $data['medium'];
        $Inst_Rno = strtoupper($data['Inst_Rno']);
        $MarkOfIden =strtoupper($data['MarkOfIden']);
        $Speciality = $data['Speciality'];
        $nat = $data['nat'];
        $sex = $data['sex'];
        $IsHafiz = $data['IsHafiz'];
        $rel = $data['rel'];
        $addr =strtoupper($data['addr']) ;
        if(($data['grp_cd'] == 1) or ($data['grp_cd'] == 7) or ($data['grp_cd'] == 8) )
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
        $UrbanRural = $data['UrbanRural'];
        $Inst_cd = $data['Inst_cd'];
        $formno = $data['FormNo'];
        $RegGrp = $data['grp_cd'];
        $Pic_data = $data['Image'];
        $query = $this->db->query("Registration..tblReg9th_insert '$formno',9, ".regyear.",1,'$name','$fname','$BForm','$FNIC','$Dob','$CellNo',$medium,'$Inst_Rno','".$MarkOfIden."',$Speciality,$nat,$sex,$rel,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,                                           $sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$sub8,$sub8ap1,1,0,0,0,0,$IsHafiz,$Inst_cd,$UrbanRural,$RegGrp,'$Pic_data'");
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));

         return $query->result_array();
    }      
    public function EditPicEnrolement($inst_cd)
    {

        // //DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        //sp_get_regInfo_spl_case

        $query = $this->db->query("Registration..sp_regPicInfo $inst_cd,9,".regyear.",1");    





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
    public function Update_NewEnorlement($data)//$father_name,$bay_form,$father_cnic,$dob,$mob_number)  MA_P1_Reg_Adm2016_sp_Update
    {
        ////DebugBreak();
        $name =strtoupper(trim($data['name'])) ;
        $fname =strtoupper(trim($data['Fname']));
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $Dob = $data['Dob'];
        $CellNo = $data['MobNo'];
        $medium = $data['medium'];
        $Inst_Rno = strtoupper($data['Inst_Rno']);
        $MarkOfIden =strtoupper($data['MarkOfIden']);
        $Speciality = $data['Speciality'];
        $nat = $data['nat'];
        $sex = $data['sex'];
        $IsHafiz = $data['IsHafiz'];
        $rel = $data['rel'];
        $addr =strtoupper($data['addr']);
        if(($data['grp_cd'] == 1) or ($data['grp_cd'] == 7) or ($data['grp_cd'] == 8) )
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
        $UrbanRural = $data['UrbanRural'];
        $Inst_cd = $data['Inst_cd'];
        $formno = $data['FormNo'];
        $RegGrp = $data['grp_cd'];
        $regoldrno = $data['regoldrno'];
        $regoldsess = $data['regoldsess'];
        $regoldclass = $data['regoldclass'];
        $regoldyear = $data['regoldyear'];
        $isreadm = $data['isreadm'];
        $Pic_data = $data['Image'];
         if(!isset($data['ckpo']))
        {
        $ckpo = 0;
        }
        else
        {
        $ckpo = @$data['ckpo'];
        
        }
      //  //DebugBreak();
        $query = $this->db->query("Registration..tblReg9th_Update '$formno',9,".regyear.",1,'$name','$fname','$BForm','$FNIC','$Dob','$CellNo',$medium,'$Inst_Rno','$MarkOfIden',$Speciality,$nat,$sex,$rel,'$addr',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$sub8,$sub8ap1,0,0,$IsHafiz,$Inst_cd,$UrbanRural,$RegGrp,$regoldrno,$regoldclass,$regoldyear,$regoldsess,$isreadm,$ckpo,'$Pic_data'");
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
         return $query->result_array();
       // return true;
    }
    public function EditEnrolement($inst_cd)
    {

         ////DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        //sp_get_regInfo_spl_case

        $query = $this->db->query("Registration..sp_regInfo_9th $inst_cd,9,".regyear.",1");    





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
         
          $query = $this->db->query("Registration..ReleaseBatchINSERT $Inst_cd,$batchid,'$reason','$branch',$challan,$amount,'$date'");
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
        return true;
    }
    public function EditEnrolement_data($formno,$year,$inst_cd)
    {

         ////DebugBreak(); 
         if($year == regyear-1){
        $query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' =>9, 'iyear' => regyear, 'regpvt'=>1,'formNo'=>$formno));     
         }
         else{
        $query = $this->db->get_where(tblreg9th,  array('formNo' => $formno,'class'=>9,'iyear'=>$year,'sess'=>1));     
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
    public function Delete_NewEnrolement($formno)
    {
        $data=array('isDeleted'=>1);
        $this->db->where('formNo',$formno);
        $this->db->update(tblreg9th,$data);
        return true;

    }
     public function UpdateBatchFee($Alldata)
    {
        // //DebugBreak();
        $data=array('Amount'=>$Alldata['data']['Amount'],'Total_RegistrationFee'=>$Alldata['data']['Total_RegistrationFee'],'Total_ProcessingFee'=>$Alldata['data']['Total_ProcessingFee'],'Total_LateRegistrationFee'=>$Alldata['data']['Total_LateRegistrationFee'],'cdate'=>date('Y-m-d H:i:s'));
        $this->db->where('Batch_Id',$Alldata['data']['batch_info'][0]['Batch_ID']);
        $this->db->update('Registration..tblregbatch',$data);
        
        $data=array('RegTotalFee'=>$Alldata['data']['Amount'],'regFee'=>$Alldata['rulefee'][0]['Reg_Fee'],'RegProcessFee'=>$Alldata['rulefee'][0]['Processing_Fee'],'RegFineFee'=>$Alldata['rulefee'][0]['Fine']);
        $this->db->where('Batch_Id',$Alldata['data']['batch_info'][0]['Batch_ID']);
        $this->db->update('Registration..tblReg9th',$data);
        return true;

    }
    public function UpdateFee_Final($Alldata){
     
     $data=array('Amount'=>$Alldata['data']['Amount'],'Total_RegistrationFee'=>$Alldata['data']['Total_RegistrationFee'],'Total_ProcessingFee'=>$Alldata['data']['Total_ProcessingFee'],'Total_LateRegistrationFee'=>$Alldata['data']['Total_LateRegistrationFee'],'cdate'=>date('Y-m-d H:i:s'));
     $this->db->where('Batch_Id',$Alldata['data']['batch_info'][0]['Batch_ID']);
     $this->db->update('Registration..tblregbatch',$data);
     //DebugBreak();
     $this->db->update_batch('Registration..tblreg9th',$Alldata['Alluser'],'formNo');
      return true;
    }
     public function GetFormNo($Inst_Id)
    {
        $this->db->select('formno');
        $this->db->order_by("formno", "DESC");
        $formno = $this->db->get_where(tblreg9th, array('sch_cd' => $Inst_Id));
        $rowcount = $formno->num_rows();
//$rowcount = 1258;
        if($rowcount == 0 )
        {
            $formno =  ($Inst_Id.'0001' );
            return $formno;
        }
        else
        {
            $row  = $formno->result_array();
            
            $fromno = $row[0]['formno'];
           // $count =  substr($fromno, -4);
            $inst_cd = substr($fromno, 0, 6);
            if($inst_cd != $Inst_Id)
            {
                $row = $Inst_Id.str_pad($rowcount, 4, '0', STR_PAD_LEFT); 
                $formno = $row+2;   
            }
            else
            {
                $formno = $row[0]['formno']+1;
            }
            
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
               //$this->db->select("*");
               // $this->db->from(tblreg9th);
            if($spl_cd == FALSE || $spl_cd == '0')
            {
                $where = '(IsDeleted=0 or IsDeleted is null) and (Batch_ID = 0 or Batch_ID is null) and Sch_cd ='.$Inst_cd.' and RegGrp ='.$RegGrp;
               // $q1 = $this->db->where($where);
                
                $q1         = $this->db->get_where(tblreg9th,$where);    
            }
            else{
            $where = '(IsDeleted=0 or IsDeleted is null) and (Batch_ID = 0 or Batch_ID is null) and Sch_cd ='.$Inst_cd.' and Spec ='.$spl_cd;
             //  $q1 = $this->db->where($where);
                $q1         = $this->db->get_where(tblreg9th,$where);    
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
    public function user_info_Batch_Id($User_info_data)
    {
        // //DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        $RegGrp = $User_info_data['Batch_Id'];
       // $spl_cd = $User_info_data['spl_case'];

        // $forms_id = $User_info_data['forms_id'];
        $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
        $rowcount = $query->num_rows();
        
        if($rowcount > 0)
        {
               //$this->db->select("*");
               // $this->db->from(tblreg9th);
              $where = '(IsDeleted=0 or IsDeleted is null) and Sch_cd ='.$Inst_cd.' and Batch_Id = '.$RegGrp;
               // $q1 = $this->db->where($where);
                
                $q1         = $this->db->get_where(tblreg9th,$where);    
           
           

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
     public function getuser_info($User_info_data)
    {
        // //DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        
        $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            $q2         = $this->db->get_where('Registration..RuleFee_Reg_Nineth',array('Rule_Fee_ID'=>1));
            $resultarr = array("info"=>$query->result_array(),"rule_fee"=>$q2->result_array());
            return  $resultarr;
        }
        else
        {
            return  false;
        }
    }
    public function readmission_check($User_info_data)
    {
        
        
//        DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        $RollNo = $User_info_data['RollNo'];
        $spl_cd = $User_info_data['spl_case'];

        // $forms_id = $User_info_data['forms_id'];
        
        //$where = ' (spl_cd =  17 OR  spl_cd = 70 OR status = 4 OR status = 2)';
        $where = ' (spl_cd in(17 ,70) OR status in(4,2) OR sub1pf1 = 2 OR sub2pf1 = 2 OR sub3pf1 = 2 OR sub4pf1 = 2 OR sub5pf1 = 2 OR sub6pf1 = 2 OR sub7pf1 = 2 OR sub8pf1 = 2)';
        $this->db->where('rno', $RollNo);
     //   $query = $this->db->get_where(RE_ADMISSION_TBL,  array('rno' => $RollNo));
        $query = $this->db->where($where);
        $query = $this->db->get(RE_ADMISSION_TBL);
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

            $q1         = $this->db->query("select * from ".tblreg9th." where Sch_cd =$Inst_cd and (isdeleted = 0 or isdeleted is null)  and  formNo in($forms_id)");
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
            $q2         = $this->db->get_where('Registration..RuleFee_Reg_Nineth',array('Rule_Fee_ID'=>1));
            $resultarr = array("info"=>$query->result_array(),"fee"=>$result_1,"rule_fee"=>$q2->result_array());
            return  $resultarr;
        }
        else
        {
            return  false;
        }
    }
    
    public function getreulefee($ruleID)
    {
        $q2         = $this->db->get_where('Registration..RuleFee_Reg_Nineth',array('Rule_Fee_ID'=>$ruleID));
        return $resultarr = $q2->result_array();
    }
    public function Batch_Insertion($data,$AllUser)
    {
        //  //DebugBreak();

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
           $query = $this->db->query("Registration..Batch_Create_9th $inst_cd,$reg_fee,$fine,$processing_fee,$total_std,$total_fee,$TotalRegFee,$Totalprocessing_fee,$TotalLatefee,'$todaydate','$forms_id',".regyear.",9");  
        
        $rowcount = $query->num_rows();
         if ($rowcount > 0)
         {
            $chalno =  $query->result_array();
            $challan_no = $chalno[0]['Batch_ID'];
            if($challan_no > 0)
            {
                $this->db->update_batch('Registration..tblreg9th',$AllUser,'formNo');
                return 1;
            }
            else
            {
                return  0;
            }
         }
        else
        {
            return  0;
        }
    }
    public function Batch_List($data)
    {
        ////DebugBreak();
        $inst_cd = $data['Inst_Id'];
        $q2         = $this->db->get_where('Registration..tblregbatch',array('Inst_Cd'=>$inst_cd,'Is_Delete'=>0,'iyear'=>regyear,'class'=>9));
        $result = $q2->result_array();
        return $result;
    }
    public function return_pdf($fetch_data)
    {
        // //DebugBreak();
        $Inst_cd = $fetch_data['Inst_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];
        $query = $this->db->query("Registration..sp_reg_return_formInfo $Inst_cd,$Batch_Id");
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
        $query = $this->db->query("Registration..sp_reg_Print_Form $Inst_cd,$Grp_cd,$Batch_Id");
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
        $query = $this->db->query("Registration..sp_reg_Print_Form_formnowise $Inst_cd,'$start_formno','$end_formno',$Batch_Id");
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

        $this->db->select('FormNo,name, Fname, IsReAdm,regFee,RegProcessFee,RegFineFee,RegTotalFee,Spec');
        $this->db->from(tblreg9th);
        $this->db->order_by("FormNo", "asc");
        $this->db->where(array('Sch_cd' => $Inst_cd,'Batch_ID'=>$Batch_Id));
        $result_1 = $this->db->get()->result();
        //$query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',  array('Sch_cd' => $Inst_cd,'Batch_ID'=>$Batch_Id));
        //$rowcount = $query->num_rows();
        //if($rowcount > 0)
        //{
        //$q = $query->result_array();
        $query_1 = $this->db->get_where('Registration..tblregbatch',  array('Inst_Cd' => $Inst_cd,'Batch_ID'=>$Batch_Id,'iYear'=>regyear,'class'=>9));
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
     public function Print_challan_Form($fetch_data)
    {
        $Inst_cd = $fetch_data['Inst_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];

        // //DebugBreak();
        $query = $this->db->query("Registration..sp_Registration_9th_regular_Batch_challan $Inst_cd,$Batch_Id");
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
       public function forwarding_pdf_final($fetch_data)
    {
        ////DebugBreak();
        $Inst_cd = $fetch_data['Inst_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];
        $query = $this->db->query("Registration..spForwading_letter_final $Inst_cd,$Batch_Id");
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
                $query = $this->db->query("Registration..sp_regInfo_9th $inst_cd,9,".regyear.",1");    
            }

            else
            {
                $query = $this->db->query("Registration..sp_get_regInfo_spl_case_9th $inst_cd,9,".regyear.",1,$spl_cd");    
            }    
        }
        else
        {
            $query = $this->db->query("Registration..sp_get_regInfo_Groupwise_9th $inst_cd,9,".regyear.",1,$grp_selected");    
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
        $query = $this->db->get_where(tblreg9th,  array('BForm' => $bayformno,'IsDeleted'=>0));
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
        $query = $this->db->get_where(tblreg9th,  array('BForm' => $bayformno,'FNIC' => $fnic,'Dob' => $dob,'IsDeleted'=>0));
        $rowcount = $query->num_rows();
        if ($rowcount > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function bay_form_fnic($bayformno,$fnic)
    {
        $query = $this->db->get_where(tblreg9th,  array('BForm' => $bayformno,'FNIC' => $fnic,'IsDeleted'=>0));
        $rowcount = $query->num_rows();
        if ($rowcount > 0){
            return true;
        }
        else{
            return false;
        }
    }
     public function generateStrNo($sex,$fromno)
    {
        $query = $this->db->query("select max(regno) as regno from Registration..regcard9th where sex=$sex ");
        $maxnumber = $query->result_array()[0]['regno'];
        $maxnumber = $maxnumber+1;
        $year = substr( regyear, -2);
        $data2 = array(
            'regno'=>$maxnumber,
            'sex'=>$maxnumber,
            'formno'=>$fromno,
            'strRegNo'=>'2-1-'.$maxnumber.'-'.$year,
        );
        $res = $this->db->insert("Registration..regcard9th", $data2);


        $data2 = array(
            'strRegNo'=>'2-1-'.$maxnumber.'-'.$year,
        );
        $this->db->where('formno',$fromno);
        $res =  $this->db->update(tblreg9th, $data2);

        if ($res === FALSE) {
            return -1; // Or do whatever you gotta do here to raise an error
        } else {
            return '2-1-'.$maxnumber.'-'.$year;
        }  

         
    }
}
?>
