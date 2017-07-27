# Yaml - Configuration file

To use read from Yaml file option it must has be installed.
It it was not and, for some reason you don't want or don't can install it, you still can make it at regular php file, see more [here](./PHP.md).

## Dependencies

 * libyaml-dev

### How install libyaml-dev

 It work into my docker container, which was with debian image.

 >`# apt-get install libyaml-dev -y`
 >`# pecl install yaml`

 Put this line bellow into php.ini file.

 `extension=yaml.so`

 I supose where you are using PHP will need be restarted.


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

2. Set to use the path to it

```
<php
...
$beholder = new BeholderWebClient\Observer();
$beholder->useFileConf( './PathToMyConfFile.yml');

```
