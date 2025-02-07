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
                        
                        <!-- Outsourcing Input -->
                        <div class="assessment-item card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h6 class="mb-0 text-primary">Outsourcing</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="input1df8" id="input1df8" class="form-control" required>
                                        <small class="text-muted">Masukkan nilai dalam persen (contoh: 33 untuk 33%).</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cloud Input -->
                        <div class="assessment-item card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h6 class="mb-0 text-primary">Cloud</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="input2df8" id="input2df8" class="form-control" required>
                                        <small class="text-muted">Masukkan nilai dalam persen (contoh: 33 untuk 33%).</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Insourced Input -->
                        <div class="assessment-item card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h6 class="mb-0 text-primary">Insourced</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="input3df8" id="input3df8" class="form-control" required>
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
    // Initialize Pie Chart
    const ctx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Outsourcing', 'Cloud', 'Insourced'],
            datasets: [{
                data: [33, 33, 34], // Default data
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)', // Red for Outsourcing
                    'rgba(54, 162, 235, 0.6)',  // Blue for Cloud
                    'rgba(255, 206, 86, 0.6)'   // Yellow for Insourced
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', // Red border
                    'rgba(54, 162, 235, 1)',  // Blue border
                    'rgba(255, 206, 86, 1)'   // Yellow border
                ],
                borderWidth: 1
            }]
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

    // Update Pie Chart on Input Change
    function updatePieChart() {
        const input1 = parseFloat(document.getElementById('input1df8').value) || 0;
        const input2 = parseFloat(document.getElementById('input2df8').value) || 0;
        const input3 = parseFloat(document.getElementById('input3df8').value) || 0;

        // Update data for pie chart
        pieChart.data.datasets[0].data = [input1, input2, input3];

        // Update colors dynamically
        pieChart.data.datasets[0].backgroundColor = [
            input1 > 0 ? 'rgba(255, 99, 132, 0.6)' : 'rgba(169, 169, 169, 0.6)', // Red if input1 is greater than 0, otherwise gray
            input2 > 0 ? 'rgba(54, 162, 235, 0.6)' : 'rgba(169, 169, 169, 0.6)',  // Blue if input2 is greater than 0, otherwise gray
            input3 > 0 ? 'rgba(255, 206, 86, 0.6)' : 'rgba(169, 169, 169, 0.6)'   // Yellow if input3 is greater than 0, otherwise gray
        ];

        // Update chart
        pieChart.update();
    }

    // Add Event Listeners to Inputs
    document.getElementById('input1df8').addEventListener('input', updatePieChart);
    document.getElementById('input2df8').addEventListener('input', updatePieChart);
    document.getElementById('input3df8').addEventListener('input', updatePieChart);

    // Validation Function
    function validateForm() {
        const input1 = parseFloat(document.getElementById('input1df8').value) || 0;
        const input2 = parseFloat(document.getElementById('input2df8').value) || 0;
        const input3 = parseFloat(document.getElementById('input3df8').value) || 0;
        const total = input1 + input2 + input3;

        // Check if total exceeds 100%
        if (total > 100) {
            document.getElementById('error-message').style.display = 'block';
            return false; // Stop form submission
        }

        // Hide error message if validation passes
        document.getElementById('error-message').style.display = 'none';
        return true; // Allow form submission
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