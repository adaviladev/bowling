#!/usr/bin/env bash

STAGED_PHP_FILES=$(git diff --cached --name-only --diff-filter=ACM | grep ".php$")

PASS=true

if [[ "$STAGED_PHP_FILES" != "" ]]; then
  for PHP_FILE in ${STAGED_PHP_FILES}
  do
    composer run-script lint "$PHP_FILE"
    git add "$PHP_FILE"
    composer run-script style "$PHP_FILE"

    if [[ "$?" != 0 ]]; then
      PASS=false
    fi
  done
fi

STAGED_JS_FILES=$(git diff --cached --name-only --diff-filter=ACM | grep "^resources" | grep ".ts$")

if [[ "$STAGED_JS_FILES" != "" ]]; then
  for JS_FILE in ${STAGED_JS_FILES}
  do
    npm run lint "$JS_FILE"

    if [[ "$?" != 0 ]]; then
      PASS=false
   fi
  done

  npm run test
  if [[ "$?" != 0 ]]; then
    PASS=false
  fi
fi

if ! ${PASS}; then
  exit 1
fi

exit $?