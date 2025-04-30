@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Raw Dump for Assessment #{{ $assessment->assessment_id }}</h3>

  <pre style="background:#f8f9fa; padding:1rem; border:1px solid #ddd; overflow:auto; white-space:pre-wrap;">
{!! json_encode($assessment->toArray(), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!}
  </pre>
</div>
@endsection
