# Beholder Eye - Redis

This beholder eye keep an eye on your Redis server.

## Exemple of use

```
require 'vendor/autoload.php';

$conf = [
  'eyes' => [
      'DB' => [ // This DB is just an alias, it can be anything.
        'type' => 'Db\Redis', // Model wich will be used.
        'host' => 'beholder-test-redis',
//      'port' => 6379, // If not set it will use the default port 6379
];

$beholder = new BeholderWebClient\Observer($conf);
$beholder->run();
$beholder->writeJson();

```
