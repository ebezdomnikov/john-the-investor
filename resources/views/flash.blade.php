<div>
    @if (session('level') === 'error')
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('message') }}.
        </div>
    @endif

    @if (session('level') === 'info')
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('message') }}.
        </div>
    @endif
</div>