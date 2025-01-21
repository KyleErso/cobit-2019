@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Design Factor 4</div>

                <div class="card-body">
                    <form action="{{ route('df4.store') }}" method="POST">
                        @csrf

                        <!-- Tambahkan input untuk df_id -->
                        <input type="hidden" name="df_id" value="{{ $id }}"> <!-- Mengambil $id yang dikirim dari controller -->

                        <!-- Field 1 -->
                        <div class="form-group text-center">
                            <label>Frustration between different IT entities across the organization because of a perception of low contribution to business value</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input1df4" id="input1df4_1" value="1" required>
                                    <label class="form-check-label" for="input1df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input1df4" id="input1df4_2" value="2">
                                    <label class="form-check-label" for="input1df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input1df4" id="input1df4_3" value="3">
                                    <label class="form-check-label" for="input1df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 2 -->
                        <div class="form-group text-center mt-3">
                            <label>Frustration between business departments (i.e., the IT customer) and the IT department because of failed initiatives or a perception of low contribution to business value</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input2df4" id="input2df4_1" value="1" required>
                                    <label class="form-check-label" for="input2df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input2df4" id="input2df4_2" value="2">
                                    <label class="form-check-label" for="input2df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input2df4" id="input2df4_3" value="3">
                                    <label class="form-check-label" for="input2df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 3 -->
                        <div class="form-group text-center mt-3">
                            <label>Significant IT-related incidents, such as data loss, security breaches, project failure and application errors, linked to IT</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input3df4" id="input3df4_1" value="1" required>
                                    <label class="form-check-label" for="input3df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input3df4" id="input3df4_2" value="2">
                                    <label class="form-check-label" for="input3df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input3df4" id="input3df4_3" value="3">
                                    <label class="form-check-label" for="input3df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 4 -->
                        <div class="form-group text-center mt-3">
                            <label>Service delivery problems by the IT outsourcer(s)</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input4df4" id="input4df4_1" value="1" required>
                                    <label class="form-check-label" for="input4df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input4df4" id="input4df4_2" value="2">
                                    <label class="form-check-label" for="input4df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input4df4" id="input4df4_3" value="3">
                                    <label class="form-check-label" for="input4df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 5 -->
                        <div class="form-group text-center mt-3">
                            <label>Failures to meet IT-related regulatory or contractual requirements</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input5df4" id="input5df4_1" value="1" required>
                                    <label class="form-check-label" for="input5df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input5df4" id="input5df4_2" value="2">
                                    <label class="form-check-label" for="input5df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input5df4" id="input5df4_3" value="3">
                                    <label class="form-check-label" for="input5df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 6 -->
                        <div class="form-group text-center mt-3">
                            <label>Regular audit findings or other assessment reports about poor IT performance or reported IT quality or service problems</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input6df4" id="input6df4_1" value="1" required>
                                    <label class="form-check-label" for="input6df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input6df4" id="input6df4_2" value="2">
                                    <label class="form-check-label" for="input6df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input6df4" id="input6df4_3" value="3">
                                    <label class="form-check-label" for="input6df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 7 -->
                        <div class="form-group text-center mt-3">
                            <label>Substantial hidden and rogue IT spending, that is, IT spending by user departments outside the control of the normal IT investment decision mechanisms and approved budgets</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input7df4" id="input7df4_1" value="1" required>
                                    <label class="form-check-label" for="input7df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input7df4" id="input7df4_2" value="2">
                                    <label class="form-check-label" for="input7df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input7df4" id="input7df4_3" value="3">
                                    <label class="form-check-label" for="input7df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 8 -->
                        <div class="form-group text-center mt-3">
                            <label>Duplications or overlaps between various initiatives, or other forms of wasted resources</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input8df4" id="input8df4_1" value="1" required>
                                    <label class="form-check-label" for="input8df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input8df4" id="input8df4_2" value="2">
                                    <label class="form-check-label" for="input8df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input8df4" id="input8df4_3" value="3">
                                    <label class="form-check-label" for="input8df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 9 -->
                        <div class="form-group text-center mt-3">
                            <label>Insufficient IT resources, staff with inadequate skills or staff burnout/dissatisfaction</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input9df4" id="input9df4_1" value="1" required>
                                    <label class="form-check-label" for="input9df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input9df4" id="input9df4_2" value="2">
                                    <label class="form-check-label" for="input9df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input9df4" id="input9df4_3" value="3">
                                    <label class="form-check-label" for="input9df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 10 -->
                        <div class="form-group text-center mt-3">
                            <label>IT-enabled changes or projects frequently failing to meet business needs and delivered late or over budget</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input10df4" id="input10df4_1" value="1" required>
                                    <label class="form-check-label" for="input10df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input10df4" id="input10df4_2" value="2">
                                    <label class="form-check-label" for="input10df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input10df4" id="input10df4_3" value="3">
                                    <label class="form-check-label" for="input10df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 11 -->
                        <div class="form-group text-center mt-3">
                            <label>Reluctance by board members, executives or senior management to engage with IT, or a lack of committed business sponsorship for IT</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input11df4" id="input11df4_1" value="1" required>
                                    <label class="form-check-label" for="input11df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input11df4" id="input11df4_2" value="2">
                                    <label class="form-check-label" for="input11df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input11df4" id="input11df4_3" value="3">
                                    <label class="form-check-label" for="input11df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 12 -->
                        <div class="form-group text-center mt-3">
                            <label>Complex IT operating model and/or unclear decision mechanisms for IT-related decisions</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input12df4" id="input12df4_1" value="1" required>
                                    <label class="form-check-label" for="input12df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input12df4" id="input12df4_2" value="2">
                                    <label class="form-check-label" for="input12df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input12df4" id="input12df4_3" value="3">
                                    <label class="form-check-label" for="input12df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 13 -->
                        <div class="form-group text-center mt-3">
                            <label>Excessively high cost of IT</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input13df4" id="input13df4_1" value="1" required>
                                    <label class="form-check-label" for="input13df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input13df4" id="input13df4_2" value="2">
                                    <label class="form-check-label" for="input13df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input13df4" id="input13df4_3" value="3">
                                    <label class="form-check-label" for="input13df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 14 -->
                        <div class="form-group text-center mt-3">
                            <label>Obstructed or failed implementation of new initiatives or innovations caused by the current IT architecture and systems</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input14df4" id="input14df4_1" value="1" required>
                                    <label class="form-check-label" for="input14df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input14df4" id="input14df4_2" value="2">
                                    <label class="form-check-label" for="input14df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input14df4" id="input14df4_3" value="3">
                                    <label class="form-check-label" for="input14df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 15 -->
                        <div class="form-group text-center mt-3">
                            <label>Gap between business and technical knowledge, which leads to business users and information and/or technology specialists speaking different languages</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input15df4" id="input15df4_1" value="1" required>
                                    <label class="form-check-label" for="input15df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input15df4" id="input15df4_2" value="2">
                                    <label class="form-check-label" for="input15df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input15df4" id="input15df4_3" value="3">
                                    <label class="form-check-label" for="input15df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 16 -->
                        <div class="form-group text-center mt-3">
                            <label>Regular issues with data quality and integration of data across various sources</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input16df4" id="input16df4_1" value="1" required>
                                    <label class="form-check-label" for="input16df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input16df4" id="input16df4_2" value="2">
                                    <label class="form-check-label" for="input16df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input16df4" id="input16df4_3" value="3">
                                    <label class="form-check-label" for="input16df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 17 -->
                        <div class="form-group text-center mt-3">
                            <label>High level of end-user computing, creating (among other problems) a lack of oversight and quality control over the applications that are being developed and put in operation</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input17df4" id="input17df4_1" value="1" required>
                                    <label class="form-check-label" for="input17df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input17df4" id="input17df4_2" value="2">
                                    <label class="form-check-label" for="input17df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input17df4" id="input17df4_3" value="3">
                                    <label class="form-check-label" for="input17df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 18 -->
                        <div class="form-group text-center mt-3">
                            <label>Business departments implementing their own information solutions with little or no involvement of the enterprise IT department (related to end-user computing, which often stems from dissatisfaction with IT solutions and services)</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input18df4" id="input18df4_1" value="1" required>
                                    <label class="form-check-label" for="input18df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input18df4" id="input18df4_2" value="2">
                                    <label class="form-check-label" for="input18df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input18df4" id="input18df4_3" value="3">
                                    <label class="form-check-label" for="input18df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 19 -->
                        <div class="form-group text-center mt-3">
                            <label>Ignorance of and/or noncompliance with privacy regulations</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input19df4" id="input19df4_1" value="1" required>
                                    <label class="form-check-label" for="input19df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input19df4" id="input19df4_2" value="2">
                                    <label class="form-check-label" for="input19df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input19df4" id="input19df4_3" value="3">
                                    <label class="form-check-label" for="input19df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Field 20 -->
                        <div class="form-group text-center mt-3">
                            <label>Inability to exploit new technologies or innovate using I&T</label>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input20df4" id="input20df4_1" value="1" required>
                                    <label class="form-check-label" for="input20df4_1">1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input20df4" id="input20df4_2" value="2">
                                    <label class="form-check-label" for="input20df4_2">2</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="input20df4" id="input20df4_3" value="3">
                                    <label class="form-check-label" for="input20df4_3">3</label>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection