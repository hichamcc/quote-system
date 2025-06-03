<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pricing_factors', function (Blueprint $table) {
            // Add service price columns for both residential and contractor
            $table->decimal('residential_vein_exact_match', 8, 2)->default(0)->after('residential_profit');
            $table->decimal('contractor_vein_exact_match', 8, 2)->default(0)->after('residential_vein_exact_match');
            
            $table->decimal('residential_electrical_cutout', 8, 2)->default(0)->after('contractor_vein_exact_match');
            $table->decimal('contractor_electrical_cutout', 8, 2)->default(0)->after('residential_electrical_cutout');
            
            $table->decimal('residential_demo', 8, 2)->default(0)->after('contractor_electrical_cutout');
            $table->decimal('contractor_demo', 8, 2)->default(0)->after('residential_demo');
        });
    }

    public function down()
    {
        Schema::table('pricing_factors', function (Blueprint $table) {
            $table->dropColumn([
                'residential_vein_exact_match',
                'contractor_vein_exact_match',
                'residential_electrical_cutout',
                'contractor_electrical_cutout',
                'residential_demo',
                'contractor_demo'
            ]);
        });
    }
};
