
<main>
    <header>
        <h2>Welcome to the stamp database</h2>
        <p>The place to share your stamps with the community</p>
    </header>
    <main>
        <section>
            {% for stamp in stamps %}
            <a href="{{ path }}stamp/show/{{ stamp.id }}">
                <article class="thumb-stamp">
                    <h3>{{ stamp.name }}</h3>
                    <div>
                        <p>{{ stamp.origin ? stamp.origin : 'Origin undefined'}}</p>
                        <p>{{ (stamp.year != 0) ? stamp.year : 'Year undefined'}}</p>
                    </div>
                </article>
            </a>
            {% endfor %}
        </section>
    </main>
</main>
