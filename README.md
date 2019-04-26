# UltraNote-RPC-PHP
UltraNote RPC PHP is a PHP wrapper for the UltraNote JSON-RPC interfaces.
---

1) [Install UltraNote RPC PHP](#install-UltraNote-rpc-php)
1) [Examples](#examples)
1) [Docs](#docs)
1) [License](#license)

---

## Install UltraNote RPC PHP

This package requires PHP >=7.1.3. Requires to download :

```
xun-rpc-php.php
```

## Examples

```php
require_once('ultranote-rpc-php.php');
                $config = [
    'rpcUrl'     => 'http://localhost:8060/json_rpc',
    'rpcUser'     => 'theusername',
    'rpcPassword' => 'thepassword'
];
$coin = new XunCoin($config);
echo $UltraNoted->getStatus();

> 39375
``` 

```php
require_once('ultranote-rpc-php.php');
                $config = [
    'rpcUrl'     => 'http://localhost:8060/json_rpc',
    'rpcUser'     => 'theusername',
    'rpcPassword' => 'thepassword'
];
$coin = new XunCoin($config);
echo $UltraNoted->createAddress();

> 'XunG5DVpjrpNJ2JngzwaPS15iEySg2SVggQPArXzDVpJCEgHM5yhHPSR7X6nPg7E3sfN5CzibcUqXqmqMFj4DV3xgL5TsPEsCw'
``` 

// Or more functions
```php
$coin->deleteAddress($address);
$coin->getUnconfirmedTransactionHashes($address);
$coin->getTransactions($firstBlockIndex,$blockCount);
$coin->getTransaction($transactionHash);
$coin->sendTransaction($from,$to,$ammount);
$coin->sendTransactionAdvanced($params);
$coin->reset();
$coin->save();
``` 

## Docs

Documentation of the Ultranote RPC API and more PHP examples for this package can be found at [https://wiki.ultranote.org/ultranote_coin_daemon.html](https://wiki.ultranote.org/ultranote_coin_daemon.html).

## License

UltraNote RPC PHP is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
