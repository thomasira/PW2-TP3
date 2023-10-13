<!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="author" content="Thomas Aucoin-Lo">

                <link rel="stylesheet" href="{{ path }}style/main.css">

                <title>MVC | {{ name }}</title>
            </head>
            <body>
            <header>
                <h1>MVC - OOP</h1>
                <p>cours 10-11 - Validation + login</p>
            </header>
            <nav>
                <a href="{{ path }}">HOME</a>
                <a href="{{ path }}client">CLIENT</a>
                <a href="{{ path }}user">USER</a>

                {% if guest %}
                <a href="{{ path }}login">LOGIN</a>
                {% else %}
                <a href="{{ path }}login/logout">LOGOUT</a>
                {% endif %}
            </nav>
