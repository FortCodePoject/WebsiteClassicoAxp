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
        Schema::create('verify_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Company::class)->nullable();
            $table->string("product")->nullable();
            $table->decimal("price",10,2)->nullable();
            $table->decimal("availablePrice",10,2)->nullable();
            $table->integer("quantity")->nullable();
            $table->integer("availableQuantity")->nullable();
            $table->string("ipaddress")->nullable();
            $table->string("image")->nullable()->default(Null);
            $table->boolean("status")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verify_stocks');
    }
};
