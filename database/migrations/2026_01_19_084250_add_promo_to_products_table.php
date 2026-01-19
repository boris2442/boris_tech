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
          // On place les nouveaux champs juste après le prix pour la clarté
        $table->boolean('is_promo')->default(false)->after('prix');
        $table->decimal('old_price', 10, 2)->nullable()->after('is_promo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
         $table->dropColumn(['is_promo', 'old_price']);
        });
    }
};
