
<main>
    <header>
        <h2>All Staff</h2>
    </header>
    <section>
        {% for employees in staff %}
        <article>
            <h2>{{ employee.name }}</h2></a>
            <ul>
                <li>Email: <span>{{ employee.email }}</span></li>
                <li>Address: </li>
            </ul>
        </article>
        {% endfor %}
    </section>
</main>