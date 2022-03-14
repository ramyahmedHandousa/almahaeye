<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('trade_name')->nullable();
            $table->enum('type',['admin','client','vendor']);
            $table->foreignId('country_id')->nullable()->constrained('countries')->cascadeOnDelete();
            $table->foreignId('bank_id')->nullable()->constrained('banks')->cascadeOnDelete();
            $table->string('phone',20)->unique()->nullable();
            $table->string('email',40)->unique()->nullable();
            $table->boolean('is_active')->default(0);
            $table->string('api_token',60)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('iban')->nullable();
            $table->string('commercial_registration')->nullable();
            $table->string('lang',4);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
