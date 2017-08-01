# Beholder Eye - Domain

This beholder eye keep an eye on Domains, if it's published, if it exists, or it are into another status.

## Dependencies

  * linux "whois" command

## Exemple of use

```
require 'vendor/autoload.php';

$conf = [
  'eyes' => [
      'MyDomain' => [ // This MyDomain is just an alias, it can be anything.
        'type' => 'Domain', // Model wich will be used.
        'domain' => 'mydomain.com.br', //Name of the domain to keep an eye on.
        'status' => 'expectedStatus', //Expected status. The default is "published".
        'expire' => 10, // Warning when it is n days close to expire, default: 0, RegistroBr domains only.
      ]
  ]
];

$beholder = new BeholderWebClient\Observer($conf);
$beholder->run();
$beholder->writeJson();
```
