# Beholder Eye - Domain

This beholder eye keep an eye into Domain, if it's mounted, if it's possible to read, to write and to delete files into it.

## Dependencies

  * linux "whois" command

## Exemple of use

```
require 'vendor/autoload.php';

$conf = [
  'eyes' => [
      'MyDomain' => [ // This MyDomain is just an alias, it can be anything.
        'type' => 'Domain', // Model wich will be used, this will be usage.
        'domain' => 'mydomain.com.br', //Name of domain which will be keep on eye.
        'status' => 'expectedStatus', //Status which is expected, default is "published".
        'expire' => 10, // Warning when it is n days close to expire, default: 0, RegistroBr domains only.
      ]
  ]
];

$beholder = new BeholderWebClient\Observer($conf);
$beholder->run();
$beholder->writeJson();
```
