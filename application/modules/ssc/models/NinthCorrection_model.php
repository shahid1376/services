<?php
  class NinthCorrection_model extends CI_Model 
{
    public function __construct()    
    {

        $this->load->database(); 



    }
      public function GetAppNo()
    {
        // DebugBreak();
        $this->db->select('AppNo');
        $this->db->order_by("AppNo", "DESC");
        $appno = $this->db->get_where('Registration..MA_P1_Reg_Correction');
        $rowcount = $appno->num_rows();

        if($rowcount == 0 )
        {
            $appno =  (Corr_ApplicationNo.'1' );
            return $appno;
        }
        else
        {
            $row  = $appno->result_array();
            $appno = $row[0]['AppNo']+1;
            return $appno;
        }

    }
      public function getreulefee($ruleID)
    {
        $q2         = $this->db->get_where('Registration..RuleFee_Reg_Nineth_Correction',array('Rule_Fee_ID'=>$ruleID));
        return $resultarr = $q2->result_array();
    }
     public function Update_NewEnorlement($data)//$father_name,$bay_form,$father_cnic,$dob,$mob_number)  MA_P1_Reg_Adm2016_sp_Update
    {
      //  DebugBreak();
         /*'name'=>$corr_name,
            'Fname'=>$corr_Fname,
            'BForm'=>$corr_BForm,
            'FNIC'=>$corr_FNIC,
            'Dob'=>$corr_Dob,
            'RegGrp'=>$corr_grp_cd,
            'NameFee'=>$NameFee,
            'FnameFee'=>$FnameFee,
            'DobFee'=>$DobFee,
            'FNICFee'=>$FNICFee,
            'BFormFee'=>$BFormFee,
            'grpFee'=>$grpFee,
            'subFee'=>$subFee,
            'picFee'=>$PicFee,
            'totalFee'=>$corr_totalFee,
            'sub1'=>$corr_sub1,'sub2'=>$corr_sub2,'sub3'=>$corr_sub3,
            'sub4'=>$corr_sub4,'sub5'=>$corr_sub5,
            'sub6'=>$corr_sub6,'sub7'=>$corr_sub7,
            'sub8'=>$corr_sub8,'PicPath'=>$config['file_name'],'formNo'=>@$_POST['formNo'],
            'AppNo'=>$AppNo,
            'Pic'=>$isPic,*/
        $name =strtoupper($data['name']) ;
        $fname =strtoupper($data['Fname']);
        $BForm = $data['BForm'];
        $FNIC = $data['FNIC'];
        $Dob = $data['Dob'];
        
      if(($data['RegGrp'] == 1) or ($data['RegGrp'] == 7) or ($data['RegGrp'] == 8) )
        {
            $grp_cd = 1;    
        }
        else if($data['RegGrp'] == 2 )
        {
            $grp_cd = 2;        
        }
        else if($data['RegGrp'] == 5 )
        {
            $grp_cd = 5;        
        }
        else{
            $grp_cd = 0;   
               
        }
       
           // $reg_grp = $data['RegGrp']; 
       
        $sub1= $data['sub1'];
        $sub2 = $data['sub2'];
        $sub3 = $data['sub3'];
        $sub4 = $data['sub4'];
        $sub5 = $data['sub5'];
        $sub6 = $data['sub6'];
        $sub7 = $data['sub7'];
        $sub8 = $data['sub8'];
        $Inst_cd = $data['Inst_cd'];
        $RegGrp = $data['RegGrp'];
        $formno = $data['formNo'];
        $NameFee = $data['NameFee'];
        $FnameFee = $data['FnameFee'];
        $DobFee = $data['DobFee'];
        $FNICFee = $data['FNICFee'];
        $BFormFee = $data['BFormFee'];
        $grpFee = $data['grpFee'];
        $subFee = $data['subFee'];
        $picFee = $data['picFee'];
        $totalFee = $data['totalFee'];
        $AppNo = $data['AppNo'];
        $Pic = $data['Pic'];
        $PicPath = $data['PicPath'];
         $year = regyear;
        $query = $this->db->query("Registration..MA_P1_Reg_Correction_sp_insert '$formno',9,$year,1,'$name','$fname','$BForm','$FNIC','$Dob',$grp_cd,$sub1,$sub2,$sub3,$sub4,$sub5,$sub6,$sub7,$sub8,$Pic,$Inst_cd,$RegGrp,$NameFee,$FnameFee,$BFormFee,$DobFee,$FNICFee,$grpFee,$subFee,$picFee,$totalFee,$AppNo");
        //$query = $this->db->insert('msadmissions2015', $data);//,'Fname' => $father_name,'BForm'=>$bay_form,'FNIC'=>$father_cnic,'Dob'=>$dob,'CellNo'=>$mob_number));
         return $query->result_array();
       // return true;
    }
      public function EditEnrolement($inst_cd)
    {

       //  DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        //sp_get_regInfo_spl_case
         $iyear =  regyear;
        $query = $this->db->query("Registration..sp_get_regInfo_Correction $inst_cd,9,$iyear,1");    





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
    public function Print_challan_Form($fetch_data)
    {
        $Inst_cd = $fetch_data['Inst_cd'];
        $formno = $fetch_data['formno'];
      
      //DebugBreak();
     $year = regyear;
        $query = $this->db->query("Registration..sp_get_regInfo_correction_challan $Inst_cd,9,$year,1,'$formno'");
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
    public function Print_corr_Form_Final($fetch_data)
    {
        //  debugbreak();
        $Inst_cd = $fetch_data['Inst_cd'];
        $AppNo = $fetch_data['AppNo'];
        
        $query = $this->db->query("Registration..sp_get_reg_Print_Form_Correction $Inst_cd,$AppNo");
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
    public function EditEnrolement_Applied($inst_cd)
    {
              $iyear =  regyear;
        // DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        //sp_get_regInfo_spl_case

        $query = $this->db->query("Registration..sp_get_regInfo_after_Correction $inst_cd,9,$iyear,1");    





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
    public function EditEnrolement_Branch()
    {

       // DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        //sp_get_regInfo_spl_case
                         $iyear =  regyear;
        $query = $this->db->query("Registration..sp_get_regInfo_after_Correction_Branch 9,$iyear,1");    





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
    public function Delete_Corr_App($AppNo)
    {
        $data=array('isDeleted'=>1);
        $this->db->where('AppNo',$AppNo);
        $this->db->update('Registration..MA_P1_Reg_Correction',$data);
        return true;

    }

}
?>
