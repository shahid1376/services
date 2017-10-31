<?php
class Login_model extends CI_Model {
    public function __construct() {
        $this->load->database(); 
    }
    public function auth($username,$password) 
    {
       // DebugBreak();
        
		$query = $this->db->get_where('Admission_online..tblInstitutes_all', array('inst_cd' => $username,'Inst_pwd' => $password));
		$rowcount = $query->num_rows();
		if($rowcount >0)
		{
            $query_1 = $this->db->get_where('Admission_online..tblInstitutes_all', array('Inst_cd' => $username));
            
            
            $tblInstitutes_all_Info  = $this->db->get_where('Registration..tblInstitutes_all_Info', array('inst_cd' => $username));
            $specialPermission = $this->db->get_where('Registration..inst_Special_Permission_9th',array('inst_cd'=>$username,'Isactive'=>1));
            if($specialPermission->num_rows()>0)
            {
                
                $isSpecial=1;
                $isSpecial_Info= $specialPermission->row_array();
            }
            else{
                $isSpecial=0;
                $isSpecial_Info = false;
            }
            $isInserted = 0;
            if ($tblInstitutes_all_Info->num_rows() > 0)
            {
                $isInserted = 1;
            }
               $allinfo = array('flusers'=>$query->row_array(), 'tbl_inst'=>$query_1->row_array(),'isInserted'=>$isInserted,'SpecPermission'=>$isSpecial,'spec_info'=>$isSpecial_Info);
			 return $allinfo;
		}
		else
		{
		   return  false;; 
		}
    }
    public function chekdefultar($username)
    {
         $query = $this->db->get_where('Admission_online..tblInstitutes_Deactivated', array('inst_cd' => $username,'isactive' => 0 ,'sess'=>1,'myear'=>2017));
        $rowcount = $query->num_rows();
        
        if($rowcount>=1)
        {
            return  $query->row_array();
        }
        
        return -1;
    }
      public function biseauth($username,$password) 
    {
      //  DebugBreak();
        //$query = $this->db->get_where('Admission_online..tblInstitutes_all', array('Inst_cd' => $username,'Inst_pwd' => $password));
        $query = $this->db->get_where('matric_new..tblEmployee', array('Emp_cd' => $username,'pass' => $password));
        $rowcount = $query->num_rows();
        if($rowcount >0)
        {
            
             return $query->row_array();
        }
        else
        {
           return  false;; 
        }
    }
    
    public function getappconfig() 
    {
         // DebugBreak();
        //$query = $this->db->get_where('Admission_online..tblInstitutes_all', array('Inst_cd' => $username,'Inst_pwd' => $password));
        $query = $this->db->get_where('online_BAK..tblAppConfig', array('iyear' => Year,'class' => 9));
        $rowcount = $query->num_rows();
        if($rowcount >0)
        {

            return $query->row_array();
        }
        else
        {
            return  false;; 
        }
    }
    
}
?>
