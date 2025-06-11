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
        Schema::create('year_levels', function (Blueprint $table) {
            $table->id()->primary();
            
            $table->string('year_level_name', 20)->unique()->nullable(false);
            $table->string('year_level_code', 5)->unique()->nullable(false);
            $table->integer('order_level')->default(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement('CREATE TRIGGER update_year_levels_timestamp
            BEFORE UPDATE ON year_levels
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_year_levels_timestamp ON year_levels;');

        Schema::dropIfExists('year_levels');
    }
};
