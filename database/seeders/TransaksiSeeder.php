<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaksis')->insert([
            [
                'nominal_transaksi' => 100000,
                'tipe_transaksi' => 'Pemasukan',
                'tanggal_transaksi' => date('Y-m-d H:i:s'),
                'keterangan' => 'Menemukan di jalan'
            ],
            [
                'nominal_transaksi' => 200000,
                'tipe_transaksi' => 'Pengeluaran',
                'tanggal_transaksi' => date('Y-m-d H:i:s'),
                'keterangan' => 'Buat Beli Kambing'
            ],
            [
                'nominal_transaksi' => 250000,
                'tipe_transaksi' => 'Pemasukan',
                'tanggal_transaksi' => date('Y-m-d H:i:s'),
                'keterangan' => 'Dapat gaji'
            ],
        ]);
    }
}
