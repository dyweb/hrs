<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTeamRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_team', function (Blueprint $table) {
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('member_id');
            
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');

            $table->increments('id');
            $table->unsignedInteger('position')->default(App\Team::POSITION_MEMBER);
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
        Schema::dropIfExists('member_team');
    }
}
