<?php


/*
  Randomly choose "RA or Longitude" and "DEC or Latitude" while leave other fields intact.
  "RA or Longitude" : from 0h0m0s ~ 24h (e.g. 2h59m59s)
  "DEC or Latitude" : from -90 ~ 90 (e.g. 30d0m0s)
*/
$random_RA = mt_rand(0,23)."h".mt_rand(0,59)."m".mt_rand(0,59)."s";
$random_DEC = mt_rand(-89,89)."d".mt_rand(0,59)."m".mt_rand(0,59)."s";


/* Fetch the whole page */
$star_page_content = file_get_contents('http://ned.ipac.caltech.edu/cgi-bin/calc?in_csys=Equatorial&in_equinox=B1950.0&obs_epoch=1950.0&lon=' . $random_RA . '&lat=' . $random_DEC . '&pa=0.0&out_csys=Equatorial&out_equinox=J2000.0');


/*
  We cannot use strpos(string, startPos, endPos) here due to the string containing both " character and ' character.
  So we use 2 strpos() as a workaround.
*/
$posStart = strpos($star_page_content,'Landolt B');
$star_page_content = substr($star_page_content,$posStart);

$posEnd = strpos($star_page_content,'UKIRT   L');
$star_page_content = substr($star_page_content,0,$posEnd);


/*
  Tokenize the string and fetch datas that we are interested in:
    From D. Schlegel et al.
      index[7] : Landolt B Bandpass [µm] (B_um)
      index[8] : Landolt B Aλ [mag] (B_A)
      index[23] : Landolt R Bandpass [µm] (R_um)
      index[24] : Landolt R Aλ [mag] (R_A)
      index[95] : UKIRT   K Bandpass [µm] (K_um)
      index[96] : UKIRT   K Aλ [mag] (K_A)
*/
$token = strtok($star_page_content, " ");
$count = 0;

while ($token !== false){
    $count++;
    // remove the parentheses. e.g.(0.44) -> 0.44
    if($count == 7){
        $B_um = substr($token, 1, strlen($token)-2);
    }else if($count == 23){
        $R_um = substr($token, 1, strlen($token)-2);
    }else if($count == 95){
        $K_um = substr($token, 1, strlen($token)-2);
    }else if($count == 8){
        $B_A = $token;
    }else if($count == 24){
        $R_A = $token;
    }else if($count == 96){
        $K_A = $token;
    }
    $token = strtok(" ");
}


/* Put the datas into Array*/
$post_data = array('RA' => $random_RA,
    'DEC' => $random_DEC,
    'B_um' => $B_um,
    'B_A' => $B_A,
    'R_um' => $R_um,
    'R_A' => $R_A,
    'K_um' => $K_um,
    'K_A' => $K_A
);


/* Create a JSON from that array and echos back */
$post_data = json_encode($post_data);
echo $post_data;


?>
