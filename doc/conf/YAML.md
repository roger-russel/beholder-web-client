# Yaml - Configuration file

To use the Yaml conf file option it must to be installed.

If it was not installed or for some other reason you don't want it or can't install it, you still can make a regular php configuration file, see more [here](./PHP.md).

## Dependencies

 * libyaml-dev

### How install libyaml-dev

 It work into the docker container, which is an debian image.

 >`# apt-get install libyaml-dev -y`
 >`# pecl install yaml`

 Put this line bellow into php.ini file.

 `extension=yaml.so`

 I suppose you will need to restart your PHP service.


## Example

1. Write your conf file.

```
eyes:
  MyEyeName:
    type: Url
    uri: http://UrlWhichIwantKeepOnEye
    http:
      method: get
```

2. Set to use the path to the yml file

```
<php
...
$beholder = new BeholderWebClient\Observer();
$beholder->useFileConf( './PathToMyConfFile.yml');

```
