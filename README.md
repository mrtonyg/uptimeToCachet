# UptimeRobot API client

Easily use the [API](https://uptimerobot.com/api) of the website monitoring service 
[UptimeRobot](https://uptimerobot.com/).

## Requirements

This package requires PHP 7+ and uses cUrl.

## Installation

This package can be used in any PHP project or with any framework. The packages is tested in PHP 7.0.

You can install the package via composer:

```
composer require vdhicts/uptimerobot-api-client
```

## Usage

This package is just an easy client for using the UptimeRobot API. Please refer to the 
[API documentation](https://uptimerobot.com/api) for more information about the requests.

### Quick usage

```php
use Vdhicts\UptimeRobot\Client;

// Load the configuration once, the URL is optional
$configuration = new Client\Configuration('API_KEY', 'OPTIONAL_API_URL');

// Start the client once
$client = new Client\Client($configuration);

// Perform the request, returns a string for further processing
$response = $client->perform('getMonitors', ['monitors' => '15830-32696-83920']);
```

### Output formats

The UptimeRobot API support XML and JSON as output format, so does this client. This can be changed by the third 
parameter of the `perform` method of the client.

### Exceptions

When something goes wrong, the client will throw an exception which extends the `UptimeRobotClientException`. If you 
want to catch exceptions from this package, that's the one you should catch. Error responses from the API aren't 
catched, so handle the response with some suspicion.

## Contribution

Any contribution is welcome, but it should meet the PSR-2 standard and please create one pull request  per feature. In 
exchange you will be credited as contributor on this page.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
