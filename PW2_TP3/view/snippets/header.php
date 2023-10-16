
<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Thomas Aucoin-Lo">
        <link rel="stylesheet" href="{{ path }}assets/style/main.css">
        <title>{{ title }}</title>
    </head>
    <body>
    <header>
        <h1>PW2-TP3</h1>
        <p>OOP | MVC</p>
    </header>
    <nav>
        <a href="{{ path }}">HOME</a>
        <a href="{{ path }}stamp">stamps</a>
        <a href="{{ path }}customer">users</a>
        <a href="{{ path }}category">categories</a>
    {% if session %}
        {% if session.privilege_id < 3 %}
            <a href="{{ path }}panel">Panel</a>
        {% elseif session.privilege_id == 3 %}
            <a href="{{ path }}customer/profile">Profile</a>
        {% endif %}

        <a href="{{ path }}login/logout">Logout</a>
    {% else %}
        <a href="{{ path }}login">Login</a> 
    {% endif %}
    </nav>
{% if session %}
    <div>
        Bienvenue {{ session.name }}
    {% if session.privilege_id < 3 %}
        <p>Vous êtes connecté en tant qu{{ session.privilege_id == 1 ? "e super-admin" : "'admin" }}</p>
    {% endif %}
    </div>
{% endif %}
    
