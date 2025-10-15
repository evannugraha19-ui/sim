<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Laporan;
use App\Models\Pengaduan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PengaduanController extends Controller
{
    public function laporan(Request $request)
    {
        $query = Pengaduan::with('user')->latest();

        if (Auth::user()->hasRole('user')) {
            $query->where('user_id', Auth::id());
        }

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_laporan', [
                $request->tanggal_awal . ' 00:00:00',
                $request->tanggal_akhir . ' 23:59:59'
            ]);

            $laporan = $query->get();

            return view('admin.laporan-cetak-admin', compact('laporan'));
        }

        return view('admin.laporan-cetak-admin');
    }

    public function exportPdf(Request $request)
    {
        $laporan = Pengaduan::whereBetween('tanggal_laporan', [$request->tanggal_awal, $request->tanggal_akhir])->get();
        $pdf = Pdf::loadView('pengaduans.export-pdf', compact('laporan'));
        return $pdf->download('laporan_pengaduan.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new LaporanExport($request->tanggal_awal, $request->tanggal_akhir), 'laporan_pengaduan.xlsx');
    }


    public function index()
    {
        $query = Pengaduan::with('user')->latest();

        if (Auth::user()->role === 'user') {
            $query->where('user_id', Auth::id());
        } else {
            $query->whereNotNull('id');
        }

        $pengaduans = $query->paginate(10);

        return view('pengaduans.riwayat-pengaduan', compact('pengaduans'));
    }

    public function create()
    {
        return view('pengaduans.pengaduan-input');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'jabatan_pelapor' => 'required|string|max:100',
            'departemen' => 'required|string|max:100',
            'nama_mesin' => 'required|string|max:100',
            'tanggal_laporan' => 'required|date',
            'keterangan' => 'required|string',
        ]);

        Pengaduan::create([
            'user_id' => Auth::id(),
            'nama_pelapor' => $request->nama_pelapor,
            'jabatan_pelapor' => $request->jabatan_pelapor,
            'departemen' => $request->departemen,
            'nama_mesin' => $request->nama_mesin,
            'tanggal_laporan' => $request->tanggal_laporan,
            'keterangan' => $request->keterangan,
            'status' => 'Menunggu',
        ]);

        return redirect('/riwayat-pengaduan')->with('success', 'Pengaduan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with('user')->find($id);

        if (!$pengaduan) {
            abort(404, 'Pengaduan tidak ditemukan');
        }

        if (Auth::user()->role === 'user' && $pengaduan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak punya akses ke pengaduan ini');
        }

        return view('pengaduans.pengaduan-detail', compact('pengaduan'));
    }


    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|string',
            'hasil_perbaikan' => 'nullable|string',
        ]);

        $pengaduan->update(['status' => $validated['status'], 'hasil_perbaikan' => $validated['hasil_perbaikan']]);

        return redirect('/riwayat-pengaduan')
            ->with('success', 'Data pengaduan berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();
        return redirect('/riwayat-pengaduan')->with('success', 'Pengaduan berhasil dihapus');
    }
}
