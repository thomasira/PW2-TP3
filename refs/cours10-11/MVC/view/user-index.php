
<main>
    <header>
        <h2>Welcome User</h2>
    </header>
    <section>
        {% for user in users %}
        <article>
            <h2>{{ user.name }}</h2>
            <ul>
                <li>Username: <span>{{ user.username}}</span></li>
                <li>Name: <span>{{ user.name }}</span></li>
                <li>Privilège: <span>{{ user.privilege }}</span></li>
            </ul>
        </article>
        {% endfor %}
    </section>
</main>