<?php
class RollNoSlip_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
      public function get9thStdData($inst_cd)
    {
        //DebugBreak();
        //  $query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 9, 'iyear' => 2016, 'regpvt'=>1,));
         $mClass =  9;
        $mSession =  mSession;
        $mYear =  mYear;
        $query = $this->db->query("Registration..get9thStdData $inst_cd,$mYear,$mClass,1,$mSession");
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
    public function get10thStdData($inst_cd)
    {
//DebugBreak();
        $mClass =  mClass;
        $mSession =  mSession;
        $mYear =  mYear;
        
        $query = $this->db->query("Registration..get10thStdData $inst_cd,$mYear,$mClass,$mSession,1");
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

     public function get12thStdData($inst_cd)
    {

        $mClass =  mClass1;
        $mSession =  mSession;
        $mYear =  mYear;
        
        
       //   DebugBreak();
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $inst_cd = $inst_cd;
        $query = $this->db->query("Registration..get12thStdData $inst_cd,$mYear,$mClass,$mSession,1");
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
    public function get10thStdDataDeaf($inst_cd)
    {

        //  DebugBreak();
        $query = $this->db->get_where('matric_new..tblbiodata_DFD', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        //$query = $this->db->query("Registration..get10thStdData $inst_cd,2016,10,1,1");
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
    public function get9thStdDataDeaf($inst_cd)
    {

        //  DebugBreak();
        $query = $this->db->get_where('matric_new..tblbiodata_DFD', array('sch_cd' => $inst_cd,'class' => 9, 'iyear' => 2016, 'regpvt'=>1,));
        //$query = $this->db->query("Registration..get10thStdData $inst_cd,2016,10,1,1");
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
    public function get10thrslipDataDeaf($rno,$class,$iyear,$sess)
    {

        // DebugBreak();
        $query = $this->db->query("Registration..MatricSlipInfo_DEAF $rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $this->db->order_by("Datesort", "ASC");
            //  $query = $this->db->query("select * from Registration..tblMRSlips where rno in( (select rno from Registration..tblMRSlips  where rno=$rno))"); 
            $query = $this->db->query("Registration..MatricSlips_Deaf $rno,$class,$iyear,$sess");
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  false;
        }
    }
    public function get9ththrslipDataDeaf($rno,$class,$iyear,$sess)
    {

        // DebugBreak();
        $query = $this->db->query("Registration..MatricSlipInfoP1_DEAF $rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $this->db->order_by("Datesort", "ASC");
            //  $query = $this->db->query("select * from Registration..tblMRSlips where rno in( (select rno from Registration..tblMRSlips  where rno=$rno))"); 
            $query = $this->db->query("Registration..MatricSlips9th_DEAF $rno,$class,$iyear,$sess,1");
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  false;
        }
    }
    public function get10thrslip($rno,$class,$iyear,$sess)
    {

     //    DebugBreak();
        $query = $this->db->query("Registration..MatricSlipInfo $rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $query = $this->db->query("Registration..MatricSlips $rno,$class,$iyear,$sess");
            //$this->db->order_by("Datesort", "ASC");
            //  $query = $this->db->query("select * from Registration..tblMRSlips where rno in( (select rno from Registration..tblMRSlips  where rno=$rno))"); 
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  false;
        }
    }
    public function get12thrslip($rno,$class,$iyear,$sess)
    {

        // DebugBreak();
        $query = $this->db->query("Registration..InterSlipInfo $rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $query = $this->db->query("Registration..InterSlips $rno,$class,$iyear,$sess");
            //$this->db->order_by("Datesort", "ASC");
            //  $query = $this->db->query("select * from Registration..tblMRSlips where rno in( (select rno from Registration..tblMRSlips  where rno=$rno))"); 
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  false;
        }
    }
       public function get9thrslip($rno,$class,$iyear,$sess)
    {

        $query = $this->db->query("Registration..MatricSlipInfoP1 $rno,$class,$iyear,$sess");

        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            // $query = $this->db->query("select * from Registration..maP1Datesheet2016 where rno in( (select rno from Registration..maP1Datesheet2016  where rno=$rno))"); 
            $query = $this->db->query("Registration..MatricSlips9th $rno,$class,$iyear,$sess,1");
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  -1;
        }
    }

    public function get10thrslipWith_Grp_CD($class,$iyear,$sess,$group_cd,$inst_cd,$sub_cd)
    {
        if($sub_cd == '')
            $sub_cd = -1;
        $query = $this->db->query("Registration..MatricSlipInfo_With_Grp_cd $class,$iyear,$sess,$group_cd,$inst_cd,$sub_cd");
        $rowcount = $query->num_rows();
        $row = array();
        $grpwiserow = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $this->db->order_by("Datesort", "ASC");
            if($sub_cd >0)
            {
                $query1 = $this->db->query("select * from Registration..tblMRSlips where rno in( (select rno from Registration..tblMRSlips  where grp_cd = $group_cd and sub_cd = $sub_cd and sch_cd = $inst_cd))");  
                // $query1 = $this->db->get_where('Registration..tblMRSlips', array('sch_cd' => $inst_cd,'grp_cd'=>$group_cd,'sub_cd'=>$sub_cd)); 
            }
            else
            {
                $query1 = $this->db->get_where('Registration..tblMRSlips', array('sch_cd' => $inst_cd,'grp_cd'=>$group_cd)); 
            }
            $rowcount = $query1->num_rows();
            $row['slip'] = $query1->result_array(); 
            return $row;
        }
        else
        {
            return  false;
        }
    }
   public function get12thrslipWith_Grp_CD($class,$iyear,$sess,$group_cd,$inst_cd)
    {
         //DebugBreak();
        $query = $this->db->query("Registration..InterSlipInfo_With_Grp_cd $class,$iyear,$sess,$group_cd,$inst_cd");
        $rowcount = $query->num_rows();
        $row = array();
        $grpwiserow = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $this->db->order_by("rno", "ASC");
            $this->db->order_by("Datesort", "ASC");

            $query1 = $this->db->query("select Count(*) as total from Registration..InterDatesheet2016 where  sch_cd ='$inst_cd' AND grp_cd = '$group_cd'");
            $rowcountslip = $query1->result_array(); 
            $limit =  '';   
            $remain = 0;    
            $start_row=  0;  
            $total = '';
            if($rowcountslip[0]['total']>8999)
            {
                $limit = 8999;
                $total = $rowcountslip[0]['total'];
                $remain = $total - $limit;
            }
            else
            {
                $limit = $rowcountslip[0]['total'];
            }
            $condition = " sch_cd = '$inst_cd' AND grp_cd =  $group_cd";
            
            $this->db->select('*');
            if(isset($limit)&& $limit!='')
                { $this->db->limit($limit, $start_row); }
            $this->db->from("Registration..InterDatesheet2016");
            if(isset($condition) && $condition != '')
                { $this->db->where($condition); } 
            $query = $this->db->get();
            $qry = $this->db->last_query();
            $slips[] = $query->result_array();
            //$rowcount = $query->num_rows();

            if($remain != '')
            {
                $this->db->select('*');
                if(isset($limit)&& $limit!='')
                    { $this->db->limit($total, $limit); }
                $this->db->from("Registration..InterDatesheet2016");
                if(isset($condition) && $condition != '')
                    { $this->db->where($condition); } 
                $query = $this->db->get();
                $slips[] = $query->result_array();
                //$rowcount = $query->num_rows(); 
            }

            if(count($slips)>1)
            {
                $slips = array_merge($slips[0],$slips[1]);
            }
            else
            {
                $slips = $slips[0];
            }
           // $totalslip =  count($slips);
            $row['slip'] = $slips ; 
            return $row;
        }
        else
        {
            return  false;
        }
    }
    /* public function get12thrslipWith_Grp_CD($class,$iyear,$sess,$group_cd,$inst_cd)
    {
        // DebugBreak();
        $query = $this->db->query("Registration..InterSlipInfo_With_Grp_cd $class,$iyear,$sess,$group_cd,$inst_cd");
        $rowcount = $query->num_rows();
        $row = array();
        $grpwiserow = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $this->db->order_by("Datesort", "ASC");

            $query1 = $this->db->get_where('Registration..InterDatesheet2016', array('sch_cd' => $inst_cd,'grp_cd'=>$group_cd)); 

            $rowcount = $query1->num_rows();
            $row['slip'] = $query1->result_array(); 
            return $row;
        }
        else
        {
            return  false;
        }
    }*/
    public function get9thrslipWith_Grp_CD($class,$iyear,$sess,$group_cd,$inst_cd,$sub_cd)
    {
        if($sub_cd == '')
            $sub_cd = -1;
        $query = $this->db->query("Registration..MatricSlipInfoWithGrp_cdP1 $class,$iyear,$sess,$group_cd,$inst_cd,$sub_cd");
        $rowcount = $query->num_rows();
        $row = array();
        $grpwiserow = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $this->db->order_by("Datesort", "ASC");
            /// $query1 = $this->db->query("select * from maP1Datesheet2016 where rno in( (select distinct rno from maP1Datesheet2016 a where grp_cd = $group_cd and sub_cd = $sub_cd and sch_cd = $inst_cd))");
            if($sub_cd >0)
            {
                $query1 = $this->db->query("select * from Registration..maP1Datesheet2016 where rno in( (select rno from Registration..maP1Datesheet2016  where grp_cd = $group_cd and sub_cd = $sub_cd and sch_cd = $inst_cd))");  

            }
            else
            {
                $query1 = $this->db->get_where('Registration..maP1Datesheet2016', array('sch_cd' => $inst_cd,'grp_cd'=>$group_cd)); 
            }
            $row['slip'] = $query1->result_array(); 
            return $row;
        }
        else
        {
            return  false;
        }
    }
    public function get10datesheetonly($rno,$class,$iyear,$sess)
    {
        $this->db->order_by("Datesort", "ASC");
        $query = $this->db->query("Registration..MatricSlips $rno,$class,$iyear,$sess");
        $row = $query->result_array();
        return $row;
    }
    public function get12datesheetonly($rno,$class,$iyear,$sess)
    {

        $this->db->order_by("Datesort", "ASC");
        $query = $this->db->query("Registration..InterSlips $rno,$class,$iyear,$sess");
        $row = $query->result_array();
        return $row;
    }
    public function get9datesheetonly($rno,$class,$iyear,$sess)
    {
        $this->db->order_by("Datesort", "ASC");
        $query = $this->db->query("Registration..MatricSlips9th $rno,$class,$iyear,$sess,1");
        $row = $query->result_array();
        return $row;
    }
    public function getPVT10thrslip($Name,$Fname,$Fnic,$rno,$formno,$class,$iyear,$sess)
    {
        $Name  = empty($Name) ? '' : $Name;
        $Fname  = empty($Fname) ? '' : $Fname;
        $Fnic  = empty($Fnic) ? '' : $Fnic;
        $formno  = empty($formno) ? '' : $formno;
        $rno  = empty($rno) ? 0 : $rno;


        //DebugBreak();
        $query = $this->db->query("Registration..MatricSlipInfopvt '$Name','$Fname','$Fnic','$formno',$rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $rno = $row['info'][0]['Rno'];
          
            $this->db->order_by("Datesort", "ASC");
            
            if( $row['info'][0]['grp_cd'] == 5)
            $query = $this->db->query("Registration..MatricSlips_Deaf_PVT $rno,$class,$iyear,$sess");
            else
            $query = $this->db->query("Registration..MatricSlipspvt $rno,$class,$iyear,$sess");
             //in( (select rno from Registration..tblMPSlips  where rno=$rno)
          //  $query = $this->db->query("select * from Registration..tblMPSlips where rno =  $rno"); 
            $row['info'][0]['slips'] = $query->result_array();
            //   $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  $rowcount;
        }
    }
    public function getPVT12thrslip($Name,$Fname,$Fnic,$rno,$formno,$class,$iyear,$sess)
    {
        $Name  = empty($Name) ? '' : $Name;
        $Fname  = empty($Fname) ? '' : $Fname;
        $Fnic  = empty($Fnic) ? '' : $Fnic;
        $formno  = empty($formno) ? '' : $formno;
        $rno  = empty($rno) ? 0 : $rno;


        //DebugBreak();
        $query = $this->db->query("Registration..InterSlipInfopvt '$Name','$Fname','$Fnic','$formno',$rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $rno = $row['info'][0]['Rno'];
            // $query = $this->db->query("Registration..MatricSlipspvt $rno,$class,$iyear,$sess");
            $this->db->order_by("Datesort", "ASC");
            $query = $this->db->query("select * from Registration..InterDatesheet2016pvt where rno in( (select rno from Registration..InterDatesheet2016pvt  where rno=$rno))"); 
            $row['info'][0]['slips'] = $query->result_array();
            //   $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  $rowcount;
        }
    }
    public function getPVT9thrslip($Name,$Fname,$Fnic,$rno,$formno,$class,$iyear,$sess)
    {
        $Name  = empty($Name) ? '' : $Name;
        $Fname  = empty($Fname) ? '' : $Fname;
        $Fnic  = empty($Fnic) ? '' : $Fnic;
        $formno  = empty($formno) ? '' : $formno;
        $rno  = empty($rno) ? 0 : $rno;


        //DebugBreak();
        $query = $this->db->query("Registration..MatricSlipInfopvtP1 '$Name','$Fname','$Fnic','$formno',$rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $rno = $row['info'][0]['Rno'];
            
            if( $row['info'][0]['grp_cd'] == 5)
                $query = $this->db->query("Registration..MatricSlips9th_DEAF $rno,$class,$iyear,$sess,2");
            else
                $query = $this->db->query("Registration..MatricSlips9th $rno,$class,$iyear,$sess,2");
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  $rowcount;
        }
    }
    public function get11thStdData($inst_cd)
    {
        //DebugBreak();
        //  $query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 9, 'iyear' => 2016, 'regpvt'=>1,));
        $query = $this->db->query("Registration..get11thStdData $inst_cd,2016,11,1,1");
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
    public function get11thrslip($rno,$class,$iyear,$sess)
    {
//DebugBreak();
        $query = $this->db->query("Registration..InterSlipInfoP1 $rno,$class,$iyear,$sess");

        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            // $query = $this->db->query("select * from Registration..maP1Datesheet2016 where rno in( (select rno from Registration..maP1Datesheet2016  where rno=$rno))"); 
            $query = $this->db->query("Registration..InterSlips11th $rno,$class,$iyear,$sess,1");
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  false;
        }
    }
     public function get11thrslipWith_Grp_CD($class,$iyear,$sess,$group_cd,$inst_cd)
    {
        //  DebugBreak();
        $query = $this->db->query("Registration..InterSlipInfo_With_Grp_cd_P1 $class,$iyear,$sess,$group_cd,$inst_cd");
        $rowcount = $query->num_rows();
        $row = array();
        $grpwiserow = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $this->db->order_by("Datesort", "ASC");

            $query1 = $this->db->get_where('Registration..InterP1Datesheet2016', array('sch_cd' => $inst_cd,'grp_cd'=>$group_cd)); 

            $rowcount = $query1->num_rows();
            $row['slip'] = $query1->result_array(); 
            return $row;
        }
        else
        {
            return  false;
        }
    }
     public function get11datesheetonly($rno,$class,$iyear,$sess)
    {

        $this->db->order_by("Datesort", "ASC");
        $query = $this->db->query("Registration..InterSlips11th $rno,$class,$iyear,$sess");
        $row = $query->result_array();
        return $row;
    }
    public function getPVT11thrslip($Name,$Fname,$Fnic,$rno,$formno,$class,$iyear,$sess)
    {
        $Name  = empty($Name) ? '' : $Name;
        $Fname  = empty($Fname) ? '' : $Fname;
        $Fnic  = empty($Fnic) ? '' : $Fnic;
        $formno  = empty($formno) ? '' : $formno;
        $rno  = empty($rno) ? 0 : $rno;


        //DebugBreak();
        $query = $this->db->query("Registration..InterSlipInfopvtP1 '$Name','$Fname','$Fnic','$formno',$rno,$class,$iyear,$sess");
        //$query = $this->db->get_where('matric_new..tblbiodata', array('sch_cd' => $inst_cd,'class' => 10, 'iyear' => 2016, 'regpvt'=>1,));
        $rowcount = $query->num_rows();
        $row = array();
        if($rowcount > 0)
        {
            $row['info']  = $query->result_array();
            $rno = $row['info'][0]['Rno'];
            $query = $this->db->query("select * from Registration..InterP1Datesheet2016pvt where rno in( (select rno from Registration..InterP1Datesheet2016pvt  where rno=$rno))"); 
            //$query = $this->db->query("Registration..InterSlips11th $rno,$class,$iyear,$sess,2");
            $row['info'][0]['slips'] = $query->result_array();
            return $row;
        }
        else
        {
            return  $rowcount;
        }
    }
    
}
?>
