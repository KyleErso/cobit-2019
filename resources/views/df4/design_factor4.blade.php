@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Card Utama -->
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow border-0 rounded">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Design Factor 4</h4>
                </div>
                <!-- Card Body -->
                <div class="card-body p-4">
                    <form id="df4Form" action="{{ route('df4.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="df_id" value="{{ $id }}">

                        @php
                            $labels = [
                                "Frustration between different IT entities across the organization",
                                "Frustration between business departments and the IT department",
                                "Significant IT-related incidents (e.g., data loss, security breaches)",
                                "Service delivery problems by IT outsourcers",
                                "Failures to meet IT-related regulatory or contractual requirements",
                                "Regular audit findings about poor IT performance",
                                "Substantial hidden and rogue IT spending",
                                "Duplications or overlaps causing wasted resources",
                                "Insufficient IT resources or staff dissatisfaction",
                                "IT-enabled projects failing to meet business needs",
                                "Reluctance by senior management to engage with IT",
                                "Complex IT operating model and unclear decision mechanisms",
                                "Excessively high IT costs",
                                "Obstructed implementation of new initiatives due to IT architecture",
                                "Gap between business and technical knowledge",
                                "Issues with data quality and integration across sources",
                                "High level of end-user computing causing oversight issues",
                                "Business units implementing IT solutions without enterprise IT involvement",
                                "Noncompliance with privacy regulations",
                                "Inability to exploit new technologies or innovate using IT"
                            ];
                        @endphp

                        <!-- Tabel mirip DF2 -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 5%;">#</th>
                                        <th scope="col">Issue Description</th>
                                        <th scope="col" style="width: 20%;">Rating (1-3)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($labels as $index => $label)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $label }}</td>
                                            <td>
                                                <div class="d-flex justify-content-evenly">
                                                    @for ($i = 1; $i <= 3; $i++)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input input-score" 
                                                                   type="radio" 
                                                                   name="input{{ $index+1 }}df4" 
                                                                   id="input{{ $index+1 }}df4_{{ $i }}" 
                                                                   value="{{ $i }}" required>
                                                            <label class="form-check-label small" 
                                                                   for="input{{ $index+1 }}df4_{{ $i }}">{{ $i }}</label>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Chart Container (Bar Chart) -->
                        <div class="row mb-4 mt-4">
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header text-center text-primary">
                                        DF4 Bar Chart
                                    </div>
                                    <div class="card-body" style="height: 400px;">
                                        <canvas id="barChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Submit Assessment</button>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div>
        </div>
    </div>
</div>

<!-- Sertakan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Labels ringkas untuk Bar Chart
    const df4Labels = [
        "Frustration: IT entities",
        "Frustration: Biz & IT",
        "IT incidents",
        "IT outsourcers",
        "Regulatory failures",
        "Audit findings",
        "Hidden IT spending",
        "Duplications/wasted",
        "Insufficient resources",
        "Projects failing",
        "Management reluctance",
        "Complex IT model",
        "High IT costs",
        "Obstructed initiatives",
        "Biz vs. technical gap",
        "Data quality issues",
        "High end-user computing",
        "Biz units do own IT",
        "Privacy noncompliance",
        "Lack of IT innovation"
    ];

    // Awal data = 0
    let scores = new Array(df4Labels.length).fill(0);

    // Inisialisasi Bar Chart
    const barChart = new Chart(document.getElementById('barChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: df4Labels,
            datasets: [{
                label: 'DF4 Score',
                data: scores,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',  // Horizontal bar
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
                    min: 0,
                    max: 3,
                    ticks: {
                        stepSize: 1
                    }
                },
                y: {
                    ticks: {
                        font: {
                            size: 12
                        },
                        autoSkip: false
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            }
        }
    });

    // Event Listener: Update Chart berdasarkan input radio
    document.querySelectorAll('.input-score').forEach(input => {
        input.addEventListener('change', function () {
            // Dapatkan index dari nama (misal: input1df4 => 1)
            let index = parseInt(this.name.replace('input', '').replace('df4', '')) - 1;
            scores[index] = parseInt(this.value);

            // Update chart data
            barChart.data.datasets[0].data = scores;
            barChart.update();
        });
    });
});
</script>
@endsection
