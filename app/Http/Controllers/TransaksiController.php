<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index() {
        $data = transaksi::where('user_id', '=', Auth::user()->id)->get();
        $halaman = 'Dashboard';
        $saldo = Auth::user()->saldo;

        $pemasukan = transaksi::where('user_id', '=', Auth::user()->id)
                    ->where('tipe_transaksi', '=', 'Pemasukan')
                    ->sum('nominal_transaksi');

        $pengeluaran = transaksi::where('user_id', '=', Auth::user()->id)
                    ->where('tipe_transaksi', '=', 'Pengeluaran')
                    ->sum('nominal_transaksi');

        return view('dashboard', compact('data', 'halaman', 'saldo', 'pemasukan', 'pengeluaran'));
    }

    public function delete($id) {
        $find = transaksi::findOrFail($id);
        $totalsaldo = 0;

        if ($find['tipe_transaksi'] == 'Pemasukan') {
            $totalsaldo = -$find['nominal_transaksi'];
        } else {
            $totalsaldo = $find['nominal_transaksi'];
        }

        $getuid = User::findOrFail(Auth::user()->id);

        $total = $getuid['saldo'] + $totalsaldo;

        $getuid->update([
            'saldo' => $total
        ]);

        transaksi::destroy($id);

        return redirect('/dashboard')->with('pesan', 'Berhasil menghapus transaksi!');
    }

    public function transaksiViewCreate($type) {
        $halaman = '';
        if ($type === 'pemasukan') {
            $halaman = 'Pemasukan';
            return view('transaksi-create', compact('halaman', 'type'));
        }
        else if ($type === 'pengeluaran') {
            $halaman = 'Pengeluaran';
            return view('transaksi-create', compact('halaman', 'type'));
        }
        else {
            return abort(404);
        }
    }

    public function transaksiCreate(Request $request, $type) {
        if ($type != 'pemasukan' && $type != 'pengeluaran') {
            return abort(404);
        }

        $request->validate([
            'nominal' => 'required|numeric',
            'tanggal' => 'date|required'
        ]);

        $data = [];
        $totalsaldo = 0;

        if ($type === 'pemasukan') {
            $data = [
                'nominal_transaksi' => $request->nominal,
                'tanggal_transaksi' => $request->tanggal,
                'tipe_transaksi' => 'Pemasukan',
                'keterangan' => $request->keterangan,
                'user_id' => Auth::user()->id
            ];
            $totalsaldo = $data['nominal_transaksi'];
        } else {
            $data = [
                'nominal_transaksi' => $request->nominal,
                'tanggal_transaksi' => $request->tanggal,
                'tipe_transaksi' => 'Pengeluaran',
                'keterangan' => $request->keterangan,
                'user_id' => Auth::user()->id
            ];
            $totalsaldo = -$data['nominal_transaksi'];
        }

        transaksi::create($data);

        $getuid = User::findOrFail(Auth::user()->id);

        $total = $getuid['saldo'] + $totalsaldo;

        $getuid->update([
            'saldo' => $total
        ]);

        return redirect('/dashboard')->with('pesan', 'Berhasil menambahkan data');
    }

    public function transaksiViewEdit($id) {
        $data = transaksi::findOrFail($id);
        $halaman = 'Edit Data';
        return view('transaksi-edit', compact('data', 'halaman'));
    }

    public function transaksiEdit(Request $request, $id) {
        $request->validate([
            'nominal' => 'required|numeric',
            'tanggal' => 'date|required'
        ]);

        $user = User::findOrFail(Auth::user()->id);

        $data = transaksi::findOrFail($id);

        $reset = 0;

        if ($request->tipe == 'Pengeluaran') {
            // reset pengeluaran
            $reset = $user['saldo'] - $data['nominal_transaksi'];
        } else {
            $reset = $user['saldo'] + $data['nominal_transaksi'];
        }


        $data->update([
            'nominal_transaksi' => $request->nominal,
            'tanggal_transaksi' => $request->tanggal,
            'tipe_transaksi' => $request->tipe,
            'keterangan' => $request->keterangan
        ]);

        $saldo = 0;

        // cek apakah ada perubahan di tipe transaksinya
        if ($request->tipe == 'Pemasukan') {
            $saldo = $reset + $data['nominal_transaksi'];
        } else {
            $saldo = $reset - $data['nominal_transaksi'];
        }

        $user->update([
            'saldo' => $saldo
        ]);

        return redirect('/dashboard')->with('pesan', 'Berhasil edit data');
    }
}
