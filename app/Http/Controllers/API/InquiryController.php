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
    public function store(Request $request)
    {

        // Simpan data ke database (asumsikan sudah ada model Inquiry)
        $inquiry = Inquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);
        // dd($inquiry);


        // Kirim notifikasi email ke admin
        Mail::to('reonaldi1105@gmail.com')->send(new InquiryNotification($inquiry));

        return response()->json(['message' => 'Inquiry sent successfully'], 200);
    }
}
