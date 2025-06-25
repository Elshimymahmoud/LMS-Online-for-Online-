<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal-{{$order->id}}">@lang('labels.backend.orders.fields.bank_receipt')</button>

<div id="myModal-{{$order->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <img style="width: 100%;" src="{{asset('storage/receipts/'.$order->bank_transfer_receipt)}}" class="img-responsive">
        </div>
    </div>
  </div>
</div>