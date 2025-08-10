<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        $validasiAktif = session('jabatan_df_middleware_enabled', true);
    @endphp

    <div class="container-fluid d-flex justify-content-center" id="paginationContainer" data-current-df="{{ $currentDF }}">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm">
                {{-- Prev --}}
                <li class="page-item {{ $currentDF == 1 ? 'disabled' : '' }}">
                    <a class="page-link" data-df="{{ $currentDF - 1 }}"
                        href="{{ $currentDF == 1 ? '#' : route('df' . ($currentDF - 1) . '.form', ['id' => $currentDF - 1]) }}">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                {{-- DF1–DF10 + Canvas di i == 11 --}}
                @for ($i = 1; $i <= 11; $i++)
                    @if ($i <= 10)
                        @php $isActive = (Route::currentRouteName() == 'df' . $i . '.form'); @endphp
                        <li class="page-item {{ $isActive ? 'active' : '' }}">
                            <a class="page-link" data-df="{{ $i }}" href="{{ route('df' . $i . '.form', ['id' => $i]) }}">
                                DF {{ $i }}
                            </a>
                        </li>

                        @if ($i == 4)
                            <li class="page-item {{ Route::currentRouteName() == 'step2.index' ? 'active' : '' }}">
                                <a class="page-link" href="{{ route('step2.index') }}">
                                    Summary Step2
                                </a>
                            </li>
                        @endif

                        @if ($i == 10)
                            <li class="page-item {{ Route::currentRouteName() == 'step3.index' ? 'active' : '' }}">
                                <a class="page-link" href="{{ route('step3.index') }}">
                                    Summary Step3
                                </a>
                            </li>
                        @endif

                    @else
                        {{-- i == 11: Canvas --}}
                        <li class="page-item {{ Route::currentRouteName() == 'step4.index' ? 'active' : '' }}">
                            <a class="page-link" href="{{ route('step4.index') }}">
                                Canvas
                            </a>
                        </li>
                    @endif
                @endfor

                {{-- Next --}}
                <li class="page-item {{ $currentDF == 10 ? 'disabled' : '' }}">
                    <a class="page-link" data-df="{{ $currentDF + 1 }}"
                        href="{{ $currentDF == 10 ? '#' : route('df' . ($currentDF + 1) . '.form', ['id' => $currentDF + 1]) }}">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="mb-2 text-center">
        <form action="{{ route('akses-df.toggle') }}" method="get" style="display:inline;">
            <div class="form-check form-switch d-inline-flex align-items-center mb-2">
                <input class="form-check-input" type="checkbox" id="validasiJabatanSwitch"
                    name="validasiJabatanSwitch"
                    onchange="this.form.submit()" {{ $validasiAktif ? 'checked' : '' }}>
                <label class="form-check-label ms-2 small" for="validasiJabatanSwitch">
                    {{ $validasiAktif ? 'Validasi Jabatan Aktif' : 'Validasi Jabatan Nonaktif' }}
                </label>
            </div>
        </form>

        @if(session('show_alert'))
            @if($validasiAktif)
                <div class="alert alert-info alert-dismissible fade show py-1 px-2 small" role="alert">
                    <i class="fas fa-info-circle me-1"></i>
                    Anda hanya punya akses ke DF sesuai jabatan.
                </div>
            @else
                <div class="alert alert-warning alert-dismissible fade show py-1 px-2 small" role="alert">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Dengan menonaktifkan validasi jabatan, Anda akan memiliki akses ke DF 1 sampai 10.
                </div>
            @endif
        @endif
    </div>

    @if(session('jabatan_warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Akses Ditolak',
            text: '{{ session('jabatan_warning') }}',
            confirmButtonText: 'OK'
        });
    </script>
    @endif
@endauth
