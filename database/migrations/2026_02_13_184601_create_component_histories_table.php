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
    Schema::create('component_histories', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('component_id');
      $table->string('employee_id');
      $table->string('employee_name');
      $table->string('employee_position');
      $table->integer('quantity');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('component_histories');
  }
};
