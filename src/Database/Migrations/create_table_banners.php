<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\BannersModule\Models\Banners;

class CreateTableBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable(Banners::TABLE_NAME)) {
            Schema::create(Banners::TABLE_NAME, function (Blueprint $table) {
                $table->increments('id');
                $table->boolean('active')->default(0);
                $table->integer('banner_type'); // category - 1 or product - 2 banner
                $table->string('banner_url');
                $table->string('url');
                $table->string('discount')->nullable();
                $table->integer('position')->default(0);
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
        Schema::dropIfExists(Banners::TABLE_NAME);
    }
}
