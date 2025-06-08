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
        Schema::create('strands', function (Blueprint $table) {
            $table->id()->primary();
            
            $table->string('strand_name', 100)->unique()->nullable(false);
            $table->string('strand_code', 10)->unique()->nullable(false);
            $table->text('strand_description')->nullable(true);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement('CREATE TRIGGER update_strands_timestamp
            BEFORE UPDATE ON strands
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_strands_timestamp ON strands;');

        Schema::dropIfExists('strands');
    }
};
