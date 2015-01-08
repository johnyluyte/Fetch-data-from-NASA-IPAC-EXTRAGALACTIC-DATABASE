<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="lib/bootstrap/darkly.min.css">
     <style>
        body{
            font-size: 1.6rem;
        }
        footer{
            font-size: 80%;
        }
        #div_loading_percent_text{
            font-size: 3.0rem;
            color: yellow;
        }
     </style>
</head>
<body>
    <div class="container">

    <div id="div_introduction">
        <h3>Introuction</h3>
        This program generates random RA(Longitude) and DEC(Latitude). It sends these parameters to <a href="http://ned.ipac.caltech.edu/forms/calculator.html" target="_blank">NASA/IPAC EXTRAGALACTIC DATABASE</a> and fetch the following fields from the returned results.
        <ul>
            <li>Landolt B Bandpass [µm]dog</li>
            <li>Landolt B Aλ [mag]</li>
            <li>Landolt R Bandpass [µm]</li>
            <li>Landolt R Aλ [mag]</li>
            <li>UKIRT   K Bandpass [µm]</li>
            <li>UKIRT   K Aλ [mag]</li>
        </ul>
    </div>
    <hr>

    <div id="div_howManySample">
        <h3>How many samples do you need?</h3>
        <div class="row">
            <div class="col-lg-4">
                <form class="form-inline">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">Fetch</div>
                      <input type="text" class="form-control" id="inputAmount" placeholder="" size="8" name="        sample_numbers" value="10">
                      <div class="input-group-addon">samples</div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-info" id="btn_gogogo">Go Go Go</button>
                </form>
            </div>
            <div class="col-lg-4" id="div_loading">
            </div>
            <div class="col-lg-1" id="div_loading_percent_text">
            </div>
        </div>
    </div>
    <hr>

    <div>
        <h3>Results:</h3>
        <div id="div_result">
        </div>
    </div>

    <hr>
      <footer>
        By <a href='mailto:johnyluyte@gmail.com'>Chun Chien</a> /
        Fork me on <a href='https://github.com/johnyluyte/Fetch-data-from-NASA-IPAC-EXTRAGALACTIC-DATABASE' target="_blank">Github</a> / Code released under the <a href="http://opensource.org/licenses/MIT" target="_blank">MIT License</a>.
      </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="lib/bootstrap/bootstrap.min.js"></script>
    <script src="ajaxFetch.js"></script>
</body>
</html>
