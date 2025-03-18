<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use Yajra\DataTables\Facades\DataTables;
use App\Models\KategoriModel;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Data Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Data barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang'; // set menu yang sedang aktif

        $barang = BarangModel::select('barang_id', 'barang_kode', 'barang_nama')->get();

        return view('barang.index', [
            'breadcrumb'=>$breadcrumb, 
            'page'=>$page, 'barang'=>$barang, 
            'activeMenu'=>$activeMenu,
            'barang'=>$barang
        ]);
    }

    public function list(Request $request)
    {
        $query = BarangModel::select('barang_id', 'barang_kode', 'barang_nama', 'created_at', 'updated_at');
    
        // Tambahkan filter berdasarkan barang_id
        if (!empty($request->barang_kode)) {
            $query->where('barang_kode', $request->barang_kode);
        }
    
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) {
                return '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn-info btn-sm">Detail</a> '.
                       '<a href="'.url('/barang/' . $barang->barang_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> '.
                       '<form class="d-inline-block" method="POST" action="'.url('/barang/' . $barang->barang_id).'">'.
                       csrf_field().
                       method_field('DELETE').
                       '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\')">Hapus</button>'.
                       '</form>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah barang baru'
        ];

        $barang = BarangModel::all();
        $kategori = KategoriModel::all(); // ambil data barang untuk ditampilkan di form
        $activeMenu = 'barang'; // set menu yang sedang aktif

        return view('barang.create',['breadcrumb'=> $breadcrumb, 'page' => $page, 'barang' => $barang, 'kategori'=>$kategori,'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode',
            'barang_nama'     => 'required|string|max:100',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'kategori_id' => 'required|exists:m_kategori,kategori_id'
        ]);

        BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    public function show($barang_id)
    {
        $barang = BarangModel::with('kategori')->find($barang_id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list'  => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail barang'
        ];

        $activeMenu = 'barang'; // set menu yang sedang aktif

        return view('barang.show', [
            'barang'     => $barang,
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id)
    {
        $barang = BarangModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit barang',
            'list'  => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang'
        ];

        $activeMenu = 'barang'; // set menu yang sedang aktif

        return view('barang.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'barang' => $barang,
            'kategori' => KategoriModel::all(),
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode,' . $id . ',barang_id',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'kategori_id' => 'required|exists:m_kategori,kategori_id'
        ]);

        BarangModel::find($id)->update([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = BarangModel::find($id);  // Cari barang berdasarkan ID
        
        if (!$check) { // Cek barang ada atau nggak
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            BarangModel::destroy($id);  // Hapus barang
            
            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
            
        } catch (\Illuminate\Database\QueryException $e) { // Jika gagal delete (biasanya FK constraint)
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    } 
}
