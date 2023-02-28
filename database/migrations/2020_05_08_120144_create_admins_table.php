<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{

    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('contact')->nullable();
            $table->string('hash_key')->nullable();
            $table->timestamps();
        });

        (new \App\Models\Admin([
            'name'     => 'Effects Tech',
            'email'    => 'info@admin.com',
            'password' => 'ams@123',
        ]))->save();

    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }

}
