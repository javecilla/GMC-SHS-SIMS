<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE OR REPLACE FUNCTION update_timestamp()
            RETURNS TRIGGER AS $$
            BEGIN
                NEW.updated_at = CURRENT_TIMESTAMP;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ');

        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp" WITH SCHEMA public;');

        Schema::create('user_roles', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('role_name', 50)->unique()->nullable(false);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement('CREATE TRIGGER update_user_roles_timestamp
            BEFORE UPDATE ON user_roles
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'user_status') THEN
                    CREATE TYPE user_status AS ENUM ('Active', 'Inactive');
                END IF;
            END$$;
        ");


        Schema::create('users', function (Blueprint $table) {
            $table->id()->primary();
            $table->unsignedBigInteger('role')->nullable(false);

            $table->uuid('user_uid')->default(DB::raw('uuid_generate_v4()'))->unique();
            $table->string('email', 100)->unique()->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username', 100)->unique()->nullable(false);
            $table->string('password', 255)->nullable(false);
            $table->string('image_profile', 255)->nullable(true);
            // $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
            $table->timestamp('first_login_at')->nullable(true);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('role')
                ->references('id')
                ->on('user_roles')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        DB::statement("ALTER TABLE users ADD COLUMN status user_status DEFAULT 'Inactive' NOT NULL");

        DB::statement('CREATE TRIGGER update_users_timestamp
            BEFORE UPDATE ON users
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_user_roles_timestamp ON user_roles;');
        DB::statement('DROP TRIGGER IF EXISTS update_users_timestamp ON users;');

        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('users');
       
        DB::statement('DROP TYPE IF EXISTS user_status;');
        DB::statement('DROP FUNCTION IF EXISTS update_timestamp();');
    }
};
