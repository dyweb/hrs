<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('qq');
            $table->string('GitTq');
            $table->string('GitHub');
            $table->string('stdId');
            $table->string('department');
            $table->string('grade');
            $table->date('birthday');
            $table->unsignedInteger('gender');
            $table->string('QA');
            $table->string('nickname');
            $table->string('remark');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
