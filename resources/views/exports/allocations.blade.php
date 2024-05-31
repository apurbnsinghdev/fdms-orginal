<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellspacing="0" cellpadding="0" width="700">
    @if ($stocks->stock_details)
      @php
          $num=2+$stocks->stock_details->count();
      @endphp
    @else
       @php
          $num=4;
      @endphp
    @endif
  <tr>
    <td colspan="{{ $num }}" style="text-align:center;border-bottom:3px solid #ff0000;" align="center">
      <strong>Dhaka Ice – Cream Industries Ltd. ( POLAR )</strong>
    </td>
  </tr>
  <tr>
    <td colspan="{{ $num }}" style="text-align:center;">
      Invoice No:  {{ $stocks->invoice_no }},
      Invoice Date: {{ $stocks->invoice_date }}
    </td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:center; background-color: #FFFF99;border:10px solid #ccc;" height="100">Address</td>
    @if ($stocks->stock_details)
    @php
      $orderDetils=$stocks->stock_details->pluck('','id')->toArray();
    @endphp
      @foreach ($stocks->stock_details as $ele)
        <td style="word-wrap: break-word;">
          {{ $ele->qty }}ps.
          (DF: @if ($ele->brand)
            {{ $ele->brand->short_code }}-
          @endif
            {{ $ele->size->name }})
      </td>
      @endforeach
    @endif
  </tr>
  @foreach ($allocations as $val)
  @php
    $data=$val->allocation_details->pluck('qty','stock_detail_id')->toArray();
    $merged = collect(array_replace($orderDetils,$data));
  @endphp
  <tr>
    <td style="background-color: #E5FFCC;" height="100">{{ $loop->iteration }}</td>
    <td style="background-color: #E5FFCC;border: 5px solid #000000;" height="100">{{ $val->depot->user->name or '' }}</td>
    @foreach ($merged as $ke=>$vl)
       <td style="background-color: #E5FFCC;" height="100">{{ $vl }}</td>
    @endforeach
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>{{ $val->depot->user->designation->title or '' }} </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>{{ $val->depot->address or '' }}</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Phone: {{ $val->depot->user->mobile or '' }}</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Email: {{ $val->depot->user->email or '' }}</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  @endforeach

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>.....................</td>
    <td>.....................</td>
    <td>.....................</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Provided By:</td>
    <td>Checked By:</td>
    <td>Approved By:</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</html>

