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
        /**
         * Students
         */
        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'gender') THEN
                    CREATE TYPE gender AS ENUM ('M', 'F');
                END IF;
            END$$;
        ");

        Schema::create('students', function (Blueprint $table) {
            $table->id()->primary();

            $table->string('lrn', 12)->unique()->nullable(true);
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

        DB::statement("ALTER TABLE students ADD COLUMN gender gender NOT NULL;");

        DB::statement('CREATE TRIGGER update_students_timestamp
            BEFORE UPDATE ON students
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        /**
         * Contact Persons
         */
        
        Schema::create('contact_persons', function (Blueprint $table) {
            $table->unsignedBigInteger('student')->nullable(false)->primary();

            // Father's information
            $table->string('father_full_name', 200)->nullable(true);
            $table->string('father_occupation', 50)->nullable(true);
            $table->string('father_contact_no', 15)->nullable(true);

            // Mother's information
            $table->string('mother_full_name', 200)->nullable(true);
            $table->string('mother_occupation', 50)->nullable(true);
            $table->string('mother_contact_no', 15)->nullable(true);

            // Guardian's information (required)
            $table->string('guardian_full_name', 200)->nullable(false);
            $table->string('guardian_occupation', 50)->nullable(true);
            $table->string('guardian_contact_no', 15)->nullable(false);
            $table->string('guardian_relationship', 100)->nullable(false);
            $table->text('guardian_full_address')->nullable(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('student')
                ->references('id')
                ->on('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        DB::statement('CREATE TRIGGER update_contact_persons_timestamp
            BEFORE UPDATE ON contact_persons
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'completer_as') THEN
                    CREATE TYPE completer_as AS ENUM ('Junior High School', 'Alternative Learning System');
                END IF;
            END$$;
        ");

        /**
         * Academic History
         */

        Schema::create('academic_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('student')->nullable(false)->primary();

            $table->string('school_name', 200)->nullable(false);
            $table->text('school_address')->nullable(true);
            //$table->enum('completer_as', ['Junior High School', 'Alternative Learning System'])->nullable();
            $table->date('completion_date')->nullable(true);
            $table->decimal('gwa', 4, 2)->nullable(true);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('student')
                ->references('id')
                ->on('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        DB::statement("ALTER TABLE academic_histories ADD COLUMN completer_as completer_as DEFAULT 'Junior High School' NOT NULL;");

        DB::statement('CREATE TRIGGER update_academic_histories_timestamp
            BEFORE UPDATE ON academic_histories
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'document_status_type') THEN
                    CREATE TYPE document_status_type AS ENUM ('Not Submitted', 'Submitted');
                END IF;
            END
            $$;
        ");

        /**
         * Documents
         */

        Schema::create('documents', function (Blueprint $table) {
            $table->unsignedBigInteger('student')->nullable(false)->primary();

            // PSA
            //$table->string('psa_status')->default('Not Submitted');
            $table->string('psa_remarks', 200)->nullable();
            $table->string('psa_image', 255)->nullable();

            // Report Card
            //$table->string('card_status')->default('Not Submitted');
            $table->string('card_remarks', 200)->nullable();
            $table->string('card_image', 255)->nullable();

            // Form 137
            //$table->string('f137_status')->default('Not Submitted');
            $table->string('f137_remarks', 200)->nullable();
            $table->string('f137_image', 255)->nullable();

            // Good Moral
            //$table->string('good_moral_status')->default('Not Submitted');
            $table->string('good_moral_remarks', 200)->nullable();
            $table->string('good_moral_image', 255)->nullable();

            // Waiver and COE
            $table->string('waiver_image', 255)->nullable();
            $table->string('coe_image', 255)->nullable();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('student')
                ->references('id')
                ->on('students')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        DB::statement("ALTER TABLE documents ADD COLUMN psa_status document_status_type DEFAULT 'Not Submitted' NOT NULL;");
        DB::statement("ALTER TABLE documents ADD COLUMN card_status document_status_type DEFAULT 'Not Submitted' NOT NULL;");
        DB::statement("ALTER TABLE documents ADD COLUMN f137_status document_status_type DEFAULT 'Not Submitted' NOT NULL;");
        DB::statement("ALTER TABLE documents ADD COLUMN good_moral_status document_status_type DEFAULT 'Not Submitted' NOT NULL;");

        DB::statement('
            CREATE TRIGGER update_documents_timestamp
            BEFORE UPDATE ON documents
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'freebies_status') THEN
                    CREATE TYPE freebies_status AS ENUM ('Not Received', 'Received');
                END IF;
            END
            $$;
        ");

        /**
         * Freebies
         */

        Schema::create('freebies', function (Blueprint $table) {
            $table->unsignedBigInteger('student')->nullable(false)->primary();

            //$table->enum('pe_shirt', ['Not Received', 'Received'])->default('Not Received');
            //$table->enum('pe_pants', ['Not Received', 'Received'])->default('Not Received');
            $table->timestamp('pe_received_date')->nullable();

            //$table->enum('uniform_shirt', ['Not Received', 'Received'])->default('Not Received');
            //$table->enum('uniform_pants', ['Not Received', 'Received'])->default('Not Received');
            $table->timestamp('uniform_received_date')->nullable();

            //$table->enum('id_card', ['Not Received', 'Received'])->default('Not Received');
            //$table->enum('id_lace', ['Not Received', 'Received'])->default('Not Received');
            //$table->enum('id_jacket', ['Not Received', 'Received'])->default('Not Received');
            $table->timestamp('id_received_date')->nullable();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('student')
                ->references('id')
                ->on('students')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        DB::statement("ALTER TABLE freebies ADD COLUMN pe_shirt freebies_status DEFAULT 'Not Received' NOT NULL;");
        DB::statement("ALTER TABLE freebies ADD COLUMN pe_pants freebies_status DEFAULT 'Not Received' NOT NULL;");
        DB::statement("ALTER TABLE freebies ADD COLUMN uniform_shirt freebies_status DEFAULT 'Not Received' NOT NULL;");
        DB::statement("ALTER TABLE freebies ADD COLUMN uniform_pants freebies_status DEFAULT 'Not Received' NOT NULL;");
        DB::statement("ALTER TABLE freebies ADD COLUMN id_card freebies_status DEFAULT 'Not Received' NOT NULL;");
        DB::statement("ALTER TABLE freebies ADD COLUMN id_lace freebies_status DEFAULT 'Not Received' NOT NULL;");
        DB::statement("ALTER TABLE freebies ADD COLUMN id_jacket freebies_status DEFAULT 'Not Received' NOT NULL;");

        DB::statement('
            CREATE TRIGGER update_freebies_timestamp
            BEFORE UPDATE ON freebies
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');

        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'referral_status') THEN
                    CREATE TYPE referral_status AS ENUM ('Not Received', 'Received');
                END IF;
            END
            $$;
        ");

        /**
         * Referrals
         */

        Schema::create('referrals', function(Blueprint $table) {
            $table->unsignedBigInteger('student')->nullable(false)->primary();

            $table->string('referral_full_name', 200)->nullable(false);
            $table->string('referral_contact_no', 15)->nullable(false);
            //$table->enum('referral_status', ['Not Received', 'Received'])->default('Not Received');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('student')
                ->references('id')
                ->on('students')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        DB::statement("ALTER TABLE referrals ADD COLUMN referral_status referral_status DEFAULT 'Not Received' NOT NULL;");

        DB::statement('
            CREATE TRIGGER update_referrals_timestamp
            BEFORE UPDATE ON referrals
            FOR EACH ROW
            EXECUTE FUNCTION update_timestamp();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS update_student_enrollments_timestamp ON student_enrollments;');
        DB::statement('DROP TRIGGER IF EXISTS update_referrals_timestamp ON referrals;');
        DB::statement('DROP TRIGGER IF EXISTS update_freebies_timestamp ON freebies;');
        DB::statement('DROP TRIGGER IF EXISTS update_documents_timestamp ON documents;');
        DB::statement('DROP TRIGGER IF EXISTS update_academic_histories_timestamp ON academic_histories;');
        DB::statement('DROP TRIGGER IF EXISTS update_contact_persons_timestamp ON contact_persons;');
        
        Schema::dropIfExists('referrals');
        Schema::dropIfExists('freebies');
        Schema::dropIfExists('documents');
        Schema::dropIfExists('academic_histories');
        Schema::dropIfExists('contact_persons');
        Schema::dropIfExists('students');

        DB::statement('DROP TYPE IF EXISTS referral_status;');
        DB::statement('DROP TYPE IF EXISTS freebies_status;');
        DB::statement("DROP TYPE IF EXISTS document_status_type;");
        DB::statement('DROP TYPE IF EXISTS completer_as;');
        DB::statement('DROP TYPE IF EXISTS gender;');
    }
};
