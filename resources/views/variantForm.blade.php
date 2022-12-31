@php
    use App\Models\Tag;
    use App\Models\Variant;
    /** @var Variant $variant */
    /** @var array $tags */

    $variant_title = !empty(old('variant-title')) ? old('variant-title') : (isset($variant) ? $variant->title : '');
    $reference = !empty(old('reference')) ? old('reference') : (isset($variant) ? $variant->reference : '');
    $footprint = !empty(old('footprint')) ? old('footprint') : (isset($variant) ? $variant->footprint : '');
    $fk_footprintUnitID = !empty(old('fk_footprintUnitID')) ? old('fk_footprintUnitID') : (isset($variant) ? $variant->fk_footprintUnitID : '');
    $tags = !empty(old('tags')) ? old('tags') : (isset($tags) ? Tag::renderString($tags) : '');
    $fk_verifyingGradeID = !empty(old('fk_verifyingGradeID')) ? old('fk_verifyingGradeID') : (isset($variant) ? $variant->fk_verifyingGradeID : '');
@endphp
<h5>Variant info</h5>
<label class="form-label" for="variant-title">Product variant: </label>
<input class="form-control" type="text" name="variant-title" placeholder="Product variant" id="variant-title"
       value="{{$variant_title}}">
@foreach($errors->get('variant-title') as $error)
    {{$error}}<br>
@endforeach
<br>
<label class="form-label" for="reference">Product reference: </label>
<input class="form-control" type="text" name="reference" placeholder="GTIN or internal reference, given to suppliers"
       id="reference"
       value="{{$reference}}">
@foreach($errors->get('reference') as $error)
    {{$error}}<br>
@endforeach
<br>
<label class="form-label" for="footprint">CO2 equivalent: </label>
<div class="input-group">
    <input class="form-control w-75" type="number" name="footprint" placeholder="CO2 equivalents as decimal value"
           id="footprint"
           value="{{$footprint}}">
    <select class="form-select w-25 input-group-text" name="fk_footprintUnitID" id="fk_footprintUnitID"
            aria-label="footprintUnit">
        @foreach($footprintUnits as $footprintUnit)
            <option value="{{$footprintUnit->getKey()}}"
                    title="{{$footprintUnit->title}}" {{$footprintUnit->getKey() == $fk_footprintUnitID ? 'selected' : ''}}>{{$footprintUnit->unit}}</option>
        @endforeach
    </select>
</div>
@foreach($errors->get('footprint') as $error)
    {{$error}}<br>
@endforeach
@foreach($errors->get('fk_footprintUnitID') as $error)
    {{$error}}<br>
@endforeach
<br>
<label class="form-label" for="tags">Tags: </label>
<input class="form-control" type="text" name="tags" placeholder="tag1: value1, tag2: value2, tag3..." id="tags"
       value="{{$tags}}">
@foreach($errors->get('tags') as $error)
    {{$error}}<br>
@endforeach
<br>
<label class="form-label" for="fk_verifyingGradeID">Verifying grade: </label>
<select class="form-select" name="fk_verifyingGradeID" id="fk_verifyingGradeID">
    @foreach($verifyingGrades as $verifyingGrade)
        <option
            value="{{$verifyingGrade->getKey()}}" {{$verifyingGrade->getKey() == $fk_verifyingGradeID ? 'selected' : ''}}>{{$verifyingGrade->title}}
            - {{$verifyingGrade->grade}}</option>
    @endforeach
</select>
@foreach($errors->get('fk_verifyingGradeID') as $error)
    {{$error}}<br>
@endforeach
