# Fetch data from NASA/IPAC EXTRAGALACTIC DATABASE

## Demo site

[http://chunnorris.net/public/fetch-data-from-nasa-extragalactic-database/](http://chunnorris.net/public/fetch-data-from-nasa-extragalactic-database/index.php)

## Introuction
This program generates random **RA(Longitude)** and **DEC(Latitude)**. It sends these parameters to [NASA/IPAC EXTRAGALACTIC DATABASE](http://ned.ipac.caltech.edu/forms/calculator.html) and fetch the following fields from the returned result.

- Landolt B Bandpass [µm]
- Landolt B Aλ [mag]
- Landolt R Bandpass [µm]
- Landolt R Aλ [mag]
- UKIRT K Bandpass [µm]
- UKIRT K Aλ [mag]

You can easily change the fields that need to be fetched.

### Sample input:

- Sample = `3`

### Sample output:

| RA       | DEC     | B[µm] | B Aλ  | R[µm] | R Aλ  | K[µm] | K Aλ  |
|----------|---------|-------|-------|-------|-------|------:|-------|
| 2h59m59s | 30d0m0s | 0.44  | 0.823 | 0.65  | 0.510 |  2.22 | 0.070 |
| 15h2m32s | -54d7m27s | 0.44  | 4.133 | 0.65  | 2.561 |  2.22 | 0.352 |
| 9h49m44s | 54d3m48s | 0.44  | 0.039 | 0.65  | 0.024 |  2.22 | 0.003 |

## Usage

1. Choose AJAX or PHP form
2. Enter the sample number
3. Click the "GO GO GO" button

Note: **If the sample number is set too large (i.e. larger than 100), it may take a long time to get the result depending on the Internet connection of your web server.**

To fetch 1000 samples, it is recommended to fetch 100 samples 10 times, rather than to fetch 1000 samples directly.


## License

Licensed under the terms of the [MIT license](http://opensource.org/licenses/MIT).

This project is powered by:

- [Bootstrap](http://getbootstrap.com/)
- [darkly](http://bootswatch.com/darkly/)
