<?php

namespace App\Http\Controllers;

use App\Models\Jadwals;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class JadwalsController extends Controller
{
    public function pesanView()
    {
        $terpesan = Pesanan::pluck('jadwal_id');

        $jadwalAvail = Jadwals::whereNotIn('id', $terpesan)->get();
        return view('pesan', [
            'laps' => $jadwalAvail
        ]);
    }
    public function pesan(Request $request)
    {
        $data = $request->only(['nama', 'wa', 'tanggalBook', 'nomorLap', 'jamBook']);
        $valid = Validator::make($data, [
            'nama' => 'required',
            'wa' => 'required|regex:/^0\d{9,14}$/',
            'tanggalBook' => 'required|date',
            'nomorLap' => 'required',
            'jamBook' => 'required',
        ], [
            'nama.required' => 'Nama Pemesan wajib Diisi',
            'wa.required' => 'Nomor Whatsapp Pemesan wajib Diisi',
            'tanggalBook.required' => 'Tanggal Pemesananan wajib Diisi',
            'nomorLap.required' => 'Nomor Lapangan yang ingin dipesan wajib Diisi',
            'jamBook.required' => 'Jam Pemesan wajib Diisi',

            'tanggalBook.date' => 'Tanggal Pemesananan wajib dalam format Tanggal',
            'wa.regex' => 'Nomor Whatsapp Harus berawalan 0 dan dengan panjang 9 hingga 14 digits'
        ]);
        if ($valid->fails()) {
            return redirect()->back()->with(['error' => $valid->errors()->first()])->withInput();
        }

        $jadwalPicked = Jadwals::where('nomor_lapangan', $data['nomorLap'])->where('jam_mulai', substr($data['jamBook'], 0, 2) . ':00')->first();
        if (!$jadwalPicked) {
            return redirect()->back()->with(['error' => 'Jadwal Tidak Ditemukan'])->withInput();
        }
        $jadwalTerpesan = Pesanan::where('jadwal_id', $jadwalPicked->id)->get();
        if (!empty($jadwalTerpesan)) {
            return redirect()->back()->with(['error' => 'Lapangan sudah Dibooking pada jadwal tersebut, Silahkan pilih jadwal lain'])->withInput();
        }
        $pesanan = new Pesanan();
        $pesanan->nama_pemesan = $data['nama'];
        $pesanan->wa_pemesan = $data['wa'];
        $pesanan->tanggal = $data['tanggalBook'];
        $pesanan->jadwal_id = $jadwalPicked->id;

        $pesanan->save();
        return redirect()->back()->with('success', 'Pemesanan Berhasil!');
    }

    public function pesananView()
    {
        $pesanan = Pesanan::orderBy('tanggal')->with('jadwal')->get();
        return view('pemesanan', [
            'pesanan' => $pesanan
        ]);
    }
    public function editPesanView()
    {
        $terpesan = Pesanan::pluck('jadwal_id');

        $jadwalAvail = Jadwals::whereNotIn('id', $terpesan)->get();
        return view('editpesan', [
            'laps' => $jadwalAvail
        ]);
    }
    public function delete($id){
        $a = Pesanan::where('id', $id);
        $a->delete();
        return redirect()->back()->with('success', 'Removed!');
    }
}
