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
        Schema::create('animals', function (Blueprint $table) {
            MigrationHelpers::resource_id($table, 'id')->primary();

            $table->string('name');
            $table->integer('location');
            $table->foreign('location')->references('id')->on('units');

            $table->timestamps();
        });

        MigrationHelpers::create_resource_id(table: 'animals', column: 'id', prefix: 'A');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
