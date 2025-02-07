@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Design Factor 6</div>
                <div class="card-body">
                    <form action="{{ route('df6.store') }}" method="POST" onsubmit="return validateForm()">
                        @csrf
                        <input type="hidden" name="df_id" value="{{ $id }}">
                        
                        <!-- High Input -->
                        <div class="assessment-item card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h6 class="mb-0 text-primary">High</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="input1df6" id="input1df6" class="form-control" required>
                                        <small class="text-muted">Masukkan nilai dalam persen (contoh: 33 untuk 33%).</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Normal Input -->
                        <div class="assessment-item card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h6 class="mb-0 text-primary">Normal</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="input2df6" id="input2df6" class="form-control" required>
                                        <small class="text-muted">Masukkan nilai dalam persen (contoh: 33 untuk 33%).</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Low Input -->
                        <div class="assessment-item card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h6 class="mb-0 text-primary">Low</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="input3df6" id="input3df6" class="form-control" required>
                                        <small class="text-muted">Masukkan nilai dalam persen (contoh: 34 untuk 34%).</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Error Message -->
                        <div id="error-message" class="alert alert-danger mt-3" role="alert" style="display: none;">
                            The sum of all fields must not exceed 100%.
                        </div>

                        <!-- Pie Chart -->
                        <div class="chart-container mt-4" style="height: 300px;">
                            <canvas id="pieChart"></canvas>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Submit Assessment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                data: [33, 33, 33], // Default data
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)', // Red
                    'rgba(54, 162, 235, 0.6)',  // Blue
                    'rgba(255, 247, 0, 0.6)'   // Yellow
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', // Red border
                    'rgba(54, 162, 235, 1)',  // Blue border
                    'rgba(255, 247, 0, 1)'    // Yellow border
                ],
                borderWidth: 1
            }],
            labels: ['High', 'Normal', 'Low']
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false // Hide legend
                }
            }
        }
    });

    function updatePieChart() {
        const input1 = parseFloat(document.getElementById('input1df6').value) || 0;
        const input2 = parseFloat(document.getElementById('input2df6').value) || 0;
        const input3 = parseFloat(document.getElementById('input3df6').value) || 0;

        // Update data for pie chart
        pieChart.data.datasets[0].data = [input1, input2, input3];

        // Update colors dynamically
        pieChart.data.datasets[0].backgroundColor = [
            input1 > 0 ? 'rgba(255, 99, 132, 0.6)' : 'rgba(169, 169, 169, 0.6)', // Red if input1 is greater than 0, otherwise gray
            input2 > 0 ? 'rgba(54, 162, 235, 0.6)' : 'rgba(169, 169, 169, 0.6)',  // Blue if input2 is greater than 0, otherwise gray
            input3 > 0 ? 'rgba(255, 247, 0, 0.6)' : 'rgba(169, 169, 169, 0.6)'   // Yellow if input3 is greater than 0, otherwise gray
        ];

        // Update chart
        pieChart.update();
    }

    document.getElementById('input1df6').addEventListener('input', updatePieChart);
    document.getElementById('input2df6').addEventListener('input', updatePieChart);
    document.getElementById('input3df6').addEventListener('input', updatePieChart);

    function validateForm() {
        // Ambil nilai dari input
        const input1 = parseFloat(document.getElementById('input1df6').value) || 0;
        const input2 = parseFloat(document.getElementById('input2df6').value) || 0;
        const input3 = parseFloat(document.getElementById('input3df6').value) || 0;
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
<style>
.assessment-item {
    transition: transform 0.2s;
}
.assessment-item:hover {
    transform: translateY(-2px);
}
.chart-container {
    transition: transform 0.2s;
}
.chart-container:hover {
    transform: translateY(-2px);
}
</style>
@endsection