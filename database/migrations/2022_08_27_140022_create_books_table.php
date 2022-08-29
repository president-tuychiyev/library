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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'userId');
            $table->foreignIdFor(Detail::class, 'docTypeId');
            $table->foreignIdFor(Detail::class, 'docLangId');
            $table->foreignIdFor(Detail::class, 'textTypeId');
            $table->foreignIdFor(Detail::class, 'docFormatId');
            $table->foreignIdFor(Detail::class, 'directId');
            $table->string('nameuz')->nullable();
            $table->string('nameru')->nullable();
            $table->string('nameen')->nullable();
            $table->foreignIdFor(Author::class, 'authorId');
            $table->string('cityPublication')->nullable();
            $table->string('publisher')->nullable();
            $table->string('isbn')->nullable();
            $table->string('udk')->nullable();
            $table->string('brcode')->nullable();
            $table->text('annouz')->nullable();
            $table->text('annoru')->nullable();
            $table->text('annoen')->nullable();
            $table->timestamp('datePublication')->nullable();
            $table->integer('numPage');
            $table->integer('price');
            $table->boolean('isActive')->default(false);
            $table->foreignIdFor(Media::class, 'coverMediaId')->default(1);
            $table->foreignIdFor(Media::class, 'docMediaId')->default(1);
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
        Schema::dropIfExists('books');
    }
};
