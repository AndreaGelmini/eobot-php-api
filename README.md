# Eobot-api - a Php Wrapper for Eobot public API

![Eobot API](https://www.eobot.com/eobotlogo.png "Eobot.com")


This php class provides implementation for the API of the Cloud mining and Bitcoin mining [Eobot.com](https://www.eobot.com/)   
> Eobot is the easiest, cheapest, and best way to get or mine Bitcoin, Litecoin, BlackCoin, Namecoin, Dogecoin, Dash, Reddcoin, BitShares, CureCoin, StorjcoinX, Monero, Voxels, Lumens, Bytecoin, Peercoin, NXT, MaidSafeCoin, Ethereum, and Factom. Whether or not you use our Cloud Mining or your own hardware, you can mine any cryptocurrency, regardless if it is based on a SHA-256 or Scrypt algorithm.

The API that Eobot expose are listed in this page: [Eobot Developers](https://www.eobot.com/developers).

## API Implementation

I implement all the APIs listed in the developers page. Every API uses as input all the parameters required by Eobot, in the same order as described in the developers page, and a callback function for the returned values. As example a simple call to get dogecoin price be
```php
  include("api.php");

  use Eobot;

  $api = new Eobot\Api();
  $api->getCoinPrice("DOGE");

  // return array(["DOGE"] => 0.12345678);
  // or

  $api->getCoinPrice("DOGE", function($res){
    return $res["DOGE"];
  });

  //return a float 0.12345678

```
You can set up a callback that has this structure
```php

   getCoinPrice("DOGE", function($response){
     //do something
     return response;
   });

   //or

   function worker($response)
   {
     //do something
     return response;
   }

   getCoinPrice("DOGE", "worker");

```

## First of all

Very important aspect. You can set the required data both at the time of the class instance, so as not to have to insert them again. But you can also set them for each single method.
```php
   $api = new Eobot\api($userID, $userEmail, $UserPassword);
   $api->getBalances();

   //or if you need a callback
   $api->getBalances(NULL, function($response){
      $response = "do something";
      return $response;
   });

```
```php
   $api = new Eobot\api();
   $api->getBalances($userID, function($response){
      $response = "do something";
      return $response;
   });

```
use the method you prefer ..

#### Get Balances
Returns total account value followed by cryptocurrency balances. Pass in querystring UserID.
```php
   $api->getBalances($Id [, optional callback]);
```

#### Get Mining Mode
Returns the cryptocurrency you are currently mining. Pass in querystring UserID.
```php
   $api->getMiningMode($Id [, optional callback]);
```

#### Get Speed
Returns the mining and cloud speeds. Pass in querystring UserID.
```php
   $api->getSpeed($Id [, optional callback]);
```

#### Get Deposit Address
Returns a deposit wallet address for specified cryptocurrency. Pass in querystring UserID and deposit type (BTC, ETH, LTC, etc.). Default is BTC
```php
   $api->getSpeed($Id, $depositType [, optional callback]);
```

#### Get UserID
Returns the UserID. Pass in querystring (or post parameters) email and password/API Key.
```php
   $api->getUserID($email, $passoword or api key [, optional callback]);
```

#### Set Mining Mode
Programmatically set your mining mode. Pass in querystring (or post parameters) UserID, email, password/API Key, and mining mode (BTC, ETH, LTC, etc.).
```php
   $api->setMiningMode($Id, $email, $passoword or api key [, optional callback]);
```

#### Set Automatic Withdraw
Programmatically set an automatic withdraw. Pass in querystring (or post parameters) UserID, email, password/API Key, automatic withdraw type (BTC, ETH, LTC, etc.), amount, and wallet address.
```php
   $api->setAutomaticWithdraw($Id, $email, $passoword or api key, currency,amount,walletAddress [, optional callback]);
```

#### Manual Withdraw
Performs a one-time manual withdraw. Pass in querystring (or post parameters) UserID, email, password/API Key, manual withdraw type (BTC, ETH, LTC, etc.), amount, and wallet address.
```php
   $api->manualWithdraw($Id, $email, $passoword or api key, $currency, $amount, $walletAddress [, optional callback]);
```

#### exchange Cryptocurrency
Programmatically exchange Coin or Cloud. Pass in querystring (or post parameters) UserID, email, password/API Key, cloud type (GHS or GHS4 or SCRYPT), cryptocurrency source (BTC, ETH, LTC, etc.), and cryptocurrency amount.
```php
   $api->exchangeCryptocurrency($Id, $email, $passoword or api key, $currencyFrom, $amount, $currencyTo [, optional callback]);
```

#### Exchange Estimate
Programmatically get estimate. Pass in querystring from coin type, to coin type, and cryptocurrency amount.
```php
   $api->exchangeEstimate($currencyFrom, $amount, $currencyTo [, optional callback]);
```

### Disclaimer
I'm **not** associated or **related** with Eobot.com, this is my implementation based on the public API. I'm **not** responsible if **you** lose money using this library because this is a simple node.js wrapper for the Eobot.com Public API.

## License

GPL-3.0. See [gpl-3.0-standalone.html](http://www.gnu.org/licenses/gpl-3.0-standalone.html) for details.
