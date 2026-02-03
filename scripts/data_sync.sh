#!/usr/bin/env bash
# Data sync helper: uses pgloader for full or incremental MySQL -> Postgres sync
# Edit the variables below before running. Run on a safe host with network access to both DBs.

set -euo pipefail

MYSQL_USER="MYSQL_USER"
MYSQL_PASS="MYSQL_PASS"
MYSQL_HOST="MYSQL_HOST"
MYSQL_DB="MYSQL_DB"

PG_USER="PG_USER"
PG_PASS="PG_PASS"
PG_HOST="PG_HOST"
PG_DB="PG_DB"

echo "Ensure pgloader is installed and you have network access to both DBs."
echo "Starting migration..."

pgloader "mysql://${MYSQL_USER}:${MYSQL_PASS}@${MYSQL_HOST}/${MYSQL_DB}" "postgresql://${PG_USER}:${PG_PASS}@${PG_HOST}/${PG_DB}"

echo "Migration finished. Verify data and run tests against staging."

# For incremental syncs, consider dumping delta tables or using binlog-based tools; pgloader can be repeated for idempotent updates if configured.
