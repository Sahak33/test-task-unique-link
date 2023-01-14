<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        User::insertOrIgnore([
            'username' => 'Admin',
            'phone_number'=>'123456789',
            'email' => 'admin@dev.loc',
            'password' => Hash::make('12345678'),
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
