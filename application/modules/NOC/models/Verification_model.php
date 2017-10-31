<?php
class Verification_model extends CI_Model 
{
    public function __construct()    {

        $this->load->database(); 
    }

    public function getresult_matric($rno,$year,$sess,$dob)
    {


        if($rno >400000)
        {
            $class =10;
        }
        else 

        {
            $class =9;
        }
        $query = $this->db->query("Registration..NOC_GET_STD_MATRIC $rno,$sess,$year,'$dob',$class");
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
    function generatepath($rno,$class,$year,$sess)
    {
        $query = $this->db->query("Registration..GetPicPath $rno,$sess,$year,$class");
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

    public function Pre_Matric_data($rno,$year,$sess,$matrno,$intclass)
    {

        //DebugBreak();

        $matched = 0;
        $query = $this->db->query("Registration..NOC_GET_Inter_STD_MAINFO $rno,$intclass,$year,$sess");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            @$info =  $query->result_array();

            $matrno =    $info[0]['matrno'];
            $sscsess =    $info[0]['sessofpass'];
            $ssiyear =    $info[0]['yearofpass'];
            if($info[0]['SpacialCase']!="" || (isset($info[0]['spl_cd'])))
            {
                $checkPreResult[0]['Mesg'] = $info[0]['SpacialCase']."";
            }
            $query = $this->db->query("Registration..Prev_Get_Student_Matric_For_NOC $matrno,$ssiyear,$sscsess"); //,$ssiyear,$sscsess,$rno,$year,$sess

            $rowcount = $query->num_rows();
            if($rowcount > 0)
            {
                @$checkPreResult =     $query->result_array(); 
                $new_inter_rno =      $checkPreResult[0]['rno'];
                $new_inter_class =    $checkPreResult[0]['class'];  
                $new_inter_iyear =    $checkPreResult[0]['iyear'];  
                $new_inter_sess =     $checkPreResult[0]['sess'];
                $new_matric_rno =     $checkPreResult[0]['SSC_RNo'];  
                $new_matric_Year =     $checkPreResult[0]['SSC_Year'];  
                $new_matric_Sess =     $checkPreResult[0]['SSC_Sess'];
                $checkPreResult[0]['Mesg'] =   $info[0]['SpacialCase'];
                if(!isset($checkPreResult[0]['Mesg']))
                {
                    $checkPreResult[0]['Mesg'] = '';
                }  

                if($matrno != $new_matric_rno || $sscsess != $new_matric_Sess || $ssiyear != $new_matric_Year || $rno !=$new_inter_rno || $intclass != $new_inter_class || $year != $new_inter_iyear || $sess != $new_inter_sess   )
                {
                    $checkPreResult[0]['matched']=0;
                    $checkPreResult[0]['SpacialCase'] = $info[0]['SpacialCase'];
                    $checkPreResult[0]['spl_cd'] = $info[0]['spl_cd'];
                    return $checkPreResult;
                }  

                if($new_inter_iyear > $year) 
                {

                    $matched = 0;
                }
                else  if($new_inter_sess > $sess && $new_inter_iyear == $year)
                {
                    $matched = 0;
                }
                else
                {
                    $matched = 1;

                }

                $checkPreResult[0]['matched']=$matched;
                return $checkPreResult;
            }
            else
            {
                return  false;
            }

        }
        else
        {
            return  false;
        }


        // DebugBreak();

    }
    public function insert_DATA_matric($MobNo,$rno,$year,$sess,$dob,$migratedto)
    {
        $dob1 = date('d-m-Y',strtotime($dob))   ;

        if($rno >400000)
        {
            $class =10;
        }
        else 

        {
            $class =9;
        }

        $query = $this->db->query("Registration..NOC_GET_STD_MATRIC $rno,$sess,$year,'$dob1',$class");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            $myresult =  $query->result_array();
            $multiquery = $myresult;  
            $this->db->select('app_No');
            $this->db->order_by("app_No", "DESC");
            $formno = $this->db->get_where('Registration..tblMig', array('isother'=> 1));
            $rowcount = $formno->num_rows();
            //  DebugBreak();
            if($rowcount == 0 )
            {
                $formno =  (NOC_APP_NO.'1' );
                // return $formno;
            }
            else
            {
                $row  = $formno->result_array();

                $formno = $row[0]['app_No']+1;
                // return $formno;
            }
            // DebugBreak();
            $app_no =   $formno;
            $formno = $myresult[0]['formno'];
            $rno =    $myresult[0]['SSC_RNo'];
            $sess = $myresult[0]['SSC_Sess'];
            $iyear = $myresult[0]['SSC_Year'];
            $class = $myresult[0]['SSC_CLASS'];
            $name = $myresult[0]['name'];
            $Fname = $myresult[0]['Fname'];
            $fnic = $myresult[0]['FNIC'];
            $gender = $myresult[0]['Gender'];
            $strregno = $myresult[0]['strregno'];

            $status = $myresult[0]['status'];
            $result1 = $myresult[0]['result1'];
            $result2 = $myresult[0]['result2'];

            if(!isset($status))
            {
                $status = 0;  
            }
            if(!isset($result1))
            {
                $result1 = 0;
            }
            if(!isset($result2))
            {
                $result2 = 0;
            }



            $picpath = '';

            //  debugbreak();
            $query_2 = $this->db->query("Registration..Insert_NOC_RECORD $app_no,'$formno',$rno,$sess,$iyear,$class,'$name','$Fname','$fnic',$gender,'$strregno',$migratedto,'$picpath',$status,'$result1','$MobNo'");
            $rowcount = $query_2->num_rows();
            if($rowcount > 0)
            {
                return $query->result_array();
            }
            else
            {   
                $query = $this->db->query("Registration..NOC_GET_INFO $app_no");
                $rowcount = $query->num_rows();
                if($rowcount > 0)
                {
                    return $query->result_array();
                }

            }


        }
        else
        {
            return  -1;
        }
    }
    public function insert_DATA_inter($rno,$year,$sess,$matrno,$intclass,$migratedto,$MobNo)
    {
        //DebugBreak();
        
        $query = $this->db->query("Registration..NOC_GET_Inter_STD_MAINFO $rno,12,$year,$sess");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {

            $info =  $query->result_array();

            $matrno =    $info[0]['matrno'];
            $sscsess =    $info[0]['sessofpass'];
            $ssiyear =    $info[0]['yearofpass'];

            $query = $this->db->query("Registration..Prev_Get_Student_Matric_For_NOC $matrno,$ssiyear,$sscsess"); //,$ssiyear,$sscsess,$rno,$year,$sess

            $rowcount = $query->num_rows();
            if($rowcount > 0)
            {
                $checkPreResult =     $query->result_array(); 
                $new_inter_rno =      $checkPreResult[0]['rno'];
                $new_inter_class =    $checkPreResult[0]['class'];  
                $new_inter_iyear =    $checkPreResult[0]['iyear'];  
                $new_inter_sess =     $checkPreResult[0]['sess'];  

            }
            else
            {
                return  false;
            }

        }
        else
        {
            return  false;
        }



        $myresult =  $checkPreResult;
        $multiquery = $myresult;  
        $this->db->select('app_No');
        $this->db->order_by("app_No", "DESC");
        //$formno = $this->db->get_where('Registration..tblMig',array('isother'=> 1, 'class'=> $intclass));
        $formno = $this->db->get_where('Registration..tblMig',array('isother'=> 1));
        $rowcount = $formno->num_rows();
        //  DebugBreak();
        if($rowcount == 0 )
        {
            $formno =  (NOC_APP_NO1.'1' );
            // return $formno;
        }
        else
        {
            $row  = $formno->result_array();

            $formno = $row[0]['app_No']+1;
            // return $formno;
        }
        // DebugBreak();
        $app_no =   $formno;
        $formno = trim($myresult[0]['formno'],' ');

        $class = $myresult[0]['class'];
        $iyear = $year;
        $name = $myresult[0]['name'];
        $Fname = $myresult[0]['Fname'];
        $fnic = $myresult[0]['FNIC'];
        $gender = $myresult[0]['Gender'];
        $strregno = $myresult[0]['strregno'];

        $status = $myresult[0]['status'];
        $result1 = $myresult[0]['result1'];
        $result2 = $myresult[0]['result2'];

        if(!isset($status))
        {
            $status = 0;  
        }
        if(!isset($result1))
        {
            $result1 = 0;
        }
        if(!isset($result2))
        {
            $result2 = 0;
        }

        $picpath = '';

        //debugbreak();
        $query_2 = $this->db->query("Registration..Insert_NOC_RECORD $app_no,'$formno',$rno,$sess,$iyear,$class,'$name','$Fname','$fnic',$gender,'$strregno',$migratedto,'$picpath',$status,'$result1','$MobNo'");
        $rowcount = $query_2->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {   
            $query = $this->db->query("Registration..NOC_GET_INFO $app_no");
            $rowcount = $query->num_rows();
            if($rowcount > 0)
            {
                return $query->result_array();
            }

        }
    }
    public function Downolad_data ($app_no)
    {
        $query = $this->db->query("Registration..NOC_GET_INFO $app_no");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }   
    }

    public function check_status ($appNo,$class)
    {
        $this->db->select('ismigrated, BiseAdminMsg');
        //$this->db->order_by("app_No", "DESC");
        $formno = $this->db->get_where('Registration..tblMig',array('app_No'=>$appNo,'isother'=>1));

        $rowcount = $formno->num_rows();
        //  DebugBreak();
        if($rowcount > 0 )
        {
            return $formno->result_array();
            // return $formno;
        }
        else
        {
            return false;
        }
    }



}
?>
