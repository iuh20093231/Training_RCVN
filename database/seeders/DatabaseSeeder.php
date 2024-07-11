<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Lê Thị Kim Thoa',
                'email' => 'thoale150896@gmail.com',
                'password' => bcrypt('678999'),
                'group_role' => 'Admin',
                'created_at' => now()
            ],
            [
                'name' => 'Nguyễn Thị Ngọc Hân',
                'email' => 'han12345@gmail.com',
                'password' => bcrypt('123456'),
                'group_role' => 'Admin',
                'created_at' => now()
            ],
            [
                'name' => 'Lê Văn Tuấn',
                'email' => 'NguyenTuan12345@gmail.com',
                'password' => bcrypt('345678'),
                'group_role' => 'Editor',
                'created_at' => now()
            ],
            [
                'name' => 'Nguyễn Nghĩa',
                'email' => 'LiemTran11111@gmail.com',
                'password' => bcrypt('111111'),
                'group_role' => 'Admin',
                'created_at' => now()
            ],
            [
                'name' => 'Hồ Tấn Dương',
                'email' => 'DuongHo22222@gmail.com',
                'password' => bcrypt('22222'),
                'group_role' => 'Review',
                'created_at' => now()
            ],
            [
                'name' => 'Lê Hữu Nhân',
                'email' => 'Nhan292009@gmail.com',
                'password' => bcrypt('33333'),
                'group_role' => 'Editor',
                'created_at' => now()
            ],
            [
                'name' => 'Trần Trọng Tín',
                'email' => 'TranTrongTin2100@gmail.com',
                'password' => bcrypt('444444'),
                'group_role' => 'Admin',
                'created_at' => now()
            ],
            [
                'name' => 'Trấn Lê Thiện',
                'email' => 'TranThien99@gmail.com',
                'password' => bcrypt('55555'),
                'group_role' => 'Admin',
                'created_at' => now()
            ],
            [
                'name' => 'Phạm Thị Thùy Linh',
                'email' => 'LinhTran78@gmail.com',
                'password' => bcrypt('77777'),
                'group_role' => 'Admin',
                'created_at' => now()
            ],
            [
                'name' => 'Võ Hồng Yến',
                'email' => 'VoHongYen@gmail.com',
                'password' => bcrypt('666666'),
                'group_role' => 'Admin',
                'created_at' => now()
            ],
            [
                'name' => 'Trần Như Hảo',
                'email' => 'TranHao23@gmail.com',
                'password' => bcrypt('888888'),
                'group_role' => 'Admin',
                'created_at' => now()
            ],
            [
                'name' => 'Đỗ Thị Mỹ Nhiều',
                'email' => 'Suong4567@gmail.com',
                'password' => bcrypt('99999'),
                'group_role' => 'Editor',
                'created_at' => now()
            ]
        ];
        DB::table('users')->insert($data);
        $data2 = [
            [
                'customer_name' => 'Nguyễn Đức Thiện',
                'email' => 'thientran22@gmail.com',
                'tel_num' => '0123654998',
                'address' => 'Phan Văn trị, Gò Vấp',
                'is_active' => 1,
                'created_at' => now()
            ]
        ];
        DB::table('custormers')->insert($data2);
    }
}
