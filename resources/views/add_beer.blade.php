<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/style.css') }}" rel="stylesheet" type="text/css" >
    <title>Add beer</title>
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
	<form action="/add_b" method="post">
        @csrf
		<label style="font-size: 20px; padding-top: 10px; margin: auto">Додати пиво</label><br/>
        <br/>
        <label style="font-size: 20px; padding-top: 10px; margin: auto">Назва</label><br/>
		<input type="text" style="font-size: 20px; margin: 10px 0 0 20px; width: 500px; margin: auto" name="name" placeholder="Назва..." /><br/>
        <label style="font-size: 20px; padding-top: 10px;">Опис</label><br/>
        <input type="text" style="font-size: 20px; margin: 10px 0 0 20px; width: 500px; margin: auto" name="description" placeholder="Опис..." /><br/>

        <label style="font-size: 20px; padding-top: 10px;">Компанія</label><br/>
        @if(count($company) > 0)
            <select name="company" style="width: 500px; font-size: 20px; margin: auto">

            @foreach($company as $c)
                    <option value="{{$c->idCompany}}">{{$c->name}}</option>
                @endforeach
        </select>
        @else
            <p style="font-size: 20px;">Додайте хоча б одну компанію</p>
            <a href="/add_company" class="button" style="margin-top: 10px; width: 200px; height: 30px; font-size: 20px;">Додати компанію</a><br/>
        @endif
        <br/>

        <label style="font-size: 20px; padding-top: 10px;">Тип</label><br/>
        @if(count($type) > 0)
        <select name="type" style="width: 500px; font-size: 20px; margin: auto">

                @foreach($type as $t)
                    <option value="{{$t->idType}}">{{$t->name}}</option>
                @endforeach
        </select>
        @else
            <p style="font-size: 20px;">Додайте хоча б один тип</p>
            <a href="/add_type" class="button" style="margin-top: 10px; width: 200px; height: 30px; font-size: 20px;">Додати тип</a>
        @endif





		<input type="submit" value="Створити" style="margin: 0px; width: 100%; font-size: 1vw; margin-top: 20px;" />
	</form>



</div>



</body>
</html>
