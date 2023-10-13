
<main>
    <header>
        <h2>All users</h2>
    </header>
    <section>
        {% for user in users %}
        <article>
            <a href="{{ path }}user/show/{{user.id}}"><h2>{{ user.name }}</h2></a>
            <ul>
                <li>Email: <span>{{ user.email }}</span></li>
            </ul>
        </article>
        {% endfor %}
    </section>
</main>