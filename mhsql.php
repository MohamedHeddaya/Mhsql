<?php

/*

MIT License

Copyright (c) 2023 Mohamed Abdelsalam Ahmed Khalil Heddaya

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE. 

*/

$GLOBALS["mh_dsql"]=NULL;
$GLOBALS["mh_dprp"]=NULL;
$GLOBALS["mh_dtnm"]=NULL;
$GLOBALS["mh_dcod"]=TRUE;
$GLOBALS["mh_dcdct"]=":";
$GLOBALS["mh_dcdci"]=":";
$GLOBALS["mh_bklc"]="\n";
$GLOBALS["mh_eqas"]=" ";
$GLOBALS["mh_bnds"]="@:::::::::::::::::::::::::::::::::::::@:::::::::::::::::::::::::::::::::::::::::::::@:::::::::::::::::::::::::::::::::::::::::@";

function mh_RCV(){

if($_SERVER["REQUEST_METHOD"]==="POST"){
$mh_rcvt=file_get_contents("php://input");
$mh_rcvd=json_decode($mh_rcvt,true);
return [$mh_rcvd,$mh_rcvt];
};

};

function mh_RSP($mh_resp){

echo json_encode($mh_resp);

};

function mh_PRNT($mh_msg){

print_r($mh_msg);
print_r("\n");

};

function mh_EQ($mh_qu,$mh_sql=NULL){

if($mh_sql===NULL){
$mh_sql=$GLOBALS["mh_dsql"];
};





$mh_qu=str_replace(
["\\^ctne^","\\^aipk^","\\^ftxt^"],
[$GLOBALS["mh_bnds"]."0",$GLOBALS["mh_bnds"]."1",$GLOBALS["mh_bnds"]."2"]
,$mh_qu);

$mh_qu=str_replace("^ctne^",$GLOBALS["mh_eqas"]."CREATE TABLE IF NOT EXISTS".$GLOBALS["mh_eqas"],$mh_qu);
$mh_qu=str_replace("^aipk^",$GLOBALS["mh_eqas"]."INT AUTO_INCREMENT PRIMARY KEY".$GLOBALS["mh_eqas"],$mh_qu);
$mh_qu=str_replace("^ftxt^",$GLOBALS["mh_eqas"]."VARCHAR(255)".$GLOBALS["mh_eqas"],$mh_qu);

$mh_qu=str_replace(
[$GLOBALS["mh_bnds"]."0",$GLOBALS["mh_bnds"]."1",$GLOBALS["mh_bnds"]."2"],
["^ctne^","^aipk^","^ftxt^"]
,$mh_qu);

mh_QU($mh_qu,$mh_sql,"MH EQ");

};

function mh_FD($mh_data){

$mh_res=[];
$mh_nrc=-1;
while($mh_nrc!=$mh_data->num_rows-1){
$mh_nrc+=1;
$mh_res[$mh_nrc]=$mh_data->fetch_assoc();
};
return $mh_res;

};

function mh_SQL($mh_sn,$mh_un,$mh_pw){

$mh_sql=new mysqli($mh_sn,$mh_un,$mh_pw);
if($mh_sql->connect_error){
die($GLOBALS["mh_bklc"]."MH SQL FAIL! : $mh_sql->connect_error");
}
else{

$GLOBALS["mh_dsql"]=$mh_sql;
return $mh_sql;
}

};

function mh_SDB($mh_sn,$mh_un,$mh_pw,$mh_db){

$mh_sql=new mysqli($mh_sn,$mh_un,$mh_pw,$mh_db);
if($mh_sql->connect_error){
die($GLOBALS["mh_bklc"]."MH SDB FAIL! : $mh_sql->connect_error");
}
else{

$GLOBALS["mh_dsql"]=$mh_sql;
return $mh_sql;
}

};

function mh_CDB($mh_name,$mh_sql=NULL){

if($mh_sql===NULL){
$mh_sql=$GLOBALS["mh_dsql"];
}

$mh_q="CREATE DATABASE $mh_name";
if($mh_sql->query($mh_q)===TRUE){

}
else{

}

};

function mh_QU($mh_q,$mh_sql=NULL,$mh_pap=NULL){

if($mh_sql===NULL){
$mh_sql=$GLOBALS["mh_dsql"];
};
$mh_qres=$mh_sql->query($mh_q);



















return $mh_qres;

};

function mh_MQU($mh_q,$mh_sql=NULL,$mh_pap=NULL){

if($mh_sql===NULL){
$mh_sql=$GLOBALS["mh_dsql"];
};
$mh_qres=$mh_sql->multi_query($mh_q);


















return $mh_qres;

};






































function mh_PIN($mh_ns,$mh_tp,$mh_tnm=NULL,$mh_sql=NULL){

if($mh_sql===NULL){
$mh_sql=$GLOBALS["mh_dsql"];
};
if($mh_tnm===NULL){
$mh_tnm=$GLOBALS["mh_dtnm"];
};

$mh_qmsk="";
if($GLOBALS['mh_dcod']===TRUE){
$mh_nsar=explode($GLOBALS['mh_dcdci'],"$mh_ns");
};
if($GLOBALS['mh_dcod']===FALSE){
$mh_nsar=$mh_ns;
};
$mh_nsal=count($mh_nsar);
$mh_hs=[];
foreach($mh_nsar as $mh_nsc => $mh_nsh){

if($mh_nsc!=$mh_nsal-1){
$mh_qmsk.="?,";
}else{
$mh_qmsk.="?";
}
$GLOBALS["$mh_nsh"]=NULL;
$mh_hs[$mh_nsc]=&$GLOBALS["$mh_nsh"];

};
$mh_prp=$mh_sql->prepare("INSERT INTO $mh_tnm ($mh_ns) VALUES ($mh_qmsk)");
$mh_prp->bind_param("$mh_tp",...$mh_hs);
$GLOBALS["mh_dprp"]=$mh_prp;
return $mh_prp;

};

function mh_PEX($mh_nms,$mh_nvls,$mh_prpv=NULL){

if($mh_prpv===NULL){
$mh_prpv=$GLOBALS["mh_dprp"];
}

if($GLOBALS['mh_dcod']===TRUE){
$mh_nmsa=explode($GLOBALS['mh_dcdci'],"$mh_nms");
};
if($GLOBALS['mh_dcod']===FALSE){
$mh_nmsa=$mh_nms;
};

$mh_nmsl=count($mh_nmsa);

foreach($mh_nmsa as $mh_nmsc => $mh_nmsv){
$GLOBALS["$mh_nmsv"]=$mh_nvls[$mh_nmsc];
}

$mh_prpv->execute();

};

function mh_PCLS($mh_prpv=NULL){

if($mh_prpv===NULL){
$mh_prpv=$GLOBALS["mh_dprp"];
};
$mh_prpv->close();

};

function mh_INS($mh_ns,$mh_ds,$mh_sql=NULL,$mh_tnm=NULL){

if($mh_sql===NULL){
$mh_sql=$GLOBALS["mh_dsql"];
};
if($mh_tnm===NULL){
$mh_tnm=$GLOBALS["mh_dtnm"];
};

mh_QU("INSERT INTO $mh_tnm ($mh_ns) VALUES ($mh_ds)",$mh_sql,"MH INS");

};
function mh_o($mh_n,$mh_sql=NULL){

if($mh_sql===NULL){
$mh_sql=$GLOBALS["mh_dsql"];
};
if($mh_n==="lid"){
$mh_n="insert_id";
};
return $mh_sql->{$mh_n};

};

function mh_TBL($mh_tnm,$mh_cms,$mh_sql=NULL){



if($mh_sql===NULL){
$mh_sql=$GLOBALS["mh_dsql"];
};

$mh_qa0="";
$mh_qa1="";


foreach($mh_cms as $mh_cmc => $mh_cm){

if($GLOBALS['mh_dcod']===TRUE){
$mh_spa=explode($GLOBALS['mh_dcdct'],$mh_cm);
};
if($GLOBALS['mh_dcod']===FALSE){
$mh_spa=$mh_cm;
};

foreach($mh_spa as $mh_spc => $mh_sp){



if($mh_spc===0){
$mh_qa1=$mh_qa1."$mh_sp";

};
if($mh_spc>0){
if($mh_sp[0]==="(" and substr($mh_sp,-1)===")"){
$mh_qa1=$mh_qa1."$mh_sp";

}
else{
if($mh_sp==="int"){
$mh_qa1=$mh_qa1." INT";

};
if($mh_sp==="ch"){
$mh_qa1=$mh_qa1." VARCHAR";
};
if($mh_sp==="ts"){
$mh_qa1=$mh_qa1." TIMESTAMP";
};
if($mh_sp==="inc"){
$mh_qa1=$mh_qa1." AUTO_INCREMENT";
};
if($mh_sp==="nn"){
$mh_qa1=$mh_qa1." NOT NULL";
};
if($mh_sp==="df"){
$mh_qa1=$mh_qa1." DEFAULT";
};
if($mh_sp==="ct"){
$mh_qa1=$mh_qa1." CURRENT_TIMESTAMP";
};
if($mh_sp==="up"){
$mh_qa1=$mh_qa1." UPDATE";
};
if($mh_sp==="on"){
$mh_qa1=$mh_qa1." ON";
};
if($mh_sp==="uns"){
$mh_qa1=$mh_qa1." UNSIGNED";
};
if($mh_sp==="pk"){
$mh_qa1=$mh_qa1." PRIMARY KEY";
};

};

};

};

if($mh_cmc!==count($mh_cms)-1){
$mh_qa0=$mh_qa0."$mh_qa1,";
$mh_qa1="";
};
if($mh_cmc===count($mh_cms)-1){
$mh_qa0=$mh_qa0."$mh_qa1";
$mh_qa1="";
};

};



mh_QU("CREATE TABLE $mh_tnm ($mh_qa0)",$mh_sql,"MH TBL");



$GLOBALS["mh_dtnm"]=$mh_tnm;

};

function mh_CLS($mh_sql=NULL){

if($mh_sql===NULL){
$mh_sql=$GLOBALS["mh_dsql"];
}

$mh_sql->close();

};

?>