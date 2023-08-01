<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\signresource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class signcontroller extends Controller
{
    //
    public function index(Request $request)
    {
    
        $param=$request->input('param');
        $pharase="";
        $ttype="";  

    if($this->is_json_string($param))
    {
      $json= json_decode($param);

     $pharase=$json->text;
     $ttype=$json->translator;

     $arr=$this->SearchExprssions($this->unvocalize($pharase));
        $allresults=array();
        for($i=0;$i<count($arr);$i++)
        {
            $results=$this->findinwrords($arr[$i],$ttype);
            if($results){
                array_push($allresults,$results);
               }       
          }
        
        if( $allresults){ 
            $msg=array("message"=>"found");
            return  response($allresults,200,$msg);
        }
        else {
            $msg=array("message"=>"not found 1");
            return  response($allresults,404,$msg);
        }

    }
    else {
        $msg=array("message"=>"not found 2");
        return  response($allresults,404,$msg);
    }
        

    }

    public function transit(Request $request)
    {
    
       
        $pharase="";
        $ttype="";  

    
     $uid=Session::get('MyID');

     $pharase=$request->input('text');
     $ttype=$request->input('translator');

     $arr=$this->SearchExprssions($this->unvocalize($pharase));
     $res=DB::select("SELECT remain_words FROM accounts WHERE user_id=".$uid);
     if(intval($res[0]->remain_words)>count($arr))  
     {
     $allresults=array();
        for($i=0;$i<count($arr);$i++)
        {
            $results=$this->findinwrords($arr[$i],$ttype);
            if($results){
                array_push($allresults,$results);
               }       
          }
        
       if( $allresults){ 
          $temp="";
       /*
            for($i=0;$i<count($allresults);$i++)
            {
             if($temp=="") $temp =  $allresults[$i]["matches"]["word"]."~".$allresults[$i]["matches"]["video"][0];
             else $temp =$temp.",". $allresults[$i]["matches"]["word"]."~".$allresults[$i]["matches"]["video"][0];
            }
         */   
            return json_encode($allresults);
        }
        else {
          
            return  "عفوا حدث خطأ";
        }

    }
    else return "لا يوجد رصيد كافي";  
        

    }

    public function mirror(Request $request)
    {
        $param=$request->input('param');
        $msg=array("message"=>"found");
        return  response($param,200,$msg);
    }

    
    public function ReadNum(Request $request)
    {
        $param=$request->input('param');
        $pharase="";
        $ttype="";  

    if($this->is_json_string($param))
    {
      $json= json_decode($param);

     $pharase=$json->text;
     $ttype=$json->translator;

        $arr=$this->ReadNummber($pharase);
        $allresults=array();
        if($arr)
        {
            
            for($i=0;$i<count($arr);$i++)
            {
                $results=$this->findinwrords($arr[$i],$ttype);
                if($results){
                    array_push($allresults,$results);
                   }       
              }
        }
        if( $allresults){ 
            $msg=array("message"=>"found");
            return  response($allresults,200,$msg);
        }
        else {
            $msg=array("message"=>"not found");;
            return  response($allresults,404,$msg);
        }
    }
    else {
        $msg=array("message"=>"not found");;
        return  response($allresults,404,$msg);
    }

    }

    protected function is_json_string($json_str)
    {
        json_decode($json_str);
        return json_last_error() === JSON_ERROR_NONE;
    }

    protected function unvocalize($param)
    {
        $ww=$param;
        $ww=str_replace("ّ","",$ww);
        $ww=str_replace("ْ","",$ww);
        $ww=str_replace("ٍ","",$ww);
        $ww=str_replace("ِ","",$ww);
        $ww=str_replace("ً","",$ww);
        $ww=str_replace("َ","",$ww);
        $ww=str_replace("ٌ","",$ww);
        $ww=str_replace("ّ","",$ww);
        $ww=str_replace("أ","ا",$ww);
        $ww=str_replace("إ","ا",$ww);
        $ww=str_replace("آ","ا",$ww);
        $ww=str_replace("ى","ي",$ww);
        return $ww;
    }

    protected function findinwrords($param,$ttype)
    {
         $spath="https://kcgwebservices.net/deafservice/media/".$ttype."/";
        $results = DB::select("select vocalized ,wcode from words_coded where unvocalized ='".$param."'" );
        $arr=array();
       if($results)
       {
        $temp=array();
        for ($i=0;$i<count($results);$i++)
        {
            $temp[$i]=array("word"=>$results[$i]->vocalized,"video"=>array($spath."words/".$results[$i]->wcode.".webm"));
        }
        $arr=array("word"=>$param,"matches"=>$temp);
       }
       else {
        $results = DB::select("select vocalized,wcode,pronounce_id from verbs_coded where unvocalized ='".$param."'" );
        if($results) {
            $temp=array();
        for ($i=0;$i<count($results);$i++)
        {
            $temp[$i]=array("word"=>$results[$i]->vocalized,"video"=>array($spath."verbs/".$results[$i]->wcode.".webm",$spath."pronouns/".$results[$i]->pronounce_id.".webm"));
        }
        $arr=array("word"=>$param,"matches"=>$temp);
        }
        else $arr=$this->SearchInDic($param,$ttype);
       }
       
        return $arr;
    }
    protected function GetLetters($param,$ttype)
    {

        $spath="https://kcgwebservices.net/deafservice/media/".$ttype."/letters/";
       
       $varr=array();

       for($i=0;$i<strlen($param);  $i += 2)
       {
        $varr[$i]=$spath.$this->GetLetterOrdinalNumber(substr($param,$i,2)).".webm";
       }

       $arr=array("word"=>$param,"matches"=>array(array("word"=>$param,"video"=>$varr)));
        return $arr;
    }

    protected function  GetLetterOrdinalNumber($str)

{

$lstr="00";	

switch ($str)

            {



                case "أ":

                    $lstr = "01"; break;          

                case "ب":

                    $lstr = "02"; break;

                case "ت":

                    $lstr = "03"; break;

                case "ث":

                    $lstr = "04"; break;

                case "ج":

                    $lstr = "05"; break;

                case "ح":

                    $lstr = "06"; break;

                case "خ":

                    $lstr = "07"; break;

                case "د":

                    $lstr = "08"; break;

                case "ذ":

                    $lstr = "09"; break;

                case "ر":

                    $lstr = "10"; break;

                case "ز":

                    $lstr = "11"; break;

                case "س":

                    $lstr = "12"; break;

                case "ش":

                    $lstr = "13"; break;

                case "ص":

                    $lstr = "14"; break;

                case "ض":

                    $lstr = "15"; break;

                case "ط":

                    $lstr = "16"; break;

                case "ظ":

                    $lstr = "17"; break;

                case "ع":

                    $lstr = "18"; break;

                case "غ":

                    $lstr = "19"; break;

                case "ف":

                    $lstr = "20"; break;

                case "ق":

                    $lstr = "21"; break;

                case "ك":

                    $lstr = "22"; break;

                case "ل":

                    $lstr = "23"; break;

                case "م":

                    $lstr = "24"; break;

                case "ن":

                    $lstr = "25"; break;

                case "ه":

                    $lstr = "26"; break;

                case "و":

                    $lstr = "27"; break;

                case "ي":

                    $lstr = "28"; break;

                case "إ": 

                    $lstr = "01"; break;

                case "آ":

                    $lstr = "10"; break;

                case "ى":

                    $lstr = "28"; break;

                case "ة":

                    $lstr = "03"; break;

                case "ئ":

                    $lstr = "28"; break;

                case "ؤ":

                    $lstr = "27"; break;

                case "ا":

                    $lstr = "1"; break;

                                }

    return $lstr;
            }

 protected function SearchExprssions($phrase)

            {
            
            $str=array();
            
            
            
            if(strpos($phrase," ") !== false) $str = explode(" ", $phrase);
            
            else array_push($str,$phrase);
            
            
            
            $sss=array();
            
            
            
            $ss="";
            
            
            
            
            
            for($k=2; $k<=count($str);$k++)
            
            {
            
            
            
            for($i=0;$i<=(count($str) - $k);$i++)
            
            {
            
            
            
            $ss="";
            
            
            
            for ($j=$i; $j<($i+$k);$j++) {$ss=$ss." ".$str[$j];}
            
            $ss=trim($ss);
            
            array_push($sss,$this->Noquots($ss));
            
            
            
            
            
            }
            
            }
            
            
            
            $temp="";
            
            $vvv=$this->Noquots($phrase);
            
            $expr=array();
            
            
            
            for ($i=0; $i<count($sss); $i++) {if ($this->FoundInDic($sss[$i])){array_push($expr,$sss[$i]); }} 
            
            if (count($expr)>0) 
            
            { 
            
            for ($i=0; $i < count($expr);  $i++ ) {$temp="~".$i; $vvv= str_replace($expr[$i],$temp,$vvv);}
            
                                         
            
            $estr=explode(" ",$vvv);
            
            $j=0;
            
            for($k=0;$k<count($expr);$k++)
            
            for ($i=0; $i< count($estr);$i++){$temp="~".$j; if ($estr[$i]==$temp) { $estr[$i]=$expr[$j];$j++;}     }
            
            
            
            return $estr;
            
            
            
            }                                     
            
            else return $str;
            
            }   
            
            
            protected function Noquots($str)

            {
           
                $ss=str_replace(".","",$str);
           
                $ss=str_replace("ـ","",$ss);
           
                $ss=str_replace("،","",$ss);
           
                $ss=str_replace("!","",$ss);
           
                $ss=str_replace("؟","",$ss); 
           
                $ss=str_replace("(","",$ss);
           
                $ss=str_replace(")","",$ss);
           
                $ss=str_replace("'","",$ss);
           
                $ss=str_replace('"','',$ss);
           
                $ss=str_replace('،','',$ss);
           
                $ss=str_replace('؛','',$ss);
           
                $ss=str_replace(':','',$ss);
           
                return trim($ss);
           
            } 
            protected function FoundInDic($word)

            {
               $flag=false;
                $results = DB::select("select wcode from words_coded where unvocalized ='".$word."'" );
                $arr=array();
               if($results)
               {
                $flag=true;
               }
            
               return $flag;
            
            }  
            
            function SearchInDic($strr,$ttype)

            {
            
       
       

            $words=array();
            
            $flag=false;
            
            $doneflag=false;
            
            $femaleflag=false;
            
            $pluflag = false;
            
            $twoflag=false;
            
            $adjflag=false;
            
            $ownflag=false;
            $spath="https://kcgwebservices.net/deafservice/media/".$ttype."/words/";
            //$str=Withoutquot(WithoutHamza(WithoutAccent($strr)));
            
            $str=$strr;
            
            
            
            $ssss="";
            
            $sss=$str;
            
            $cc="";
            
            
            
            if(is_numeric($str) ) 
            
            {  $vv =$this->ReadNummber($str); 
            
            for( $i=0;$i<count($vv);$i++) array_push($words,$vv[$i]);
            
            if(count($words)>0) { $flag=true;return $words;}
            
            
            
            }
            
            if ($flag==false ) {
            
            $ss =substr($str,0, 4);
            
            
            
            
            
            if ($ss == "ال") {$doneflag=true; $sss = substr($str,4, strlen($str) - 4) ;$flag=$this->FoundInDic($sss);};
            
            
            
            if ($flag==true) {array_push($words,$sss);}
            
            }
            
            
            
            if ($flag==false ) {
            
                $sss="ال".$str;$flag=$this->FoundInDic($sss);
            
            
            
            if ($flag==true) {array_push($words,$sss);}
            
            else  $sss=$str;
            
            }
            
            
            
            if ($flag==false ) {
            
            $ss = substr($str,0, 2);
            
            if ($ss == "ب") { $doneflag=true;$sss = substr($str,2, strlen($str) - 2);$flag=$this->FoundInDic($sss); };
            
            
            
            if ($flag==true) {array_push($words,"في");array_push($words,$sss);}
            
            }
            
            
            
            if ($flag==false ) {
            
            $ss = substr($str,0, 2);
            
            if ($ss == "ف") { $doneflag=true; $sss = substr($str,2, strlen($str) - 2) ;$flag=$this->FoundInDic($sss);};
            
            
            
            if ($flag==true) {array_push($words,$sss);}
            
            }
            
            
            
            if ($flag==false ) {
            
            $ss = substr($str,0, 2);
            
            if ($ss == "ل") {$doneflag=true; $sss = substr($str,2, strlen($str) - 2);$flag=$this->FoundInDic($sss); };
            
            
            
            if ($flag==true) {array_push($words,"إلى");array_push($words,$sss);}
            
            }
            
            
            
            if ($flag==false ) {
            
            $ss = substr($str,0, 6);
            
            if ($ss == "بال") { $doneflag=true;$sss = substr($str,6, strlen($str) - 6);$flag=$this->FoundInDic($sss); };
            
            
            
            if ($flag==true) {array_push($words,"في");array_push($words,$this->GetWord($sss));}
            
            }
            
            
            
            if ($flag==false ) {
            
            $ss = substr($str,0, 4);
            
            if ($ss == "لل") {$doneflag=true; $sss = substr($str,4, strlen($str) - 4);$flag=$this->FoundInDic($sss); };
            
            
            
            if ($flag==true) {array_push($words,"إلى");array_push($words,$this->GetWord($sss));}
            
            }
            
            
            
            if ($flag==false && $doneflag==true)
            
            {
            
            $doneflag=false;
            
             
            
            $ssss=$str; 
            
            $ss=substr($sss,strlen($sss)-6,6);
            
            if ($ss=="تان" ){$ssss=substr($sss,0,strlen($sss)-6);$femaleflag=true;$twoflag=true;$doneflag=true;};
            
            if ($ss=="تين" ){$ssss=substr($sss,0,strlen($sss)-6);$femaleflag=true;$twoflag=true;$doneflag=true;};
            
            
            
            $ss=substr($sss,strlen($sss)-4,4);
            
            if (($ss=="ان") && ($doneflag == false) ){$ssss=substr($sss,0,strlen($sss)-4);$twoflag=true;};
            
            if (($ss=="ين") && ($doneflag == false) ){$ssss=substr($sss,0,strlen($sss)-4);$twoflag=true;};
            
            if ($ss=="ون" ){$ssss=substr($sss,0,strlen($sss)-4);$pluflag =true;};
            
            if ($ss=="ات" ){$ssss=substr($sss,0,strlen($sss)-4);$pluflag =true;$femaleflag=true;};
            
            if ($ss == "تا") { $ssss = substr($sss,0, strlen($sss) - 4); $femaleflag = true; $twoflag=true; $doneflag = true; };
            
            
            
            $ss=substr($sss,strlen($sss)-2,2);
            
            if ($ss == "ة") { $ssss = substr($sss,0, strlen($sss) - 2); $femaleflag = true; };
            
            if ($ss == "ا" && ($doneflag == false)) { $ssss = substr($sss,0, strlen($sss) - 2); $twoflag=true; };
            
            if ($ss == "و" && ($doneflag == false)) { $ssss = substr($sss,0, strlen($sss) - 2); $pluflag=true; };
            
            if ($ss == "ي" && ($doneflag == false)) { $ssss = substr($sss,0, strlen($sss) - 2); $ownflag = true; };
            
            if ($ss == "ى" && ($doneflag == false)) { $ssss = substr($sss,0, strlen($sss) - 2); $ownflag = true; };
            
            
            
            $flag=$this->FoundInDic($ssss);
            
            if($flag==false) if ($ss=="ه") {$ssss=substr($sss,0,strlen($sss)-2); $ssss=$ssss."ة"; $flag=$this->FoundInDic($ssss);} 
            
            
            
            if ($flag==true){array_push($words,$this->GetWord($ssss));$adjflag=$this->isAdj($ssss); if ($adjflag==true) { $femaleflag =false; $pluflag=false;$twoflag=false;$ownflag=false;}}
            
            
            
            if (($flag==true) && ($femaleflag == true)){array_push($words,"مؤنث");}
            
            if (($flag==true) && ($pluflag == true)){array_push($words,"الذين");}
            
            if (($flag==true) && ($twoflag == true)){array_push($words,"هذان");}
            
            if (($flag==true) && ($ownflag == true)){array_push($words,"أَنَا");}
            
            
            
            }
            
            $cc=substr($sss,strlen($sss)-2,2); 
            
            if($flag==false) {if ($cc=="ه") {$ssss=substr($sss,0,strlen($sss)-2); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هو");} }} 
            
            if($flag==false) {if ($cc=="ك") {$ssss=substr($sss,0,strlen($sss)-2); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أنتَ");} }}
            
            if($flag==false) {if ($cc=="ي") {$ssss=substr($sss,0,strlen($sss)-2); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أَنَا");} }} 
            
            if($flag==false) {if ($cc=="ى") {$ssss=substr($sss,0,strlen($sss)-2); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أَنَا");} }} 
            
            
            
            $cc=substr($sss,strlen($sss)-4,4);
            
            if($flag==false) {if ($cc=="هم") {$ssss=substr($sss,0,strlen($sss)-4); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"الَّذِينَ");} }} 
            
            if($flag==false) {if ($cc=="هن") {$ssss=substr($sss,0,strlen($sss)-4); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هُنَّ");} }} 
            
            if($flag==false) {if ($cc=="نا") {$ssss=substr($sss,0,strlen($sss)-4); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"نَحْنُ");} }}   
            
            if($flag==false) {if ($cc=="ته") {$ssss=substr($sss,0,strlen($sss)-4)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هو");} }}
            
            if($flag==false) {if ($cc=="تك") {$ssss=substr($sss,0,strlen($sss)-4)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أنتَ");} }}
            
            if($flag==false) {if ($cc=="تي") {$ssss=substr($sss,0,strlen($sss)-4)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أَنَا");} }}
            
            if($flag==false) {if ($cc=="تى") {$ssss=substr($sss,0,strlen($sss)-4)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أَنَا");} }}
            
                 
            if($flag==false) {if ($cc=="ها") {$ssss=substr($sss,0,strlen($sss)-4); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هَذِهِ");} }}
            
            $cc=substr($sss,strlen($sss)-6,6);
            
            if($flag==false) {if ($cc=="هما") {$ssss=substr($sss,0,strlen($sss)-6); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هَذَانِ");} }} 
            
            if($flag==false) {if ($cc=="يا") {$ssss=substr($sss,0,strlen($sss)-6); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أَنَا");array_push($words,"هَذَانِ");} }} 
            
            if($flag==false) {if ($cc=="تها") {$ssss=substr($sss,0,strlen($sss)-6)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هَذِهِ");} }}
            
            if($flag==false) {if ($cc=="تنا") {$ssss=substr($sss,0,strlen($sss)-6)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"نَحْنُ");} }}
            
            if($flag==false) {if ($cc=="تهم") {$ssss=substr($sss,0,strlen($sss)-6)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"الَّذِينَ");} }}
            
            if($flag==false) {if ($cc=="تهن") {$ssss=substr($sss,0,strlen($sss)-6)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هُنَّ");} }}
            
            if($flag==false) {if ($cc=="تكم") {$ssss=substr($sss,0,strlen($sss)-6)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أَنْتُمْ");} }}
            
            
            
            $cc=substr($sss,strlen($sss)-8,8);
            
            if($flag==false) {if ($cc=="تهما") {$ssss=substr($sss,0,strlen($sss)-8)+"ة";$flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هَاتَانِ");} }}
            
            if($flag==false) {if ($cc=="تهما") {$ssss=substr($sss,0,strlen($sss)-8);$flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"مُؤَنَّثٌ");array_push($words,"هَاتَانِ");} }}
            
            
            
            if($flag==false) {if ($cc=="تيا") {$ssss=substr($sss,0,strlen($sss)-8)+"ة";$flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));;array_push($words,"مُؤَنَّثٌ");array_push($words,"هَاتَانِ");} }}
            
            if($flag==false) {if ($cc=="تيا") {$ssss=substr($sss,0,strlen($sss)-8);$flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"مُؤَنَّثٌ");array_push($words,"أَنَا");array_push($words,"هَاتَانِ");} }}
            
            
            
            /////--------------------------
            
            
            
            if ($flag==false)
            
            {
            
            $doneflag=false;
            
            $sss=$str; 
            
            $ssss=$str; 
            
            $ss=substr($sss,strlen($sss)-6,6);
            
            if ($ss=="تان" ){$ssss=substr($sss,0,strlen($sss)-6);$femaleflag=true;$twoflag=true;$doneflag=true;};
            
            if ($ss=="تين" ){$ssss=substr($sss,0,strlen($sss)-6);$femaleflag=true;$twoflag=true;$doneflag=true;};
            
            
            
            $ss=substr($sss,strlen($sss)-4,4);
            
            if (($ss=="ان") && ($doneflag == false) ){$ssss=substr($sss,0,strlen($sss)-4);$twoflag=true;};
            
            if (($ss=="ين") && ($doneflag == false) ){$ssss=substr($sss,0,strlen($sss)-4);$twoflag=true;};
            
            if ($ss=="ون" ){$ssss=substr($sss,0,strlen($sss)-4);$pluflag =true;};
            
            if ($ss=="ات" ){$ssss=substr($sss,0,strlen($sss)-4);$pluflag =true;$femaleflag=true;};
            
            if ($ss == "تا") { $ssss = substr($sss,0, strlen($sss) - 4); $femaleflag = true; $twoflag=true; $doneflag = true; };
            
            
            
            $ss=substr($sss,strlen($sss)-2,2);
            
            if ($ss == "ة") { $ssss = substr($sss,0, strlen($sss) - 2); $femaleflag = true; };
            
            if ($ss == "ا" && ($doneflag == false)) { $ssss = substr($sss,0, strlen($sss) - 2); $twoflag=true; };
            
            if ($ss == "و" && ($doneflag == false)) { $ssss = substr($sss,0, strlen($sss) - 2); $pluflag=true; };
            
            if ($ss == "ي" && ($doneflag == false)) { $ssss = substr($sss,0, strlen($sss) - 2); $ownflag = true; };
            
            if ($ss == "ى" && ($doneflag == false)) { $ssss = substr($sss,0, strlen($sss) - 2); $ownflag = true; };
            
            
            
            $flag=$this->FoundInDic($ssss);
            
            if($flag==false) if ($ss=="ه") {$ssss=substr($sss,0,strlen($sss)-2); $ssss=$ssss."ة"; $flag=$this->FoundInDic($ssss);} 
            
            
            
            if ($flag==true){array_push($words,$this->GetWord($ssss));$adjflag=$this->isAdj($ssss); if ($adjflag==true) { $femaleflag =false; $pluflag=false;$twoflag=false;$ownflag=false;}}
            
            
            if (($flag==true) && ($femaleflag == true)){array_push($words,"مؤنث");}
            
            if (($flag==true) && ($pluflag == true)){array_push($words,"الذين");}
            
            if (($flag==true) && ($twoflag == true)){array_push($words,"هذان");}
            
            if (($flag==true) && ($ownflag == true)){array_push($words,"أَنَا");}
            
            
            
            
            }
            
            $cc=substr($sss,strlen($sss)-2,2); 
            
            if($flag==false) {if ($cc=="ه") {$ssss=substr($sss,0,strlen($sss)-2); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هو");} }} 
            
            if($flag==false) {if ($cc=="ك") {$ssss=substr($sss,0,strlen($sss)-2); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أنتَ");} }}
            
            if($flag==false) {if ($cc=="ي") {$ssss=substr($sss,0,strlen($sss)-2); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أَنَا");} }} 
            
            if($flag==false) {if ($cc=="ى") {$ssss=substr($sss,0,strlen($sss)-2); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أَنَا");} }} 
            
            
            
            $cc=substr($sss,strlen($sss)-4,4);
            
            if($flag==false) {if ($cc=="هم") {$ssss=substr($sss,0,strlen($sss)-4); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"الَّذِينَ");} }} 
            
            if($flag==false) {if ($cc=="هن") {$ssss=substr($sss,0,strlen($sss)-4); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هُنَّ");} }} 
            
            if($flag==false) {if ($cc=="نا") {$ssss=substr($sss,0,strlen($sss)-4); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"نَحْنُ");} }}   
            
            if($flag==false) {if ($cc=="ته") {$ssss=substr($sss,0,strlen($sss)-4)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هو");} }}
            
            if($flag==false) {if ($cc=="تك") {$ssss=substr($sss,0,strlen($sss)-4)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أنتَ");} }}
            
            if($flag==false) {if ($cc=="تي") {$ssss=substr($sss,0,strlen($sss)-4)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أَنَا");} }}
            
            if($flag==false) {if ($cc=="تى") {$ssss=substr($sss,0,strlen($sss)-4)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أَنَا");} }}
            
            
            if($flag==false) {if ($cc=="ها") {$ssss=substr($sss,0,strlen($sss)-4); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هَذِهِ");} }}
            
            $cc=substr($sss,strlen($sss)-6,6);
            
            if($flag==false) {if ($cc=="هما") {$ssss=substr($sss,0,strlen($sss)-6); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هَذَانِ");} }} 
            
            if($flag==false) {if ($cc=="يا") {$ssss=substr($sss,0,strlen($sss)-6); $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أَنَا");array_push($words,"هَذَانِ");} }} 
            
            if($flag==false) {if ($cc=="تها") {$ssss=substr($sss,0,strlen($sss)-6)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هَذِهِ");} }}
            
            if($flag==false) {if ($cc=="تنا") {$ssss=substr($sss,0,strlen($sss)-6)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"نَحْنُ");} }}
            
            if($flag==false) {if ($cc=="تهم") {$ssss=substr($sss,0,strlen($sss)-6)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"الَّذِينَ");} }}
            
            if($flag==false) {if ($cc=="تهن") {$ssss=substr($sss,0,strlen($sss)-6)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هُنَّ");} }}
            
            if($flag==false) {if ($cc=="تكم") {$ssss=substr($sss,0,strlen($sss)-6)+"ة"; $flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"أَنْتُمْ");} }}
            
            
            
            $cc=substr($sss,strlen($sss)-8,8);
            
            if($flag==false) {if ($cc=="تهما") {$ssss=substr($sss,0,strlen($sss)-8)+"ة";$flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"هَاتَانِ");} }}
            
            if($flag==false) {if ($cc=="تهما") {$ssss=substr($sss,0,strlen($sss)-8);$flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"مُؤَنَّثٌ");array_push($words,"هَاتَانِ");} }}
            
            
            
            if($flag==false) {if ($cc=="تيا") {$ssss=substr($sss,0,strlen($sss)-8)+"ة";$flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));;array_push($words,"مُؤَنَّثٌ");array_push($words,"هَاتَانِ");} }}
            
            if($flag==false) {if ($cc=="تيا") {$ssss=substr($sss,0,strlen($sss)-8);$flag=$this->FoundInDic($ssss); if ($flag==true) {array_push($words,$this->GetWord($ssss));array_push($words,"مُؤَنَّثٌ");array_push($words,"أَنَا");array_push($words,"هَاتَانِ");} }}
            $arr=array();
            $varr=array();
            if(count($words)>0)
            {
                for($i=0;$i<count($words);$i++)
                {
                    $results = DB::select("select wcode from words_coded where unvocalized ='".$words[$i]."'" );
                    if($results)
                    {
                      $varr[$i]= $spath. $results[0]->wcode.".webm";
                    }
                 
                }

                $arr=array("word"=>$strr,"matches"=>array(array("word"=>$strr,"video"=>$varr)));
       

            }
            else $arr=$this->GetLetters($strr,$ttype);
            
            
            
             return $arr;
            
            }
          
            protected function isAdj($str)
            {
                $flag=false;
                $results = DB::select("select subject from words_coded where unvocalized ='".$str."'" );
                if($results)
                {
                    if($results[0]->subject=='صفات') $flag=true;
                }
                return $flag;
            }
			
			
            protected function GetWord($wrd)
            {
                return $wrd;
            }
			
            protected  function ReadNummber($numstr)

            {
           
               
           
                $num=array();
           
                
           
                if(strlen($numstr)<=12) 
           
                {
           
                    $xx=intval($numstr);
           
               $numb =(int)($xx/1000000000); 
           
               if ($numb>1){ $yy=$this->Readhandreds($numb);
           
                            for( $i=0;$i<count($yy);$i++)array_push($num,$yy[$i]);}
           
               if($numb>0) array_push($num,"1000000000");
           
               if($numb>0)$xx=$xx-1000000000*$numb;
           
               
           
                $numb =(int)($xx/1000000); 
           
               if ($numb>1){ $yy=$this->Readhandreds($numb);
           
                            for( $i=0;$i<count($yy);$i++)array_push($num,$yy[$i]);}
           
               if($numb>0) array_push($num,"1000000");
           
               if($numb>0)$xx=$xx-1000000*$numb;
           
               
           
                $numb =(int)($xx/1000); 
           
               if ($numb>1){ $yy=$this->Readhandreds($numb);
           
                            for( $i=0;$i<count($yy);$i++)array_push($num,$yy[$i]);}
           
               if($numb>0) array_push($num,"1000");
           
               if($numb>0)$xx=$xx-1000*$numb;  
           
              if ($xx>1){ $yy=$this->Readhandreds($xx);
           
                            for( $i=0;$i<count($yy);$i++)array_push($num,$yy[$i]);}
           
                    }
           
            return $num;
           
            }
           
            
           
            /////////////////////////////////////////////////////////////////////
           
            
           
        protected function Readhandreds($numb)
           
            {
           
               $ss=array();
           
               $h=0;
           
               $d=0;
           
               $u=0; 
           
               $uu=0;
           
               $h=(int)($numb/100);
           
               $dd=$numb-($h*100);
           
               if($dd>0) $d=(int)($dd/10);
           
               if($dd>0) $u=$dd-($d*10);
           
               if($h>0) array_push($ss,strval(100*$h));
           
               if($u>0) array_push($ss,strval($u));
           
               if($d>0)  array_push($ss,strval(10*$d));
           
               return $ss;
           
               
           
            }
            
}
