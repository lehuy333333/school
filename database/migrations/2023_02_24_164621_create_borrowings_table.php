<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->string('short_description')->nullable();

            $table->boolean('is_applied')->nullable();
            $table->string('cancel_reason')->nullable();

            $table->boolean('confirm_attend')->default(false);
            $table->boolean('is_actived')->default(true);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('property_id');            
            $table->foreign('property_id')->references('id')->on('properties');

            $table->unsignedBigInteger('created_by_user_id');
            $table->foreign('created_by_id')->references('id')->on('users');

            $table->unsignedBigInteger('updated_by_user_id');
            $table->foreign('updated_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrowings');
    }
};
