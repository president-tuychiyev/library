<?php

use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'userId');
            $table->integer('bookId');
            $table->foreignIdFor(User::class, 'recUserId');
            $table->integer('status')->default(1)->comment("1 - berilgan | 2 - qaytarilgan | 3 - qayatarib bermagan muddati o'tgan");
            $table->integer('day');
            $table->timestamp('getBack');
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
        Schema::dropIfExists('orders');
    }
};
