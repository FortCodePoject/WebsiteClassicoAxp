<?php

use App\Models\pacote;
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
        Schema::create('generate_images', function (Blueprint $table) {
            $table->id();
            $table->string("packgename");
            $table->string("packgeqtd");
            $table->decimal("packgeprice", 10,2);
            $table->string("packgedescription");
            $table->foreignIdFor(pacote::class);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generate_images');
    }
};
