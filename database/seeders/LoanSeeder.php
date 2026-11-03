<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $petugas = User::where('role', 'petugas')->firstOrFail();

        $loanData = [
            [
                'member_nim' => '2111160001',
                'status' => 'dipinjam',
                'tanggal_pinjam' => now()->subDays(3)->toDateString(),
                'tanggal_kembali' => now()->addDays(4)->toDateString(),
                'tanggal_dikembalikan' => null,
                'book_judul' => 'Clean Code',
            ],
            [
                'member_nim' => '2111160002',
                'status' => 'dikembalikan',
                'tanggal_pinjam' => now()->subDays(14)->toDateString(),
                'tanggal_kembali' => now()->subDays(7)->toDateString(),
                'tanggal_dikembalikan' => now()->subDays(7)->toDateString(),
                'book_judul' => 'Laskar Pelangi',
            ],
            [
                'member_nim' => '2111160003',
                'status' => 'terlambat',
                'tanggal_pinjam' => now()->subDays(20)->toDateString(),
                'tanggal_kembali' => now()->subDays(6)->toDateString(),
                'tanggal_dikembalikan' => null,
                'book_judul' => 'Pemrograman Web dengan Laravel',
            ],
        ];

        foreach ($loanData as $data) {
            $member = Member::where('nim', $data['member_nim'])->firstOrFail();
            $book = Book::where('judul', $data['book_judul'])->firstOrFail();

            $loan = Loan::updateOrCreate(
                [
                    'member_id' => $member->id,
                    'user_id' => $petugas->id,
                    'tanggal_pinjam' => $data['tanggal_pinjam'],
                ],
                [
                    'tanggal_kembali' => $data['tanggal_kembali'],
                    'tanggal_dikembalikan' => $data['tanggal_dikembalikan'],
                    'status' => $data['status'],
                ]
            );

            $loan->loanItems()->firstOrCreate(['book_id' => $book->id]);
        }
    }
}
