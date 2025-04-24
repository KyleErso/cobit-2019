@auth
@php
    // Tentukan DF yang sedang aktif berdasarkan route name
    $currentDF = 1;
    for ($i = 1; $i <= 10; $i++) {
        if (Route::currentRouteName() == 'df' . $i . '.form') {
            $currentDF = $i;
            break;
        }
    }
@endphp

<!-- Container Pagination dengan atribut data-current-df -->
<div class="container-fluid d-flex justify-content-center" id="paginationContainer" data-current-df="{{ $currentDF }}">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm">
            {{-- Tombol Previous --}}
            <li class="page-item {{ $currentDF == 1 ? 'disabled' : '' }}">
                <a class="page-link" data-df="{{ $currentDF - 1 }}" 
                   href="{{ $currentDF == 1 ? '#' : route('df' . ($currentDF - 1) . '.form', ['id' => $currentDF - 1]) }}"
                   aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            {{-- Loop DF1 sampai DF10 --}}
            @for ($i = 1; $i <= 10; $i++)
                @if ($currentDF == $i)
                    <li class="page-item active" aria-current="page">
                        <span class="page-link" data-df="{{ $i }}">DF {{ $i }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" data-df="{{ $i }}" href="{{ route('df' . $i . '.form', ['id' => $i]) }}">
                            DF {{ $i }}
                        </a>
                    </li>
                @endif

                {{-- Setelah DF4 tambahkan tombol Summary Step2 --}}
                @if ($i == 4)
                    <li class="page-item">
                        <a class="page-link coming-soon-btn" href="#">Summary Step2</a>
                    </li>
                @endif

                {{-- Setelah DF10 tambahkan tombol Summary Step3 --}}
                @if ($i == 10)
                    <li class="page-item">
                        <a class="page-link coming-soon-btn" href="#">Summary Step3</a>
                    </li>
                @endif
            @endfor

            {{-- Tombol Canvas --}}
            <li class="page-item">
                <a class="page-link coming-soon-btn" href="#">Canvas</a>
            </li>

            {{-- Tombol Next --}}
            <li class="page-item {{ $currentDF == 10 ? 'disabled' : '' }}">
                <a class="page-link" data-df="{{ $currentDF + 1 }}" 
                   href="{{ $currentDF == 10 ? '#' : route('df' . ($currentDF + 1) . '.form', ['id' => $currentDF + 1]) }}"
                   aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- SweetAlert dan Script Coming Soon -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.coming-soon-btn').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Coming Soon!',
                    text: 'Fitur ini akan tersedia di versi selanjutnya.',
                    icon: 'info',
                    confirmButtonText: 'Oke'
                });
            });
        });
    });
</script>
@endauth
