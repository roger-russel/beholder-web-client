# Php - Configuration file

It's possible to setup a configuration file, which can be a PHP file or an Yml file. You can see more about Yml conf file [here](YAML.md).

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

2. Set to use the path to the php file

```
<php
...
$beholder = new BeholderWebClient\Observer();
$beholder->useFileConf( './PathToMyConfFile.php');

```
