#!/bin/bash
psql --username ${POSTGRES_USER} ${POSTGRES_DB} -c "CREATE DATABASE ${POSTGRES_DB}_test;"
