<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
define('PRIVATE_IMAGE_PATH9TH', 'uploads/2016/9th/private/');
define('PRIVATE_IMAGE_PATH', 'uploads/2016/10th/private/');
define('RE_ADMISSION_TBL', 'matric_new..vw9th17');
define('REGULAR_IMAGE_PATH', 'uploads/2016/10th/regular/');
define('Session','2');  // 1 for Annual and 2 for Supply
define('Year','2017');  
define('ISREADMISSION','1');  
define('lastdate','23-12-2016');
define('GET_PRIVATE_IMAGE_PATH', '../');
define('GET_IMAGE_PATH_9th_Admission_Annual', '../uploads/2016/regular/');
define('GET_IMAGE_PATH_9th_Admission_Annual1', 'uploads/2016/regular/');
define('GET_PRIVATE_IMAGE_PATH_COPY','');
define('Insertion_tbl','Admission_online..tblMAdm');   // For Matric Admissions
define('Batch_tbl','Admission_online..tblRegBatch10th'); // For Matric Admission Batch
define('INSERT_TBL','Admission_online..tblMAdm'); // for insertion matric supply
define('Insert_sp','Admission_online..MSAdm2016_sp_insert_temp'); // for insertion matric supply
define('Insert_sp_matric_annual','Admission_online..tblMAdmInsert'); // for insertion matric Annual
define('formprint_sp','Admission_online..sp_form_data_temp');    // for selection matric supply
define('formprint_sp_9th','Registration..sp_form_data_9thAdm');    // for selection 9th Annual
define('formprint_sp_matric_annual','Admission_online..sp_form_data');    // for selection matric Annual
define('return_pdf_isPicture','1');
define('CURRENT_SESS','2017-2019');
////9th registration
define('IMAGE_PATH', 'uploads/2017/reg/');
define('IMAGE_PATH2', 'uploads/2017_backup/');
define('BARCODE_PATH', 'uploads/pdfs/');
define('BARCODE_PATH1', '../../assets/pdfs/');
define('SINGLE_LAST_DATE', '2017-05-26');
define('DOUBLE_LAST_DATE', '2017-09-19');
define('Correction_Last_Date','2017-10-31');
define('tblreg9th','Registration..tblReg9th');
define('regyear','2017');
define ('sessReg','2017-2019');
define('corr_bank_chall_class','9th');
define('assets', 'assets/img/');
define('CORR_IMAGE_PATH', 'uploads/2017/correction/');
define('DOB_LIMIT','01-07-2005'); // dd-mm-Y format;

//===============10TH Regular/Private Admission Matric challan varaible
define('currdate','date("d-m-Y");');
define('SingleDateFee','23-12-2016');
define('DoubleDateFee', '03-01-2017');
define('TripleDateFee', '10-01-2017');
define('SingleDateFee9th','08-08-2017');
define('DoubleDateFee9th', '15-08-2017');
define('TripleDateFee9th', '22-08-2017');
define('getinfo','admission_online..tblAdmissionDataForSSC');
//define('DIRPATH','C:\inetpub\vhosts\bisegrw.com\Share Images\OldPics'); 
define('DIRPATH','C:\inetpub\vhosts\bisegrw.com\Share Images\\'); 
define('DIRPATH9th','C:\inetpub\vhosts\bisegrw.com\registration.bisegrw.com\uploads\2016'); 
define('DIRPATHOTHER','C:\inetpub\vhosts\bisegrw.com\registration.bisegrw.com\uploads\other'); 
define('corr_bank_chall_class1','10th');
define('CURRENT_SESS1','2017'); 
define('CURRENT_SESS1_year','2017'); 
define('class_for_9th_Adm','9th');
define('formnovalid',100000);// Starting Form No. for Pvt 10th candidates.
define('formno_9thpvt',600000); // Starting Form No. for Pvt 9th candidates. 

//================ RollNumber Slips variables ========================
define('mClass','10'); 
define('mClass1','12'); 
define('mSession','2'); 
define('mSession1','1'); 
define('mClass2','9'); 
define('mYear','2017'); 
define('PVT_TITLE','Download Roll Number Slip For S.S.C Supplementary 2017'); 
define('PVT_TITLE_INTER','Download Roll Number Slip For H.S.S.C Supply 2016'); 

//================ Controller Stamp ========================
define('CESIGN','C:\inetpub\vhosts\bisegrw.com\Share Images\Controller Stamp\CE_Signature.png'); 

//========================Online NOC
define('CORRECTION_TITLE', 'Online Correction System');
define('VERIFICATION_TITLE', 'Online NOC System');
define('NOC_APP_NO', '400000');
define('NOC_APP_NO1', '100000');





