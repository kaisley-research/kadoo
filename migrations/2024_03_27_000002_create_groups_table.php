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
        Schema::create('groups', function (Blueprint $table) {
            MigrationHelpers::resource_id($table, 'id')->primary();

            $table->string('name');
            $table->string('description')->nullable();

            // The administrator must be able to login
            MigrationHelpers::resource_id($table, 'administrator_id', ['authentications', 'person_id']);

            // The primary member is the person who is the main contact for the group
            MigrationHelpers::resource_id($table, 'primary_member_id', ['persons', 'id'])->nullable();

            $table->timestamps();
        });

        MigrationHelpers::create_resource_id('groups', 'id', 'G');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
