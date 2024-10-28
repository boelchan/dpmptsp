<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan Masyarakat</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
</head>

<body>
    <div class="container my-5">
        <h3 class="text-center">MAL PELAYANAN PUBLIK (MPP)<br> KABUPATEN SUMENEP</h3>
        <h4 class="text-center mb-4">Survey Kepuasan Masyarakat</h4>
        <h5 class="text-center mb-4">{{ $antrian?->layanan?->instansi?->nama }}</h5>

        <p>Layanan : {{ $antrian?->layanan?->nama }}</p>

        @if ($antrian->layanan_id == '')
            <h5 class="text-center mb-4">Anda belum menerima pelayanan. Mohon untuk menunggu hingga pelayanan Anda selesai, kemudian silakan mengisi SKM</h5>
            <div class="text-center">
                <a href="/" class="btn btn-info">Lihat website MPP Sumenep</a>
            </div>
        @elseif ($antrian->kepuasan == '')
            <x-form :action="route('front.skmqr.store')">
                <input type="hidden" name="id" value="{{ $antrian->id }}">
                <input type="hidden" name="uuid" value="{{ $antrian->uuid }}">

                <div class="mb-3">
                    <label for="question1" class="form-label">Bagaimana penilaian Anda terhadap layanan kami?</label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kepuasan" required id="baik-sekali" value="5">
                            <label class="form-check-label" for="baik-sekali">Sangat Puas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kepuasan" required id="baik" value="4">
                            <label class="form-check-label" for="baik">Puas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kepuasan" required id="cukup" value="3">
                            <label class="form-check-label" for="cukup">Cukup</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kepuasan" required id="kurang" value="2">
                            <label class="form-check-label" for="kurang">Tidak Puas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kepuasan" required id="kurang-sekali" value="1">
                            <label class="form-check-label" for="kurang-sekali">Sangat Tidak Puas</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="feedback" class="form-label">Masukan Anda:</label>
                    <textarea class="form-control" id="feedback" name="masukan" rows="4" required placeholder="Tulis masukan Anda di sini"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Kirim</button>
            </x-form>
        @else
            <h5 class="text-center mb-4">Terima kasih atas partisipasi Anda dalam mengisi SKM. Masukan Anda sangat berharga dan akan menjadi dasar untuk perbaikan selanjutnya. Kami menghargai waktu dan kontribusi Anda. Terima kasih.</h5>
            <div class="text-center">
                <a href="/" class="btn btn-info">Lihat website MPP Sumenep</a>
            </div>
        @endif


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
