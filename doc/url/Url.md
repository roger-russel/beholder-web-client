# Beholder Eye - URL

This beholder eye keep an eye into an Url for you. It can be an API an image or anything that should be accessible from http protocol.

## Dependencies

  * curl, php-curl

## Example of use

<code>
require 'vendor/autoload.php';

$conf = [
  'eyes' => [
      'API URL' => [// This API URL is just an alias, it can be anything
        'type' => 'Url',
        'path' => 'AbsolutePathToFolder',
        'filename' => 'filename which will be used, if not given it will use the default filename, which is beholder.txt',
        'write' => false, // set to not check if the folder is writable, if it was not setted or anything differ from false it will be true.
        'read' => false, // set to not check if the folder is readable, if it was not setted or anything differ from false it will be true.
        'delete' => false // set to not check if the folder is deletable, if it was not setted or anything differ from false it will be true.
      ]
  ]
];

$beholder = new BeholderWebClient\Observer($conf);
$beholder->run();
$beholder->writeJson();

</code>
