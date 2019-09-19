<table border="1">
    <tr>
        <td colspan="2">
            領域/科目
        </td>
        @foreach($year12 as $v)
            <td>
                {{ $v }}年級
            </td>
        @endforeach
    </tr>
    <tr>
        <td rowspan="3">
            語文
        </td>
        <td width="100">
            國語文
        </td>
        @foreach($year12 as $v)
            <td>
                <select name="mandarin_book[{{ $v }}]" required>
                    <option>
                    </option>
                    @foreach($mandarin_books as $book)
                        <option value="{{ $book->name }}">
                            {{ $book->name }}
                        </option>
                    @endforeach
                </select>
            </td>
        @endforeach
    </tr>
    <tr>
        <td>
            本土語文/新住民語文
        </td>
        @foreach($year12 as $v)
            <td>
                <select name="dialects_book[{{ $v }}]" required>
                    <option>
                    </option>
                    @foreach($dialects_books as $book)
                        <option value="{{ $book->name }}">
                            {{ $book->name }}
                        </option>
                    @endforeach
                </select>
            </td>
        @endforeach
    </tr>
    <tr>
        <td>
            英語文
        </td>
        @foreach($year12 as $v)
            <td>
                @if($v=="一" or $v=="二")
                    -
                @else
                    <select name="english_book[{{ $v }}]" required>
                        <option>
                        </option>
                        @foreach($english_books as $book)
                            <option value="{{ $book->name }}">
                                {{ $book->name }}
                            </option>
                        @endforeach
                    </select>
                @endif
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            數學
        </td>
        @foreach($year12 as $v)
            <td>
                <select name="mathematics_book[{{ $v }}]" required>
                    <option>
                    </option>
                    @foreach($mathematics_books as $book)
                        <option value="{{ $book->name }}">
                            {{ $book->name }}
                        </option>
                    @endforeach
                </select>
            </td>
        @endforeach
    </tr>
    <tr>
        <td rowspan="4">
            生活
        </td>
        <td>
            社會
        </td>
        @foreach($year12 as $v)
            @if($v=="一" or $v=="二")
            <td rowspan="4">
                <select name="life_curriculum_book[{{ $v }}]" required>
                    <option>
                    </option>
                    @foreach($life_curriculum_books as $book)
                        <option value="{{ $book->name }}">
                            {{ $book->name }}
                        </option>
                    @endforeach
                </select>
            </td>
            @else
            <td>
                <select name="social_studies_book[{{ $v }}]" required>
                    <option>
                    </option>
                    @foreach($social_studies_books as $book)
                        <option value="{{ $book->name }}">
                            {{ $book->name }}
                        </option>
                    @endforeach
                </select>
            </td>
            @endif
        @endforeach
    </tr>
    <tr>
        <td>
            自然科學
        </td>
        @foreach($year12 as $v)
            @if($v=="一" or $v=="二")

            @else
                <td>
                    <select name="science_book[{{ $v }}]" required>
                        <option>
                        </option>
                        @foreach($science_books as $book)
                            <option value="{{ $book->name }}">
                                {{ $book->name }}
                            </option>
                        @endforeach
                    </select>
                </td>
            @endif
        @endforeach
    </tr>
    <tr>
        <td>
            藝術
        </td>
        @foreach($year12 as $v)
            @if($v=="一" or $v=="二")

            @else
                <td>
                    <select name="arts_humanities_book[{{ $v }}]" required>
                        <option>
                        </option>
                        @foreach($arts_humanities_books as $book)
                            <option value="{{ $book->name }}">
                                {{ $book->name }}
                            </option>
                        @endforeach
                    </select>
                </td>
            @endif
        @endforeach
    </tr>
    <tr>
        <td>
            綜合活動
        </td>
        @foreach($year12 as $v)
            @if($v=="一" or $v=="二")

            @else
                <td>
                    <select name="integrative_activities_book[{{ $v }}]" required>
                        <option>
                        </option>
                        @foreach($integrative_activities_books as $book)
                            <option value="{{ $book->name }}">
                                {{ $book->name }}
                            </option>
                        @endforeach
                    </select>
                </td>
            @endif
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            健康與體育
        </td>
        @foreach($year12 as $v)
            <td>
                <select name="health_physical_book[{{ $v }}]" required>
                    <option>
                    </option>
                    @foreach($health_physical_books as $book)
                        <option value="{{ $book->name }}">
                            {{ $book->name }}
                        </option>
                    @endforeach
                </select>
            </td>
        @endforeach
    </tr>
</table>
