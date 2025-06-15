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
        Schema::create('employee_positions', function (Blueprint $table) {
            $table->id()->primary();
            
            $table->string('position_name', 100)->unique()->nullable(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement('
            CREATE TRIGGER update_employee_positions_timestamp
            BEFORE UPDATE ON employee_positions
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'gender') THEN
                    CREATE TYPE gender AS ENUM ('M', 'F');
                END IF;
            END$$;
        ");

        Schema::create('employees', function (Blueprint $table) {
            $table->id()->primary();

            $table->string('first_name', 100)->nullable(false);
            $table->string('middle_name', 100)->nullable(true);
            $table->string('last_name', 100)->nullable(false);
            $table->string('extension_name', 20)->nullable(true);

            //$table->enum('gender', ['M', 'F']);
            $table->date('birthdate')->nullable(false);
            $table->text('birthplace')->nullable(true);

            $table->string('contact_no', 15)->nullable(false);

            $table->string('nationality', 50)->default('Filipino');
            $table->string('religion', 50)->default('Catholic');

            $table->string('house_address', 200)->nullable(true);
            $table->string('barangay', 100)->nullable(true);
            $table->string('municipality', 100)->nullable(true);
            $table->string('province', 100)->nullable(true);
            $table->string('postal_code', 10)->nullable(true);

            $table->unsignedBigInteger('account')->nullable(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('account')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        DB::statement("ALTER TABLE employees ADD COLUMN gender gender NOT NULL;");

        DB::statement('
            CREATE TRIGGER update_employees_timestamp
            BEFORE UPDATE ON employees
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        Schema::create('employee_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('employee')->nullable(false);
            $table->unsignedBigInteger('position')->nullable(false);
            $table->unsignedBigInteger('campus')->nullable(false);

            $table->boolean('is_default_account')->default(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->primary(['employee', 'position', 'campus'], 'employee_accounts_pkey');

            $table->foreign('employee')
                ->references('id')
                ->on('employees')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('position')
                ->references('id')
                ->on('employee_positions')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('campus')
                ->references('id')
                ->on('campuses')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        DB::statement('
            CREATE TRIGGER update_employee_accounts_timestamp
            BEFORE UPDATE ON employee_accounts
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_employee_positions_timestamp ON employee_positions;');
        DB::statement('DROP TRIGGER IF EXISTS update_employees_timestamp ON employees;');

        Schema::dropIfExists('employee_positions');
        Schema::dropIfExists('employees');
    }
};
