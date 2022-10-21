<span class="sort">
    @if(request()->get('sortDirection','asc') == 'asc')
        <i class="arrow up"></i>
    @else
        <i class="arrow down"></i>
    @endif
</span>
