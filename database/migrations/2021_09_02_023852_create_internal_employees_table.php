<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('sex', ['MALE', 'FEMALE', 'OTHER']);
            $table->enum('department', ['OWNER', 'PROGRAMMER', 'SALER']);
            $table->date('birth_date');
            $table->softDeletes();
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
        Schema::dropIfExists('internal_employees');
    }
}
