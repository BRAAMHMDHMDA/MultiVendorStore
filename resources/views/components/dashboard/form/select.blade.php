@props([
     'name', 'label' => '' , 'options' , 'old_option'
])


<div class="row">
    @if($label !== '')
        <label class="col-sm-2 col-form-label" for="{{ $name }}">{{ $label }}</label>
    @endif
    <div @if($label != '')class="col-sm-9"@endif>
        <select id="{{ $name }}"
                name="{{ $name }}"
                data-allow-clear="false"
                {{ $attributes->class([
                              'select2',
                              'form-select',
                              'is-invalid' => $errors->has($name)
                             ])
               }}
        >
            <option disabled selected>-- Select {{ $label }} --</option>
            @foreach($options as $option)
                <option value="{{ $option->id }}" @selected(old("$name", $old_option) == $option->id)>{{ $option->name }}</option>
            @endforeach
        </select>
        @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>