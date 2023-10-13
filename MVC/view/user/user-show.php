
<main>
    <article class="file-user">
        <header>
            <h2>{{ user.name }}</h2>
            <p>user id: {{ user.id }}</p>
        </header>
        <section>
            <h3>{{ user.name }}'s stamps</h3>
            <div>
                {% for stamp in stamps %}
                    <a href="{{ path }}/stamp/show/{{ stamp.id }}">{{ stamp.name }}</a>
                {% endfor %}
            </div>
        </section>
    </article>
</main>