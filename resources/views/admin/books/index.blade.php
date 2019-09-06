@extends('layouts.master',['bg_color'=>'bg-secondary'])

@section('title','教科書 | ')

@section('content')
    <?php
        for($i=1;$i<8;$i++){
            $active[$i] = null;
        }
        $active[4] = "active";
    ?>
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('admin.side',['active'=>$active])
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5>
                        <img src="{{ asset('images/book.svg') }}" height="24">
                        科目版本列表
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                科目
                            </th>
                            <th>
                                課程
                            </th>
                            <th>
                                新增版本
                            </th>
                            <th>
                                已儲列表
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                國語文
                            </td>
                            <td>
                                九年一貫課程<br>
                                十二年國教課程
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.store','method'=>'post']) }}
                                <input type="text" name="name" required>
                                <input type="hidden" name="subject" value="mandarin">
                                <button type="submit" onclick="return confirm('確定？')">儲存</button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.destroy','method'=>'delete'])}}
                                <select name="id">
                                    <option>
                                    </option>
                                    @foreach($mandarin_books as $book)
                                        <option value="{{ $book->id }}">
                                            {{ $book->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" onclick="return confirm('確定移除？')">移除</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                本土語文<br>
                                新住民語文
                            </td>
                            <td>
                                九年一貫課程<br>
                                十二年國教課程
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.store','method'=>'post']) }}
                                <input type="text" name="name" required>
                                <input type="hidden" name="subject" value="dialects">
                                <button type="submit" onclick="return confirm('確定？')">儲存</button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.destroy','method'=>'delete'])}}
                                <select name="id">
                                    <option>
                                    </option>
                                    @foreach($dialects_books as $book)
                                        <option value="{{ $book->id }}">
                                            {{ $book->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" onclick="return confirm('確定移除？')">移除</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                英語文
                            </td>
                            <td>
                                九年一貫課程<br>
                                十二年國教課程
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.store','method'=>'post']) }}
                                <input type="text" name="name" required>
                                <input type="hidden" name="subject" value="english">
                                <button type="submit" onclick="return confirm('確定？')">儲存</button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.destroy','method'=>'delete'])}}
                                <select name="id">
                                    <option>
                                    </option>
                                    @foreach($english_books as $book)
                                        <option value="{{ $book->id }}">
                                            {{ $book->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" onclick="return confirm('確定移除？')">移除</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                數學
                            </td>
                            <td>
                                九年一貫課程<br>
                                十二年國教課程
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.store','method'=>'post']) }}
                                <input type="text" name="name" required>
                                <input type="hidden" name="subject" value="mathematics">
                                <button type="submit" onclick="return confirm('確定？')">儲存</button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.destroy','method'=>'delete'])}}
                                <select name="id">
                                    <option>
                                    </option>
                                    @foreach($mathematics_books as $book)
                                        <option value="{{ $book->id }}">
                                            {{ $book->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" onclick="return confirm('確定移除？')">移除</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                生活
                            </td>
                            <td>
                                九年一貫課程<br>
                                十二年國教課程
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.store','method'=>'post']) }}
                                <input type="text" name="name" required>
                                <input type="hidden" name="subject" value="life_curriculum">
                                <button type="submit" onclick="return confirm('確定？')">儲存</button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.destroy','method'=>'delete'])}}
                                <select name="id">
                                    <option>
                                    </option>
                                    @foreach($life_curriculum_books as $book)
                                        <option value="{{ $book->id }}">
                                            {{ $book->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" onclick="return confirm('確定移除？')">移除</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                社會
                            </td>
                            <td>
                                九年一貫課程<br>
                                十二年國教課程
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.store','method'=>'post']) }}
                                <input type="text" name="name" required>
                                <input type="hidden" name="subject" value="social_studies">
                                <button type="submit" onclick="return confirm('確定？')">儲存</button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.destroy','method'=>'delete'])}}
                                <select name="id">
                                    <option>
                                    </option>
                                    @foreach($social_studies_books as $book)
                                        <option value="{{ $book->id }}">
                                            {{ $book->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" onclick="return confirm('確定移除？')">移除</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong class="text-primary">自然與生活科技</strong>
                            </td>
                            <td>
                                九年一貫課程
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.store','method'=>'post']) }}
                                <input type="text" name="name" required>
                                <input type="hidden" name="subject" value="science_technology">
                                <button type="submit" onclick="return confirm('確定？')">儲存</button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.destroy','method'=>'delete'])}}
                                <select name="id">
                                    <option>
                                    </option>
                                    @foreach($science_technology_books as $book)
                                        <option value="{{ $book->id }}">
                                            {{ $book->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" onclick="return confirm('確定移除？')">移除</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong class="text-primary">自然科學</strong>
                            </td>
                            <td>
                                十二年國教課程
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.store','method'=>'post']) }}
                                <input type="text" name="name" required>
                                <input type="hidden" name="subject" value="science">
                                <button type="submit" onclick="return confirm('確定？')">儲存</button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.destroy','method'=>'delete'])}}
                                <select name="id">
                                    <option>
                                    </option>
                                    @foreach($science_books as $book)
                                        <option value="{{ $book->id }}">
                                            {{ $book->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" onclick="return confirm('確定移除？')">移除</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                藝術與人文
                            </td>
                            <td>
                                九年一貫課程<br>
                                十二年國教課程
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.store','method'=>'post']) }}
                                <input type="text" name="name" required>
                                <input type="hidden" name="subject" value="arts_humanities">
                                <button type="submit" onclick="return confirm('確定？')">儲存</button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.destroy','method'=>'delete'])}}
                                <select name="id">
                                    <option>
                                    </option>
                                    @foreach($arts_humanities_books as $book)
                                        <option value="{{ $book->id }}">
                                            {{ $book->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" onclick="return confirm('確定移除？')">移除</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                綜合活動
                            </td>
                            <td>
                                九年一貫課程<br>
                                十二年國教課程
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.store','method'=>'post']) }}
                                <input type="text" name="name" required>
                                <input type="hidden" name="subject" value="integrative_activities">
                                <button type="submit" onclick="return confirm('確定？')">儲存</button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.destroy','method'=>'delete'])}}
                                <select name="id">
                                    <option>
                                    </option>
                                    @foreach($integrative_activities_books as $book)
                                        <option value="{{ $book->id }}">
                                            {{ $book->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" onclick="return confirm('確定移除？')">移除</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong class="text-primary">科技</strong>
                            </td>
                            <td>
                                十二年國教課程
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.store','method'=>'post']) }}
                                <input type="text" name="name" required>
                                <input type="hidden" name="subject" value="technology">
                                <button type="submit" onclick="return confirm('確定？')">儲存</button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.destroy','method'=>'delete'])}}
                                <select name="id">
                                    <option>
                                    </option>
                                    @foreach($technology_books as $book)
                                        <option value="{{ $book->id }}">
                                            {{ $book->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" onclick="return confirm('確定移除？')">移除</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                健康與體育
                            </td>
                            <td>
                                九年一貫課程<br>
                                十二年國教課程
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.store','method'=>'post']) }}
                                <input type="text" name="name" required>
                                <input type="hidden" name="subject" value="health_physical">
                                <button type="submit" onclick="return confirm('確定？')">儲存</button>
                                {{ Form::close() }}
                            </td>
                            <td>
                                {{ Form::open(['route'=>'books.destroy','method'=>'delete'])}}
                                <select name="id">
                                    <option>
                                    </option>
                                    @foreach($health_physical_books as $book)
                                        <option value="{{ $book->id }}">
                                            {{ $book->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" onclick="return confirm('確定移除？')">移除</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
