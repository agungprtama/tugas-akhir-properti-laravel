<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KprController extends Controller
{
    // public function simulate(Request $request)
    // {
    //     $price = $request->input('price');
    //     $downPayment = $request->input('down_payment');
    //     $interestRate = $request->input('interest_rate') / 100;
    //     $loanTerm = $request->input('loan_term');

    //     $loanAmount = $price - $downPayment;
    //     $monthlyInterestRate = $interestRate / 12;
    //     $numberOfPayments = $loanTerm * 12;

    //     $monthlyPayment = $loanAmount * $monthlyInterestRate / (1 - pow((1 + $monthlyInterestRate), -$numberOfPayments));

    //     return view('kpr.simulation_result', compact('monthlyPayment', 'loanAmount', 'interestRate', 'loanTerm', 'price', 'downPayment'));
    // }

    // public function simulate(Request $request)
    // {
    //     // Ambil input dari formulir
    //     $price = $request->input('price');
    //     $downPayment = $request->input('down_payment');
    //     $interestRate = $request->input('interest_rate');
    //     $loanTerm = $request->input('loan_term');

    //     // Hitung jumlah pinjaman
    //     $loanAmount = $price - $downPayment;

    //     // Hitung suku bunga bulanan
    //     $monthlyInterestRate = ($interestRate / 100) / 12;

    //     // Hitung jumlah total pembayaran dalam bulan
    //     $numberOfPayments = $loanTerm * 12;

    //     // Hitung angsuran bulanan
    //     $monthlyPayment = $loanAmount * $monthlyInterestRate * pow((1 + $monthlyInterestRate), $numberOfPayments) / (pow((1 + $monthlyInterestRate), $numberOfPayments) - 1);

    //     // Kembalikan hasil ke view
    //     return view('kpr.simulation_result', compact('monthlyPayment', 'loanAmount', 'interestRate', 'loanTerm', 'price', 'downPayment'));
    // }


    public function simulate(Request $request)
    {
        // Ambil input dari formulir
        $price = $request->input('price');
        $downPayment = $request->input('down_payment');
        $interestRate = $request->input('interest_rate');
        $loanTerm = $request->input('loan_term');

        // Hitung jumlah pinjaman
        $loanAmount = $price - $downPayment;

        // Konversi suku bunga tahunan ke desimal dan hitung suku bunga bulanan
        $monthlyInterestRate = ($interestRate / 100) / 12;

        // Hitung jumlah total pembayaran dalam bulan
        $numberOfPayments = $loanTerm * 12;

        // Hitung angsuran bulanan menggunakan rumus anuitas
        $monthlyPayment = $loanAmount * $monthlyInterestRate * pow((1 + $monthlyInterestRate), $numberOfPayments) / (pow((1 + $monthlyInterestRate), $numberOfPayments) - 1);

        // Kembalikan hasil ke view
        return view('kpr.simulation_result', compact('monthlyPayment', 'loanAmount', 'interestRate', 'loanTerm', 'price', 'downPayment'));
    }
}
