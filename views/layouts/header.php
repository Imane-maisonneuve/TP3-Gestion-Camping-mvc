<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }}</title>
    <link rel="stylesheet" href="{{ asset }}css/style.css">
</head>

<body>
    <header>
        <nav id=navigation>
            <h1>Camping Les Belles Montagnes</h1>
            <div id=menu>
                <a href="{{base}}/"><img src="{{asset}}img/home.png" alt=""></a>
                {% if session.privilege_id == 1 %}
                <a href="{{base}}/"><img src="{{asset}}img/journal.png" alt=""></a>
                {% endif %}
                <!-- <a href="{{base}}/reservations"><img src="{{asset}}img/user.png" alt=""></a> -->
                {%if guest %}
                <a href="{{base}}/login"><img src="{{asset}}img/user.png" alt=""></a>
                {% else %}
                <a href="{{base}}/logout"><img src="{{asset}}img/logout.png" alt=""></a>
                {% endif %}
            </div>
        </nav>
    </header>
    <main>