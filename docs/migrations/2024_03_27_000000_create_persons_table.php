<?php

use App\Platform\MigrationHelpers;
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
        Schema::create('persons', function (Blueprint $table) {
            MigrationHelpers::resource_id(blueprint: $table, column: 'id')->primary();

            $table->string('name');
            $table->string('handle')->unique(); // The username or handle with a prefix `staff.mwilson`, `volunteer.mwilson`, `public.mwilson`

            $table->timestamps();
        });

        MigrationHelpers::create_resource_id(table: 'persons', column: 'id', prefix: 'P');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
