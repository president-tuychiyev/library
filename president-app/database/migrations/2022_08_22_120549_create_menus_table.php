<?php

use App\Models\Menu;
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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'userId');
            $table->boolean('user')->default(false);
            $table->boolean('admin')->default(false);
            $table->string('nameuz');
            $table->string('nameru');
            $table->string('nameen');
            $table->string('icon')->nullable();
            $table->foreignIdFor(Menu::class, 'parentId')->nullable();
            $table->string('route')->nullable();
            $table->integer('turn')->nullable();
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
        Schema::dropIfExists('menus');
    }
};
