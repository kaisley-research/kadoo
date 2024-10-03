<?php

use App\Kadoo\Constants;
use App\Platform\MigrationHelpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('phone_numbers', function (Blueprint $table) {
            $table->id();

            // This can connect to either groups or persons (and probably others eventually)
            // TODO: If this connects outside the persons schema, this may not be the best schema for it
            // The ID keeps it unique
            MigrationHelpers::resource_id($table, 'owner_id')->unique();

            $table->string('phone_number')->unique();
            $table->timestamp('verified_at')->nullable();
            $table->boolean('is_primary')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_numbers');
    }
};
