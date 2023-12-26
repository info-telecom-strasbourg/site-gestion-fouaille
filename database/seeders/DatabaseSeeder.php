<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\Member;
use App\Models\Organization;
use App\Models\OrganizationMember;
use App\Models\Product;
use App\Models\ProductType;
use Database\Factories\MemberFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Challenge;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Member::factory(300)->create();

        $this->call([
            ProductTypeSeeder::class,
            ProductSeeder::class
        ]);

        Order::factory(1000)->create();

        Organization::factory(10)->create();

        OrganizationMember::factory(50)->create();

    }
}
