@extends('layout/backend')
@section('content')
    <div class="pad">
        <h2>News mangement</h2>
        <a href="{{ route('add_news') }}"><button class="btn blue" style="float:right;position:relative;" >Create new</button></a>
        <table class="tbl">
            <thead>
            <tr>
                <th style="text-align:center;"><input type="checkbox" /></th>
                <th>Title</th>
                <th>Author</th>
                <th>Last updated at</th>
                <th>Posted on</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($entry as $news)
                <tr>
                    <td style="text-align:center;"><input type="checkbox" /></td>
                    <td>{{$news->title}}</td>
                    <?php echo '<td>' . Auth::user()->find($news->author_id)->username . '</td>' ?>
                    <td>{{$news->updated_at}}</td>
                    <td>{{$news->created_at}}</td>
                    <td>
                        <a href="{{ URL::route('edit_news', $news->id) }}"><button class="btn blue"><img src="{{URL('/images/backend/edit.png')}}" class="edit-icon"/></button></a>
                        <button class="btn red" style="font-weight:bold;" onclick="openModal('delete{{$news->id}}')">X</button>
                    </td>
                </tr>

                <div class="modal red" id="delete{{$news->id}}">
                    <form action="{!! URL::route('delete_news', $news->id) !!}" method="post">
                        <input name="file" value="{{$news->title}}" style="display:none;" />
                        <div class="left">
                            <p>Weet u zeker dat u dit bestand wilt verwijderen?</p>
                            <span>{{$news->title}}</span>
                        </div>
                        <div class="right" style="padding-top:30px;">
                            <button>Delete</button>
                            <button onclick="closeModal('delete{{$news->id}}');return false;">Cancel</button>
                        </div>
                    </form>
                </div>
            @endforeach
            </tbody>
        </table>
        @if (Session::has('error'))
            <p class="error">{{Session::get('error')}}</p>
        @elseif (Session::has('succes'))
            <p class="error">{{Session::get('succes')}}</p>
        @endif
    </div>
@endsection