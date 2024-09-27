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
        $resources = [
            'behavior' => "B",
            "medical" => "M",
            "intake" => "I",
            "outcome" => "O",
        ];

        foreach ($resources as $singular => $prefix) {
            $plural = "{$singular}s";

            // types
            Schema::create("{$singular}_types", function (Blueprint $table) {
                $table->id();

                $table->string('code')->unique();
                $table->string('name');
                $table->string('description')->nullable();

                $table->jsonb('data_schema');

                $table->timestamps();
            });

            // core
            // TODO: May involve other things
            Schema::create($plural, function (Blueprint $table) use ($singular) {
                MigrationHelpers::resource_id($table, 'id')->primary();

                MigrationHelpers::resource_id($table, 'owner_id', ['authentications', 'person_id']);

                $table->integer('type')->unsigned();
                $table->foreign('type')->references('id')->on("{$singular}_types");

                $table->jsonb('data')->nullable();

                $table->timestamps();
            });

            MigrationHelpers::create_resource_id(table: $plural, column: 'id', prefix: $prefix);

            // animal
            $sorted_animal = [$singular, 'animal'];
            sort($sorted_animal);

            Schema::create("{$sorted_animal[0]}_{$sorted_animal[1]}", function (Blueprint $table) use ($singular, $plural) {
                $table->id();

                MigrationHelpers::resource_id($table, 'animal_id', ['animals', 'id']);
                MigrationHelpers::resource_id($table, "{$singular}_id", [$plural, 'id']);

                $table->timestamps();
            });

            // note
            $sorted_note = [$singular, 'note'];
            sort($sorted_note);
            Schema::create("{$sorted_note[0]}_{$sorted_note[1]}", function (Blueprint $table) use ($singular, $plural) {
                $table->id();

                MigrationHelpers::resource_id($table, "{$singular}_id", [$plural, 'id']);

                // Notes for a behavior session in general
                MigrationHelpers::resource_id($table, 'note_id', ['notes', 'id']);

                // Notes for a specific animal, if wanted
                // TODO: What about notes for people?
                MigrationHelpers::resource_id($table, 'animal_id', ['animals', 'id'])->nullable();

                $table->boolean('is_primary')->default(false);
                $table->integer('sort_order')->default(0);

                $table->timestamps();
            });

            // person
            $sorted_person = [$singular, 'person'];
            sort($sorted_person);
            Schema::create("{$sorted_person[0]}_{$sorted_person[1]}", function (Blueprint $table) use ($singular, $plural) {
                $table->id();

                MigrationHelpers::resource_id($table, "{$singular}_id", [$plural, 'id']);
                MigrationHelpers::resource_id($table, 'person_id', ['persons', 'id']);

                $table->integer('sort_order')->default(0);

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communication_consent_person');
    }
};
