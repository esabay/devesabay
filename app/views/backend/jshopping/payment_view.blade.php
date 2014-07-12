<div class="dl-horizontal">
    <dl>
        <dt>{{\Lang::get('jshopping.transfer_s')}}</dt>
        <dd>{{$page['item']->transfer_name}}</dd>
        <dt>{{\Lang::get('jshopping.transfer_amount')}}</dt>
        <dd>{{$page['item']->transfer_total}}</dd>
        <dt>{{\Lang::get('jshopping.transfer_date')}} / {{\Lang::get('jshopping.transfer_time')}}</dt>
        <dd>{{$page['item']->transfer_date}} {{$page['item']->transfer_time}}</dd>
        <dt>{{\Lang::get('jshopping.transfer_bank_in')}}</dt>
        <dd>{{$page['item']->transfer_in_bank}}</dd>
        <dt>{{\Lang::get('jshopping.transfer_bank_out')}}</dt>
        <dd>{{$page['item']->transfer_out_bank}} {{$page['item']->transfer_bank_branch}}</dd>
        <dt>{{\Lang::get('jshopping.transfer_slip')}}</dt>
        <dd>
            @if($page['item']->transfer_slip!='')
            <a href="{{\URL::to($page['item']->transfer_slip)}}" target="_blank">Download</a>
            @endif
        </dd>
        <dt>{{\Lang::get('jshopping.remark')}}</dt>
        <dd>{{$page['item']->transfer_remark}}</dd>

    </dl>
</div>