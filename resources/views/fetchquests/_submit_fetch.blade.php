                {!! Form::open(['url' => 'fetch/new/' . $fetch->id]) !!}

                <p>This will submit the fetch quest, remove {{ $fetch->fetch_quantity > 1 ? $fetch->fetch_quantity : 'one' }} {!! $fetch->fetchItem->displayName !!} from your inventory, and give you the quest's rewards. Are
                    you sure?</p>

                <div class="text-right">
                    {!! Form::submit('Confirm', ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
