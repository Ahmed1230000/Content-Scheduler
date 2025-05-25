<?php

namespace Database\Seeders;

use App\Enums\PlatformType;
use App\Models\platform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = PlatformType::cases();

        foreach ($types as $type) {
            Platform::createOrFirst([
                'name' => $type->value, 
                'type' => $type->value,
            ]);
        }
    }
}
