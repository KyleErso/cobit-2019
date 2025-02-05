@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Design Factor 8</div>

                <div class="card-body">
                    <form action="{{ route('df8.store') }}" method="POST" onsubmit="return validateForm()">
                        @csrf
                        <input type="hidden" name="df_id" value="{{ $id }}">

                        <!-- 3 Input Fields for df8 -->
                        <div class="form-group">
                            <label for="input1df8">High</label>
                            <input type="number" name="input1df8" id="input1df8" class="form-control" required>
                            <small class="text-muted">Masukkan nilai dalam persen (contoh: 33 untuk 33%).</small>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input2df8">Normal</label>
                            <input type="number" name="input2df8" id="input2df8" class="form-control" required>
                            <small class="text-muted">Masukkan nilai dalam persen (contoh: 33 untuk 33%).</small>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input3df8">Low</label>
                            <input type="number" name="input3df8" id="input3df8" class="form-control" required>
                            <small class="text-muted">Masukkan nilai dalam persen (contoh: 34 untuk 34%).</small>
                        </div>

                        <!-- Error message container -->
                        <div id="error-message" class="alert alert-danger mt-3" role="alert" style="display: none;">
                            The sum of all fields must not exceed 100%.
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        // Ambil nilai dari input
        const input1 = parseFloat(document.getElementById('input1df8').value) || 0;
        const input2 = parseFloat(document.getElementById('input2df8').value) || 0;
        const input3 = parseFloat(document.getElementById('input3df8').value) || 0;
        const total = input1 + input2 + input3;

        // Periksa apakah total melebihi 100
        if (total > 100) {
            // Tampilkan pesan error
            document.getElementById('error-message').style.display = 'block';
            return false; // Hentikan proses submit
        }

        // Sembunyikan pesan error jika validasi berhasil
        document.getElementById('error-message').style.display = 'none';
        return true; // Lanjutkan proses submit
    }
</script>
@endsection