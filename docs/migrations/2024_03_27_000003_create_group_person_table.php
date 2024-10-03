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
        Schema::create('group_person', function (Blueprint $table) {
            $table->id();
            MigrationHelpers::resource_id($table, 'group_id', ['groups', 'id']);
            MigrationHelpers::resource_id($table, 'person_id', ['persons', 'id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_in_groups');
    }
};
