#!/bin/sh

if [ "$1" = "travis" ]; then
    psql -U postgres -c "CREATE DATABASE meneame_test;"
    psql -U postgres -c "CREATE USER meneame PASSWORD 'meneame' SUPERUSER;"
else
    sudo -u postgres dropdb --if-exists meneame
    sudo -u postgres dropdb --if-exists meneame_test
    sudo -u postgres dropuser --if-exists meneame
    sudo -u postgres psql -c "CREATE USER meneame PASSWORD 'meneame' SUPERUSER;"
    sudo -u postgres createdb -O meneame meneame
    sudo -u postgres psql -d meneame -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    sudo -u postgres createdb -O meneame meneame_test
    sudo -u postgres psql -d meneame_test -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    LINE="localhost:5432:*:meneame:meneame"
    FILE=~/.pgpass
    if [ ! -f $FILE ]; then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE; then
        echo "$LINE" >> $FILE
    fi
fi
