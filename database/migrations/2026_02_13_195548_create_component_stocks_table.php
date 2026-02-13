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
    Schema::create('component_stocks', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('component_id');
      $table->string('model_type')->nullable();
      $table->decimal('cost', 12, 2)->default(0);
      $table->integer('quantity')->default(1);
      $table->integer('available_component')->default(0);
      $table->string('specification')->nullable();
      $table->string('supplier')->nullable();
      $table->date('purchase_date')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('component_stocks');
  }
};
