<?php

use App\Models\User;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string("companyname");
            $table->string("companyemail")->unique();
            $table->string("companynif")->unique();
            $table->string("companybusiness");
            $table->string("companyhashtoken");
            $table->string("companytokenapi")->nullable();
            $table->string("token_xzero")->nullable();
            $table->enum("status", ["active", "inactive"])->default("inactive");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
