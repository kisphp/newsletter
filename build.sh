#!/bin/bash

PHP=`which php`
COMPOSER=`which composer`
NPM=`which npm`
PHPUNIT=`which phpunit`
PWD=`pwd`

export SYMFONY_ENV=prod

ERROR=`tput setab 1` # background red
GREEN=`tput setab 2` # background green
BACKGROUND=`tput setab 4` # background blue
INFO=`tput setaf 3` # yellow text
BLACKTEXT=`tput setaf 0`
COLOR=`tput setaf 7` # text white
NC=`tput sgr0` # reset

if [[ `echo "$@" | grep '\-\-reset'` ]] || [[ `echo "$@" | grep '\-r'` ]]; then
    RESET=1
else
    RESET=0
fi

function labelText {
    echo -e "\n${BACKGROUND}${COLOR}-> ${1} ${NC}\n"
}

function errorText {
    echo -e "\n${ERROR}${COLOR}=> ${1} <=${NC}\n"
}

function infoText {
    echo -e "\n${INFO}=> ${1} <=${NC}\n"
}

function successText {
    echo -e "\n${GREEN}${BLACKTEXT}=> ${1} <=${NC}\n"
}

function writeErrorMessage {
    if [[ $? != 0 ]]; then
        errorText "${1}"
    fi
}

function upgradeNode {
    if [[ `node -v | grep -E '^v[0-4]'` ]]; then
        labelText "Upgrade Node.js"
        sudo $NPM cache clean -f
        sudo $NPM install -g n
        sudo n stable

        successText "Node.js updated to version `node -v`"
        successText "NPM updated to version `$NPM -v`"
    fi
}

upgradeNode

if [[ "dev" == "$1" ]]; then
    labelText "Development run"
    $COMPOSER install
    $PHP $PWD/app/console cache:clear -e=dev
    $PHP $PWD/app/console cache:clear -e=test
else
    labelText "PRODUCTION optimize autoloader"
    $COMPOSER install --no-dev -o -a
fi

#labelText "Run setup:install"
#$PHP $PWD/app/console setup:install

#labelText "Run npm install"
#$NPM install

if [[ "dev" == "$1" ]]; then
    $PHPUNIT
else
    infoText "Not development, no tests run"
fi

successText "Setup finished"

exit 0
