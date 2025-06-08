<?php

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
        Schema::create('school_years', function (Blueprint $table) {
            $table->id()->primary();
            
            $table->string('school_year_name', 20)->unique()->nullable(false);
            $table->boolean('is_current')->default(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement('CREATE TRIGGER update_school_years_timestamp
            BEFORE UPDATE ON school_years
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_school_years_timestamp ON school_years;');

        Schema::dropIfExists('school_years');
    }
};
