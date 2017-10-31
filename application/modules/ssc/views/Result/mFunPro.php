<?php
    function subRemarks($mVar){
        
        $mVar = trim($mVar);
                
        if ($mVar == "2") 
            return "Less than Pass Marks";
        else        
        if ($mVar == "5")
            return "Absent";
        else
            return "&nbsp;";    
    }    
    //--------------------------------
    function subRemarksWAP($mVar){
        
        $mVar = trim($mVar);
        
        if ($mVar == "2") 
            return " (LTPM)";
        else        
        if ($mVar == "5")
            return " (Absent)";
        else
            return "&nbsp;";    
    }    
    //--------------------------------
    function isNumber($mVar){
        
        $mVar = trim($mVar);
        $len = strlen($mVar);
        
        if ($len == 0 || $len > 6 )
            return false;
        else {
            $i = 1;                
            while ( $i <= $len){                        
                $str = substr($mVar,$i,1);
                
                if ($str == "0" || $str == "1" || $str == "2" || $str == "3" || $str == "4" ||
                    $str == "5" || $str == "6" || $str == "7" || $str == "8" || $str == "9") {
                    $i++;
                    continue;
                } 
                else
                    break;
            } //end while
            
            if ($i > $len)
                return true;
            else
                return false;            
        } // end else
    } //end function
    //--------------------------------        
    function subStatus($mVar){
        if ($mVar == "1") return "P";
        else
        if ($mVar == "2") return "P*";
        else        
        if ($mVar == "3") return "F";
        else
            return "";    
    }
    //--------------------------------
    /*function subMaxMarks($mVar){
        if ($mVar == "70") return "200";
        else
        if ($mVar == "39" || $mVar == "71") return "150";
        else        
        if ($mVar == "80" || $mVar == "97") return "100";
        else
            return "";    
    }*/
    //---------------------------------------------------
    function mIsSubPr($mVar){
        //return true;
        switch (trim($mVar)){
            case '6':
            case '7':
            case '8':
            case '18':
            case '27':
            case '28':
            case '30':
            case '40':
            case '43':
            case '45':
            case '46':
            case '48':            
            case '68':
            case '69':
            case '70':
            case '72':    
            case '73':
            case '78':            
            case '79':
            case '83':
            case '88':    
            case '89':
            case '90':            
                return(true); break;
            default: 
                return (false);
        }
    }    
    //--------------------- Group ---------------------------
    function mGroup($mVar){
        switch (trim($mVar)){
            case '1': return "SCIENCE";    break;
            case '2': return "GENERAL";    break;
            case '3': return "TECHNICAL"; break;
            case '4': return "DARS-E-NAZAMI"; break;
            case '5': return "DEAF & DUMB"; break;
            default : "&nbsp;";            
        }
    }
    //--------------------- District_Old ---------------------------
    function mDistrict($mVar){
        switch (trim($mVar)){
            case '1': return "GUJRANWALA";             break;
            case '2': return "GUJRAT";                break;
            case '3': return "HAFIZABAD";             break;
            case '4': return "MANDI BAHA-UD-DIN";    break;
            case '5': return "NAROWAL";             break;
            case '6': return "SIALKOT";             break;            
            default : "&nbsp;";
        }
    }
    //--------------------- District_New ---------------------------
    function mDistrictNew($mVar){
        switch (trim($mVar)){
            case '341': return "GUJRANWALA";             break;
            case '342': return "GUJRAT";                break;
            case '345': return "HAFIZABAD";             break;
            case '346': return "MANDI BAHA-UD-DIN";    break;
            case '344': return "NAROWAL";             break;
            case '343': return "SIALKOT";             break;            
            default : "&nbsp;";
        }
    }
    //---------------------------------------------------------------------    
    
    
    function  mSubName($_sub_cd)
    {
$ret_val = "";
if($_sub_cd == 1)  $ret_val = "URDU";
else if($_sub_cd == 2)  $ret_val = "ENGLISH";
else if($_sub_cd == 3)  $ret_val = "ISLAMIYAT (COMPULSORY)";
else if($_sub_cd == 4)  $ret_val = "PAKISTAN STUDIES";
else if($_sub_cd == 5)  $ret_val = "MATHEMATICS";
else if($_sub_cd == 6)  $ret_val = "PHYSICS";
else if($_sub_cd == 7)  $ret_val = "CHEMISTRY";
else if($_sub_cd == 8)  $ret_val = "BIOLOGY";
else if($_sub_cd == 9)  $ret_val = "GENERAL SCIENCE";
else if($_sub_cd == 11)  $ret_val = "GEOGRAPHY OF PAKISTAN";
else if($_sub_cd == 18)  $ret_val = "ART/ART & MODEL DRAWING";
else if($_sub_cd == 22)  $ret_val = "ARABIC";
else if($_sub_cd == 23)  $ret_val = "PERSIAN";
else if($_sub_cd == 36)  $ret_val = "PUNJABI";
else if($_sub_cd == 20)  $ret_val = "ISLAMIC HISTORY";
else if($_sub_cd == 21)  $ret_val = "HISTORY OF PAKISTAN/ HISTORY OF INDO PAK";
else if($_sub_cd == 78)  $ret_val = "COMPUTER SCIENCE";
else if($_sub_cd == 12)  $ret_val = "HOUSE HOLD ACCOUNTS & ITS RELATED PROBLEMS";
else if($_sub_cd == 13)  $ret_val = "ELEMENTS OF HOME ECONOMICS";
else if($_sub_cd == 14)  $ret_val = "PHYSIOLOGY & HYGIENE";
else if($_sub_cd == 15)  $ret_val = "GEOMETRICAL & TECHNICAL DRAWING";
else if($_sub_cd == 16)  $ret_val = "GEOLOGY";
else if($_sub_cd == 17)  $ret_val = "ASTRONOMY & SPACE SCIENCE";
else if($_sub_cd == 19)  $ret_val = "ISLAMIC STUDIES";
else if($_sub_cd == 27)  $ret_val = "FOOD AND NUTRITION";
else if($_sub_cd == 28)  $ret_val = "ART IN HOME ECONOMICS";
else if($_sub_cd == 29)  $ret_val = "MANAGEMENT FOR BETTER HOME";
else if($_sub_cd == 30)  $ret_val = "CLOTHING & TEXTILES";
else if($_sub_cd == 31)  $ret_val = "CHILD DEVELOPMENT AND FAMILY LIVING";
else if($_sub_cd == 32)  $ret_val = "MILITARY SCIENCE";
else if($_sub_cd == 33)  $ret_val = "COMMERCIAL GEOGRAPHY";
else if($_sub_cd == 34)  $ret_val = "URDU LITERATURE";
else if($_sub_cd == 35)  $ret_val = "ENGLISH LITERATURE";
else if($_sub_cd == 37)  $ret_val = "EDUCATION";
else if($_sub_cd == 38)  $ret_val = "ELEMENTARY NURSING & FIRST AID";
else if($_sub_cd == 39)  $ret_val = "PHOTOGRAPHY";
else if($_sub_cd == 40)  $ret_val = "HEALTH & PHYSICAL EDUCATION";
else if($_sub_cd == 41)  $ret_val = "CALIGRAPHY";
else if($_sub_cd == 42)  $ret_val = "LOCAL (COMMUNITY) CRAFTS";
else if($_sub_cd == 43)  $ret_val = "ELECTRICAL WIRING";
else if($_sub_cd == 44)  $ret_val = "RADIO ELECTRONICS";
else if($_sub_cd == 45)  $ret_val = "COMMERCE";
else if($_sub_cd == 46)  $ret_val = "AGRICULTURE";
else if($_sub_cd == 53)  $ret_val = "ANIMAL PRODUCTION";
else if($_sub_cd == 54)  $ret_val = "PRODUCTIVE INSECTS AND FISH CULTURE";
else if($_sub_cd == 55)  $ret_val = "HORTICULTURE";
else if($_sub_cd == 56)  $ret_val = "PRINCIPLES OF HOME ECONOMICS";
else if($_sub_cd == 57)  $ret_val = "RELATED ACT";
else if($_sub_cd == 58)  $ret_val = "HAND AND MACHINE EMBROIDERY";
else if($_sub_cd == 59)  $ret_val = "DRAFTING AND GARMENT MAKING";
else if($_sub_cd == 60)  $ret_val = "HAND & MACHINE KNITTING & CROCHEING";
else if($_sub_cd == 61)  $ret_val = "STUFFED TOYS AND DOLL MAKING";
else if($_sub_cd == 62)  $ret_val = "CONFECTIONERY AND BAKERY";
else if($_sub_cd == 63)  $ret_val = "PRESERVATION OF FRUITS,VEGETABLES & OTHER FOODS";
else if($_sub_cd == 64)  $ret_val = "CARE AND GUIDENCE OF CHILDREN";
else if($_sub_cd == 65)  $ret_val = "FARM HOUSE HOLD MANAGEMENT";
else if($_sub_cd == 66)  $ret_val = "ARITHEMATIC";
else if($_sub_cd == 67)  $ret_val = "BAKERY";
else if($_sub_cd == 68)  $ret_val = "CARPET MAKING";
else if($_sub_cd == 69)  $ret_val = "DRAWING";
else if($_sub_cd == 70)  $ret_val = "EMBORIDERY";
else if($_sub_cd == 71)  $ret_val = "HISTORY";
else if($_sub_cd == 72)  $ret_val = "TAILORING";
else if($_sub_cd == 24)  $ret_val = "GEOGRAPHY";
else if($_sub_cd == 25)  $ret_val = "ECONOMICS";
else if($_sub_cd == 26)  $ret_val = "CIVICS";
else if($_sub_cd == 47)  $ret_val = "BOOK KEEPING & ACCOUNTANCY";
else if($_sub_cd == 48)  $ret_val = "WOOD WORK (FURNITURE MAKING)";
else if($_sub_cd == 49)  $ret_val = "GENERAL AGRICULTURE";
else if($_sub_cd == 50)  $ret_val = "FARM ECONOMICS";
else if($_sub_cd == 52)  $ret_val = "LIVE STOCK FARMING";
else if($_sub_cd == 73)  $ret_val = "TYPE WRITING";
else if($_sub_cd == 74)  $ret_val = "WEAVING";
else if($_sub_cd == 75)  $ret_val = "SECRETARIAL PRACTICE";
else if($_sub_cd == 76)  $ret_val = "CANDLE MAKING";
else if($_sub_cd == 77)  $ret_val = "SECRETARIAL PRACTICE AND CORRESPONDANCE";
else if($_sub_cd == 10)  $ret_val = "FOUNDATION OF EDUCATION";
else if($_sub_cd == 51)  $ret_val = "ETHICS";
else if($_sub_cd == 79)  $ret_val = "WOOD WORK (BOAT MAKING)";
else if($_sub_cd == 80)  $ret_val = "PRINCIPLES OF ARITHMATIC";
else if($_sub_cd == 81)  $ret_val = "SEERAT-E-RASOOL";
else if($_sub_cd == 82)  $ret_val = "AL-QURAAN";
else if($_sub_cd == 83)  $ret_val = "POULTRY FARMING";
else if($_sub_cd == 84)  $ret_val = "ART & MODEL DRAWING";
else if($_sub_cd == 85)  $ret_val = "BUSINESS STUDIES";
else if($_sub_cd == 86)  $ret_val = "HADEES & FIQAH";
else if($_sub_cd == 87)  $ret_val = "ENVIRONMENTAL STUDIES";
else if($_sub_cd == 88)  $ret_val = "REFRIGERATION AND AIR CONDITIONING";
else if($_sub_cd == 89)  $ret_val = "FISH FARMING";
else if($_sub_cd == 90)  $ret_val = "COMPUTER HARDWARE";
else if($_sub_cd == 91)  $ret_val = "BEAUTICIAN";
else if($_sub_cd == 92)  $ret_val = "GENERAL MATH"; 
else if($_sub_cd == 93)  $ret_val = "COMPUTER SCIENCES_DFD";    
else if($_sub_cd == 94)  $ret_val = "HEALTH & PHYSICAL EDUCATION_DFD";   
                                                                                                                                                                                                                                      return $ret_val ;             
    }

    //------------------------------------------------------------------
  function Get9thSubMarks($_sub_cd)
    {
    $ret_val = '';
if($_sub_cd == 1)$ret_val = "75";
else if($_sub_cd == 2)$ret_val = "75";
else if($_sub_cd == 3)$ret_val = "50";
else if($_sub_cd == 4)$ret_val = "50";
else if($_sub_cd == 5)$ret_val = "75";
else if($_sub_cd == 6)$ret_val = "60";
else if($_sub_cd == 7)$ret_val = "60";
else if($_sub_cd == 8)$ret_val = "60";
else if($_sub_cd == 9)$ret_val = "75";
else if($_sub_cd == 10)$ret_val = "50";
else if($_sub_cd == 11)$ret_val = "75";
else if($_sub_cd == 12)$ret_val = "75";
else if($_sub_cd == 13)$ret_val = "75";
else if($_sub_cd == 14)$ret_val = "75";
else if($_sub_cd == 15)$ret_val = "75";
else if($_sub_cd == 16)$ret_val = "75";
else if($_sub_cd == 17)$ret_val = "75";
else if($_sub_cd == 18)$ret_val = "40";
else if($_sub_cd == 19)$ret_val = "75";
else if($_sub_cd == 20)$ret_val = "75";
else if($_sub_cd == 21)$ret_val = "75";
else if($_sub_cd == 22)$ret_val = "75";
else if($_sub_cd == 23)$ret_val = "75";
else if($_sub_cd == 24)$ret_val = "75";
else if($_sub_cd == 25)$ret_val = "75";
else if($_sub_cd == 26)$ret_val = "75";
else if($_sub_cd == 27)$ret_val = "60";
else if($_sub_cd == 29)$ret_val = "75";
else if($_sub_cd == 30)$ret_val = "60";
else if($_sub_cd == 31)$ret_val = "75";
else if($_sub_cd == 32)$ret_val = "75";
else if($_sub_cd == 33)$ret_val = "75";
else if($_sub_cd == 34)$ret_val = "75";
else if($_sub_cd == 35)$ret_val = "75";
else if($_sub_cd == 36)$ret_val = "75";
else if($_sub_cd == 37)$ret_val = "75";
else if($_sub_cd == 40)$ret_val = "60";
else if($_sub_cd == 43)$ret_val = "40";
else if($_sub_cd == 48)$ret_val = "40";
else if($_sub_cd == 51)$ret_val = "50";
else if($_sub_cd == 66)$ret_val = "75";
else if($_sub_cd == 69)$ret_val = "30";
else if($_sub_cd == 70)$ret_val = "30";
else if($_sub_cd == 72)$ret_val = "30";
else if($_sub_cd == 73)$ret_val = "75";
else if($_sub_cd == 78)$ret_val = "50";
else if($_sub_cd == 79)$ret_val = "40";
else if($_sub_cd == 81)$ret_val = "75";
else if($_sub_cd == 82)$ret_val = "75";
else if($_sub_cd == 83)$ret_val = "40";
else if($_sub_cd == 84)$ret_val = "75";
else if($_sub_cd == 85)$ret_val = "75";
else if($_sub_cd == 86)$ret_val = "75";
else if($_sub_cd == 87)$ret_val = "75";
else if($_sub_cd == 89)$ret_val = "40";
else if($_sub_cd == 90)$ret_val = "40";
else if($_sub_cd == 92)$ret_val = "75";
else if($_sub_cd == 93)$ret_val = "30";
else if($_sub_cd == 94)$ret_val = "30";
return $ret_val;
    }
function get_gradeMA_oldSch($marks,$status) {
if($status == 1)    
{
    if($marks >= 840) {
        echo "A+";
    }else if($marks >= 735 and $marks <=839 ) {
        echo "A";
    }else if($marks >= 630 and $marks <=734 ) {
        echo "B";
    }else if($marks >= 525 and $marks <=629 ) {
        echo "C";
    }else if($marks >= 420 and $marks <=524 ) {
        echo "D";
    }else if($marks < 420) {
        echo "E";
    }else 
        echo "F";
}
else
echo "";
}

function get_gradeMA_newSch($marks,$cat1,$cat2,$status) {
    
    if($status== NULL){$marks=0;}

    if($cat1==4 or $cat2==4){$marks = $marks/400 *1100;}

if($status == 1)
{
    if($marks >= 880) {
    echo "A+";
    }else if($marks >=770 and $marks <=879 ) {
        echo "A";
    }else if($marks >=660 and $marks <=769 ) {
        echo "B";
    }else if($marks >=550  and $marks <=649 ) {
        echo "C";
    }else if($marks >=440  and $marks <=549 ) {
        echo "D";
    }else if($marks < 440  ) {
        echo "E";
    }else 
        echo "";
}
else
echo "";
    
}
function get_gradeMA($percentage) {
    if($percentage >= 80.00) {
        echo "A+";
    }else if($percentage <= 79.99 and $percentage >=70.00 ) {
        echo "A";
    }else if($percentage <= 69.99 and $percentage >=60.00 ) {
        echo "B";
    }else if($percentage <= 59.99 and $percentage >=50.00 ) {
        echo "C";
    }else if($percentage <= 49.99 and $percentage >=40.00 ) {
        echo "D";
    }else if($percentage <= 39.99 and $percentage >=30.00 ) {
        echo "E";
    }else if($percentage <= 29.99) {
        echo "F";
    }
}

function get_gradeMAPrac($marks,$mSub_cd) {

   if ($mSub_cd ==6 || $mSub_cd==7 || $mSub_cd==8 || $mSub_cd==78 || $mSub_cd==27 || $mSub_cd==43 || $mSub_cd==83 || $mSub_cd==48 || $mSub_cd==79 || $mSub_cd==18 || $mSub_cd==84 || $mSub_cd==40 || $mSub_cd==30 || $mSub_cd==89 || $mSub_cd==90 )
    {
            if($marks >= 18) 
            {
                return "(A+)";
            }else if($marks == 16 or $marks ==17 ) {
                return "(A)";
            }else if($marks == 14 or $marks ==15 ) {
                return "(B)";
            }else if($marks == 12 or $marks ==13 ) {
                return "(C)";
            }else if($marks == 10 or $marks ==11 ) {
                return "(D)";
            }else if($marks == 8 or $marks ==9 ) {
                return "(E)";
            }else if($marks < 8) {
                return "(F)";
            }
    }
    else 
     return "";
}

function get_gradeMAPrac_new($marks,$st,$mSub_cd) {

if($st != 2 && ($marks ==0 || $marks == null))
return "";

   if ($mSub_cd ==6 || $mSub_cd==7 || $mSub_cd==8 || $mSub_cd==78 || $mSub_cd==27 || $mSub_cd==43 || $mSub_cd==83 || $mSub_cd==48 || $mSub_cd==79 || $mSub_cd==18 || $mSub_cd==84 || $mSub_cd==40 || $mSub_cd==30 || $mSub_cd==89 || $mSub_cd==90 )
    {
            if($marks >= 18) 
            {
                return "(A+)";
            }else if($marks == 16 or $marks ==17 ) {
                return "(A)";
            }else if($marks == 14 or $marks ==15 ) {
                return "(B)";
            }else if($marks == 12 or $marks ==13 ) {
                return "(C)";
            }else if($marks == 10 or $marks ==11 ) {
                return "(D)";
            }else if($marks == 8 or $marks ==9 ) {
                return "(E)";
            }else if($marks < 8) {
                return "(F)";
            }
    }
    else 
     return "";
}

function getField($row, $field){
    if(is_array($row)){ // edition
        if(array_key_exists($field,$row)){
            $field = $row[$field];
            return $field;
        } else {
            echo "Invalid field name or number.".$field."</br>";
        }
    }
}

?>