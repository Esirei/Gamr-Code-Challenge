<?php

use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixturesTable extends Migration
{
    public function up()
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class, 'home_team_id')->constrained('teams');
            $table->foreignIdFor(Team::class, 'away_team_id')->constrained('teams');
            $table->unsignedTinyInteger('home_team_score')->default(0);
            $table->unsignedTinyInteger('away_team_score')->default(0);
            $table->string('status', 20)->default(Fixture::UPCOMING);
            $table->dateTime('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fixtures');
    }
}
