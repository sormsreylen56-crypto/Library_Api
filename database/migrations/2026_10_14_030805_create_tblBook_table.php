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
        Schema::create('tblBook', function (Blueprint $table) {
            $table->id('BookID');
            $table->string('BookTitle');
            $table->unsignedBigInteger('BookTypeID');
            $table->date('PublishDate')->nullable();
            $table->integer('NumOfPages')->nullable();
            $table->integer('NumOfCopies')->nullable();
            $table->string('Edition')->nullable();
            $table->string('Publisher')->nullable();
            $table->string('BookSource')->nullable();
            $table->text('Remark')->nullable();

            $table->foreign('BookTypeID')->references('BookTypeID')->on('tblBookType');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblBook');
    }
};
