<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('employees', function (Blueprint $table) {
      // Make employee_id unique
      $table->unique('employee_id');

      // Make cubicle_id nullable
      $table->unsignedBigInteger('cubicle_id')->nullable()->change();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('employees', function (Blueprint $table) {
      // Remove unique from employee_id
      $table->dropUnique(['employee_id']);

      // Revert cubicle_id to NOT NULL
      $table->unsignedBigInteger('cubicle_id')->nullable(false)->change();
    });
  }
};
