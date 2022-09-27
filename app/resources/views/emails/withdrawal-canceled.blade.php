<div width="100%" style="margin:0;padding:0!important;background-color:#f5f6fa">
<center style="width:100%;background-color:#f5f6fa">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f6fa">
        <tbody><tr>
            <td style="padding:30px 0">
                <table style="width:100%;max-width:620px;margin:0 auto">
        <tbody>
        <tr>
            <td style="text-align:center;padding-bottom:15px">
                <img style="max-height:50px;width:auto" src="{{asset('logo.png')}}" alt="mazeoptions logo" class="CToWUd">
            </td>
        </tr>
        </tbody>
    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff">
        <tbody>
                <tr>
            <td style="padding:10px 30px 10px">
                Hello  {{ $withdrawal->user->username }},
            </td>
        </tr>
                
        <tr>
            <td style="padding:0 30px">
                <p>Your Withdrawal of {{ moneyFormat($withdrawal->amount, 'USD') }} was Canceled!</p>
<table width="100%">
<tbody><tr>
<td width="150">Withdrawal Reference</td>
<td width="25">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
<td>{{ $withdrawal->ref }}</td>
</tr>
<tr>
<td width="150">Payment Amount</td>
<td width="25">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
<td>{{ moneyFormat($withdrawal->amount, 'USD') }} </td>
</tr>
<tr>
<td width="150">Withdrawal Method</td>
<td width="25">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
<td>{{ $withdrawal->formatted_payment_method }}</td>
</tr>
<tr>
<td width="150">Status</td>
<td width="25">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
<td style="padding:15px 10px;border:1px solid #f5f5f5;width:65%">
                             @if( $withdrawal->status == \App\Models\Withdrawal::STATUS_PAID)
                                <span style="color: green;">Processed</span>
                            @elseif ($withdrawal->status == \App\Models\Withdrawal::STATUS_CANCELED)
                                <span style="color: red;">Canceled</span>
                            @else
                                <span style="color: green;">Pending</span>
                            @endif
</td>
</tr>
</tbody></table>
<p>If you have any issues or complaints regarding any transaction, kindly send us an email at billing@zenithcapital.cc</p>

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