# meta-hub
This repository contains a basic website powered by yii framework.
Some implemented features are:
* User profiles:
    * Registration and Login process
    * User descriptions
    * Changes to profile
    * Profile image upload

Some future features are:

* User profiles:
    * View profiles of other users

* Multiple yii-modules:
    * prancing pony (drink list)
    * waffle list (todo list)
    * score board (for wargames)
    * event calendar

## Installation
TODO: Add required steps for installing the meta-hub

Before running the meta-hub, a directory ''uploads/'' must be created in the project root.
User uploaded profile images would not be possible without it.

For image manipulation, the yii2-imagine extension must be installed.
See https://github.com/yiisoft/yii2-imagine for more information on this subject.
Also the php extension 'imagick' must be installed. Try 'apt-get -i php-imagick' on debian systems.
