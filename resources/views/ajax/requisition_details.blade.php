<table class="table table-condensed">
	<tr>
		<th>Requisition Type</th>
		<td @if ($requisition->type=='replace') class="text-danger" @endif>
			{{ mystudy_case($requisition->type) }}
			 @if ($requisition->df_return_id)
                <span class="text-danger">(Transfer)</span>
            @endif
		</td>
	</tr>
	@if ($requisition->type=='replace')
	<tr>
		<th>Current DF Serial</th>
		<td>{{ $requisition->currentdf->serial_no or '' }}</td>
	</tr>
	@endif
	<tr>
		<th>Reference</th>
		<td>{{ $requisition->reference_id or '' }}</td>
	</tr>
	@if($requisition->user_id!=auth()->user()->id)
	<tr>
		<th>Sender</th>
		<td>{{ $requisition->user->name or '' }}</td>
	</tr>
	@endif
	@if($requisition->created_by)
	<tr>
		<th>Creator</th>
		<td>{{ $requisition->creator->name or '' }}</td>
	</tr>
	@endif
	<tr>
		<th>Outlet Name</th>
		<td>{{$requisition->shop->outlet_name or ''}}</td>
	</tr>
	<tr>
		<th>Shop Address</th>
		<td>{{$requisition->shop->address or ''}}</td>
	</tr>
	<tr>
		<th>Required DF Size</th>
		<td>DF-{{$requisition->size->name or ''}}</td>
	</tr>
	<tr>
		<th>Mobile Number</th>
		<td>{{$requisition->shop->mobile or ''}}</td>
	</tr>
	<tr>
		<th>Payment Mode</th>
		<td>
			@if ($requisition->payment_modes)
				{{config('myconfig.payment_modes')[$requisition->payment_modes]}}
			@endif
			@if ($requisition->payment_methods)
				(<strong class="text-danger">{{  $requisition->payment_methods }}</strong>)
			@endif
		</td>
	</tr>
	<tr>
		<th>Payable Amount</th>
		<td><strong class="text-danger">{{$requisition->receive_amount or '0'}}</strong></td>
	</tr>
	@if ($requisition->payment_methods && $requisition->payment_methods == 'bkash')
	<tr>
		<th>Paid Amount</th>
		<td><strong class="text-danger">{{$requisition->total or '0'}}</strong></td>
	</tr>
	@endif
	<tr>
		<th>Others Company DF</th>
		<td>
			@php
				$otherCompanyDf = json_decode($requisition->other_company_df,true);
			@endphp
			@if ($otherCompanyDf) {{ implode(',',$otherCompanyDf)}} @else NO @endif
		</td>
	</tr>
	<tr>
		<th>Exclusive Outlet</th>
		<td>
			{{config('myconfig.boolArr')[$requisition->exclusive_outlet]}}
		</td>
	</tr>
	<tr>
		<th>Distance From Dist. Point</th>
		<td>{{$requisition->distance_from_dist or ''}} km.</td>
	</tr>
	<tr>
		<th>Market Category</th>
		<td>
			@if ($requisition->shop->category)
				{{config('myconfig.shop_category')[$requisition->shop->category]}}
			@endif
		</td>
	</tr>
	<tr>
		<th>Visibility Of DF</th>
		<td>{{$requisition->visibility_of_df or ''}}</td>
	</tr>
	<tr>
		<th>Estemated Sales</th>
		<td>{{$requisition->shop->estimated_sales or ''}}</td>
	</tr>
	<tr>
		<th>Stage</th>
		<td>{{$requisition->stage or '0'}}</td>
	</tr>
	@if($requisition->action_by)
	<tr>
		<th>Last Action By</th>
		<td>
			@if ($requisition->action_by!=auth()->user()->id)
               {{ $requisition->stager->name or '' }}
            @else
                Self
            @endif
        </td>
	</tr>
	@endif
	@if ($requisition->status!='draft')
		<tr>
			<th>Document verification</th>
			<td>
				@if ($requisition->doc_verified=='yes')
					<span class="badge x-success">yes</span>
				@else
					<span class="badge x-danger">No</span>
				@endif
				@if ($requisition->doc_verified_by)
	            	By: <span>{{ $requisition->document_verifier->name or '' }}</span>
	            @endif
			</td>
		</tr>
		<tr>
			<th>Payment verification</th>
			<td>
	            @if ($requisition->payment_verified=='yes')
	            	<span class="badge x-success">yes</span>
	            @else
	            	<span class="badge x-danger">No</span>
	            @endif
	            @if ($requisition->payment_verrified_by)
	            	By: <span>{{ $requisition->payment_verifier->name or '' }}</span>
	            @endif
			</td>
		</tr>
		<tr>
			<th>Item Assign</th>
			<td>
	            @if ($requisition->item_id)
	            	<span class="badge x-success">yes</span>
	            @else
	            	<span class="badge x-danger">No</span>
	            @endif
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table">
					<tr>
						<th>&nbsp;</th>
						<th>Raw Data</th>
						<th>Validate Data</th>
					</tr>
					<tr>
						<th>Last Three Months AVG DF Sales</th>
						<td>{{ $requisition->last_three_months_avg_sales or '0' }}</td>
						<td>{{ $requisition->last_three_months_avg_sales_real or '0' }}</td>
					</tr>
					<tr>
						<th>Yearly Average DF Sales</th>
						<td>{{ $requisition->average_sales or '0' }}</td>
						<td>{{ $requisition->average_sales_real or '0' }}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th>Validate</th>
			<td>
	            @if ($requisition->validate_by)
	            	<span class="badge x-success">yes</span>
	            	By: <span>{{ $requisition->validator->name or '' }}</span>
	            @else
	            	<span class="badge x-danger">No</span>
	            @endif

			</td>
		</tr>
		@if ($requisition->item)
		<tr>
			<th>DF-Code</th>
			<td>{{ $requisition->item->serial_no or '' }}</td>
		</tr>
		@endif
		<tr>
			<th>Application Date</th>
			{{-- l jS \\of F Y h:i:s A --}}
			<td>{{ Carbon\Carbon::parse($requisition->created_at)->format('l jS \\of F Y') }}</td>
		</tr>
		@if ($requisition->approved_at)
		<tr>
			<th>Final Approved Date</th>
			<td>{{ Carbon\Carbon::parse($requisition->approved_at)->format('l jS \\of F Y')}}</td>
		</tr>
		@endif
	@endif
	@if ($requisition->physical_visits->count())
	<tr>
		<th>Physical Visits</th>
		<td>
		@foreach($requisition->physical_visits as $visit)
			@if($visit->user)
				@if ($visit->status)
					<i class="fa fa-check text-success"></i><strong class="text-success">{{$visit->user->name}}</strong>
				@else
					<i class="fa fa-times text-danger"></i><strong class="text-danger">{{$visit->user->name}}</strong>
				@endif
			@endif
			@if(!$loop->last),&nbsp;@endif
		@endforeach
		</td>
	</tr>
	@endif
	<tr>
		<th>Status</th>
		<td><strong class="text-danger">{{ config('myconfig.application_status')[$requisition->status] }}</strong></td>
	</tr>
	@if ($requisition->type=='replace')
	<tr>
		<th>Comment</th>
		<td>{{ $requisition->comment }}</td>
	</tr>
	@endif
</table>
@if ($requisition->comments->count())
<h5 class="bb-sm"><b>Comments :</b></h5>
<ul id="comments-list" class="comments-list">
	@foreach ($requisition->comments as $ele)
    <li>
        <div class="comment-main-level">
            <div class="comment-box">
                <div class="comment-head">
                    <h6 class="comment-name">
                    	<i @if ($ele->action_name=='hold')
                    		class="text-warning"
                    	@elseif($ele->action_name=='cancel')
                    		class="text-danger"
                    	@elseif($ele->action_name=='approve')
                    		class="text-success"
                    	@endif>
                    {{ mystudy_case($ele->action_name) }} by </i> <a> {{ $ele->user->name }}</a></h6>
                    <span>{{ $ele->updated_at->diffForHumans() }}</span>
                </div>
                <div class="comment-content">
                    {{ $ele->comments or '' }}
                </div>
            </div>
        </div>
    </li>
    @endforeach
</ul>
@endif
