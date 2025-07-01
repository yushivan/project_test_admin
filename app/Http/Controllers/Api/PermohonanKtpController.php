<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermohonanKtp;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class PermohonanKtpController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'alamat'      => 'required|string',
            'kk'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status'      => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Cek customer terverifikasi
        $customer = Customer::find($request->customer_id);
        if (!$customer || !$customer->verifikasi) {
            return response()->json([
                'success' => false,
                'message' => 'Customer belum diverifikasi.',
            ], 403);
        }

        // Simpan file KK ke public storage (storage/app/public/permohonan/kk)
        $kkPath = $request->file('kk')->store('permohonan/kk', 'public');

        // Simpan data ke database
        $permohonan = PermohonanKtp::create([
            'customer_id' => $request->customer_id,
            'alamat'      => $request->alamat,
            'kk'          => $kkPath, // contoh: "permohonan/kk/kk_abc.jpg"
            'status'      => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permohonan KTP berhasil disimpan.',
            'data'    => $permohonan,
        ], 201);
    }
}
