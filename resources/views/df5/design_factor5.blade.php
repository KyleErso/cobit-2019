@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Design Factor 5</div>
                <div class="card-body">
                    <form action="{{ route('df5.store') }}" method="POST" onsubmit="return validateForm()">
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
                                        <input type="number" name="input1df5" id="input1df5" class="form-control" required>
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
                                        <input type="number" name="input2df5" id="input2df5" class="form-control" required>
                                        <small class="text-muted">Masukkan nilai dalam persen (contoh: 67 untuk 67%).</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Error Message -->
                        <div id="error-message" class="alert alert-danger mt-3" role="alert" style="display: none;">
                            The sum of High and Normal must be exactly 100%.
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
                data: [50, 50], // Default data
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)', // Red for High
                    'rgba(54, 162, 235, 0.6)'  // Blue for Normal
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', // Red border
                    'rgba(54, 162, 235, 1)'  // Blue border
                ],
                borderWidth: 1
            }],
            labels: ['High', 'Normal']
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
        const input1 = parseFloat(document.getElementById('input1df5').value) || 0;
        const input2 = parseFloat(document.getElementById('input2df5').value) || 0;

        // Update data for pie chart
        pieChart.data.datasets[0].data = [input1, input2];

        // Update chart
        pieChart.update();
    }

    document.getElementById('input1df5').addEventListener('input', updatePieChart);
    document.getElementById('input2df5').addEventListener('input', updatePieChart);

    function validateForm() {
        const input1 = parseFloat(document.getElementById('input1df5').value) || 0;
        const input2 = parseFloat(document.getElementById('input2df5').value) || 0;
        const total = input1 + input2;

        // Check if the total is exactly 100
        if (total !== 100) {
            document.getElementById('error-message').style.display = 'block';
            return false;
        }

        document.getElementById('error-message').style.display = 'none';
        return true;
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