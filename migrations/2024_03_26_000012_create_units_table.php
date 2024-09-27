<?php

use App\Platform\MigrationHelpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();

            $table->integer('site_id')->unsigned();
            $table->foreign('site_id')->references('id')->on('sites');

            $table->integer('sub_site_id')->unsigned();
            $table->foreign('sub_site_id')->references('id')->on('sub_sites');

            $table->integer('number')->unsigned();
            $table->string('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
