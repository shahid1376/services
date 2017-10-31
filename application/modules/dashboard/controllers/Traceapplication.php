<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Traceapplication extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        define('HEADER_TITLE', 'Trace Your Application Status');
    }
    public function index()
    {
        $data = array(
            'isselected' => '3', 
        );
        $this->load->library('session');

        $error ="";

        if($this->session->flashdata('downerror'))
        {
            $error = $this->session->flashdata('downerror');
        }
        else{
            $error = "";
        }
        $this->load->view('common/commonheader_Verification.php');
        $mydata = array('error'=>$error);
        $this->load->view('Traceapplication/default.php',$mydata);
        $this->load->view('common/verfooter.php');
    }


    public function TraceFile()
    {    
        @$traceType = $_POST['traceType'];
        if($traceType == 1){
            @$fileId = $_POST['fileId'];    
        }
        else if($traceType == 2){
            @$fileId = $_POST['owoNo'];    
            @$owoDate = $_POST['owoDate'];    
        }
        $this->load->model('TraceApplicationModel');
        @$val = $this->TraceApplicationModel->FileTrackModel($fileId, $traceType, $owoDate);
        if($val == -1){
            $err = array(
                'Error' => 'NO RECORD FOUND'
            );
            $this->load->view('common/commonheader_Verification.php');
            $this->load->view('Traceapplication/default.php', array('err'=>$err));
            $this->load->view('common/verfooter.php');
            return;
        }
        if($val){
            $this->load->view('common/commonheader_Verification.php');
            $this->load->view('Traceapplication/default.php', array('info'=>$val));
            $this->load->view('common/verfooter.php');
            return;
        }
    }
}