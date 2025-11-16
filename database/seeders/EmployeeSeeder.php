<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ⚡ Xóa dữ liệu cũ (không dùng truncate để tránh lỗi FK)
        DB::table('employees')->delete();
        DB::table('users')->delete();

        // 🔹 Tạo user admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@ls.com',
            'password' => Hash::make('123456'),
        ]);

        // 🔹 Tạo user nhân viên
        $staff = User::create([
            'name' => 'Mai Thai Quoc',
            'email' => 'maithaiquoc@ls.com',
            'password' => Hash::make('123456'),
        ]);

        // 🔹 Thêm employee tương ứng
        Employee::create([
            'user_id' => $admin->id,
            'name' => 'Admin',
            'email' => 'admin@ls.com',
            'password' => Hash::make('123456'),
            'phone' => '0912345678',
            'position' => 'Manager',
        ]);

        Employee::create([
            'user_id' => $staff->id,
            'name' => 'Mai Thai Quoc',
            'email' => 'maithaiquoc@ls.com',
            'password' => Hash::make('123456'),
            'phone' => '0812345678',
            'position' => 'Staff',
        ]);
    }
}
