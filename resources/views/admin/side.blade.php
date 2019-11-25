<div class="list-group">
    <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action {{ $active[1] }}">
        <i class="fas fa-users"></i> 使用者管理
    </a>
    <a href="{{ route('years.index') }}" class="list-group-item list-group-item-action {{ $active[2] }}">
        <i class="far fa-calendar-alt"></i> 年度管理
    </a>
    <a href="{{ route('questions.index') }}" class="list-group-item list-group-item-action {{ $active[3] }}">
        <i class="far fa-question-circle"></i> 題目管理
    </a>
    <a href="{{ route('books.index') }}" class="list-group-item list-group-item-action {{ $active[4] }}">
        <i class="fas fa-book"></i> 教科書版本管理
    </a>
    <a href="{{ route('reviews.index') }}" class="list-group-item list-group-item-action {{ $active[5] }}">
        <i class="fas fa-user"></i> 普教審查管理
    </a>
    <a href="{{ route('reviews.index2') }}" class="list-group-item list-group-item-action {{ $active[6] }}">
        <i class="fas fa-user-tag"></i> 特教審查管理
    </a>
    <a href="{{ route('exports.index') }}" class="list-group-item list-group-item-action {{ $active[7] }}">
        <i class="fas fa-file-export"></i> 匯出表單
    </a>
</div>
