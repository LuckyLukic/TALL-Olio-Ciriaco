<?php

use App\Enums\Liters;
use App\Enums\ItemType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('item_type', ItemType::values());
            $table->enum('liters', Liters::values());
            $table->string('image');
            $table->longText('description');
            $table->decimal('price', 9, 2);
            $table->unsignedTinyInteger('quantity')->nullable();
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
