#!/usr/bin/env bash

STAGED_PHP_FILES=$(git diff --cached --name-only --diff-filter=ACM | grep ".php$")

PASS=true

if [[ "$STAGED_PHP_FILES" != "" ]]; then
  for PHP_FILE in ${STAGED_PHP_FILES}
  do
    composer run-script lint "$PHP_FILE"
    git add "$PHP_FILE"


    if ! composer run-script style "$PHP_FILE"
    then
      PASS=false
    fi
  done

#  if ! vendor/bin/phpunit
#  then
#    PASS=false
#  fi
fi


STAGED_JS_FILES=$(git diff --cached --name-only --diff-filter=ACM | grep "^resources" | grep ".ts$")

cd ./frontend
if [[ "$STAGED_JS_FILES" != "" ]]; then
  for JS_FILE in ${STAGED_JS_FILES}
  do
    if ! npm run lint "$JS_FILE"
    then
      PASS=false
    fi
  done
  if ! npm run test
  then
    PASS=false
  fi
fi


if ! ${PASS}; then
  exit 1
fi

exit $?
