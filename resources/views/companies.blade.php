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
        <div style="width: 80%; border: 1px solid; height: 40px; margin: auto;">
            <div class="blockList"> Ім'я</div>

            <div class="blockList" style="float: right; width: 40px; ">
            </div>
            <div class="blockList" style="float: right; width: 40px;"></div>
            <div class="blockList" style="width: 20%; float: right; border-left: 1px solid;">


             <form action="/filter/company" method="post">
                @csrf
                    <select name="type" style="width: 100%; font-size: 20px; margin: auto">
                        <option value="-1" selected>Тип</option>
                        @foreach($type as $t)
                                <option value="{{$t->idType}}">{{$t->name}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="blockList" style="width: 20%; float: right; border-left: 1px solid;"> <input type="submit" value="Фільтрація" style="text-decoration: none; color: black; font-size: 20px; width: 100%;"/></div>
            </form>
        </div>
        <br/>
        @foreach($tables as $t)
    <div style="width: 80%; border: 1px solid; height: 40px; margin: auto;">
    	<div class="blockList"> <a href="/get/company/{{$t->idCompany}}" style=" text-decoration: none; ">{{$t->name}}</a></div>

    	<div class="blockList" style="float: right; width: 40px; border-left: 1px solid;">
            <form action="/delete/company/{{$t->idCompany}}" method="post">
                @csrf
                <input type="submit" value="X" style="text-decoration: none; color: red" />
            </form>
        </div>
        <div class="blockList" style="float: right; border-left: 1px solid; width: 40px;"> <a href="/edit/company/{{$t->idCompany}}" style=" text-decoration: none; color: black"><img width="40px;" src={{ asset('pictures/edit.png')}}></a></div>
    </div>
        @endforeach
    <a href="/add_company" class="button" style="margin-top: 10px; width: 100px; height: 30px; font-size: 24px;">Додати</a>

    </div>
</body>
</html>
