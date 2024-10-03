<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
CREATE OR REPLACE FUNCTION to_base36(val bigint, OUT result text) returns text
    immutable
    strict
    language plpgsql
as
$$
DECLARE
  chars char(36) := '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
BEGIN
  result := '';
  LOOP
    EXIT WHEN val = 0;
    result := substr(chars, val % 36 + 1, 1) || result;
    val := val / 36;
  END LOOP;
END;
$$;

alter function to_base36(bigint, out text) owner to sail;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP FUNCTION to_base36;");
    }
};
