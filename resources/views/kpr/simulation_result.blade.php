<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Hasil Simulasi KPR</h1>
        <p>Harga Properti: Rp {{ number_format($price, 0, ',', '.') }}</p>
        <p>Uang Muka (DP): Rp {{ number_format($downPayment, 0, ',', '.') }}</p>
        <p>Jumlah Pinjaman: Rp {{ number_format($loanAmount, 0, ',', '.') }}</p>
        <p>Suku Bunga: {{ $interestRate * 100 }}% per tahun</p>
        <p>Jangka Waktu Kredit: {{ $loanTerm }} tahun</p>
        <h2>Angsuran Bulanan: Rp {{ number_format($monthlyPayment, 0, ',', '.') }}</h2>
    </div>
</body>
</html>