
<main>
    <header>
        <h2>All aspects</h2>
    </header>
    <section>
        {% for aspect in aspects %}
        <article>
            <p>{{ aspect.aspect }}</p>
            <a href="{{ path }}/aspect/modify" class="button">modify</a>
            <a href="{{ path }}/aspect/delete" class="button">delete</a>
        </article>
        {% endfor %}
    </section>
    <section>
        <a href="{{ path }}aspect/create" class="button">Create</a>
    </section>
</main>