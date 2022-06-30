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
        Schema::create('node_points', function (Blueprint $table) {
            $table->id();
            $table->string("node_name");
            $table->string("description");
            $table->integer("total_ram");
            $table->integer("allocated_ram");
            $table->integer("total_disk");
            $table->integer("allocated_disk");    
            $table->integer("admin_id");                    
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
        Schema::dropIfExists('node_points');
    }
};
