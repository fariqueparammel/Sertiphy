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
        Schema::create('excelUploadData', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->bigInteger('project_id')->unsigned()->index()->nullable();
            $table->foreign('project_id')
                ->references('id')->on('projectname')->onDelete('CASCADE');
            $table->json('fieldData');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excelUploadData');
    }
};
