@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Design Factor 3</div>
                <div class="card-body">
                    <form action="{{ route('df3.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="df_id" value="{{ $id }}">
                        @php
                            $labels = [
                                'IT investment decision making, portfolio definition & maintenance',
                                'Program & projects life cycle management',
                                'IT cost & oversight',
                                'IT expertise, skills & behavior',
                                'Enterprise/IT architecture',
                                'IT operational infrastructure incidents',
                                'Unauthorized actions',
                                'Software adoption/usage problems',
                                'Hardware incidents',
                                'Software failures',
                                'Logical attacks (hacking, malware, etc.)',
                                'Third-party/supplier incidents',
                                'Noncompliance',
                                'Geopolitical Issues',
                                'Industrial action',
                                'Acts of nature',
                                'Technology-based innovation',
                                'Environmental',
                                'Data & information management'
                            ];
                        @endphp
                        @foreach($labels as $index => $label)
                            <div class="assessment-item card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 text-primary">
                                            <label for="impact{{ $index + 1 }}">{{ $label }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col mb-2">
                                                    <input type="number" class="form-control" id="impact{{ $index + 1 }}" name="impact{{ $index + 1 }}" placeholder="Impact" oninput="calculateResult({{ $index + 1 }})">
                                                </div>
                                                <div class="col mb-2">
                                                    <input type="number" class="form-control" id="likelihood{{ $index + 1 }}" name="likelihood{{ $index + 1 }}" placeholder="Likelihood" oninput="calculateResult({{ $index + 1 }})">
                                                </div>
                                                <div class="col mb-2">
                                                    <input type="hidden" id="result{{ $index + 1 }}" name="input{{ $index + 1 }}df3">
                                                    <input type="text" class="form-control" id="resultText{{ $index + 1 }}" placeholder="Result" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Bar Chart Container -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="chart-container" style="height: 500px;">
                                    <canvas id="barChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4 text-center">
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
document.addEventListener('DOMContentLoaded', function () {
    const barCtx = document.getElementById('barChart').getContext('2d');

    // Initialize Bar Chart
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: [
                'IT investment decision making',
                'Program & projects life cycle',
                'IT cost & oversight',
                'IT expertise, skills & behavior',
                'Enterprise/IT architecture',
                'IT operational infrastructure',
                'Unauthorized actions',
                'Software adoption/usage',
                'Hardware incidents',
                'Software failures',
                'Logical attacks',
                'Third-party/supplier incidents',
                'Noncompliance',
                'Geopolitical Issues',
                'Industrial action',
                'Acts of nature',
                'Technology-based innovation',
                'Environmental',
                'Data & information management'
            ],
            datasets: [{
                label: 'Risk Score',
                data: new Array(19).fill(0), // Default data with 19 items
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            scales: {
                x: {
                    max: 25, // Adjust max value based on possible impact * likelihood
                    beginAtZero: true,
                    display: false
                },
                y: {
                    ticks: {
                        autoSkip: false, // Ensure all labels are displayed
                        font: {
                            size: 12
                        }
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            }
        }
    });

    // Function to calculate result and update Bar Chart
    function calculateResult(index) {
        const impactValue = parseFloat(document.getElementById(`impact${index}`).value) || 0;
        const likelihoodValue = parseFloat(document.getElementById(`likelihood${index}`).value) || 0;
        const result = impactValue * likelihoodValue;

        // Update hidden input and result text field
        document.getElementById(`result${index}`).value = result;
        const resultText = document.getElementById(`resultText${index}`);
        resultText.value = Math.floor(result);

        // Remove previous background classes
        resultText.classList.remove('bg-success-subtle', 'bg-warning-subtle', 'bg-danger-subtle');

        // Add appropriate background class based on result
        if (result >= 0 && result <= 6) {
            resultText.classList.add('bg-success-subtle');
        } else if (result > 6 && result <= 12) {
            resultText.classList.add('bg-warning-subtle');
        } else if (result > 12) {
            resultText.classList.add('bg-danger-subtle');
        }

        // Update Bar Chart
        updateBarChart();
    }

    // Function to update Bar Chart
    function updateBarChart() {
        const data = [];
        for (let i = 1; i <= 19; i++) {
            const result = parseFloat(document.getElementById(`result${i}`).value) || 0;
            data.push(result);
        }
        barChart.data.datasets[0].data = data;
        barChart.update();
    }

    // Attach event listeners to all number inputs
    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', function () {
            const index = this.id.replace('impact', '').replace('likelihood', '');
            calculateResult(index);
        });
    });
});
</script>
<style>
.chart-container {
    position: relative;
    margin: auto;
}
.bg-success-subtle {
    background-color: #d1e7dd !important;
}
.bg-warning-subtle {
    background-color: #fff3cd !important;
}
.bg-danger-subtle {
    background-color: #f8d7da !important;
}
.assessment-item {
    transition: transform 0.2s;
}
.assessment-item:hover {
    transform: translateY(-2px);
}
.form-check-input {
    cursor: pointer;
}
.form-check-label {
    cursor: pointer;
    user-select: none;
}
</style>
@endsection