@props([
     'name', 'label' , 'options' , 'old_option'
])


<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="multicol-country">{{ $label }}</label>
    <div class="col-sm-10">
        <select id="multicol-country"
                name="{{ $name }}"
                data-allow-clear="true"
                {{ $attributes->class([
                              'select2',
                              'form-select',
                              'is-invalid' => $errors->has($name)
                             ])
               }}
        >
            <option disabled selected>-- Select Category Parent --</option>
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