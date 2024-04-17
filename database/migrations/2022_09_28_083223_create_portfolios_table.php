<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug_title')->unique();
            $table->foreignId('service_id');
            $table->string('img_thumbnail');
            $table->string('url_portfolio')->nullable();
            $table->longText('description');
            $table->mediumText('description_excerpt');
            $table->enum('status_portfolio', ['release', 'beta', 'development'])->default('development');
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
        Schema::dropIfExists('portfolios');
    }
}
