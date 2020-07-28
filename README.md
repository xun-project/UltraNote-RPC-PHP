# UltraNote-RPC-PHP
UltraNote RPC PHP is a PHP wrapper for the UltraNote Infinity JSON-RPC interfaces.
---

1) [Install UltraNote RPC PHP](#install-UltraNote-rpc-php)
1) [Examples](#examples)
1) [Docs](#docs)
1) [License](#license)

---

## Install UltraNote Infinity RPC PHP

This package requires PHP >=7.1.3. Requires to download :

```
ultranote-rpc-php.php
```

## Examples

```php
require_once('ultranote-rpc-php.php');
                $config = [
    'rpcUrl'     => 'http://localhost:8060/json_rpc',
    'rpcUser'     => 'theusername',
    'rpcPassword' => 'thepassword'
];
$ultranoteid = new XuniCoin($config);
echo $ultranoteid->getStatus()>blockCount;


> 39375
``` 

```php
require_once('ultranote-rpc-php.php');
                $config = [
    'rpcUrl'     => 'http://localhost:8060/json_rpc',
    'rpcUser'     => 'theusername',
    'rpcPassword' => 'thepassword'
];
$ultranoteid = new XuniCoin($config);
echo $ultranoteid->createAddress();

> 'Xuniik72MxR2Cn29BzvVcsPmPn2NxNPGHfpYocW7CrjhLVs928LUmgfBJnVJE1xoHy8fdL3dVcLzF49J9Y8SsryHYMWMX4BySs3'
``` 

// Or more functions
```php
$ultranoteid->deleteAddress($address);
$ultranoteid->getUnconfirmedTransactionHashes($address);
$ultranoteid->getTransactions($firstBlockIndex,$blockCount);
$ultranoteid->getTransaction($transactionHash);
$ultranoteid->sendTransaction($from,$to,$ammount);
$ultranoteid->sendTransactionAdvanced($params);
$ultranoteid->reset();
$ultranoteid->save();
``` 

## Docs

Documentation of the Ultranote RPC API and more PHP examples for this package can be found at [https://wiki.ultranote.org/ultranote_coin_daemon.html](https://wiki.ultranote.org/ultranote_coin_daemon.html).

## License

UltraNote Infinity RPC PHP is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
