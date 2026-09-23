@extends('admin.layout')

@section('admin-title')
    Customs Entry
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Customs Entry' => 'admin/custom-profile']) !!}

    <h1>My Customs Entry</h1>

    <p>
        This controls what shows for you on the <a href="{{ url('info/official_customs') }}">Official Customs</a> page.
        Your entry only appears while <strong>Show my entry</strong> is on. Each type only appears while it's open and has at least one active option.
    </p>

    {!! Form::open(['url' => 'admin/custom-profile']) !!}

    <div class="card mb-3">
        <div class="card-body">
            <div class="form-group mb-0">
                {!! Form::checkbox('is_active', 1, $profile->is_active, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                {!! Form::label('is_active', 'Show my entry on the page', ['class' => 'form-check-label ml-3']) !!}
                {!! add_help('Turn this off to hide your whole entry without losing anything you have set up.') !!}
            </div>
        </div>
    </div>

    @foreach ($types as $key => $label)
        <div class="card mb-3">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="mb-0">{{ $label }}s</h3>
                <div>
                    {!! Form::checkbox('open[' . $key . ']', 1, $profile->isTypeOpen($key), ['class' => 'form-check-input', 'data-toggle' => 'toggle', 'data-on' => 'Open', 'data-off' => 'Closed']) !!}
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm mb-2">
                    <thead>
                        <tr>
                            <th>Option name</th>
                            <th style="width: 130px;">Price</th>
                            <th style="width: 200px;">Currency</th>
                            <th class="text-center" style="width: 70px;">Active</th>
                            <th style="width: 50px;"></th>
                        </tr>
                    </thead>
                    <tbody class="option-rows" data-type="{{ $key }}">
                        @foreach ($profile->options->where('type', $key) as $index => $option)
                            @include('admin.custom_artists._option_row', ['type' => $key, 'index' => $index, 'option' => $option])
                        @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn btn-outline-info btn-sm add-option" data-type="{{ $key }}">Add {{ $label }} Option</button>
            </div>
        </div>
    @endforeach

    <div class="card mb-3">
        <div class="card-body">
            <h3>Contact Me</h3>
            <p>These are the websites you want commissioners to reach you at. They show under "Contact Me" on your entry. Drag the arrows to reorder them.</p>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th style="width: 40px;"></th>
                        <th style="width: 30%;">Website</th>
                        <th>URL</th>
                        <th style="width: 100px;"></th>
                    </tr>
                </thead>
                <tbody id="contactRows">
                    @foreach ($profile->contacts ?? [] as $contact)
                        @include('admin.custom_artists._contact_row', ['contact' => $contact])
                    @endforeach
                </tbody>
            </table>

            <button type="button" class="btn btn-outline-info" id="addContact">Add Website Link</button>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div class="form-group mb-0">
                {!! Form::label('notes', 'Important Notes / Details') !!} {!! add_help('Shown underneath Contact Me: turnaround time, what you will or won\'t draw, payment terms, etc.') !!}
                {!! Form::textarea('notes', $profile->notes, ['class' => 'form-control wysiwyg']) !!}
            </div>
        </div>
    </div>

    <div class="text-right">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    <template id="option-row-template">
        @include('admin.custom_artists._option_row', ['type' => '__TYPE__', 'index' => '__INDEX__', 'option' => null])
    </template>

    <template id="contact-row-template">
        @include('admin.custom_artists._contact_row', ['contact' => null])
    </template>
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            let optionIndex = {{ $profile->options->count() + 1 }};

            $('.add-option').on('click', function() {
                const type = $(this).data('type');
                const html = $('#option-row-template').html()
                    .replace(/__TYPE__/g, type)
                    .replace(/__INDEX__/g, optionIndex++);
                $('.option-rows[data-type="' + type + '"]').append(html);
            });

            $(document).on('click', '.remove-option', function() {
                $(this).closest('tr').remove();
            });

            // Contact links
            $('#addContact').on('click', function() {
                $('#contactRows').append($('#contact-row-template').html());
            });

            $(document).on('click', '.remove-contact', function() {
                $(this).closest('tr').remove();
            });

            $('#contactRows').sortable({
                handle: '.contact-handle',
                axis: 'y',
            });
        });
    </script>
@endsection