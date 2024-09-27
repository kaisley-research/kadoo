<?php

use App\Kadoo\Constants;
use App\Platform\MigrationHelpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            MigrationHelpers::resource_id($table, 'person_id', ['authentications', 'person_id']);

            // Dot notated, enforced by the application
            // email.notifications
            $table->integer('key');

            // All settings are encoded as strings and deserialized as needed
            // {'all': true', 'number_per_day': 5}
            $table->jsonb('value');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_settings');
    }
};
