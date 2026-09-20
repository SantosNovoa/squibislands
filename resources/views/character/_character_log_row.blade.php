<<<<<<< HEAD
<div class="row flex-wrap">
    <div class="col-6 col-md-2">
        <div class="logs-table-cell">
            {!! $log->sender ? $log->sender->displayName : '' !!}
        </div>
    </div>
    <div class="col-6 col-md-8">
        <div class="logs-table-cell">
            {!! $log->log !!}
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="logs-table-cell">
            {!! pretty_date($log->created_at) !!}
        </div>
    </div>
=======
<div class="d-flex row flex-wrap col-12 mt-1 pt-1 px-0 ubt-top">
  <div class="col-6 col-md-2">{!! $log->sender ? $log->sender->displayName : '' !!}</div>
  <div class="col-6 col-md-8">{!! $log->log !!}</div>
  <div class="col-6 col-md-2">{!! pretty_date($log->created_at) !!}</div>
>>>>>>> Cylunny/extension/polls-and-forms
</div>
