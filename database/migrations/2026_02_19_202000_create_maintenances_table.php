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
    Schema::create('maintenances', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('component_id');
      $table->unsignedBigInteger('component_stock_id');
      $table->integer('employee_id');
      $table->string('asset_tag');
      $table->string('employee_name');
      $table->string('status')->default('Maintenance');
      $table->string('description')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('maintenances');
  }
};
