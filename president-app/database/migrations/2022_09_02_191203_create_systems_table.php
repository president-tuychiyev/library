<?php

use App\Models\Detail;
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
        Schema::create('systems', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'userId');
            $table->foreignIdFor(Detail::class, 'facultyId');
            $table->foreignIdFor(Detail::class, 'depId');
            $table->string('group');
            $table->boolean('isActive')->default(false);
            $table->boolean('isDeleted')->default(false);
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
        Schema::dropIfExists('systems');
    }
};
