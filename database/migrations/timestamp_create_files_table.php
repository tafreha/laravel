<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateFilesTable extends Migration
{
    public function up()
    {
        Schema::create('articales', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('files');
    }
}




?>
