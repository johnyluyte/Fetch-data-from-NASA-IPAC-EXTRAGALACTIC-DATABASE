# Fetch data from NASA/IPAC EXTRAGALACTIC DATABASE

## Demo site

[http://chunnorris.net/public/fetch-data-from-nasa-extragalactic-database/index.php](http://chunnorris.net/public/fetch-data-from-nasa-extragalactic-database/index.php)

## Note

ADD comments
commit to master
ADD nav bar
ADD redirect

    php get file
    http://php.net/manual/en/function.file-get-contents.php

    require include
    strtok
    strpos
    echo "<td>$random_RA</td>";
    $star_page_content = file_get_contents('http://ned.ipac.caltech.edu/cgi-bin/calc?in_csys=Equatorial&in_equinox=B1950.0&obs_    epoch=1950.0&lon=2h59m59s&lat=30d0m0s&pa=0.0&out_csys=Equatorial&out_equinox=J2000.0');

    php form usage
    http://www.w3schools.com/php/showphp.asp?filename=demo_form_validation_complete

    time, microtime(true)
    https://stackoverflow.com/questions/12435556/format-a-float-to-two-decimal-places

    getcurrent time
    https://stackoverflow.com/questions/470617/get-current-date-and-time-in-php

    ## javascript
    http://itanotomomi.pixnet.net/blog/post/14899537-javascript%E8%A3%A1substr()%E8%88%87substring()%E7%9A%84%E5%B7%AE%E7%95%B0%E3%80%82

    http://www.w3schools.com/jsref/jsref_indexof.asp

    https://stackoverflow.com/questions/11832914/round-to-at-most-2-decimal-places-in-javascript

    https://stackoverflow.com/questions/5240876/difference-between-success-and-complete


## Introuction
This program generates random **RA(Longitude)** and **DEC(Latitude)**. It sends these parameters to [NASA/IPAC EXTRAGALACTIC DATABASE](http://ned.ipac.caltech.edu/forms/calculator.html) and fetch the following fields from the returned result into HTML table:

- Landolt B Bandpass [µm]
- Landolt B Aλ [mag]
- Landolt R Bandpass [µm]
- Landolt R Aλ [mag]
- UKIRT K Bandpass [µm]
- UKIRT K Aλ [mag]

You can easily change the fields that need to be fetched.

### Sample input:

- Sample = `1`
- RA(Longitude) = `2h59m59s`
- DEC(Latitude) = `30d0m0s`

### Sample output:

| RA       | DEC     | B[µm] | B Aλ  | R[µm] | R Aλ  | K[µm] | K Aλ  |
|----------|---------|-------|-------|-------|-------|------:|-------|
| 2h59m59s | 30d0m0s | 0.44  | 0.823 | 0.65  | 0.510 |  2.22 | 0.070 |

## Usage

1. Enter the sample number
2. Click the only button
3. Profit

Note: **If the sample number is set too large (i.e. larger than 100), it may take a long time to get the result.**

To fetch 1000 samples, it is recommended to fetch 100 samples 10 times, which is much faster than fetching 1000 samples directly.


## License

Licensed under the terms of the [MIT license](http://opensource.org/licenses/MIT).

This project is powered by:

- [Bootstrap](http://getbootstrap.com/)
- [darkly](http://bootswatch.com/darkly/)