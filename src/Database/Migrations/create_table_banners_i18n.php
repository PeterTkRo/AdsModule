<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\BannersModule\Models\BannersI18N;

class CreateTableBannersI18n extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable(BannersI18N::TABLE_NAME)) {
            Schema::create(BannersI18N::TABLE_NAME, function (Blueprint $table) {
                $table->increments('id');
                $table->smallInteger('banner_id');
                $table->string('description')->nullable();
                $table->string('local');
                $table->integer('created_by')->nullable();
                $table->integer('updated_by')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(BannersI18N::TABLE_NAME);
    }
}
