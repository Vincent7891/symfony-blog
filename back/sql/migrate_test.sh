#!/bin/bash
echo "running SQL test db migrations..."

DATABASE="blog_test"
USER="user"
PASSWORD="password"

for file in sql/migrations/*.sql; do
  MIGRATION=$(basename "$file")

  RESULT=$(docker exec blog_mysql_test mysql -u$USER -p$PASSWORD -D$DATABASE -N -B -e "SELECT COUNT(*) FROM migration_log WHERE migration='$MIGRATION';")
  RESULT=${RESULT:-0}

  if [ "$RESULT" -eq 0 ]; then
    echo "Applying migration to test db: $MIGRATION"
    docker exec -i blog_mysql_test mysql -u$USER -p$PASSWORD -D$DATABASE < "$file"
    docker exec blog_mysql_test mysql -u$USER -p$PASSWORD -D$DATABASE -e "INSERT INTO migration_log (migration) VALUES ('$MIGRATION');"
  else
    echo "migration has already been applied: $MIGRATION"
  fi
done
