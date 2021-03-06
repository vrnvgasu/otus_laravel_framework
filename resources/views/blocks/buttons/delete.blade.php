<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
    @lang('buttons.delete')
</button>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">@lang('messages.delete')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('buttons.close')</button>
                {!! Form::open(['url' => $src, 'method' => 'delete']) !!}
                    {{Form::submit(__('buttons.delete'), ['class' => 'btn btn-danger'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
