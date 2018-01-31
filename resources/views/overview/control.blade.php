<?php
function isActiveRoute($name) {
    return \Route::currentRouteName() === $name;
}
?>

<div class="row">
    <div class="dashboard-switch-container">
        <ul class="nav nav-pills">
            <li role="presentation" class="{{isActiveRoute('overviewCompany')?'active':''}}"><a href="{{ route('overviewCompany') }}">Companies</a></li>
            <li role="presentation" class="{{isActiveRoute('overviewMarket')?'active':''}}"><a href="{{ route('overviewMarket') }}">Markets</a></li>
            <li role="presentation" class="{{isActiveRoute('overviewHighTrade')?'active':''}}"><a href="{{ route('overviewHighTrade') }}">High trade</a></li>
        </ul>
    </div>
</div>
