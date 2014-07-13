Bittrex-API-Client
==================
A PHP Client for Bittrex.com's v1.1 API

Reference: [Bittrex API Documentation](https://bittrex.com/Home/Api)


# Getting Started:

### Edit client.php
Edit the client to include your Bittrex API Key and & Private Key


>define('API_KEY', '**YOUR_API_KEY_GOES_HERE**');

>define('PRIVATE_KEY', '**YOUR_PRIVATE_KEY_GOES_HERE**');
==================

### Example.php:
There is an example.php included in this repo which provides a template for how to utilize this client.


**Example.php:**

- The $path variable directly relates to the Bittrex API request method (eg. account/getbalances)

- The $params variable array directly relates to the Bittrex API request key/value parameters (eg. "currency" => "BTC")
==================

##### CLI Standard Input Streams are accepted :
The client.php also accepts standard input streams via a CLI layer (terminal etc.)

format: path param1 value1 param2 value2 param3 value3

example: market/selllimit market CCN-BTC quanitity 250.24232211 rate 0.00100000
==================


**Tips Appreciated!: 1NTyDTTrevTGQQbUGnMQMVgiPDqvYQboSp**
