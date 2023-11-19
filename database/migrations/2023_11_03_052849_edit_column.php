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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('marked_price');
            $table->dropColumn('price');
            $table->dropColumn('discount');
            $table->bigInteger('cost_price')->after('image');
            $table->bigInteger('selling_price')->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('cost_price');
            $table->dropColumn('selling_price');
            $table->bigInteger('marked_price')->after('image');
            $table->bigInteger('price')->after('image');
            $table->integer('discount')->after('image');
        });
    }
};
