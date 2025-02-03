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

                        <div class="form-group">
                            <label for="input1df5">High</label>
                            <input type="number" name="input1df5" id="input1df5" class="form-control" required>
                            <small class="text-muted">Masukkan nilai dalam persen (contoh: 33 untuk 33%).</small>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input2df5">Normal</label>
                            <input type="number" name="input2df5" id="input2df5" class="form-control" required>
                            <small class="text-muted">Masukkan nilai dalam persen (contoh: 67 untuk 67%).</small>
                        </div>

                        <div id="error-message" class="alert alert-danger mt-3" role="alert" style="display: none;">
                            The sum of High and Normal must be exactly 100%.
                        </div>

                        <canvas id="pieChart" style="max-height: 300px; margin-top: 20px;"></canvas>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Submit Assessment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                data: [50,50], // Default data
                backgroundColor: [
                    'rgba(169, 169, 169, 0.6)', // Default gray color
                    'rgba(169, 169, 169, 0.6)'  // Default gray color
                ],
                borderColor: [
                    'rgba(169, 169, 169, 1)', // Default gray border
                    'rgba(169, 169, 169, 1)'  // Default gray border
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

    function updatePieChart() {
        const input1 = parseFloat(document.getElementById('input1df5').value) || 0;
        const input2 = parseFloat(document.getElementById('input2df5').value) || 0;

        // Update data for pie chart
        pieChart.data.datasets[0].data = [input1, input2];

        // Update color when input is provided
        pieChart.data.datasets[0].backgroundColor = [
            input1 > 0 ? 'rgba(255, 99, 132, 0.6)' : 'rgba(169, 169, 169, 0.6)', // Red if input1 is greater than 0, otherwise gray
            input2 > 0 ? 'rgba(54, 162, 235, 0.6)' : 'rgba(169, 169, 169, 0.6)'  // Blue if input2 is greater than 0, otherwise gray
        ];

        // Update chart
        pieChart.update();
    }

    document.getElementById('input1df5').addEventListener('input', updatePieChart);
    document.getElementById('input2df5').addEventListener('input', updatePieChart);

    function validateForm() {
        const input1 = parseFloat(document.getElementById('input1df5').value) || 0;
        const input2 = parseFloat(document.getElementById('input2df5').value) || 0;
        const total = input1 + input2;

        if (total !== 100) { // Check if the total is exactly 100
            document.getElementById('error-message').style.display = 'block';
            return false;
        }
        
        document.getElementById('error-message').style.display = 'none';
        return true;
    }
</script>

@endsection
