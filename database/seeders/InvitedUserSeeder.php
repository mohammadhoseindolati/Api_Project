<?php

namespace Database\Seeders;

use App\Models\InvitedUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvitedUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InvitedUser::factory()->count(10)->create() ;
    }
}
