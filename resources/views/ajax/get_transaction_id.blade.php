<div class="row">
	<div class="col-md-6">
		<h5 class="text-info">Your payable amount is:{{$requisition->receive_amount}}</h5>
		<table class="table">
    		<thead>
           		<tr>
           			<th>Transaction ID</th>
           			<th>Amount</th>
           		</tr>
    		</thead>
    		<tbody>
    		<tr id="current_transaction"></tr>
    			@php $total = 0; @endphp
    			@if($requisition->bkashes->count())
        			@foreach($requisition->bkashes as $bkash)
        				@php
        					$total = $total + $bkash->receive_amount;
        				@endphp
            			<tr>
            				<td>{{$bkash->transaction_id}}</td>
            				<td>{{$bkash->receive_amount}}</td>
            			</tr>
        			@endforeach
        			
        			<tr>
        				<td class="text-right"><strong>Total Paid=</strong></td>
        				<td id="total">{{number_format($total,2)}}</td>
        			</tr>
        			<tr>
        				<td class="text-right"><strong>Total Due=</strong></td>
        				<td id="total_due">{{number_format(($requisition->receive_amount-$total),2)}}</td>
        			</tr>
    			@else
    			<tr id="no_data">
    				<td colspan="2">No payment received yet</td>
    			</tr>
    			@endif
    		</tbody>
       </table> 
	</div>
  <div class="col-md-6 mt-sm text-center">
      <form id="actionForm" style="position: relative;overflow: hidden;">
    		{{ csrf_field() }}
    		{{Form::hidden('id',$requisition->id)}}
    		<div class="from-group">
    			{{Form::text('transaction_id',$requisition->transaction_id,array('placeholder'=>'Input your transaction ID','class' => 'form-control'))}}
            	<p class="text-danger" id="error"></p>
    		</div>
    		@if($requisition->receive_amount != $total)
      		<div class="from-group">
            	<button type="button" class="btn btn-success" id="confirm-btn" onclick="putTransactionId('#actionForm')">Check Transaction</button>
            </div>
            @endif
       </form>
	</div>
</div>