#!/bin/sh

BASE_DIR=$(dirname "$(readlink -f "$0")")
if [ "$1" != "test" ]; then
    psql -h localhost -U meneame -d meneame < $BASE_DIR/meneame.sql
fi
psql -h localhost -U meneame -d meneame_test < $BASE_DIR/meneame.sql
