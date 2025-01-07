<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fieldProperties', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->bigInteger('project_id')->unsigned()->index()->nullable();
            $table->foreign('project_id')
                ->references('id')->on('projectname')->onDelete('CASCADE');
            $table->string("fieldDescription");
            $table->json("field_properties");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fieldProperties');
    }
};
