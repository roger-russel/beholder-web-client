# Php - Configuration file

It's possible setup a conf file, which can be a PHP file or an Yml file, you can see more about Yml conf file at [here](YAML.md).

## Example

1. Write your conf file.

```
<?php

return [
  'eyes' => [
    'MyEyeName' => [
      'type' => 'Url',
      'uri' => 'http://UrlWhichIwantKeepOnEye',
      'http' => [
        'method' => 'get',
      ]
    ],
  ],
];

```

2. Set to use the path to it

```
<php
...
$beholder = new BeholderWebClient\Observer();
$beholder->useFileConf( './PathToMyConfFile.php');

```
