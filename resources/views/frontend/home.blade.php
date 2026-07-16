@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/le-almmora-home.css') }}?v={{ file_exists(public_path('css/le-almmora-home.css')) ? filemtime(public_path('css/le-almmora-home.css')) : time() }}">
@endsection

@section('content')
<main class="le-almmora-home">

    @include('partial.frontend.homepage.hero')
    @include('partial.frontend.homepage.brand-introduction')
    @include('partial.frontend.homepage.featured-product')
    @include('partial.frontend.homepage.why-choose-us')
    @include('partial.frontend.homepage.trust')
    @include('partial.frontend.homepage.trust-strip')
    @include('partial.frontend.homepage.visual-gallery')
    @include('partial.frontend.homepage.newsletter')

    <div class="modal fade birthday_popup" id="birthday_popup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="justify-content: center;">
            <div class="modal-content" style="background-color: #fff;">
                <div class="modal-header">
                    <div class="modal-title">
                        <h4><b>{{ isset($data['lang']['lang']['birthday_popup']) ? $data['lang']['lang']['birthday_popup'] : 'Birthday Popup'}}</b></h4>
                    </div>
                    <a href="#" class="close-modal">
                        x
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! $setting->birthday_popup !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ isset($data['lang']['lang']['close']) ? $data['lang']['lang']['close'] : 'Close'}}</button>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection

@section('js')
{{-- @if($birth_month_today)
    <script>
        $(document).ready(function() {
            $('#birthday_popup').modal('show');
        });
    </script>
@endif --}}

<script src="{{ asset('js/le-almmora-home.js') }}?v={{ file_exists(public_path('js/le-almmora-home.js')) ? filemtime(public_path('js/le-almmora-home.js')) : time() }}"></script>
@endsection
