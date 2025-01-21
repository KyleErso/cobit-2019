@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Design Factor 7</div>

                <div class="card-body">

                    <!-- Form action pointing to the correct route -->
                    <form action="{{ route('df7.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="df_id" value="{{ $id }}">

                        <!-- 4 Input Fields for df7 -->
                        <div class="form-group">
                            <label for="input1df7">Field 1</label>
                            <input type="text" name="input1df7" id="input1df7" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input2df7">Field 2</label>
                            <input type="text" name="input2df7" id="input2df7" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input3df7">Field 3</label>
                            <input type="text" name="input3df7" id="input3df7" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input4df7">Field 4</label>
                            <input type="text" name="input4df7" id="input4df7" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection