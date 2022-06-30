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
        Schema::create('node_stats_entries', function (Blueprint $table) {
            $table->id();
            $table->string("comment");
            // $table->integer("ram_allocated");
            $table->integer("ram_used");
            // $table->integer("disk_allocated");
            $table->integer("disk_used");
            $table->integer('node_id');
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
        Schema::dropIfExists('node_stats_entries');
    }
};
