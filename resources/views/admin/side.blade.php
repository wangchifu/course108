<div class="list-group">
    <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action {{ $active[1] }}">
        <i class="fas fa-users"></i> 使用者管理
    </a>
    <a href="" class="list-group-item list-group-item-action {{ $active[2] }}">
        年度管理
    </a>
    <a href="{{ route('books.index') }}" class="list-group-item list-group-item-action {{ $active[3] }}">
        教科書版本管理
    </a>
    <a href="" class="list-group-item list-group-item-action {{ $active[4] }}">
        普教審查管理
    </a>
    <a href="" class="list-group-item list-group-item-action {{ $active[5] }}">
        特教審查管理
    </a>
    <a href="" class="list-group-item list-group-item-action {{ $active[6] }}">
        匯出表單
    </a>
</div>

