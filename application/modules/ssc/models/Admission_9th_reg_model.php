<?php

class Admission_9th_reg_model extends CI_Model 
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
    public function Incomplete_inst($allinfo,$inst_cd)
    {
        //  //DebugBreak();
        $data = array(
            'Inst_cd' => $inst_cd ,
            'zone_cd' => $allinfo['pvtZone'] ,
            'class' => 9 ,
            'iyear' => Year ,
            'sess' => Session ,
        );

        $res = $this->db->insert('Registration..Instexam_Info', $data); 
        return $res;
    }
    public function iszoneset($inst_cd){
       
        $query = $this->db->get_where('Registration..Instexam_Info', array('iyear' => Year,'class'=>9,'sess'=>Session,'inst_cd'=>$inst_cd));
        $rowcount = $query->num_rows();
       
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  0;
        }
    }
    public function getStudentsData($data){
        //sp_form_data
        //SELECT * FROM  fl_dataforMa15 WHERE  (isSubmit is null or isSubmit= 0) and class = 9 and iyear = 2014 and sch_cd = ".$user->inst_cd
        // DebugBreak();
        $inst_cd = $data['Inst_Id'];
        $gender = $data['gender'];
        $query = $this->db->query("Registration..SP_Get9thRecord_2016 $inst_cd,9,2016,1,$gender");
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
    public function get_zone()
    {

        //$this->db->select('zone_cd','zone_name');
        //$this->db->order_by("formno", "DESC"); myear = 2016 and class = 10 and sess = 1 
        $query = $this->db->get_where('matric_new..tblZones', array('myear' => '2017','class'=>10,'sess'=>1, 'Flag'=> 1 ));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();

        }



    }
    public function getuser_infoPVT($User_info_data)
    {
        //  DebugBreak();
        $Inst_cd = $User_info_data['Inst_Id'];
        $date = $User_info_data['date'];
        $isPratical = $User_info_data['isPratical'];

        $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
       
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
              

            $query2 = $this->db->get_where('Admission_Online..RuleFeeAdm', array('class' => 10,'sess' => 1, 'Start_Date <=' =>$date,'End_Date >='=>$date,'isPrSub'=>$isPratical));
            $resultarr = array("info"=>$query->result_array(),"rule_fee"=>$query2->result_array());
           
          $qry =  $this->db->last_query();
           
            return  $resultarr;
        }
        else
        {
            return  false;
        }
    }
    public function forwarding_pdf_final($fetch_data)
    {
        //DebugBreak();
        $Inst_cd = $fetch_data['Inst_cd'];
        $query = $this->db->query("Registration..sp_Forwading_letter_final_9TH $Inst_cd");
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
    public function forwarding_pdf_Finance_final($fetch_data)
    {
        //DebugBreak();
        $Inst_cd = $fetch_data['Inst_cd'];
       // $query = $this->db->query("Admission_online..sp_Forwading_letter_final_10TH $Inst_cd");
        $query = $this->db->query("Admission_online..sp_ForwardingLetter_Finance_9thADM $Inst_cd");
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
    public function Dashboard($inst_cd)
    {

        // //DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $query = $this->db->query("Registration..Dashboard_Adm_9th $inst_cd");



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
    public function get_formno_data($formno){

        ////DebugBreak();
        $query = $this->db->query(formprint_sp_9th."'$formno'");
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
       // DebugBreak();
        $name = strtoupper($data['name']);
        $fname =strtoupper($data['Fname']);
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $Dob = $data['Dob'];
        $CellNo = $data['CellNo'];
        $medium = $data['medium'];
       
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
        $Inst_cd = 999999;
        $formno = $data['FormNo'];
        $RegGrp = $data['grp_cd'];
        $dist = $data['dist'];
        $teh = $data['teh'];
        $zone = $data['zone'];
         //$Dob = date('Y-m-d', strtotime($Dob)); 
        $query = $this->db->query("Registration..MA_P1_PVT_Adm2016_sp_insert '$formno',9,2016,1,'$name','$fname','$BForm','$FNIC','$Dob','$CellNo',$medium,'".$MarkOfIden."',$Speciality,$nat,$sex,$rel,'".$addr."',$grp_cd,$sub1,$sub1ap1,$sub2,$sub2ap1,$sub3,$sub3ap1,$sub4,$sub4ap1,$sub5,$sub5ap1,$sub6,$sub6ap1,$sub7,$sub7ap1,$sub8,$sub8ap1,1,0,0,0,0,$IsHafiz,$Inst_cd,$UrbanRural,$RegGrp,$dist,$teh,$zone");
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));

        return $query->result_array();
    }      
    public function EditPicEnrolement($inst_cd)
    {

        // DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        //sp_get_regInfo_spl_case

        $query = $this->db->query("Registration..sp_get_regPicInfo $inst_cd,9,2016,1");    





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
    public function getzone($tehcd)
    {

        $query = $this->db->get_where('matric_new..tblZones', array('mYear' => 2017,'Class' => 10,'Sess'=>1, 'teh_cd' => $tehcd,'Flag'=> 1 ));
        // //DebugBreak();
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
        
        $where = " mYear = 2017  AND class =10  AND  sess = 1 AND Zone_cd =  $zone  AND  (cent_Gen = $gend OR cent_Gen = 3) ";      
        $query = $this->db->query("SELECT * FROM matric_new..tblcentre WHERE $where");

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
    public function Update_NewEnorlement($data)//$father_name,$bay_form,$father_cnic,$dob,$mob_number)  MA_P1_Reg_Adm2016_sp_Update
    { 
        //DebugBreak();
        // $forms_id =array("'" . implode("','", $_POST["chk"]) . "'");
       
        if(@$_POST['isformwise']==1)
        {
            $forms_id =array(implode(',',$_POST["chk"]));
            $myc = count($_POST["chk"]);
            for ($i = 0; $i < count($_POST["chk"]); $i++) 
            {
                $sm_data[] = array(
                    'IsAdmission'=>1,'cDate'=> date('Y-m-d H:i:s'),'formNo'=>$_POST["chk"][$i],
                    'zone_cd'=>$_POST["zone_cd"]
                );
            }
            $sm_data ;
            $this->db->update_batch('Registration..MA_P1_Reg_Adm2016',$sm_data,'formNo');
        }
        else if(@$_POST['isformwise']==2)
        {
            $data=array('IsAdmission'=>1,'cDate'=> date('Y-m-d H:i:s'));
            $this->db->where('Reggrp',$_POST['make_adm9th_groups']);
             $this->db->where('Sch_cd',$_POST['Inst_Id']);
            $this->db->update('Registration..MA_P1_Reg_Adm2016',$data);
        }
        else if(@$_POST['isformwise']==3)
        {
            $forms_id =array(implode(',',$_POST["chk"]));
            $myc = count($_POST["chk"]);
            for ($i = 0; $i < count($_POST["chk"]); $i++) 
            {
                $sm_data[] = array(
                    'IsAdmission'=>0,'cDate'=> date('Y-m-d H:i:s'),'formNo'=>$_POST["chk"][$i],'zone_cd'=>$_POST["zone_cd"]
                );
            }
            $sm_data ;
            $this->db->update_batch('Registration..MA_P1_Reg_Adm2016',$sm_data,'formNo');
        }

        return true;
    }
    public function checknextrno($name,$dob,$fnic)
    {
    
        $query = $this->db->query("admission_online..NextAppearanceSSC 0,9,0,0,'$name','$dob','$fnic','',3");
        
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
    public function checknextrno_newAdmission($name,$dob,$fnic,$bform)
    {
    
        $query = $this->db->query("admission_online..NextAppearanceSSC 0,9,".regyear.",0,'$name','$dob','$fnic','$bform',4");
        
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
    public function Update_AdmissionFee($data,$inst_cd,$grp_cd,$isformwise,$startFormno,$endingFormno)
    {
         if(empty($data))
        {
           return  false;
        }
        $this->db->update_batch('Registration..MA_P1_Reg_Adm2016',$data,'formNo');
        // DebugBreak();
           if($isformwise == 9)
        {
        $this->db->select('Sum(AdmFee) as sum_AdmFee,sum(AdmProcessFee) as sum_procFee,sum(AdmFine) as sum_admfine,sum(AdmTotalFee) as sum_TotalFee',False);
        $this->db->group_by("Sch_cd");
        $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016', array('sch_cd' => $inst_cd,'isdeleted'=>0,'IsAdmission'=>1)); 
        }
          else if($isformwise == 6)
        {
        $this->db->select('Sum(AdmFee) as sum_AdmFee,sum(AdmProcessFee) as sum_procFee,sum(AdmFine) as sum_admfine,sum(AdmTotalFee) as sum_TotalFee',False);
        $this->db->group_by("Sch_cd");
        $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016', array('sch_cd' => $inst_cd,'isdeleted'=>0,'IsAdmission'=>1)); 
        }
       else if($isformwise == 4)
        {
            $grp_cd = $grp_cd;
            $this->db->select('formNo,name, Fname,RegGrp, sub6,sub7,sub8,grp_cd, IsReAdm,AdmFee,AdmProcessFee,AdmFine,AdmTotalFee,Spec');
            if($grp_cd == 7)
            {
                $sub_cd= 78;   
                $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016', array('sch_cd' => $inst_cd,'grp_cd'=>1,'sub8'=>$sub_cd,'IsAdmission'=>1,'isdeleted'=>0 ,'batch_id > '=>0)); 
            }
            else if($grp_cd == 8)
            {
                $sub_cd= 43;  
                $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016', array('sch_cd' => $inst_cd,'grp_cd'=>1,'sub8'=>$sub_cd,'IsAdmission'=>1,'isdeleted'=>0 ,'batch_id > '=>0));
            }
            else if ($grp_cd == 1  )
            {
                $sub_cd= 8; 
                $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016', array('sch_cd' => $inst_cd,'grp_cd'=>1,'sub8'=>$sub_cd,'IsAdmission'=>1,'isdeleted'=>0 ,'batch_id > '=>0));  
            }
            else if ($grp_cd == 2 OR  $grp_cd== 5 )
            {
                $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016', array('sch_cd' => $inst_cd,'grp_cd'=>$grp_cd,'IsAdmission'=>1,'isdeleted'=>0 ,'batch_id > '=>0));
            }
        }
        else
        {
        $this->db->select('formNo,name, Fname,RegGrp,grp_cd sub6,sub7,sub8, IsReAdm,AdmFee,AdmProcessFee,AdmFine,AdmTotalFee,Spec');
        $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016', array('sch_cd' => $inst_cd,'formNo <= '=>$startFormno,'formNo >='=>$endingFormno,'IsAdmission'=>1)); 
        }
        //$query = $this->db->get("Registration..MA_P1_Reg_Adm2016");    
        $rowcount = $query->num_rows();
        //DebugBreak();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }

    }
    public function Update_AdmissionFeePvt($data)
    {
             //DebugBreak();
            $data['IsAdmission']=1;
            $data['cdate']= date('Y-m-d H:i:s');
            $this->db->where('formNo',$data['formNo']);
            $this->db->update('Registration..MA_P1_Reg_Adm2016',$data);
       // $this->db->update_batch('Registration..MA_P1_Reg_Adm2016',$data,'formNo');
        // DebugBreak();
        
        $this->db->select('regFee,AdmFee,AdmProcessFee,AdmFine,AdmTotalFee');
        $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016', array('formNo'=>$data['formNo'])); 
       
        //$query = $this->db->get("Registration..MA_P1_Reg_Adm2016");    
        $rowcount = $query->num_rows();
        //DebugBreak();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  false;
        }

    }
    public function Make_adm($myinfo)
    {  
        //DebugBreak();
        $inst_cd = $myinfo['Inst_cd'];
        $spl_cd = $myinfo['spl_cd'];
        $grp_selected = $myinfo['grp_selected'];
        $sess = Session;
        $Year = Year-1;
        if($grp_selected == FALSE)
        {
            $query = $this->db->query("Registration..sp_get_regInfo_9th_Make_adm $inst_cd,9,$Year,$sess");    
        }
        else
        {
            $query = $this->db->query("Registration..sp_get_regInfo_Groupwise_9th_Make_adm $inst_cd,9,$Year,$sess,$grp_selected");    
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
    public function Cancel_adm($myinfo) //sp_get_regInfo_9th_Cancel_adm
    {
        $inst_cd = $myinfo['Inst_cd'];

        $query = $this->db->query("Registration..sp_get_regInfo_9th_Cancel_adm $inst_cd,9,2016,1");    
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
    public function EditEnrolement($inst_cd)
    {

        // //DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        //sp_get_regInfo_spl_case

        $query = $this->db->query("Registration..sp_get_regInfo_9thAdm2016 $inst_cd,9,2016,1");    





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

        $query = $this->db->query("Registration..ReleaseBatch_INSERT $Inst_cd,$batchid,'$reason','$branch',$challan,$amount,'$date'");
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
        return true;
    }
    public function EditEnrolement_data($formno,$year,$inst_cd)
    {

        //  //DebugBreak();
        /* if($year == 2015){
        $query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' =>9, 'iyear' => 2016, 'regpvt'=>1,'formNo'=>$formno));     
        }
        else{
        $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',  array('formNo' => $formno,'class'=>9,'iyear'=>$year,'sess'=>1));     
        } */

        $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',  array('formNo' => $formno,'class'=>9,'iyear'=>$year,'sess'=>1));     

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
        $data=array('IsAdmission'=>0,'cDate'=> date('Y-m-d H:i:s'));
        $this->db->where('formNo',$formno);
        $this->db->update('Registration..MA_P1_Reg_Adm2016',$data);
        return true;

    }
    public function GetFormNo($Inst_Id)
    {
        // //DebugBreak();
        $this->db->select('formno');
        $this->db->order_by("formno", "DESC");
        $formno = $this->db->get_where('Registration..MA_P1_Reg_Adm2016', array('sch_cd' => $Inst_Id));
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
    public function GetFormNoPVT()
    {
        // //DebugBreak();
        $this->db->limit(1);
        $this->db->select('formno');
      //  $this->db->order_by("formno", "DESC");
              $this->db->order_by("cast(formno as int)", "DESC");
        $formno = $this->db->get_where('Registration..MA_P1_Reg_Adm2016', array('regpvt' => 2));
        $rowcount = $formno->num_rows();

        if($rowcount == 0 )
        {
            $formno =  (formno_9thpvt+1 );
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
                $q1         = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',array('Sch_cd'=>$Inst_cd,'IsDeleted'=>0,'Batch_ID'=>0,'RegGrp'=>$RegGrp));    
            }
            else{
                $q1         = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',array('Sch_cd'=>$Inst_cd,'IsDeleted'=>0,'Batch_ID'=>0,'Spec'=>$spl_cd));    
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
    public function name_fname_dob_fnic_comp($name,$fname,$dob,$fnic)
    {
        $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',  array('name' => $name,'Fname'=>$fname,'FNIC' => $fnic,'Dob' => $dob,'IsDeleted'=>0));
        $rowcount = $query->num_rows();
        if ($rowcount > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function getuser_info($User_info_data)
    {
        //  DebugBreak();
           $Inst_cd = $User_info_data['Inst_Id'];
        $date = $User_info_data['date'];

        $query = $this->db->get_where('Admission_online..tblinstitutes_all',  array('Inst_cd' => $Inst_cd));
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            $query2 = $this->db->get_where('Admission_Online..RuleFeeAdm', array('class' => 10,'sess' => 1, 'Start_Date <='=>$date,'End_Date >='=>$date));
            $resultarr = array("info"=>$query->result_array(),"rule_fee"=>$query2->result_array());
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

            $q1         = $this->db->query("select * from Registration..MA_P1_Reg_Adm2016 where Sch_cd =$Inst_cd and isdeleted = 0 and  formNo in($forms_id)");
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
    public function Batch_Insertion($data)
    {
        // //DebugBreak();

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
        $query = $this->db->query("Registration..Batch_Create_9th_2016 $inst_cd,$reg_fee,$fine,$processing_fee,$total_std,$total_fee,$TotalRegFee,$Totalprocessing_fee,$TotalLatefee,'$todaydate','$forms_id'");
    }
    public function Batch_List($data)
    {
        ////DebugBreak();
        $inst_cd = $data['Inst_Id'];
        $q2         = $this->db->get_where('Registration..fl_reg_batch_test',array('Inst_Cd'=>$inst_cd,'Is_Delete'=>0));
        $result = $q2->result_array();
        return $result;
    }
    public function return_pdf($fetch_data)
    {
        // //DebugBreak();
        $Inst_cd = $fetch_data['Inst_cd'];
        $Batch_Id = $fetch_data['Batch_Id'];
        $query = $this->db->query("Registration..sp_get_reg_return_formInfo $Inst_cd,$Batch_Id");
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
        $query = $this->db->query("Registration..sp_get_adm_Print_Form_9th $Inst_cd,$Grp_cd,$Batch_Id");
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
        $query = $this->db->query("Registration..sp_get_adm_Print_Form_formnowise_9th $Inst_cd,'$start_formno','$end_formno',$Batch_Id");
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
        //DebugBreak();

        $Inst_cd = $fetch_data['Inst_cd'];
        $this->db->select('formNo,name, Fname, sub6,sub7,sub8,grp_cd, IsReAdm,regFee,RegProcessFee,RegFineFee,RegTotalFee,Spec,challan_overall,challanno');
        $this->db->from('Registration..MA_P1_Reg_Adm2016');
        if($fetch_data['option']==4)
        {
            
            
            $grp_cd = $fetch_data['grp_cd'];
            
            if($grp_cd == 7)
            {
             $sub_cd= 78;   
              $this->db->where(array('Sch_cd' => $Inst_cd,'grp_cd'=>1,'sub8'=>$sub_cd,'IsAdmission'=>1 ,'isdeleted'=>0 ,'batch_id > '=>0));
            }
            else if($grp_cd == 8)
            {
               $sub_cd= 43;  
                $this->db->where(array('Sch_cd' => $Inst_cd,'grp_cd'=>1,'sub8'=>$sub_cd,'IsAdmission'=>1 ,'isdeleted'=>0 ,'batch_id > '=>0));
            }
            else if ($grp_cd == 1  )
            {
                $sub_cd= 8; 
                $this->db->where(array('Sch_cd' => $Inst_cd,'grp_cd'=>1,'sub8'=>$sub_cd,'IsAdmission'=>1 ,'isdeleted'=>0 ,'batch_id > '=>0));  
            }
            else if ($grp_cd == 2 OR  $grp_cd== 5 )
            {
               $this->db->where(array('Sch_cd' => $Inst_cd,'grp_cd'=>$grp_cd,'IsAdmission'=>1 ,'isdeleted'=>0 ,'batch_id > '=>0)); 
            }
          

        }
        else if($fetch_data['option']==5)
        {
            $start_formno = $fetch_data['startformno'];
            $end_formno = $fetch_data['endformno'];
            $this->db->where('formNo >=', $start_formno);
            $this->db->where('formNo <=', $end_formno);
            $this->db->where('Sch_cd', $Inst_cd);
            $this->db->where('IsAdmission', 1);
            $this->db->where('isdeleted', 0);
            $this->db->where('batch_id >' , 0);
        }
         else  if($fetch_data['option']==6)
        {
            $grp_cd = $fetch_data['Grp_cd'];
            $this->db->where(array('Sch_cd' => $Inst_cd));
            $this->db->where('IsAdmission', 1);
            $this->db->where('isdeleted', 0);
            $this->db->where('batch_id >' , 0);
            
            if($grp_cd == 7)
            {
                $sub_cd= 78;   
                $this->db->where(array('grp_cd'=>1,'sub8'=>$sub_cd));  
            }
            else if($grp_cd == 8)
            {
                $sub_cd= 43;  
                $this->db->where(array('grp_cd'=>1,'sub8'=>$sub_cd));  
            }
            else if ($grp_cd == 1  )
            {
                $sub_cd= 8; 
                $this->db->where(array('grp_cd'=>1,'sub8'=>$sub_cd));  
            }
            else if ($grp_cd == 2 OR  $grp_cd== 5 )
            {
                $this->db->where(array('grp_cd' => $grp_cd)); 
            }
            
            
            
           

        }
         else  if($fetch_data['option']==9)
        {
            $grp_cd = $fetch_data['Grp_cd'];
            $this->db->where('Sch_cd' , $Inst_cd);
            $this->db->where('IsAdmission',1);
            $this->db->where('isdeleted', 0);
            $this->db->where('batch_id >' , 0);

        }
        $result_1 = $this->db->get()->result();
        //$query_1 = $this->db->get_where('Registration..fl_reg_batch_test',  array('Inst_Cd' => $Inst_cd,'Batch_ID'=>$Batch_Id));
        // $rowcount = $result_1->num_rows();
        //if($rowcount > 0){
        //    $query_1 = $query_1->result_array();
        return $result = array('stdinfo'=>$result_1);    
        //}
        // else
        //{
        //  return  false;
        //}
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
                $query = $this->db->query("Registration..sp_get_regInfo $inst_cd,9,2016,1");    
            }

            else
            {
                $query = $this->db->query("Registration..sp_get_regInfo_spl_case $inst_cd,9,2016,1,$spl_cd");    
            }    
        }
        else
        {
            $query = $this->db->query("Registration..sp_get_regInfo_Groupwise $inst_cd,9,2016,1,$grp_selected");    
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
        $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',  array('BForm' => $bayformno,'IsDeleted'=>0));
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
        $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',  array('BForm' => $bayformno,'FNIC' => $fnic,'Dob' => $dob,'IsDeleted'=>0));
        $rowcount = $query->num_rows();
        if ($rowcount > 0){
            return true;
        }
        else{
            return false;
        }
    }
    public function challan_all($info)
    {
    
        // DebugBreak();
        
        $this->db->select('challan_overall');
       //  $this->db->where('challan_overall',False);
       $inst_cd =  $info['Inst_Id'];
       // $this->db->order_by("challan_overall", "DESC");
        $formno = $this->db->get_where('Registration..MA_P1_Reg_Adm2016', array('sch_cd' => $inst_cd,'challan_overall '=>0 ,'isdeleted '=> 0));
        $rowcount = $formno->num_rows();

        if($rowcount > 0 )
        {
        $query = $this->db->query("Admission_online..sp_gen_challanNo_overall $inst_cd");
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
       //  $challanno =  $query->result_array();  
        }
        
    }
    public function bay_form_fnic($bayformno,$fnic)
    {
        $query = $this->db->get_where('Registration..MA_P1_Reg_Adm2016',  array('BForm' => $bayformno,'FNIC' => $fnic,'IsDeleted'=>0));
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
