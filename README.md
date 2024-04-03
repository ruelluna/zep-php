# Zep PHP SDK (unofficial)

## READ THIS FIRST
We just use this package to get messages from Zep Open Source and display them in our own dashboard. **There is no PATCH and DELETE endpoints in this package**. 
We just use GET endpoints.


This is an unofficial PHP SDK for the Zep API. This package is not affiliated with Zep in any way.

## Description
A PHP wrapper for Zep REST API, providing a convenient interface for interacting with Zep API endpoints. This package simplifies the process of making HTTP requests to the Zep API and handling responses.

## Installation

Install the package via Composer:

```bash
composer require ruelluna/zep-php
```

## Configuration
Before using the Zep PHP SDK, you must set up the required environment variables. Define **ZEP_API_KEY** and **ZEP_BASE_URL** in your project's environment file:

```dotenv
ZEP_API_KEY=
ZEP_BASE_URL=
```

## Usage
To use the SDK, first create an instance of the **Session** class. This will automatically initialize the ZepApiClient with your API key and base URL.

```php
use RuelLuna\ZepPhp\Session;
use RuelLuna\ZepPhp\Message;

// get all sessions
$sessions = Session::getAll(); 

// get a single session
$session = Session::getSession([session-id]); 

// get all messages within a session
$messages = Message::getAll([session-id]); 

// get message from a session
$messages = Message::getMessage([session-id], [message-id]); 

```

## Or Create instances passing API key and base URL
```php
$sessionRequest = \RuelLuna\ZepPhp\Session::make('your-api-key', 'your-base-url');

return $sessionRequest->getAll();
```

## Contributing
We welcome contributions from the community. If you wish to contribute, please submit a pull request.

## License
This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
