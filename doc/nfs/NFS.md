# Beholder Eye - NFS

This beholder eye keep an eye into NFS, if it's mounted, if it's possible to read, to write and to delete files into it.

## Dependencies

  * linux "stat" command

## Exemple of use

<code>
require 'vendor/autoload.php';

$conf = [
  'eyes' => [
      'Nfs' => [ // This Nfs is just an alias, it can be anything
        'type' => 'Nfs', // Model wich will be used, this will be usage
        'path' => 'AbsolutePathToFolder',
        'filename' => 'filename which will be used, if not given it will use the default filename, which is beholder.txt',
        'write' => false, // set to not check if folder is writable, if it was not setted or anything differ from false it will be true.
        'read' => false, // set to not check if folder is readable, if it was not setted or anything differ from false it will be true.
        'delete' => false // set to not check if folder is deletable, if it was not setted or anything differ from false it will be true.
      ]
  ]
];

$beholder = new BeholderWebClient\Observer($conf);
$beholder->run();
$beholder->writeJson();

</code>
