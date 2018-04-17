@extends('layouts.master')

@section('title')
    Add organisation
@endsection

@section('styles')
    #result h1 {
        font-size: 1.6em;
    }
    #result {
        margin-left: -500px; <!-- horror bodge -->

    }
@endsection

@section('content')

    <h1>Add organisation</h1>

    <div class="row">
        <div class="w-100" id="form">
            {!! Form::open(['action' => 'OrganisationController@store', 'method' => 'POST']) !!}
                @include('organisations._form')
            {!! Form::close() !!}
        </div>
        <div class="float-left">
            <div id="result" class="position-absolute bg-white p-2 border w-25">
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'article-ckeditor', {
        customConfig: '/vendor/unisharp/laravel-ckeditor/my_config.js'
    });
</script>
<script>
    $(document).ready(function(){
        $('#result').hide();
        $('#name').keyup(function(){
            var searchTerms = $(this).val();
            if(searchTerms != ''){
                $.ajax({
                    url: '/organisation_search/' + searchTerms,
                    data: {
                        'searchTerms' : searchTerms,
                        '_token': '{!! csrf_token() !!}'
                    },
                    type: 'GET',
                    success: function(response) {
                        if(response != '') {
                            $('#result').html(response).show();
                            // $('#name').after("<div><p>Test</p></div>");
                        } else {
                            $('#result').html('').hide();
                        }
                    }
                });
            } else {
                $('#result').hide();
            }
        });
    });
</script>
@endsection
