<div class="form-group">
    {{Form::label('name', 'Name')}}
    {{Form::text('name', $organisation->name, ['class'=>'form-control', 'placeholder'=>'Organisation'])}}
</div>
<div class="form-group">
    {{Form::label('aims_and_activities', 'Aims and activities')}}
    {{Form::textarea('aims_and_activities', $organisation->aims_and_activities, [
        'id'=>'article-ckeditor',
        'class'=>'form-control',
        'placeholder'=>'Aims and activities'
        ])}}
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {{Form::label('line_1', 'Address')}}
        {{Form::text('line_1', $address->line_1, ['class'=>'form-control', 'placeholder'=>'First line of address'])}}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
            {{Form::label('line_2', 'Address 2')}}
            {{Form::text('line_2', $address->line_2, ['class'=>'form-control', 'placeholder'=>'Second line of address'])}}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-4">
        {{Form::label('city', 'Town or city')}}
        {{Form::text('city', $address->city, ['class'=>'form-control', 'placeholder'=>'City'])}}
    </div>
    <div class="form-group col-md-2">
        {{Form::label('postcode', 'Postcode')}}
        {{Form::text('postcode', $organisation->postcode, ['class'=>'form-control', 'placeholder'=>'Postcode'])}}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        {{Form::label('email', 'Email')}}
        {{Form::text('email', $organisation->email, ['class'=>'form-control', 'placeholder'=>'Email'])}}
    </div>
    <div class="form-group col-md-2">
        {{Form::label('telephone', 'Telephone')}}
        {{Form::text('telephone', $organisation->telephone, ['class'=>'form-control', 'placeholder'=>'Telephone'])}}
    </div>
</div>
<div class="row form-group">
    <div class="col-3">
        {{Form::label('income_band_id', 'Income band')}}

        {{-- how to make just the value conditional? --}}

        @if($organisation->income_band_id)
            {{Form::select('income_band_id', $income_bands, $organisation->income_band_id, ['class'=>'form-control'])}}
        @else
            {{Form::select('income_band_id', $income_bands, '6', ['class'=>'form-control'])}}
        @endif
    </div>
</div>


<fieldset class="form-group">
    <legend>
        Organisation type
    </legend>
    @foreach($organisation_types as $organisation_type)
        <div class="form-row">
            <div class="form-check col-6">
                {{Form::checkbox('organisation_type['.$organisation_type->id.'][id]',
                $organisation_type->id,
                null,
                ['class'=>'form-check-input', 'id'=>'type'.$organisation_type->id])}}
                <label class="form-check-label" for="type{{$organisation_type->id}}">
                  {{$organisation_type->name}}
                </label>
            </div>
            <div class="col-3">
                {{Form::text('organisation_type['.$organisation_type->id.'][reg_num]', null, ['class'=>'form-control', 'placeholder'=>'Number'])}}
            </div>
        </div>
    @endforeach
</fieldset>



{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
