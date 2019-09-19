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
        <td rowspan="2">
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
            英語文
        </td>
        @foreach($year12 as $v)
            <td>
                <select name="english_book[{{ $v }}]" required>
                    <option>
                    </option>
                    @foreach($english_books as $book)
                        <option value="{{ $book->name }}">
                            {{ $book->name }}
                        </option>
                    @endforeach
                </select>
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
        <td colspan="2">
            社會
        </td>
        @foreach($year12 as $v)
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
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            自然科學
        </td>
        @foreach($year12 as $v)
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
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            藝術
        </td>
        @foreach($year12 as $v)
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
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            綜合活動
        </td>
        @foreach($year12 as $v)
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
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            科技
        </td>
        @foreach($year12 as $v)
            <td>
                <select name="technology_book[{{ $v }}]" required>
                    <option>
                    </option>
                    @foreach($technology_books as $book)
                        <option value="{{ $book->name }}">
                            {{ $book->name }}
                        </option>
                    @endforeach
                </select>
            </td>
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
