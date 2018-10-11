# Beholder Eye - NFS

This beholder eye keep an eye into NFS, if it's mounted, if it's possible to read, to write and to delete files into it.

## Dependencies

  * linux "stat" command

## Exemple of use

```php

require 'vendor/autoload.php';

$conf = [
  'eyes' => [
    'Innode' => [ // This Innode is just an alias, it can be anything
      'type' => 'Innode', // Model wich will be used, this will usage Innodb
      'storage_path' => '/storage', // "storage path wich will be checked innode usage
      'acceptable_percents_usage' => 90, // Percentage with is acceptable
    ],
  ],
];

$beholder = new BeholderWebClient\Observer($conf);
$beholder->run();
$beholder->writeJson();
```