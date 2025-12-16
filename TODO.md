# TODO: Fix Migration Rollback Order for Foreign Key Constraints

- [x] Edit `database/migrations/2025_12_07_205741_logbook_table.php` to add `down()` method that drops the 'logbooks' table.
- [x] Edit `database/migrations/0001_01_01_000000_create_users_table.php` to reorder the drop statements in `down()` method: drop 'sessions' before 'users'.
