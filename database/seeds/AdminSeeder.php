<?php

use App\Models\Admin;
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
        DB::beginTransaction();
        try {
            DB::listen(function ($query) {
                \Log::error($query);
            });
            Admin::where("role", Admin::$role);
            $admin_user = [
                "name"     => "Administrator",
                "username" => 'admin',
                "email"    => "admin@admin.com",
                "password" => "admin123@tea",
            ];
            $user = Admin::create($admin_user);
            \Log::error($user);

        } catch (\Throwable $th) {
            DB::rollback();
            \Log::error($th);
        }
        DB::commit();

    }
}
