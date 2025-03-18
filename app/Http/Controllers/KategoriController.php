<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriModel;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    // public function index(){
    //     // $data = [
    //     //     'kategori_kode' => 'SNK',
    //     //     'kategori_nama' => 'Snack/Makanan Ringan',
    //     //     'created_at' => now()
    //     // ];
    //     // DB::table('m_kategori')->insert($data);
    //     // return 'Insert data baru berhasil';
    
    //     // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
    //     // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row. ' baris';

    //     // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
    //     // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row. ' baris';
    
    //     $data = DB::table('m_kategori')->get();
    //     return view('kategori', ['data' => $data]);
    // }

    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Data Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Data kategori yang terdaftar dalam sistem'
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif

        $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama')->get();

        return view('kategori.index', [
            'breadcrumb'=>$breadcrumb, 
            'page'=>$page, 'kategori'=>$kategori, 
            'activeMenu'=>$activeMenu,
            'kategori'=>$kategori
        ]);
    }

    public function list(Request $request)
    {
        $query = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama', 'created_at', 'updated_at');
    
        // Tambahkan filter berdasarkan kategori_id
        if (!empty($request->kategori_kode)) {
            $query->where('kategori_kode', $request->kategori_kode);
        }
    
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                return '<a href="'.url('/kategori/' . $kategori->kategori_id).'" class="btn btn-info btn-sm">Detail</a> '.
                       '<a href="'.url('/kategori/' . $kategori->kategori_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> '.
                       '<form class="d-inline-block" method="POST" action="'.url('/kategori/' . $kategori->kategori_id).'">'.
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
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah kategori baru'
        ];

        $kategori = KategoriModel::all(); // ambil data kategori untuk ditampilkan di form
        $activeMenu = 'kategori'; // set menu yang sedang aktif

        return view('kategori.create',['breadcrumb'=> $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'required|string|min:3|unique:m_kategori,kategori_kode',
            'kategori_nama'     => 'required|string|max:100',
        ]);

        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan');
    }

    public function show($kategori_id)
    {
        $kategori = KategoriModel::find($kategori_id);

        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list'  => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Kategori'
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif

        return view('kategori.show', [
            'kategori'   => $kategori,
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit kategori',
            'list'  => ['Home', 'kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit kategori'
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif

        return view('kategori.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_kode' => 'required|string|min:3|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
            'kategori_nama' => 'required|string|max:100',
        ]);

        KategoriModel::find($id)->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = KategoriModel::find($id);  // Cari kategori berdasarkan ID
        
        if (!$check) { // Cek kategori ada atau nggak
            return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
        }

        try {
            KategoriModel::destroy($id);  // Hapus kategori
            
            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
            
        } catch (\Illuminate\Database\QueryException $e) { // Jika gagal delete (biasanya FK constraint)
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    } 
}