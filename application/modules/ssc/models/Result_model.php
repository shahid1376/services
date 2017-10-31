<?php
class Result_model extends CI_Model 
{
    public function __construct()    {

        $this->load->database(); 
    }

    public function getresult($keyword,$isrno)
    {
        //$query = $this->db->query("Registration..Current_Matric_Result_Announcement '$keyword',9,2016,1,$isrno");
        $query = $this->db->query("Registration..Current_Inter_Result_Announcement '$keyword',11,2016,1,$isrno");
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
    public function getresultstd($keyword)
    {
        $query = $this->db->query("matric_new..getRes9thStdData '$keyword',2017,9,1,1");
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
    public function getresult10std($keyword)
    {
        $query = $this->db->query("matric_new..getRes10thStdData '$keyword',2017,10,1,1");
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
    public function getresult12std($keyword,$class,$iyear)
    {
        if($class == 12)
        {
            $sess =  SESSION;   
        }
        else
        {
            if($class ==  1)
            {
                $class = 12;
            } 
            $sess =  1;
        }

        $query = $this->db->query("matric_new..getRes12thStdData '$keyword',$iyear,$class,1,$sess");
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
    public function getResultCardByRNO($keyword,$class,$iyear)
    {
        if($class ==  9)
        {
            $query = $this->db->query("matric_new..spResCard9th $keyword,$iyear,$class,1,1,0,0,0");
        }
        else if($class ==  10)
        {
            $query = $this->db->query("matric_new..spResCard10th $keyword,$iyear,$class,1,1,0,0,0");
        }
        else if($class ==  12 || $class == 11 || $class == 1)
        {
            if($class ==  12)
                $sess =  SESSION;
            else
            {
                if($class ==  1)
                {
                    $class = 12;
                } 
                $sess = 1;  
            }
            //   echo "matric_new..spResCard12th $keyword,$iyear,$class,$sess,1"; exit();
            $query = $this->db->query("matric_new..spResCard12th $keyword,$iyear,$class,$sess,1");
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
    public function getResultCard10thByGroupWise($keyword,$Inst_Id)
    {
        //  DebugBreak();

        $where = "grp_cd = $keyword AND sch_cd = $Inst_Id";
        if($keyword == 7)
        {
            $grp_cd = 1;
            $subcd = 78;
        }
        else if($keyword ==  1)
        {
            $grp_cd = $keyword;
            $subcd = 8;
        }
        else if($keyword ==  8)
        {
            $grp_cd = 1;
            $subcd = 43;
        }
        else
        {
            $grp_cd = $keyword;
            $subcd  = 0;
        }

        //$query = $this->db->query("SELECT * FROM matric_new..tbl9thresultcards where $where");
        if($subcd != 0)
        {
          $query = $this->db->query("matric_new..spResCard10th 0,2017,10,1,2,$Inst_Id,$grp_cd,$subcd");  
        }
        else if($subcd == 0)
        {
            $query = $this->db->query("matric_new..spResCard10th 0,2017,10,1,3,$Inst_Id,$grp_cd,$subcd");
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
      public function getResultCard9thByGroupWise($keyword,$Inst_Id,$class)
    {
        //  DebugBreak();

        $where = "grp_cd = $keyword AND sch_cd = $Inst_Id";
        if($keyword == 7)
        {
            $grp_cd = 1;
            $subcd = 78;
        }
        else if($keyword ==  1)
        {
            $grp_cd = $keyword;
            $subcd = 8;
        }
        else if($keyword ==  8)
        {
            $grp_cd = 1;
            $subcd = 43;
        }
        else
        {
            $grp_cd = $keyword;
            $subcd  = 0;
        }

        //$query = $this->db->query("SELECT * FROM matric_new..tbl9thresultcards where $where");
        if($subcd != 0)
        {
          $query = $this->db->query("matric_new..spResCard9th 0,2017,$class,1,2,$Inst_Id,$grp_cd,$subcd");  
        }
        else if($subcd == 0)
        {
            $query = $this->db->query("matric_new..spResCard9th 0,2017,$class,1,3,$Inst_Id,$grp_cd,$subcd");
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
    public function getResultCardByGroupWise($keyword,$Inst_Id)
    {
       //  DebugBreak();

        $where = "grp_cd = $keyword AND sch_cd = $Inst_Id";
        if($keyword == 7)
        {
            $where = "grp_cd = 1 AND sub8 = 78 AND sch_cd = $Inst_Id"; 
        }
        else if($keyword ==  1)
        {
            $where = "grp_cd = 1 AND sub8 = 8 AND sch_cd = $Inst_Id";  
        }
        else if($keyword ==  8)
        {
            $where = "grp_cd = 1 AND sub8 = 43 AND sch_cd = $Inst_Id";  
        }

        $query = $this->db->query("SELECT * FROM matric_new..tbl9thresultcards where $where");
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
    public function get12thResultCardByGroupWise($keyword,$Inst_Id)
    {
        // DebugBreak();

        $where = "grp_cd = $keyword AND coll_cd = $Inst_Id";


        $query = $this->db->query("SELECT * FROM matric_new..tbl12thresultcards where $where");
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
    public function get11thResultCardByGroupWise($keyword,$Inst_Id)
    {
        // DebugBreak();

        $where = "grp_cd = $keyword AND coll_cd = $Inst_Id";


        $query = $this->db->query("SELECT * FROM matric_new..tbl11thresultcards where $where");
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
    public function getresultNocstd($Inst_Id)
    {
        // DebugBreak();

        $where = "isactive = 0 AND inst_cd = $Inst_Id";


        $query = $this->db->query("SELECT rno FROM  Registration..tblRegular_Inter_IA1p16_NOC  where $where");
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
    public function saveResHistory($rno,$iyear,$sess,$cls,$kpo)
    {
        $data2 = array(
            'rno'=>$rno,
            'iyear'=>$iyear,
            'sess'=>$sess,
            'class'=>$cls,
            'pkpo'=>$kpo,
            'print_date'=>date('Y-m-d H:i:s'),
        );
        $hist_id = $this->db->insert("Registration..ResCardsHistory", $data2);
        return $hist_id;
    }

}
?>
