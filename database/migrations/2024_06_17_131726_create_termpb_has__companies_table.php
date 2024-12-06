<?php

use App\Models\company;
use App\Models\Termpb;
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
        Schema::create('termpb_has__companies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(company::class);
            $table->foreignIdFor(Termpb::class);
            $table->enum("accept", ["yes", "no"])->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('termpb_has__companies');
    }
};
