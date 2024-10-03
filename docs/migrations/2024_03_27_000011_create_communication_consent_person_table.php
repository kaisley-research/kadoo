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
        Schema::create('communication_consent_person', function (Blueprint $table) {
            $table->id();

            MigrationHelpers::resource_id($table, 'person_id', ['persons', 'id']);

            $table->enum('channel', ['email', 'phone', 'social']);
            $table->integer('channel_id')->unsigned();

            $table->integer('communication_consent_id')->unsigned();
            $table->foreign('communication_consent_id')->references('id')->on('communication_consents');
//
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communication_consent_person');
    }
};
