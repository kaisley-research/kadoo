<?php

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
        Schema::create('notes', function (Blueprint $table) {
            MigrationHelpers::resource_id($table, 'id')->primary();
            MigrationHelpers::resource_id($table, 'owner_id', ['authentications', 'person_id']);

            $table->string('title');
            $table->text('content');

            // maybe tags, or other things

            $table->timestamps();
        });

        MigrationHelpers::create_resource_id(table: 'notes', column: 'id', prefix: 'N');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communication_consent_person');
    }
};
