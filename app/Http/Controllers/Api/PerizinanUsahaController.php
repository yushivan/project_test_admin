<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerizinanUsaha;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PerizinanUsahaController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id'    => 'required|exists:customers,id',
            'nama_usaha'     => 'required|string',
            'bidang_usaha'   => 'required|string',
            'alamat_usaha'   => 'required|string',
            'ktp'            => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'npwp'           => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status'         => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Cek apakah customer sudah diverifikasi
        $customer = Customer::find($request->customer_id);
        if (!$customer || !$customer->verifikasi) {
            return response()->json([
                'success' => false,
                'message' => 'Customer belum diverifikasi. Silakan verifikasi terlebih dahulu.',
            ], 403);
        }

        // Simpan file KTP dan NPWP ke storage/app/public/perizinan/
        $ktpPath = $request->file('ktp')->store('perizinan/ktp', 'public');
        $npwpPath = $request->file('npwp')->store('perizinan/npwp', 'public');

        // Simpan ke database
        $perizinan = PerizinanUsaha::create([
            'customer_id'   => $request->customer_id,
            'nama_usaha'    => $request->nama_usaha,
            'bidang_usaha'  => $request->bidang_usaha,
            'alamat_usaha'  => $request->alamat_usaha,
            'ktp'           => $ktpPath, // path file di storage
            'npwp'          => $npwpPath,
            'status'        => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Perizinan Usaha berhasil disimpan.',
            'data' => $perizinan,
        ], 201);
    }
}
