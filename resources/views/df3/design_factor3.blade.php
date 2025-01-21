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

                        <!-- Menambahkan input untuk df_id -->
                        <input type="hidden" name="df_id" value="{{ $id }}">

                        <!-- EG01 -->
                        <div class="form-group mt-3">
                            <label for="impact1">EG01—Portfolio of competitive products and services</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact1" name="impact1" placeholder="Impact" oninput="calculateResult('impact1', 'likelihood1', 'result1')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood1" name="likelihood1" placeholder="Likelihood" oninput="calculateResult('impact1', 'likelihood1', 'result1')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result1" name="input1df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG02 -->
                        <div class="form-group mt-3">
                            <label for="impact2">EG02—Customer satisfaction</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact2" name="impact2" placeholder="Impact" oninput="calculateResult('impact2', 'likelihood2', 'result2')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood2" name="likelihood2" placeholder="Likelihood" oninput="calculateResult('impact2', 'likelihood2', 'result2')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result2" name="input2df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG03 -->
                        <div class="form-group mt-3">
                            <label for="impact3">EG03—Market share</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact3" name="impact3" placeholder="Impact" oninput="calculateResult('impact3', 'likelihood3', 'result3')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood3" name="likelihood3" placeholder="Likelihood" oninput="calculateResult('impact3', 'likelihood3', 'result3')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result3" name="input3df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                      <!-- EG04 -->
                        <div class="form-group mt-3">
                            <label for="impact4">EG04—Description of item 4</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact4" name="impact4" placeholder="Impact" oninput="calculateResult('impact4', 'likelihood4', 'result4')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood4" name="likelihood4" placeholder="Likelihood" oninput="calculateResult('impact4', 'likelihood4', 'result4')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result4" name="input4df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG05 -->
                        <div class="form-group mt-3">
                            <label for="impact5">EG05—Description of item 5</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact5" name="impact5" placeholder="Impact" oninput="calculateResult('impact5', 'likelihood5', 'result5')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood5" name="likelihood5" placeholder="Likelihood" oninput="calculateResult('impact5', 'likelihood5', 'result5')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result5" name="input5df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG06 -->
                        <div class="form-group mt-3">
                            <label for="impact6">EG06—Description of item 6</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact6" name="impact6" placeholder="Impact" oninput="calculateResult('impact6', 'likelihood6', 'result6')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood6" name="likelihood6" placeholder="Likelihood" oninput="calculateResult('impact6', 'likelihood6', 'result6')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result6" name="input6df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG07 -->
                        <div class="form-group mt-3">
                            <label for="impact7">EG07—Description of item 7</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact7" name="impact7" placeholder="Impact" oninput="calculateResult('impact7', 'likelihood7', 'result7')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood7" name="likelihood7" placeholder="Likelihood" oninput="calculateResult('impact7', 'likelihood7', 'result7')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result7" name="input7df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG08 -->
                        <div class="form-group mt-3">
                            <label for="impact8">EG08—Description of item 8</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact8" name="impact8" placeholder="Impact" oninput="calculateResult('impact8', 'likelihood8', 'result8')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood8" name="likelihood8" placeholder="Likelihood" oninput="calculateResult('impact8', 'likelihood8', 'result8')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result8" name="input8df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG09 -->
                        <div class="form-group mt-3">
                            <label for="impact9">EG09—Description of item 9</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact9" name="impact9" placeholder="Impact" oninput="calculateResult('impact9', 'likelihood9', 'result9')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood9" name="likelihood9" placeholder="Likelihood" oninput="calculateResult('impact9', 'likelihood9', 'result9')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result9" name="input9df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG10 -->
                        <div class="form-group mt-3">
                            <label for="impact10">EG10—Description of item 10</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact10" name="impact10" placeholder="Impact" oninput="calculateResult('impact10', 'likelihood10', 'result10')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood10" name="likelihood10" placeholder="Likelihood" oninput="calculateResult('impact10', 'likelihood10', 'result10')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result10" name="input10df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG11 -->
                        <div class="form-group mt-3">
                            <label for="impact11">EG11—Description of item 11</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact11" name="impact11" placeholder="Impact" oninput="calculateResult('impact11', 'likelihood11', 'result11')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood11" name="likelihood11" placeholder="Likelihood" oninput="calculateResult('impact11', 'likelihood11', 'result11')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result11" name="input11df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG12 -->
                        <div class="form-group mt-3">
                            <label for="impact12">EG12—Description of item 12</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact12" name="impact12" placeholder="Impact" oninput="calculateResult('impact12', 'likelihood12', 'result12')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood12" name="likelihood12" placeholder="Likelihood" oninput="calculateResult('impact12', 'likelihood12', 'result12')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result12" name="input12df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG13 -->
                        <div class="form-group mt-3">
                            <label for="impact13">EG13—Description of item 13</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact13" name="impact13" placeholder="Impact" oninput="calculateResult('impact13', 'likelihood13', 'result13')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood13" name="likelihood13" placeholder="Likelihood" oninput="calculateResult('impact13', 'likelihood13', 'result13')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result13" name="input13df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG14 -->
                        <div class="form-group mt-3">
                            <label for="impact14">EG14—Description of item 14</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact14" name="impact14" placeholder="Impact" oninput="calculateResult('impact14', 'likelihood14', 'result14')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood14" name="likelihood14" placeholder="Likelihood" oninput="calculateResult('impact14', 'likelihood14', 'result14')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result14" name="input14df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG15 -->
                        <div class="form-group mt-3">
                            <label for="impact15">EG15—Description of item 15</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact15" name="impact15" placeholder="Impact" oninput="calculateResult('impact15', 'likelihood15', 'result15')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood15" name="likelihood15" placeholder="Likelihood" oninput="calculateResult('impact15', 'likelihood15', 'result15')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result15" name="input15df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG16 -->
                        <div class="form-group mt-3">
                            <label for="impact16">EG16—Description of item 16</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact16" name="impact16" placeholder="Impact" oninput="calculateResult('impact16', 'likelihood16', 'result16')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood16" name="likelihood16" placeholder="Likelihood" oninput="calculateResult('impact16', 'likelihood16', 'result16')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result16" name="input16df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG17 -->
                        <div class="form-group mt-3">
                            <label for="impact17">EG17—Description of item 17</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact17" name="impact17" placeholder="Impact" oninput="calculateResult('impact17', 'likelihood17', 'result17')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood17" name="likelihood17" placeholder="Likelihood" oninput="calculateResult('impact17', 'likelihood17', 'result17')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result17" name="input17df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG18 -->
                        <div class="form-group mt-3">
                            <label for="impact18">EG18—Description of item 18</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact18" name="impact18" placeholder="Impact" oninput="calculateResult('impact18', 'likelihood18', 'result18')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood18" name="likelihood18" placeholder="Likelihood" oninput="calculateResult('impact18', 'likelihood18', 'result18')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result18" name="input18df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- EG19 -->
                        <div class="form-group mt-3">
                            <label for="impact19">EG19—Description of item 19</label>
                            <div class="row">
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="impact19" name="impact19" placeholder="Impact" oninput="calculateResult('impact19', 'likelihood19', 'result19')">
                                </div>
                                <div class="col mb-2">
                                    <input type="number" class="form-control" id="likelihood19" name="likelihood19" placeholder="Likelihood" oninput="calculateResult('impact19', 'likelihood19', 'result19')">
                                </div>
                                <div class="col mb-2">
                                    <input type="hidden" id="result19" name="input19df3">
                                    <input type="text" class="form-control" placeholder="Result" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol submit -->
                        <div class="form-group mt-4 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function calculateResult(impactId, likelihoodId, resultId) {
        var impact = parseFloat(document.getElementById(impactId).value) || 0;
        var likelihood = parseFloat(document.getElementById(likelihoodId).value) || 0;
        var result = impact * likelihood;
        document.getElementById(resultId).value = result;
        document.querySelector(`#${resultId}`).nextElementSibling.value = result.toFixed(2);
    }
</script>

@endsection
