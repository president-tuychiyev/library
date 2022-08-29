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
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'userId');
            $table->integer('type')->comment("document types(Turi) = 1 | document langs(Tili) = 2 | text types(Kitobturi) = 3 | document formats(Matn turi) = 4 | file types(Fayl turi) = 5 | directs(Fan yo'nalishi) = 6 | user typesFoydalanuvchi turi = 7 | roles(Rollar) = 8");
            $table->string('nameuz')->nullable();
            $table->string('nameru')->nullable();
            $table->string('nameen')->nullable();
            $table->boolean('isActive')->default(false);
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
        Schema::dropIfExists('details');
    }
};