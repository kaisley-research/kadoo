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
    CREATE OR REPLACE FUNCTION prefix(prefix text, val text, OUT result text) RETURNS text
        IMMUTABLE
        STRICT
        LANGUAGE plpgsql
    AS
    $$
    BEGIN
      result := prefix || '-' || val;
    END;
    $$;

    ALTER FUNCTION prefix(text, text, out text) OWNER TO sail;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP FUNCTION prefix;");
    }
};
