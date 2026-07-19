-- Adminer 4.8.4 SQLite 3 3.51.3 dump

DROP TABLE IF EXISTS "cache";
CREATE TABLE "cache" ("key" varchar not null, "value" text not null, "expiration" integer not null, primary key ("key"));

CREATE INDEX "cache_expiration_index" ON "cache" ("expiration");

INSERT INTO "cache" ("key", "value", "expiration") VALUES ('laravel-cache-admin@company.com|127.0.0.1:timer',	'i:1784004797;',	1784004797);
INSERT INTO "cache" ("key", "value", "expiration") VALUES ('laravel-cache-admin@company.com|127.0.0.1',	'i:2;',	1784004797);

DROP TABLE IF EXISTS "cache_locks";
CREATE TABLE "cache_locks" ("key" varchar not null, "owner" varchar not null, "expiration" integer not null, primary key ("key"));

CREATE INDEX "cache_locks_expiration_index" ON "cache_locks" ("expiration");


DROP TABLE IF EXISTS "failed_jobs";
CREATE TABLE "failed_jobs" ("id" integer primary key autoincrement not null, "uuid" varchar not null, "connection" text not null, "queue" text not null, "payload" text not null, "exception" text not null, "failed_at" datetime not null default CURRENT_TIMESTAMP);

CREATE UNIQUE INDEX "failed_jobs_uuid_unique" ON "failed_jobs" ("uuid");


DROP TABLE IF EXISTS "job_batches";
CREATE TABLE "job_batches" ("id" varchar not null, "name" varchar not null, "total_jobs" integer not null, "pending_jobs" integer not null, "failed_jobs" integer not null, "failed_job_ids" text not null, "options" text, "cancelled_at" integer, "created_at" integer not null, "finished_at" integer, primary key ("id"));


DROP TABLE IF EXISTS "jobs";
CREATE TABLE "jobs" ("id" integer primary key autoincrement not null, "queue" varchar not null, "payload" text not null, "attempts" integer not null, "reserved_at" integer, "available_at" integer not null, "created_at" integer not null);

CREATE INDEX "jobs_queue_index" ON "jobs" ("queue");


DROP TABLE IF EXISTS "leaves";
CREATE TABLE "leaves" ("id" integer primary key autoincrement not null, "user_id" integer not null, "leave_type" varchar not null, "start_date" date not null, "end_date" date not null, "reason" text not null, "status" varchar not null default 'Pending', "created_at" datetime, "updated_at" datetime, foreign key("user_id") references "users"("id") on delete cascade);

INSERT INTO "leaves" ("id", "user_id", "leave_type", "start_date", "end_date", "reason", "status", "created_at", "updated_at") VALUES (1,	2,	'Annual Leave',	'2026-07-14',	'2026-07-15',	'out of town',	'Rejected',	'2026-07-14 03:48:01',	'2026-07-14 05:01:52');
INSERT INTO "leaves" ("id", "user_id", "leave_type", "start_date", "end_date", "reason", "status", "created_at", "updated_at") VALUES (3,	2,	'Annual Leave',	'2026-07-15',	'2026-07-16',	'holiday',	'Approved',	'2026-07-14 04:58:50',	'2026-07-14 09:24:07');

DROP TABLE IF EXISTS "migrations";
CREATE TABLE "migrations" ("id" integer primary key autoincrement not null, "migration" varchar not null, "batch" integer not null);

INSERT INTO "migrations" ("id", "migration", "batch") VALUES (1,	'0001_01_01_000000_create_users_table',	1);
INSERT INTO "migrations" ("id", "migration", "batch") VALUES (2,	'0001_01_01_000001_create_cache_table',	1);
INSERT INTO "migrations" ("id", "migration", "batch") VALUES (3,	'0001_01_01_000002_create_jobs_table',	1);
INSERT INTO "migrations" ("id", "migration", "batch") VALUES (4,	'2026_07_14_031156_create_leaves_table',	2);

DROP TABLE IF EXISTS "password_reset_tokens";
CREATE TABLE "password_reset_tokens" ("email" varchar not null, "token" varchar not null, "created_at" datetime, primary key ("email"));


DROP TABLE IF EXISTS "sessions";
CREATE TABLE "sessions" ("id" varchar not null, "user_id" integer, "ip_address" varchar, "user_agent" text, "payload" text not null, "last_activity" integer not null, primary key ("id"));

CREATE INDEX "sessions_last_activity_index" ON "sessions" ("last_activity");

CREATE INDEX "sessions_user_id_index" ON "sessions" ("user_id");

INSERT INTO "sessions" ("id", "user_id", "ip_address", "user_agent", "payload", "last_activity") VALUES ('gH2TNUHuWjdh93AW1PQRr0boLXJknwUzBRpxc7d4',	3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36',	'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieHMzUUlMN0hoRGlDZDFJUHprUzlZQnZrYU50dkh4YXRrZVhDZUZkRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9lbXBsb3llZS1sZWF2ZS1zeXN0ZW0udGVzdC9hZG1pbi9sZWF2ZXMiO3M6NToicm91dGUiO3M6MTI6ImxlYXZlcy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==',	1784452115);
INSERT INTO "sessions" ("id", "user_id", "ip_address", "user_agent", "payload", "last_activity") VALUES ('UfXCGHkD5npUswJBp1kuxiFpmYCnTaF7I4E9Wzbw',	NULL,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.29.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36',	'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWRaRFBHMzFDektHWXBPYkh0NndpUnJvR0NoUlFJQ2JaSWVMWWZxeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9lbXBsb3llZS1sZWF2ZS1zeXN0ZW0udGVzdC8/aGVyZD1wcmV2aWV3IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',	1784453510);
INSERT INTO "sessions" ("id", "user_id", "ip_address", "user_agent", "payload", "last_activity") VALUES ('4ZxSWDHi24OqMBfmAoYNwIQXJdOMuEJ3bght6dej',	NULL,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.29.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36',	'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRkdZdnF6Z3lYR0RzUnpPWjVUd29EN0dHQ0FmcE42VHZlbGZ5ckdEVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9lbXBsb3llZS1sZWF2ZS1zeXN0ZW0udGVzdC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',	1784453510);
INSERT INTO "sessions" ("id", "user_id", "ip_address", "user_agent", "payload", "last_activity") VALUES ('FP2C0aQxzFGtB5RFh6SzozetyvRbe6eYkYOeqseJ',	NULL,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.29.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36',	'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYnU0eWQxcm9pUnBlR3duMTJ1S1pUZzFNS3FiNFdTRjhEZGdrWlFHUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9lbXBsb3llZS1sZWF2ZS1zeXN0ZW0udGVzdC8/aGVyZD1wcmV2aWV3IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',	1784453663);
INSERT INTO "sessions" ("id", "user_id", "ip_address", "user_agent", "payload", "last_activity") VALUES ('onvMmMoAuqUtHg8RzhMn1dmpOVgjeUZXB7OavrYx',	NULL,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.29.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36',	'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSnRCRzh1QUJuY04zWGNnM20xNVhoMVpCcWphQUM3SFdDNzJNNkJRNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9lbXBsb3llZS1sZWF2ZS1zeXN0ZW0udGVzdC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',	1784453664);

DROP TABLE IF EXISTS "sqlite_sequence";
CREATE TABLE sqlite_sequence(name,seq);

INSERT INTO "sqlite_sequence" ("name", "seq") VALUES ('migrations',	4);
INSERT INTO "sqlite_sequence" ("name", "seq") VALUES ('users',	3);
INSERT INTO "sqlite_sequence" ("name", "seq") VALUES ('leaves',	3);

DROP TABLE IF EXISTS "users";
CREATE TABLE "users" ("id" integer primary key autoincrement not null, "name" varchar not null, "email" varchar not null, "email_verified_at" datetime, "password" varchar not null, "remember_token" varchar, "created_at" datetime, "updated_at" datetime);

CREATE UNIQUE INDEX "users_email_unique" ON "users" ("email");

INSERT INTO "users" ("id", "name", "email", "email_verified_at", "password", "remember_token", "created_at", "updated_at") VALUES (1,	'Ali',	'ali@gmail.com',	NULL,	'$2y$12$4sNMd6kcBuwpvPIFMagT2eFoCufAEwHv/Jb4Z1O1TiLFLlweir32O',	NULL,	'2026-07-14 03:31:35',	'2026-07-14 03:31:35');
INSERT INTO "users" ("id", "name", "email", "email_verified_at", "password", "remember_token", "created_at", "updated_at") VALUES (2,	'Ahmad Ali',	'ahmadali@gmail.com',	NULL,	'$2y$12$hkCW1h/i4DghMcsL99Rp9e1BD0J9NnkPEMqXu9bWHraPJfSwIs0ky',	NULL,	'2026-07-14 03:35:23',	'2026-07-14 03:35:23');
INSERT INTO "users" ("id", "name", "email", "email_verified_at", "password", "remember_token", "created_at", "updated_at") VALUES (3,	'Admin',	'admin@gmail.com',	NULL,	'$2y$12$yhov7K0p/e4OY3p84ARzhOwGjIHFFcH7iFlZytr14aswQLTswVH0G',	NULL,	'2026-07-14 04:33:36',	'2026-07-14 04:33:36');

-- 
