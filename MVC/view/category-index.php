<main>
    <header>
        <h2>All categories</h2>
    </header>
    <section>
        {% for category in categories %}
        <article>
            <p>{{ category.category }}</p>
        </article>
        {% endfor %}
    </section>
</main>