<tr>
    <td class="align-middle text-center">
        <span class="contact-handle" style="cursor: move;" title="Drag to reorder"><i class="fas fa-arrows-alt-v"></i></span>
    </td>
    <td>
        {!! Form::text('contact_site[]', $contact['site'] ?? null, ['class' => 'form-control', 'placeholder' => 'e.g. Toyhou.se']) !!}
    </td>
    <td>
        {!! Form::text('contact_url[]', $contact['url'] ?? null, ['class' => 'form-control', 'placeholder' => 'https://']) !!}
    </td>
    <td class="text-right">
        <button type="button" class="btn btn-danger remove-contact">Remove</button>
    </td>
</tr>