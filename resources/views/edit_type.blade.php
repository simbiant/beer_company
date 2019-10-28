<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/style.css') }}" rel="stylesheet" type="text/css" >
    <title>Edit type</title>
</head>
<body>


<div class="mainBlock" style="padding-top: 10px;">
    <div style="width: 100%; height: 70px; padding-top: 10px;">
        <a href="/" class="button">Пиво</a>
        <a href="/comps" class="button">Компанії</a>
        <a href="/types" class="button">Типи</a>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <div style="font-size: 20px; color: red;">{{ $error }}</div>
                @endforeach
            </ul>
        </div>
    @endif
	<form action="/edit_t/{{$info->idType}}" method="post">
        @csrf
		<label style="font-size: 20px; padding-top: 10px;">Редагувати тип</label><br/><br/>
		<label style="font-size: 20px; padding-top: 10px;"> Назва</label><br/>
		<input type="text" style="font-size: 20px; margin: 10px 0 0 20px; width: 500px;" name="name" value="{{$info->name}}"  placeholder="Назва..." />
		<input type="submit" value="Редагувати" style="margin: 0px; width: 100%; font-size: 1vw; margin-top: 20px;" />
	</form>



</div>



</body>
</html>
