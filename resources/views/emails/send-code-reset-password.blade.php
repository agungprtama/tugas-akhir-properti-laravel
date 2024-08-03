@component('mail::message')
    # Permintaan Reset Password Akun Anda

    Kami telah menerima permintaan untuk mereset password akun Anda. Anda dapat menggunakan kode berikut untuk memulihkan
    akun Anda:

    {{-- @component('mail::panel') --}}
    {{ $code }}
    {{-- @endcomponent --}}

    Harap dicatat bahwa kode ini hanya berlaku 5 menit sejak email ini dikirim. Jika Anda tidak meminta reset
    password, silakan abaikan email ini.

    Terima kasih telah menggunakan layanan kami.

    Salam Hangat,
    {{ config('app.name') }}

    {{-- @component('mail::subcopy')
        Jika Anda mengalami masalah dalam menggunakan tombol "Reset Password", salin dan tempel URL berikut ini ke browser web
        Anda: [{{ url('/reset-password') }}]({{ url('/reset-password') }}).
    @endcomponent --}}
@endcomponent
