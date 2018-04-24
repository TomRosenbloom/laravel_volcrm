@extends('layouts.master')

@section('title')
    Add organisation
@endsection

@section('styles')
    #name-input {
        position: relative;
    }
    #matches {
        position: absolute;
        z-index: 999;
        background-color: white;
        padding: 0 10px 0 10px;
        margin: 0 0 0 1px;
        border: 1px solid #ced4da;
        width: 500px;
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
        $('#matches').hide();
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
                            $('#matches').html(response).show();  // hmm...
                                                           // Plus, need to make this float over the rest of the form
                                                           // rather than pushing it down
                        } else {
                            $('#matches').hide();
                        }
                    }
                });
            } else {
                $('#matches').hide();
            }
        });
    });
</script>
@endsection
