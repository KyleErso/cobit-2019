@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Card Utama -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow border-0 rounded">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Design Factor 3 - Risk Profile</h4>
                </div>
                <!-- Card Body -->
                <div class="card-body p-4">
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

                        <!-- Tabel Risk Assessment -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 5%;">Refrence</th>
                                        <th scope="col">Risk Category</th>
                                        <th scope="col" style="width: 15%;">Impact</th>
                                        <th scope="col" style="width: 15%;">Likelihood</th>
                                        <th scope="col" style="width: 15%;">Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($labels as $index => $label)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-primary fw-bold">
                                                {{ $label }}
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" id="impact{{ $index + 1 }}" 
                                                    name="impact{{ $index + 1 }}" placeholder="Impact" 
                                                    oninput="calculateResult({{ $index + 1 }})">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" id="likelihood{{ $index + 1 }}" 
                                                    name="likelihood{{ $index + 1 }}" placeholder="Likelihood" 
                                                    oninput="calculateResult({{ $index + 1 }})">
                                            </td>
                                            <td>
                                                <!-- Hidden input untuk menyimpan value numeric -->
                                                <input type="hidden" id="result{{ $index + 1 }}" name="input{{ $index + 1 }}df3">
                                                <!-- Textbox hanya untuk menampilkan nilai -->
                                                <input type="text" class="form-control" id="resultText{{ $index + 1 }}" 
                                                    placeholder="Result" readonly>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Grafik Input Score -->
                        <div class="row mt-4">
                            <!-- Bar Chart Input Score -->
                            <div class="mb-3">
                                <div class="card h-100">
                                    <div class="card-header text-center">Bar Chart Input Score</div>
                                    <div class="card-body">
                                        <div class="w-100" style="height: 400px;">
                                            <canvas id="barChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Layout: Relative Importance -->
                        <div class="row mt-4">
                            <!-- Relative Importance Radar Chart -->
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-header text-center text-primary">
                                        Relative Importance (Radar Chart)
                                    </div>
                                    <div class="card-body">
                                        <div class="w-100" style="height: 400px;">
                                            <canvas id="relativeImportanceRadarChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Relative Importance Table -->
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-header text-center text-primary">
                                        Relative Importance Table
                                    </div>
                                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                                        <table class="table table-bordered table-sm" id="results-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center text-primary">Index</th>
                                                    <th class="text-center text-primary">DF2 Score</th>
                                                    <th class="text-center text-primary">Relative Importance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data akan diisi oleh JavaScript -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Relative Importance Bar Chart -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header text-center text-primary">
                                        Relative Importance (Bar Chart)
                                    </div>
                                    <div class="card-body">
                                        <div class="w-100" style="height: 700px;">
                                            <canvas id="relativeImportanceChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                data: new Array(19).fill(0),
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
                    max: 25,
                    beginAtZero: true,
                    display: false
                },
                y: {
                    ticks: {
                        autoSkip: false,
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

    // Fungsi untuk menghitung hasil dan memperbarui Bar Chart
    function calculateResult(index) {
        const impactValue = parseFloat(document.getElementById(`impact${index}`).value) || 0;
        const likelihoodValue = parseFloat(document.getElementById(`likelihood${index}`).value) || 0;
        const result = impactValue * likelihoodValue;

        // Update hidden input dan tampilan hasil
        document.getElementById(`result${index}`).value = result;
        const resultText = document.getElementById(`resultText${index}`);
        resultText.value = Math.floor(result);

        resultText.classList.remove('bg-success-subtle', 'bg-warning-subtle', 'bg-danger-subtle');
        if (result >= 0 && result <= 6) {
            resultText.classList.add('bg-success-subtle');
        } else if (result > 6 && result <= 12) {
            resultText.classList.add('bg-warning-subtle');
        } else if (result > 12) {
            resultText.classList.add('bg-danger-subtle');
        }

        updateBarChart();
    }

    // Fungsi untuk memperbarui data pada Bar Chart
    function updateBarChart() {
        const data = [];
        for (let i = 1; i <= 19; i++) {
            const result = parseFloat(document.getElementById(`result${i}`).value) || 0;
            data.push(result);
        }
        barChart.data.datasets[0].data = data;
        barChart.update();
    }

    // Pasang event listener pada setiap input angka
    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', function () {
            const index = this.id.replace('impact', '').replace('likelihood', '');
            calculateResult(index);
        });
    });
});
</script>
@endsection
