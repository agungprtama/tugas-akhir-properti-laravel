<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('kpr.simulation') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="price">Harga Properti:</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="down_payment">Uang Muka (DP):</label>
            <input type="number" class="form-control" id="down_payment" name="down_payment" required>
        </div>
        <div class="form-group">
            <label for="interest_rate">Suku Bunga (% per tahun):</label>
            <input type="number" class="form-control" id="interest_rate" name="interest_rate" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="loan_term">Jangka Waktu Kredit (tahun):</label>
            <input type="number" class="form-control" id="loan_term" name="loan_term" required>
        </div>
        <button type="submit" class="btn btn-primary">Simulasi KPR</button>
    </form>
    
</body>
</html>