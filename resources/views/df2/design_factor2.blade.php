@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Design Factor 2</div>

                <div class="card-body">
                    <form action="{{ route('df2.store') }}" method="POST">
                        @csrf

                        <!-- Menambahkan input untuk df_id -->
                        <input type="hidden" name="df_id" value="{{ $id }}"> <!-- Mengambil $id yang dikirim dari controller -->

                        <!-- 13 Input Fields untuk DF2 -->
                        <div class="form-group mt-3">
                            <label for="input1df2">EG01—Portfolio of competitive products and services</label>
                            <input type="number" name="input1df2" id="input1df2" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input2df2">EG02—Managed business risk</label>
                            <input type="number" name="input2df2" id="input2df2" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input3df2">EG03—Compliance with external laws and regulations </label>
                            <input type="number" name="input3df2" id="input3df2" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input4df2">EG04—Quality of financial information</label>
                            <input type="number" name="input4df2" id="input4df2" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input5df2">EG05—Customer-oriented service culture </label>
                            <input type="number" name="input5df2" id="input5df2" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input6df2">EG06—Business-service continuity and availability </label>
                            <input type="number" name="input6df2" id="input6df2" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input7df2">EG07—Quality of management information </label>
                            <input type="number" name="input7df2" id="input7df2" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input8df2">EG08—Optimization of internal business process functionality	</label>
                            <input type="number" name="input8df2" id="input8df2" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input9df2">EG09—Optimization of business process costs	</label>
                            <input type="number" name="input9df2" id="input9df2" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input10df2">EG10—Staff skills, motivation and productivity </label>
                            <input type="number" name="input10df2" id="input10df2" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input11df2">EG11—Compliance with internal policies </label>
                            <input type="number" name="input11df2" id="input11df2" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input12df2">EG12—Managed digital transformation programs </label>
                            <input type="number" name="input12df2" id="input12df2" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="input13df2">EG13—Product and business innovation </label>
                            <input type="number" name="input13df2" id="input13df2" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
