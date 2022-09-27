<div width="100%" style="margin:0;padding:0!important;background-color:#f5f6fa">
<center style="width:100%;background-color:#f5f6fa">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f6fa">
        <tbody><tr>
            <td style="padding:30px 0">
                <table style="width:100%;max-width:620px;margin:0 auto">
        <tbody>
        <tr>
            <td style="text-align:center;padding-bottom:15px">
                <img style="max-height:50px;width:auto" src="{{asset('logo.png')}}" alt="Mazeoptions logo" class="CToWUd">
            </td>
        </tr>
        </tbody>
    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff">
        <tbody>
                <tr>
            <td style="padding:10px 30px 10px">
                Hello  {{ $deposit->user->username }},
            </td>
        </tr>
                
        <tr>
            <td style="padding:0 30px">
                <p>Your deposit was successful. Your deposit details are shown below for your reference:</p>
<table width="100%">
<tbody><tr>
<td width="150">Payment Reference</td>
<td width="25">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
<td>{{ $deposit->ref }}</td>
</tr>
<tr>
<td width="150">Payment Amount</td>
<td width="25">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
<td>{{ moneyFormat($deposit->amount, 'USD') }} </td>
</tr>
<tr>
<td width="150">Profit</td>
<td width="25">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
<td> {{ moneyFormat($deposit->profit, 'USD') }}</td>
</tr>
<tr>
<td width="150">Payment Method</td>
<td width="25">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
<td> {{$deposit->formatted_payment_method }}</td>
</tr>
<tr>
<td width="150">Status</td>
<td width="25">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
<td>  @if( $deposit->status == \App\Models\Deposit::STATUS_COMPLETED)
                                <span style="color: green;">Completed</span>
                            @elseif ($deposit->status == \App\Models\Deposit::STATUS_CANCELED)
                                <span style="color: red;">Canceled</span>
                            @else
                                <span style="color: green;">Active</span>
                            @endif
                            </td>
</tr>
<tr>
<td width="150">Expires</td>
<td width="25">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
<td> {{ $deposit->expires_at->diffForHumans() }}</td>
</tr>
</tbody></table>
<p>If you have any issues or complaints regarding any transaction, kindly send us an email at support@zenithcapital.cc</p>

            </td>
        </tr>

                </tbody>
    </table>
                <table style="width:100%;max-width:620px;margin:0 auto">
    <tbody>
    <tr>
        <td style="text-align:center;padding:25px 20px 0">
            <p style="font-size:13px">Mazeoptions © {{Date('Y')}}.</p>
                    </td>
    </tr>
    </tbody>
</table>
            </td>
        </tr>
    </tbody></table>
</center><div class="yj6qo"></div><div class="adL">
</div></div>