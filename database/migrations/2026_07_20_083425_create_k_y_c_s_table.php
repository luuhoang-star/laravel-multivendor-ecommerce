<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kycs', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->constrained();

            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            $table->text('rejected_reason')->nullable();

            $table->timestamp('verified_at')->nullable();

            $table->string('full_name');

            $table->string('date_of_birth');

            $table->enum('gender', [
                'male',
                'female'
            ]);

            $table->string('address');

            $table->enum('document_type', [
                'passport',
                'driving_license',
                'id_card'
            ]);

            $table->string('document_scan_copy'); //Lưu đường dẫn ảnh giấy tờ.

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kycs');
    }
};
