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
        Schema::create('campuses', function (Blueprint $table) {
            $table->id()->primary();

            $table->string('campus_name', 150)->unique()->nullable(false);
            $table->string('campus_code', 30)->unique()->nullable(false);
            $table->string('deped_school_id', 50)->unique()->nullable(true);
            $table->string('shs_permit_no', 100)->unique()->nullable(true);
            $table->text('full_address')->nullable(true);
            $table->string('contact_no', 15)->nullable(true);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement('CREATE TRIGGER update_campuses_timestamp
            BEFORE UPDATE ON campuses
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_campuses_timestamp ON campuses;');

        Schema::dropIfExists('campuses');
    }
};
