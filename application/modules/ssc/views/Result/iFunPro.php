<?php
function subRemarks($mVar)
{
    $mVar = trim($mVar);
    if ($mVar == "2")
        return "Less than Pass Marks";
    else if ($mVar == "5")
        return "Absent";
        else
            return "&nbsp;";
}
//--------------------------------
function subRemarksWAP($mVar)
{
    $mVar = trim($mVar);
    if ($mVar == "2")
        return " (LTPM)";
    else if ($mVar == "5")
        return " (Absent)";
        else
            return "&nbsp;";
}
//--------------------------------
function isNumber($mVar)
{
    $mVar = trim($mVar);
    $len  = strlen($mVar);
    if ($len == 0 || $len > 6)
        return false;
    else {
        $i = 1;
        while ($i <= $len) {
            $str = substr($mVar, $i, 1);
            if ($str == "0" || $str == "1" || $str == "2" || $str == "3" || $str == "4" || $str == "5" || $str == "6" || $str == "7" || $str == "8" || $str == "9") {
                $i++;
                continue;
            } else
                break;
        } //end while
        if ($i > $len)
            return true;
        else
            return false;
    } // end else
} //end function
//--------------------------------		
function subStatus($mVar)
{
    if ($mVar == "1")
        return "P";
    else if ($mVar == "2")
        return "P*";
        else if ($mVar == "3")
            return "F";
            else
                return "";
}
//--------------------------------		
function subStatus_New($pf, $prPf)
{
    if($prPf == 2)
        return "P*";
    //----------------------------		
    else if ($pf == "1")
        return "P";
        else if ($pf == "2")
            return "P*";
            else if ($pf == "3")
                return "F";
                else
                    return "";
}
//--------------------------------
function subMaxMarks($mVar)
{
    if ($mVar == "70") return "200";
    else if ($mVar == "39" || $mVar == "71" || $mVar == "94")return "150";
        else if ($mVar == "80" || $mVar == "97") return "100";
            else
                return "";
}
function subMaxMarks_New($mVar,$schm)
{
    if ($mVar == "70" && $schm ==2) return "200";
    else if ($mVar == "70" && $schm ==1) return "150";  
        else if ($mVar == "39" || $mVar == "71" || $mVar == "72"  || $mVar == "73" || $mVar == "76" || $mVar == "76" || $mVar == "94")return "150";
            else if (($mVar == "80" || $mVar == "97") && $schm == 2) return "100";
                else if (($mVar == "80" || $mVar == "97") && $schm == 1) return "150";	
                    else
                        return "";
}

//-------------------------------------------
function iIsSubPr($mVar)
{
    //return true;
    switch (trim($mVar)) {
        case '8':
        case '12':
        case '16':
        case '18':
        case '21':
        case '23':
        case '38':
        case '42':
        case '46':
        case '47':
        case '48':
        case '79':
        case '83':
        case '90':
        case '96':
        case '98':
            return (true);
            break;
        default:
            return (false);
    }
}
//--------------------- Group ---------------------------
function iGroup($mVar)
{
    switch (trim($mVar)) {
        case '1':
            return "PRE-MEDICAL";
            break;
        case '2':
            return "PRE-ENGINEERING";
            break;
        case '3':
            return "HUMANITIES";
            break;
        case '4':
            return "GENERAL SCIENCE";
            break;
        case '5':
            return "COMMERCE";
            break;
        case '7':
            return "HOME ECONOMICS";
            break;			
        default:
            "&nbsp;";
    }
}
//--------------------- Group ---------------------------
function iDistrict($mVar)
{
    switch (trim($mVar)) {
        case '1':
            return "GUJRANWALA";
            break;
        case '2':
            return "GUJRAT";
            break;
        case '3':
            return "HAFIZABAD";
            break;
        case '4':
            return "MANDI BAHA-UD-DIN";
            break;
        case '5':
            return "NAROWAL";
            break;
        case '6':
            return "SIALKOT";
            break;
        case '23':
            return "CHAKWAL";
            break;
        default:
            "&nbsp;";
    }
}
//--------------------- District_New ---------------------------
function iDistrictNew($mVar)
{
    switch (trim($mVar)) {
        case '341':
            return "GUJRANWALA";
            break;
        case '342':
            return "GUJRAT";
            break;
        case '345':
            return "HAFIZABAD";
            break;
        case '346':
            return "MANDI BAHA-UD-DIN";
            break;
        case '344':
            return "NAROWAL";
            break;
        case '343':
            return "SIALKOT";
            break;
        default:
            "&nbsp;";
    }
}
//---------------------------------------------------------------------	
function iSubName($_sub_cd)
{
   $ret_val = "";
if($_sub_cd == 1)  $ret_val = "ENGLISH";
else if($_sub_cd == 2)  $ret_val = "URDU";
else if($_sub_cd == 3)  $ret_val = "BANGALI";
else if($_sub_cd == 4)  $ret_val = "URDU(ALTERNATIVE EASY COURSE)";
else if($_sub_cd == 5)  $ret_val = "BENGALI(ALTERNATE EASY COURSE)";
else if($_sub_cd == 6)  $ret_val = "PAKISTANI CULTURE";
else if($_sub_cd == 7)  $ret_val = "HISTORY";
else if($_sub_cd == 8)  $ret_val = "LIBRARY SCIENCE";
else if($_sub_cd == 9)  $ret_val = "ISLAMIC HISTORY & CULTURE";
else if($_sub_cd == 10)  $ret_val = "FAZAL ARABIC";
else if($_sub_cd == 11)  $ret_val = "ECONOMICS";
else if($_sub_cd == 12)  $ret_val = "GEOGRAPHY";
else if($_sub_cd == 13)  $ret_val = "MILITARY SCIENCE";
else if($_sub_cd == 14)  $ret_val = "PHILOSOPHY";
else if($_sub_cd == 15)  $ret_val = "ISLAMIC STUDIES(ISL-ST. GROUP)";
else if($_sub_cd == 16)  $ret_val = "PSYCHOLOGY";
else if($_sub_cd == 17)  $ret_val = "CIVICS";
else if($_sub_cd == 18)  $ret_val = "STATISTICS";
else if($_sub_cd == 19)  $ret_val = "MATHEMATICS";
else if($_sub_cd == 20)  $ret_val = "ISLAMIC STUDIES";
else if($_sub_cd == 21)  $ret_val = "OUTLINES OF HOME ECONOMICS";
else if($_sub_cd == 22)  $ret_val = "MUSIC";
else if($_sub_cd == 23)  $ret_val = "FINE ARTS";
else if($_sub_cd == 24)  $ret_val = "ARABIC";
else if($_sub_cd == 25)  $ret_val = "BENGALI";
else if($_sub_cd == 26)  $ret_val = "BENGALI(ADVANCE)";
else if($_sub_cd == 27)  $ret_val = "ENGLISH ELECTIVE";
else if($_sub_cd == 28)  $ret_val = "FRENCH";
else if($_sub_cd == 29)  $ret_val = "GERMAN";
else if($_sub_cd == 30)  $ret_val = "LATIN";
else if($_sub_cd == 32)  $ret_val = "PUNJABI";
else if($_sub_cd == 33)  $ret_val = "PASHTO";
else if($_sub_cd == 34)  $ret_val = "PERSIAN";
else if($_sub_cd == 35)  $ret_val = "SANSKRIT";
else if($_sub_cd == 36)  $ret_val = "SINDHI";
else if($_sub_cd == 37)  $ret_val = "URDU (ADVANCE)";
else if($_sub_cd == 38)  $ret_val = "COMMERCIAL PRACTICE";
else if($_sub_cd == 39)  $ret_val = "PRINCIPLES OF COMMERCE";
else if($_sub_cd == 42)  $ret_val = "HEALTH & PHYSICAL EDUCATION";
else if($_sub_cd == 43)  $ret_val = "EDUCATION";
else if($_sub_cd == 44)  $ret_val = "GEOLOGY";
else if($_sub_cd == 45)  $ret_val = "SOCIOLOGY";
else if($_sub_cd == 46)  $ret_val = "BIOLOGY";
else if($_sub_cd == 47)  $ret_val = "PHYSICS";
else if($_sub_cd == 48)  $ret_val = "CHEMISTRY";
else if($_sub_cd == 52)  $ret_val = "ADEEB ARBI";
else if($_sub_cd == 53)  $ret_val = "ADEEB URDU";
else if($_sub_cd == 54)  $ret_val = "FAZAL URDU";
else if($_sub_cd == 55)  $ret_val = "HISTORY OF PAKISTAN";
else if($_sub_cd == 56)  $ret_val = "HISTORY OF ISLAM";
else if($_sub_cd == 57)  $ret_val = "HISTORY OF INDO-PAK";
else if($_sub_cd == 58)  $ret_val = "HISTORY OF MODREN WORLD";
else if($_sub_cd == 59)  $ret_val = "APPLIED ART  (H-Eco Group)";
else if($_sub_cd == 60)  $ret_val = "FOOD & NUTRITION (H-Eco Group)";
else if($_sub_cd == 61)  $ret_val = "CHILD DEVELOPMENT AND FAMILY LIVING (H-Eco Group)";
else if($_sub_cd == 70)  $ret_val = "PRINCIPLES OF ACCOUNTING";
else if($_sub_cd == 71)  $ret_val = "PRINCIPLES OF ECONOMICS";
else if($_sub_cd == 72)  $ret_val = "BIOLOGY (H-Eco Group)";
else if($_sub_cd == 73)  $ret_val = "CHEMISTRY (H-Eco Group)";
else if($_sub_cd == 75)  $ret_val = "CLOTHING & TEXTILE (H-Eco Group)";
else if($_sub_cd == 76)  $ret_val = "HOME MANAGEMNET  (H-Eco Group)";
else if($_sub_cd == 79)  $ret_val = "NURSING";
else if($_sub_cd == 80)  $ret_val = "BUSINESS MATH";
else if($_sub_cd == 83)  $ret_val = "COMPUTER SCIENCE";
else if($_sub_cd == 90)  $ret_val = "AGRICULTURE";
else if($_sub_cd == 91)  $ret_val = "PAKISTAN STUDIES";
else if($_sub_cd == 92)  $ret_val = "ISLAMIC EDUCATION";
else if($_sub_cd == 93)  $ret_val = "CIVICS FOR NON MUSLIM";
else if($_sub_cd == 94)  $ret_val = "COMMERCIAL GEOGRAPHY";
else if($_sub_cd == 95)  $ret_val = "BANKING";
else if($_sub_cd == 96)  $ret_val = "TYPING";
else if($_sub_cd == 97)  $ret_val = "BUSINESS STATISTICS";
else if($_sub_cd == 98)  $ret_val = "COMPUTER STUDIES";
else if($_sub_cd == 99)  $ret_val = "BOOK KEEPING & ACCOUNTANCY";
return $ret_val ;         
}
//------------------------------------------------------------------

function get_grade($percentage) {
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
    }else if($percentage <= 39.99 and $percentage >=33.00 ) {
        echo "E";
    }
    else echo "F";
    /*else if($percentage <= 29.99) {
    echo "F";
    }*/
}
//--------------------------------------------
function Get_gradePrac_Inter_HE($Sub_Cd,$Marks,$PrPf) 
{
       $formula = ""; 
    if ($PrPf == 1) 
    {
        if ( $Sub_Cd == 73 || $Sub_Cd == 59 || $Sub_Cd == 72 || $Sub_Cd == 60 || $Sub_Cd == 75 || $Sub_Cd == 61 ) 
        {
            //echo 'here is prPf= '. $PrPf . '-->sub = '. $Sub_Cd . '--Marks-> = '. $Marks ; die();
            if ($Marks >= 13 && $Marks <= 15) {
                $formula = "(A+)";
            } else if ($Marks >= 11 && $Marks <= 12) {
                $formula = "(A)";
            } else if ($Marks >= 8 && $Marks <= 10) {
                $formula = "(B)";
            } else if ($Marks >= 7 && $Marks <= 9) {
                $formula = "(C)";
            } else if ($Marks >= 6 && $Marks <= 8) {
                $formula = "(D)";
            } else if ($Marks >= 4 && $Marks <= 5) {
                $formula = "(E)";
            }


        } 
       


    } 
    else if ($PrPf == 2) {
        //$formula = "(E*)";
        $formula = "(E)";

    } else if ($PrPf == 3) {
        $formula = "(F)";
    } 
      return $formula;
}


function Get_gradePrac_Inter($Sub_Cd,$Marks,$PrPf) 
{
    $formula = ""; 
    if ($PrPf == 1) 
    {
        if ($Sub_Cd == 8 || $Sub_Cd == 12 || $Sub_Cd == 16 || $Sub_Cd == 18 || $Sub_Cd == 21 || $Sub_Cd == 42 || $Sub_Cd == 46 || $Sub_Cd == 47 || $Sub_Cd == 48 || $Sub_Cd == 79 || $Sub_Cd == 75 || $Sub_Cd == 76 || $Sub_Cd == 73 || $Sub_Cd == 72 || $Sub_Cd == 59 || $Sub_Cd == 60 || $Sub_Cd == 61) 
        {
            //echo 'here is prPf= '. $PrPf . '-->sub = '. $Sub_Cd . '--Marks-> = '. $Marks ; die();
            if ($Marks >= 27 && $Marks <= 30) {
                $formula = "(A+)";
            } else if ($Marks >= 24 && $Marks <= 26) {
                $formula = "(A)";
            } else if ($Marks >= 21 && $Marks <= 23) {
                $formula = "(B)";
            } else if ($Marks >= 18 && $Marks <= 20) {
                $formula = "(C)";
            } else if ($Marks >= 15 && $Marks <= 17) {
                $formula = "(D)";
            } else if ($Marks >= 12 && $Marks <= 14) {
                $formula = "(E)";
            }


        } else if ($Sub_Cd == 83) {
            if ($Marks >= 45 && $Marks <= 50) {
                $formula = "(A+)";
            } else if ($Marks >= 40 && $Marks <= 44) {
                $formula = "(A)";
            } else if ($Marks >= 35 && $Marks <= 39) {
                $formula = "(B)";
            } else if ($Marks >= 30 && $Marks <= 34) {
                $formula = "(C)";
            } else if ($Marks >= 25 && $Marks <= 29) {
                $formula = "(D)";
            } else if ($Marks >= 20 && $Marks <= 24) {
                $formula = "(E)";
            }

        } 
        //===================================
        else if ($Sub_Cd == 98) 
        {
            if ( $Marks>=23  && $Marks<=25 ) 
                $formula="(A+)";
            else if ( $Marks >=20 && $Marks<=22 ) 
                $formula="(A)";
                else if ( $Marks >=18 && $Marks<=19 ) 
                    $formula="(B)";
                    else if ( $Marks >=15 && $Marks<=17 ) 
                        $formula="(C)" ;       
                        else if ( $Marks >=13 && $Marks<=14 ) 
                            $formula="(D)";
                            else if ( $Marks >=10 && $Marks<=12 ) 
                                $formula="(E)";
        }
        //===================================
        else if ($Sub_Cd == 23) 
        {
            if ($Marks >= 108 && $Marks <= 120) {
                $formula = "(A+)";
            } else if ($Marks >= 96 && $Marks <= 107) {
                $formula = "(A)";
            } else if ($Marks >= 84 && $Marks <= 95) {
                $formula = "(B)";
            } else if ($Marks >= 72 && $Marks <= 83) {
                $formula = "(C)";
            } else if ($Marks >= 60 && $Marks <= 71) {
                $formula = "(D)";
            } else if ($Marks >= 48 && $Marks <= 59) {
                $formula = "(E)";
            }
        }


    } 
    else if ($PrPf == 2) {
      //  $formula = "(E*)";
       $formula = "(E)";

    } else if ($PrPf == 3) {
        $formula = "(F)";
    }

    // echo ' formula = '. $formula; die();

    return $formula;
}

//---------------------------------------------------
function sub7Pr($Sub,$Marks,$PrPf,$st,$schm)
{
    $retVal = "";
    if($st == 2) { $retVal = "A";}
    else
    {
        if ($schm==1){ $retVal = Get_gradePrac_Inter($Sub,$Marks,$PrPf); }
        else { $retVal = $Marks;} 
    }
    return $retVal;
    //echo ' r: '. $retVal . ' <-> '  ; die();
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