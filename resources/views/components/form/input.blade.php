<div>
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
    @props([
        'type'=>'text' , 'name'=>'' , 'value'=>'' , 'label'=> false
    ])

@if ($label)
<label for="">{{ $label }}</label>

@endif

    <input
    type="{{ $type}}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    {{ $attributes->class([

        'form-control',
        'is-invalid'=> $errors->has($name)
    ]) }}>

        @error('name')
            <div class="text-danger">
                {{-- {{ $errors->first('name') }} --}}
                {{ $message }}
            </div>
        @enderror

</div>
