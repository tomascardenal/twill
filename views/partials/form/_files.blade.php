@php
    $type = $type ?? 'file';
    $max = $max ?? 1;
    $itemLabel = $itemLabel ?? strtolower($label);
    $note = $note ?? 'Add' . ($max > 1 ? " up to $max $itemLabel" : ' one ' . Str::singular($itemLabel));
    $fieldNote = $fieldNote ?? '';
    $filesizeMax = $filesizeMax ?? 0;
    $addLabelValue = $addLabelValue ?? twillTrans('twill::lang.fields.files.add-label');
@endphp

<a17-locale
    type="a17-filefield"
    :attributes="{
        type: '{{ $type }}',
        label: '{{ $label }}',
        itemLabel: '{{ $itemLabel }}',
        addLabelValue: '{{$addLabelValue}}',
        @include('twill::partials.form.utils._field_name', ['asAttributes' => true])
        note: '{{ $note }}',
        fieldNote: '{{ $fieldNote }}',
        max: {{ $max }},
        filesizeMax: {{ $filesizeMax }}
    }"
></a17-locale>

@unless($renderForBlocks)
@push('vuexStore')
    @foreach(getLocales() as $locale)
        @if (isset($form_fields['files']) && isset($form_fields['files'][$locale][$name]))
            window['{{ config('twill.js_namespace') }}'].STORE.medias.selected["{{ $name }}[{{ $locale }}]"] = {!! json_encode($form_fields['files'][$locale][$name]) !!}
        @endif
    @endforeach
@endpush
@endunless
