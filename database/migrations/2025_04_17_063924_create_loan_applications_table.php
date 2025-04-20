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
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id()->index();
            $table->string('application_id')->unique();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('loan_type_id');
            $table->decimal('interest_rate', 5, 2);
            $table->decimal('amount', 10, 2);
            $table->integer('term');
            $table->string('frequency');
            $table->string('status');
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->index(['application_id', 'member_id','loan_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_applications');
    }
};
