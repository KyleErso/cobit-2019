@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Design Factor</div>

                <div class="card-body">
                    <form action="{{ route('df1.store') }}" method="POST">
                        @csrf

                        <!-- Tambahkan input untuk df_id -->
                        <input type="hidden" name="df_id" value="{{ $id }}"> <!-- Mengambil $id yang dikirim dari controller -->

                        <div class="form-group">
                            <label for="strategy_archetype">Strategy Archetype</label>
                            <input type="text" name="strategy_archetype" id="strategy_archetype" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="current_performance">Current Performance</label>
                            <input type="number" name="current_performance" id="current_performance" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="future_goals">Future Goals</label>
                            <input type="text" name="future_goals" id="future_goals" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="alignment_with_it">Alignment with IT</label>
                            <input type="text" name="alignment_with_it" id="alignment_with_it" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
