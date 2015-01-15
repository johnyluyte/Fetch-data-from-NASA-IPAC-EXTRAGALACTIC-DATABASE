<?php

echo '<table class="table table-striped">';
echo '    <thead>';
echo '        <tr>';
echo '            <th>#</th>';
echo '            <th>RA</th>';
echo '            <th>DEC</th>';
echo '            <th>B[µm]</th>';
echo '            <th>B Aλ</th>';
echo '            <th>R[µm]</th>';
echo '            <th>R Aλ</th>';
echo '            <th>K[µm]</th>';
echo '            <th>K Aλ</tdh>';
echo '        </tr>';
echo '    </thead>';
echo '    <tbody>';

$startTime = microtime(true);

$totalAllTime = 0;
$totalFetchTime = 0;

date_default_timezone_set('Asia/Taipei');
$current_query_time = date('m/d/Y h:i:s a', time());


$total_samples = $total_samples_index;

for($sample_number=1; $sample_number<=$total_samples; $sample_number++){
  /*
    Randomly choose "RA or Longitude" and "DEC or Latitude" while leave other fields intact.
    "RA or Longitude" : from 0h0m0s ~ 24h (e.g. 2h59m59s)
    "DEC or Latitude" : from -90 ~ 90 (e.g. 30d0m0s)
  */
  // $random_RA = "2h59m59s";
  // $random_DEC = "30d0m0s";
  $random_RA = rand(0,23)."h".rand(0,59)."m".rand(0,59)."s";
  $random_DEC = rand(-89,89)."d".rand(0,59)."m".rand(0,59)."s";

  echo "<tr>";
  echo "<td>$sample_number</td>";
  echo "<td>$random_RA</td>";
  echo "<td>$random_DEC</td>";

  // Fetch the whole page
  $startFetchTime = microtime(true);
  $star_page_content = file_get_contents('http://ned.ipac.caltech.edu/cgi-bin/calc?in_csys=Equatorial&in_equinox=B1950.0&obs_epoch=1950.0&lon=' . $random_RA . '&lat=' . $random_DEC . '&pa=0.0&out_csys=Equatorial&out_equinox=J2000.0');
  $GLOBALS['totalFetchTime'] += microtime(true) - $startFetchTime;

  /*
    We cannot use strpos(string, startPos, endPos) here due to the string containing both " character and ' character.
    So we use 2 strpos() as a workaround.
  */
  $posStart = strpos($star_page_content,'Landolt B');
  $star_page_content = substr($star_page_content,$posStart);

  $posEnd = strpos($star_page_content,'UKIRT   L');
  $star_page_content = substr($star_page_content,0,$posEnd);


  /*
    Tokenize and fetch:
      From D. Schlegel et al.
        index[7] : Landolt B Bandpass [µm]
        index[8] : Landolt B Aλ [mag]
        index[23] : Landolt R Bandpass [µm]
        index[24] : Landolt R Aλ [mag]
        index[95] : UKIRT   K Bandpass [µm]
        index[96] : UKIRT   K Aλ [mag]
  */
  $token = strtok($star_page_content, " ");
  $count = 0;

  while ($token !== false){
      $count++;
      if($count == 7 || $count == 23 || $count == 95){
          // remove the parentheses. e.g.(0.44) -> 0.44
          echo "<td>". substr($token, 1, strlen($token)-2) . "</td>";
      }else if($count == 8 || $count == 24 || $count == 96){
          echo "<td>$token</td>";
      }
      $token = strtok(" ");
  }
  echo "</tr>";
}

echo '            </tbody>';
echo '        </table>';


$totalAllTime = microtime(true) - $startTime;

echo '<hr>';
echo '<h3>Addtional Information:</h3>';
echo '<table class="table table-striped table-bordered">';
echo '    <thead>';
echo '        <tr>';
echo '            <th>Query Made on</th>';
echo '            <th>Samples Fetched</th>';
echo '            <th>Time Spent on Fetching Data (Seconds)</th>';
echo '            <th>Total Time Spent (Seconds)</th>';
echo '        </tr>';
echo '    </thead>';
echo '    <tbody>';
echo '        <tr class="info">';
echo '            <td>'.$current_query_time.'</td>';
echo '            <td>'.$total_samples.'</td>';
echo '            <td>'.number_format($totalFetchTime,3).'</td>';
echo '            <td>'.number_format($totalAllTime,3).'</td>';
echo '        </tr>';
echo '    </tbody>';
echo '</table>';


?>