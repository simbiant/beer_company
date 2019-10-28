<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/style.css') }}" rel="stylesheet" type="text/css" >
    <title>Beer</title>
</head>
<body>
    <div class="mainBlock">
    <div style="width: 100%; height: 70px; padding-top: 10px;">
        <a href="/" class="button">Пиво</a>
        <a href="/comps" class="button">Компанії</a>
        <a href="/types" class="button">Типи</a>
    </div>

        @foreach($tables as $t)
    <div style="width: 80%; border: 1px solid; height: 40px; margin: auto;">
    	<div class="blockList"> <a href="/get/type/{{$t->idType}}" style=" text-decoration: none; ">{{$t->name}}</a></div>

        <div class="blockList" style="float: right; width: 40px; border-left: 1px solid;">
            <form action="/delete/type/{{$t->idType}}" method="post">
                @csrf
                <input type="submit" value="X" style="text-decoration: none; color: red; width: 100%;"/>
            </form>
        </div>
        <div class="blockList" style="float: right; border-left: 1px solid; width: 40px;"> <a href="/edit/type/{{$t->idType}}" style=" text-decoration: none; color: black"><img width="40px;" src={{ asset('pictures/edit.png')}}></a></div>
    </div>
        @endforeach
    <a href="/add_type" class="button" style="margin-top: 10px; width: 100px; height: 30px; font-size: 24px;">Додати</a>
    </div>
</body>
</html>
