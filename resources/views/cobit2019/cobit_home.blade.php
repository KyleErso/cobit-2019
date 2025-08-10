@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;
    use App\Models\Assessment;

    // Pastikan user sudah login
    if (! Auth::check()) {
        header('Location: ' . route('login'));
        exit;
    }

    $user = Auth::user();
    $org  = $user->organisasi;

    // Ambil request dari JSON
    $requests = Storage::exists('requests.json')
        ? collect(json_decode(Storage::get('requests.json'), true))
        : collect();

    // Build query Assessment
    $query = Assessment::query();
    if (! empty($org)) {
        $query->where('instansi', 'like', '%' . $org . '%');
    }

    // Filter kode via GET?kode=
    $kodeFilter = request('kode');
    if (! empty($kodeFilter)) {
        $query->where('kode_assessment', 'like', '%' . $kodeFilter . '%');
    }

    // Sort via GET?sort=terbaru|terlama
    $sort = request('sort', 'terbaru');
    $query->orderBy('created_at', $sort === 'terlama' ? 'asc' : 'desc');

    $assessments = $query->get();
@endphp

<div class="container">
  <div class="row justify-content-center g-4">
    {{-- Main Card --}}
    <div class="col-md-8">
      <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
        <div class="card-header bg-primary text-white text-center py-4">
          <h3 class="mb-0 fw-semibold">COBIT 2019 Tools</h3>
        </div>
        <div class="card-body p-4 p-xl-5">
          {{-- Judul + Tombol Assessment --}}
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold text-primary m-0">Create New Design Factor Entry</h5>
            <button id="startDefaultBtn" class="btn btn-outline-success">
              <i class="fas fa-clipboard-list me-1"></i>Assessment
            </button>
          </div>

          {{-- Alert error --}}
          @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          {{-- Jika user belum punya organisasi --}}
          @if(empty($org))
            <div class="alert alert-warning text-center mb-4">
              Maaf, Anda belum tergabung dengan organisasi mana pun.<br>
              Silakan hubungi admin terkait untuk mendapatkan akses.
            </div>
          @else
            {{-- Form filter & sort --}}
            <form action="{{ url()->current() }}" method="GET" class="row g-3 mb-4">
              <div class="col-md-6">
                <div class="input-group">
                  <input
                    type="text"
                    name="kode"
                    class="form-control"
                    placeholder="Filter berdasarkan kode..."
                    value="{{ request('kode') }}"
                  >
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter me-1"></i>Cari
                  </button>
                </div>
              </div>
              <div class="col-md-4">
                <select name="sort" class="form-select" onchange="this.form.submit()">
                  <option value="terbaru" {{ $sort === 'terbaru' ? 'selected' : '' }}>Urutkan: Terbaru</option>
                  <option value="terlama" {{ $sort === 'terlama' ? 'selected' : '' }}>Urutkan: Terlama</option>
                </select>
              </div>
              <div class="col-md-2 d-grid">
                <a href="{{ url()->current() }}" class="btn btn-outline-danger">
                  <i class="fas fa-times me-1"></i>Reset
                </a>
              </div>
            </form>

            {{-- List Assessments --}}
            @if($assessments->isEmpty())
              @if(! empty($kodeFilter))
                <div class="alert alert-warning text-center mb-4">
                  <i class="fas fa-exclamation-triangle me-2"></i>
                  Kode “{{ $kodeFilter }}” tidak ditemukan.
                </div>
              @else
                <p class="text-center text-muted">Belum ada assessment yang cocok dengan organisasi Anda.</p>
              @endif
            @else
              <div class="list-group mb-4">
                @foreach($assessments as $assessment)
                  @php
                    $entry = $requests->first(fn($r) =>
                      $r['user_id'] === $user->id && $r['assessment_id'] === $assessment->id
                    );
                    $status = $entry['status'] ?? null;
                  @endphp

                  <div class="list-group-item d-flex justify-content-between align-items-center mb-2">
                    <div>
                      <strong>{{ $assessment->kode_assessment }}</strong><br>
                      <small class="text-secondary">{{ $assessment->instansi }}</small><br>
                      <small class="text-muted">
                        {{ $assessment->created_at->translatedFormat('d M Y, H:i') }}
                      </small>
                    </div>

                    <div class="text-end">
                      {{-- Belum request --}}
                      @if(is_null($status))
                        <form method="POST" action="{{ route('assessment.request') }}" class="d-inline">
                          @csrf
                          <input type="hidden" name="kode_assessment" value="{{ $assessment->kode_assessment }}">
                          <button type="submit" class="btn btn-sm btn-warning">
                            <i class="fas fa-paper-plane me-1"></i>Request
                          </button>
                        </form>

                      {{-- Pending --}}
                      @elseif($status === 'pending')
                        <button class="btn btn-sm btn-warning" disabled>
                          <i class="fas fa-hourglass-half me-1"></i>Pending
                        </button>

                      {{-- Approved --}}
                      @elseif($status === 'approved')
                        <form method="POST" action="{{ route('assessment.join.store') }}" class="d-inline">
                          @csrf
                          <input type="hidden" name="kode_assessment" value="{{ $assessment->kode_assessment }}">
                          <button type="submit" class="btn btn-sm btn-success">
                            <i class="fas fa-sign-in-alt me-1"></i>Join
                          </button>
                        </form>
                      @endif
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
          @endif
        </div>

        {{-- Footer --}}
        <div class="card-footer text-center py-3 bg-opacity-5">
          <small class="text-muted d-block mb-1">Butuh bantuan? Hubungi kami melalui:</small>
          <a href="https://wa.me/6287779511667?text=Halo%20saya%20ingin%20bertanya%20tentang%20COBIT2019"
             target="_blank"
             class="btn btn-sm btn-success px-4 shadow-sm">
            <i class="fab fa-whatsapp me-2"></i>WhatsApp
          </a>
        </div>
      </div>
    </div>

    {{-- Calendar Card --}}
    <div class="col-md-4">
      <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
        <div class="card-header bg-primary text-white text-center py-3">
          <h5 class="mb-0 fw-semibold">Kalender</h5>
        </div>
        <div class="card-body p-4">
          <div class="text-center mb-4">
            <div class="datetime-container bg-primary bg-opacity-10 p-3 rounded-3 border border-primary border-opacity-25">
              <div class="display-4 fw-bold text-primary mb-0" id="current-time"></div>
              <div class="h5 text-secondary mb-1" id="current-day"></div>
              <div class="text-muted" id="current-date"></div>
            </div>
          </div>
          <div id="calendar" class="border-primary border-opacity-25 rounded-3"></div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Styles --}}
<style>
.display-4 {
  font-size: 2.5rem;
  font-weight: 700;
}
.datetime-container {
  background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}
</style>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/id.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Tombol "Assessment" set cookie dan redirect
    document.getElementById('startDefaultBtn').addEventListener('click', function() {
      document.cookie = "assessment_id=1; path=/";
      document.cookie = "instansi=Default Instansi; path=/";
      window.location.href = "{{ route('df1.form', ['id' => Auth::id()]) }}";
    });

      // Update time setiap detik
      function updateTime() {
        const now = new Date();
        document.getElementById('current-time').textContent =
          now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        document.getElementById('current-date').textContent =
          now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
        document.getElementById('current-day').textContent =
          now.toLocaleDateString('id-ID', { weekday: 'long' });
      }
      setInterval(updateTime, 1000);
      updateTime();

  });

  
</script>
@endsection
