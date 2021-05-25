@extends('layout.default')

@section('content')
<x-inputs.form-group for="name" label="{{ __('Name') }}" required="true">
    <x-inputs.text id="name" name="name" type="text" />
</x-inputs.form-group>
<x-inputs.form-group for="money" label="{{ __('Money') }}" required="true">
    <x-inputs.text id="money" name="money" type="text" data-mask="#.###" data-mask-reverse="true" />
</x-inputs.form-group>
<x-inputs.form-group for="example_select" label="{{ __('Select') }}" required="true">
    <x-inputs.select id="example_select" name="example_select">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </x-inputs.select>
</x-inputs.form-group>
<x-inputs.form-group for="example_select2" label="{{ __('Example Select2') }}" required="true">
    <x-inputs.select2 id="example_select2" name="example_select2">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </x-inputs.select2>
</x-inputs.form-group>
<x-inputs.form-group for="example_select2_multiple" label="{{ __('Example Select2 Multiple') }}" required="true">
    <x-inputs.select2 id="example_select2_multiple" name="example_select2_multiple" multiple>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </x-inputs.select2>
</x-inputs.form-group>
<x-inputs.form-group for="example_radio" label="{{ __('Example Radio') }}" required="true">
    <x-inputs.radio-group>
        <x-inputs.radio id="example_radio-1" name="example_radio" value="1" label="Option 1" />
        <x-inputs.radio id="example_radio-2" name="example_radio" value="2" label="Option 2" />
        <x-inputs.radio id="example_radio-3" name="example_radio" value="3" label="Option 3" />
        <x-inputs.radio id="example_radio-4" name="example_radio" value="4" label="Option 4" />
    </x-inputs.radio-group>
</x-inputs.form-group>
<x-inputs.form-group for="example_checkbox" label="{{ __('Example Checkbox') }}">
    <x-inputs.checkbox-group>
        <x-inputs.checkbox id="example_checkbox-1" name="example_checkbox" value="1" label="Option 1" />
        <x-inputs.checkbox id="example_checkbox-2" name="example_checkbox" value="2" label="Option 2" />
        <x-inputs.checkbox id="example_checkbox-3" name="example_checkbox" value="3" label="Option 3" />
        <x-inputs.checkbox id="example_checkbox-4" name="example_checkbox" value="4" label="Option 4" />
    </x-inputs.checkbox-group>
</x-inputs.form-group>
<x-inputs.form-group for="example_textarea" label="{{ __('Example Text Area') }}" required="true">
    <x-inputs.text-area id="example_textarea" name="example_textarea"></x-inputs.text-area>
</x-inputs.form-group>
<x-inputs.form-group for="example_datepicker" label="{{ __('Example Datepicker') }}" required="true">
    <x-inputs.datepicker id="example_datepicker" name="example_datepicker" disabledDay="0,6" />
</x-inputs.form-group>
<x-inputs.form-group for="example_daterangepicker" label="{{ __('Example Daterangepicker') }}" required="true">
    <x-inputs.daterangepicker id="example_daterangepicker" name="example_datepicker" start-date="2020-01-01"
        end-date="2020-02-07" />
</x-inputs.form-group>
<x-inputs.form-group for="example_timepicker" label="{{ __('Example Timepicker') }}" required="true">
    <x-inputs.timepicker id="example_timepicker" name="example_timepicker" />
</x-inputs.form-group>
<x-inputs.form-group for="example_switch" label="{{ __('Example Switch') }}">
    <x-inputs.checkbox-group>
        <x-inputs.switch id="example_switch" name="example_switch" size="small" checked />
    </x-inputs.checkbox-group>
</x-inputs.form-group>
@endsection
