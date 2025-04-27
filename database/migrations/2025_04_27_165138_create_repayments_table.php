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
        Schema::create('repayments', function (Blueprint $table) {
            $table->id();
            $table->string('repayment_id');
            $table->decimal('amount',10 )->default(0)->comment('Amount of money paid back');
            $table->timestamp('repayment_date')->comment('Date of repayment');
            $table->unsignedBigInteger('disbursement_id')->comment('Foreign key to disbursements table');
            $table->string('repayment_method')->nullable()->comment('Method of payment (e.g., cash, bank transfer)');
            $table->string('notes')->nullable()->comment('Additional notes about the repayment');
            $table->string('status')->default('pending')->comment('Status of the repayment');
            $table->timestamps();

            $table->index(['repayment_id', 'disbursement_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repayments');
    }
};
