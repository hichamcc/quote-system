<?php

namespace Database\Seeders;

use App\Models\PricingFactor;
use Illuminate\Database\Seeder;

class PricingFactorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create just one row with all the default values
        if (PricingFactor::count() == 0) {
            PricingFactor::create([]); // All default values are in the migration
        }
    }
}