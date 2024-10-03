<?php

use App\Platform\MigrationHelpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Fortify\Fortify;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('authentications', function (Blueprint $table) {
            MigrationHelpers::resource_id(blueprint: $table, column: 'person_id', foreign: ["persons", "id"])
                 ->primary();

            $table->enum('status', ['active', 'inactive']) // Pending? Should this just be active boolean?
                  ->default('inactive');

            $table->string('email')->unique();
            $table->boolean('is_oauth')->default(false);
            $table->string('password');

            $table->rememberToken();

            $table->text('two_factor_secret')
                  ->after('password')
                  ->nullable();

            $table->text('two_factor_recovery_codes')
                  ->after('two_factor_secret')
                  ->nullable();

            if (Fortify::confirmsTwoFactorAuthentication()) {
                $table->timestamp('two_factor_confirmed_at')
                      ->after('two_factor_recovery_codes')
                      ->nullable();
            }

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authentications');
    }
};
