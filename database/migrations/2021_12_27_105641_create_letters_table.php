<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->string("company_name");
            $table->enum("letter_type", ["imported", "exported", "contract"]);
            $table->text("description")->nullable();
            $table->dateTime("action_date");
            $table->string("attached_file")->nullable();
            $table->string("letter_number")->nullable();
            $table->unsignedBigInteger("created_by");
            $table->unsignedBigInteger("updated_by")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('letters', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
