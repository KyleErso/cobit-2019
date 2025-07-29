

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

    {{-- Hapus atau non‑aktifkan script coming‑soon jika tidak diperlukan --}}
@endauth