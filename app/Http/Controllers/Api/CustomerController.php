<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class CustomerController extends Controller
{
    use HasApiTokens, HasFactory, Notifiable;

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required|string|max:255',
            'nik'       => 'required|string|unique:customers,nik|max:20',
            'email'     => 'required|email|unique:customers,email',
            'nomor_hp'  => 'required|string|max:20',
            'password'  => 'required|string|min:6|confirmed',
            // pastikan frontend kirim juga `password_confirmation`
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $customer = Customer::create([
            'nama'       => $request->nama,
            'nik'        => $request->nik,
            'email'      => $request->email,
            'nomor_hp'   => $request->nomor_hp,
            'password'   => Hash::make($request->password),
            'verifikasi' => 0,
        ]);

        // Kirim email verifikasi
        $verificationUrl = url('/api/customer/verify/' . $customer->id);

        Mail::raw("Silakan klik link berikut untuk verifikasi akun Anda:\n\n$verificationUrl", function ($message) use ($customer) {
            $message->to($customer->email)
                    ->subject('Verifikasi Akun Customer');
        });

        return response()->json([
            'success' => true,
            'message' => 'Customer berhasil didaftarkan. Silakan cek email untuk verifikasi.',
            'data' => [
                'id' => $customer->id,
                'nama' => $customer->nama,
                'email' => $customer->email,
                'verifikasi' => $customer->verifikasi,
            ],
        ], 201);
    }

    public function verify($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer tidak ditemukan.',
            ], 404);
        }

        if ($customer->verifikasi) {
            return response()->json([
                'success' => true,
                'message' => 'Akun sudah terverifikasi sebelumnya.',
            ]);
        }

        $customer->verifikasi = 1;
        $customer->save();

        return response()->json([
            'success' => true,
            'message' => 'Verifikasi berhasil. Akun Anda telah diaktifkan.',
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer || !Hash::check($request->password, $customer->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah.',
            ], 401);
        }

        if (!$customer->verifikasi) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda belum diverifikasi. Silakan cek email.',
            ], 403);
        }

        // // Hapus token lama jika ingin 1 sesi
        // $customer->tokens()->delete();

        // // Buat token baru
        // $token = $customer->createToken('customer-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil.',
            // 'token'   => $token,
            'data'    => [
                'id'    => $customer->id,
                'nama'  => $customer->nama,
                'email' => $customer->email,
            ],
        ]);
    }
}
