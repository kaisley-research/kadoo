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
        // TODO: Probably doesn't belong in persons schema if it can be accessed by other resources
        Schema::create('socials', function (Blueprint $table) {
            $table->id();

            // Can be persons, groups, animals, whatever
            MigrationHelpers::resource_id($table, 'owner_id');

            $table->string('platform'); // facebook
            $table->string('key'); // username
            $table->string('value'); // mwilson
            $table->string('url');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_socials');
    }
};
