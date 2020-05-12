<?php

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        try {
            DB::listen(function ($query) {
                \Log::error($query);
            });
            Admin::truncate();
            $user = Admin::create([
                "name"     => "Administrator",
                "username" => 'admin',
                "email"    => "admin@admin.com",
                "password" => "admin123@tea",
            ]);
            \Log::error($user);

        } catch (\Throwable $th) {
            \Log::error($th);
        }

    }
}
