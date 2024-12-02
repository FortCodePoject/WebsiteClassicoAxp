<?php

use App\Models\company;
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
        Schema::create('terms_companies', function (Blueprint $table) {
            $table->id();
            $table->longText("term")->nullable();
            $table->longText("privacity")->nullable();
            $table->foreignIdFor(company::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terms_companies');
    }
};
