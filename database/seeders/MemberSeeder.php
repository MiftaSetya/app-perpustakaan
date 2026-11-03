<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $members = [
            [
                'nama' => 'Siti Nurhaliza',
                'nim' => '2111160001',
                'email' => 'siti.nurhaliza@student.pens.ac.id',
                'nomor_telepon' => '081234567801',
                'alamat' => 'Jl. Raya ITS No. 1, Surabaya',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Budi Santoso',
                'nim' => '2111160002',
                'email' => 'budi.santoso@student.pens.ac.id',
                'nomor_telepon' => '081234567802',
                'alamat' => 'Jl. Ketintang No. 25, Surabaya',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Dewi Lestari',
                'nim' => '2111160003',
                'email' => 'dewi.lestari@student.pens.ac.id',
                'nomor_telepon' => '081234567803',
                'alamat' => 'Jl. Darmo No. 10, Surabaya',
                'status' => 'nonaktif',
            ],
        ];

        foreach ($members as $member) {
            Member::updateOrCreate(
                ['nim' => $member['nim']],
                $member
            );
        }
    }
}
