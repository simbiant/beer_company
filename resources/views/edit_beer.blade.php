<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/style.css') }}" rel="stylesheet" type="text/css" >
    <title>Edit beer</title>
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
	<form action="/edit_b/{{$info->idBeer}}" method="post">
        @csrf
		<label style="font-size: 20px; padding-top: 10px; margin: auto">Редагувати пиво</label><br/>
        <br/>
        <label style="font-size: 20px; padding-top: 10px; margin: auto">Назва</label><br/>
		<input type="text" style="font-size: 20px; margin: 10px 0 0 20px; width: 500px; margin: auto" name="name" value="{{$info->name}}" placeholder="Назва..." /><br/>
        <label style="font-size: 20px; padding-top: 10px;">Опис</label><br/>
        <input type="text" style="font-size: 20px; margin: 10px 0 0 20px; width: 500px; margin: auto" name="description" value="{{$info->description}}" placeholder="Опис..." /><br/>

        <label style="font-size: 20px; padding-top: 10px;">Компанія</label><br/>
            <select name="company" style="width: 500px; font-size: 20px; margin: auto">
                <option value="{{$info->idCompany}}" selected>{{$info->companyName}}</option>
            @foreach($company as $c)
                @if($info->idCompany == $c->idCompany)
                @else
                <option value="{{$c->idCompany}}">{{$c->name}}</option>
                @endif
                @endforeach
        </select>
        <br/>

        <label style="font-size: 20px; padding-top: 10px;">Тип</label><br/>
        <select name="type" style="width: 500px; font-size: 20px; margin: auto">

            <option value="{{$info->idType}}" selected>{{$info->typeName}}</option>
            @foreach($type as $t)
                @if($info->idType == $t->idType)
                @else
                    <option value="{{$t->idType}}">{{$t->name}}</option>
                @endif
            @endforeach
        </select>





		<input type="submit" value="Створити" style="margin: 0px; width: 100%; font-size: 1vw; margin-top: 20px;" />
	</form>



</div>



</body>
</html>
