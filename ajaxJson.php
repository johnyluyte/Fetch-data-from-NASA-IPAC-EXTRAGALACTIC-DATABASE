<?php

$startTime = microtime(true);

$totalAllTime = 0;
$totalFetchTime = 0;

date_default_timezone_set('Asia/Taipei');
$current_query_time = date('m/d/Y h:i:s a', time());

// $post_data = array('item_type_id' => $item_type,
//     'string_key' => $string_key,
//     'string_value' => $string_value,
//     'string_extra' => $string_extra,
//     'is_public' => $public,
//     'is_public_for_contacts' => $public_contacts);
// $post_data = json_encode($post_data);
// echo $post_data;

echo '{';
echo '  "RA"   : "0.1",';
echo '  "DEC"  : "0.1",';
echo '  "B_um" : "0.1",';
echo '  "B_A"  : "0.1",';
echo '  "R_um" : "0.1",';
echo '  "R_A"  : "0.1",';
echo '  "K_um" : "0.1",';
echo '  "KA"   : "0.1"';
echo '}';






?>