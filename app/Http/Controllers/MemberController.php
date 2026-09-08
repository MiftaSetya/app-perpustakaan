<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private array $members = [
        [
            'id' => 1,
            'nama' => 'Ahmad Fauzi',
            'nim' => '21040101001',
            'email' => 'ahmad.fauzi@example.com',
            'nomor_telepon' => '081234567890',
            'alamat' => 'Jl. Mawar No. 12, Jakarta Selatan',
            'status' => 1,
        ],
        [
            'id' => 2,
            'nama' => 'Siti Nurhaliza',
            'nim' => '21040101002',
            'email' => 'siti.nurhaliza@example.com',
            'nomor_telepon' => '085712345678',
            'alamat' => 'Jl. Anggrek No. 45, Bandung',
            'status' => 1,
        ],
        [
            'id' => 3,
            'nama' => 'Budi Santoso',
            'nim' => '20040101015',
            'email' => 'budi.santoso@example.com',
            'nomor_telepon' => '089611223344',
            'alamat' => 'Jl. Pemuda No. 8, Surabaya',
            'status' => 0, 
        ],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = $this->members;

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = $this->members;

        return view('members.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        return redirect()->route('members.index')
            ->with('success', "Member bernama \"{$validated['nama']}\" berhasil ditambahkan (data dummy, belum tersimpan ke database).");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "MemberController@show, id: {$id}";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "MemberController@edit, id: {$id}";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "MemberController@update, id: {$id}";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "MemberController@destroy, id: {$id}";
    }
}
