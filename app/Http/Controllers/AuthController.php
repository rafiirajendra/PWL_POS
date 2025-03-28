<?php 
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
 
class AuthController extends Controller 
{ 
    public function login() 
    { 
        if(Auth::check()){ // jika sudah login, maka redirect ke halaman home 
            return redirect('/'); 
        } 
        return view('auth.login'); 
    } 
 
    public function postlogin(Request $request) 
    { 
        if($request->ajax() || $request->wantsJson()){ 
            $credentials = $request->only('username', 'password'); 
 
            if (Auth::attempt($credentials)) { 
                return response()->json([ 
                    'status' => true, 
                    'message' => 'Login Berhasil', 
                    'redirect' => url('/') 
                ]); 
            } 
             
            return response()->json([ 
                'status' => false, 
                'message' => 'Login Gagal' 
            ]); 
        } 
 
        return redirect('login'); 
    } 
 
    public function logout(Request $request) 
    { 
        Auth::logout(); 
 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken();     
        return redirect('login'); 
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        if($request->ajax() || $request->wantsJson()) {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:m_user,username',
                'password' => 'required|string|min:6|confirmed',
                'level_id' => 'required|exists:m_level,level_id',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Registrasi gagal!',
                    'msgField' => $validator->errors(),
                ]);
            }
    
            // Simpan data user baru
            UserModel::create([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'level_id' => $request->level_id,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Registrasi berhasil! Silakan login.',
                'redirect' => url('login'),
            ]);
        }
    
        return redirect('register');
    }
} 