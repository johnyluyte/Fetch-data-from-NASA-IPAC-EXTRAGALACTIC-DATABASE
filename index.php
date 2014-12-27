<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="lib/bootstrap/darkly.min.css">
     <style>
        body{
            font-size: 1.8rem;
        }
        footer{
            font-size: 80%;
        }
     </style>
</head>
<body>
    <div class="container">

    <div id="div_introduction">
        <h3>Introuction</h3>
        This program generates random RA(Longitude) and DEC(Latitude). It sends these parameters to <a href="http://ned.ipac.caltech.edu/forms/calculator.html" target="_blank">NASA/IPAC EXTRAGALACTIC DATABASE</a> and fetch the following fields from the returned results.
        <ul>
            <li>Landolt B Bandpass [µm]</li>
            <li>Landolt B Aλ [mag]</li>
            <li>Landolt R Bandpass [µm]</li>
            <li>Landolt R Aλ [mag]</li>
            <li>UKIRT   K Bandpass [µm]</li>
            <li>UKIRT   K Aλ [mag]</li>
        </ul>
    </div>
    <hr>

    <?php
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (empty($_GET["sample_numbers"])) {
                $total_samples_index = 3;
            } else {
                $total_samples_index = test_input($_GET["sample_numbers"]);
            }
        }
    ?>
    <div id="div_start">
        <h3>How many samples do you need?</h3>
        <form class="form-inline" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Fetch</div>
              <input type="text" class="form-control" id="exampleInputAmount" placeholder="" size="8" name="sample_numbers" value="<?php echo $total_samples_index ?>">
              <div class="input-group-addon">samples</div>
            </div>
          </div>
          <button type="submit" class="btn btn-info">Go Go Go</button>
        </form>
        <br>
        <div class="alert alert-warning" role="alert">
            If the sample number is set too large (i.e. larger than 100), it may take a long time to get the result. <br>
            To fetch 1000 samples, you may fetch 100 samples 10 times, which is much faster than fetching 1000 samples directly. <br>
        </div>
    </div>
    <hr>

    <div id="div_result">
        <h3>Results:</h3>
        <?php require 'fetch.php' ?>
    </div>

    <hr>
      <footer>
        By <a href='mailto:johnyluyte@gmail.com'>Chun Chien</a> /
        Fork me on <a href='https://github.com/johnyluyte/Fetch-data-from-NASA-IPAC-EXTRAGALACTIC-DATABASE' target="_blank">Github</a> / Code released under the <a href="http://opensource.org/licenses/MIT" target="_blank">MIT License</a>.
      </footer>
    </div>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
    <script src="lib/bootstrap/bootstrap.min.js"></script>
</body>
</html>
