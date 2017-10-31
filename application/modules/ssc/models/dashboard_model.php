<?php
class Dashboard_model extends CI_Model {
    public function __construct() {
        $this->load->database(); 
    }
    public function getInstInfo($username) 
    {
       // DebugBreak();
        
		$query = $this->db->order_by('iyear', 'DESC')->get_where('Registration..tblinst_stats', array('inst_cd' => $username,'class'=>9));
		$rowcount = $query->num_rows();
		if($rowcount >0)
		{
            
               $allinfo = $query->result_array();
			 return $allinfo;
		}
		else
		{
		   return  false;; 
		}
    }
     public function getInstgrading($username) 
    {
      //  DebugBreak();
        
        $query = $this->db->order_by('iyear', 'ASC')->get_where('Registration..tblInstGrade', array('inst_cd' => $username,'class'=>10));
        $rowcount = $query->num_rows();
        if($rowcount >0)
        {
            
               $allinfo = $query->result_array();
             return $allinfo;
        }
        else
        {
           return  false;; 
        }
    }
}
?>
