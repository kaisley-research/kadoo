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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            MigrationHelpers::resource_id($table, 'owner_id', foreign: ["persons", "id"]);

            $table->string('nickname'); // James
            $table->string('full_name');
            $table->string('surname'); // For alphabetical listings
            $table->string('biography');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_profiles');
    }
};
