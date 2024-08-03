<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInquiryRequest;
use App\Mail\InquiryNotification;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function store(StoreInquiryRequest $request)
    {
        // Ambil data dari request
        $data = $request->validated();

        // Simpan data ke database (asumsikan sudah ada model Inquiry)
        $inquiry = Inquiry::create($data);

        // Kirim notifikasi email ke admin
        Mail::to('admin@example.com')->send(new InquiryNotification($inquiry));

        return response()->json(['message' => 'Inquiry sent successfully'], 200);
    }
}
