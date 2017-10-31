<?php
class Dashboard_model extends CI_Model {
    public function __construct() {
        $this->load->database(); 
    }
    public function getActiveApplication() 
    {
        // DebugBreak();

        $query = $this->db->order_by('LinkOrder', 'ASC')->get_where('online_BAK..tbl_QuickLinks', array('isactive=' => 1,'isprivate'=>1));
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
