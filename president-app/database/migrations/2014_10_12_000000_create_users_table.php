<?php

use App\Models\Media;
use App\Models\Role;
use App\Models\System;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'userId');
            $table->string('name');
            $table->integer('phone');
            $table->foreignIdFor(Media::class, 'mediaId')->default(1);
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignIdFor(Role::class, 'roleId')->default(1);
            $table->boolean('isActive')->default(false);
            $table->boolean('isDeleted')->default(false);
            $table->foreignIdFor(System::class, 'systemId')->nullable();
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
};
