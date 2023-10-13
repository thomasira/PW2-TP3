
<main>
    <header>
        <h2>Panel</h2>
    </header>
    <section>
        <h3><a href="{{ path }}stamp">Stamps</a></h3>
        <ul>
        {% for stamp in stamps %}
            <li class="item-row">
                <a href="{{ path }}stamp/show/{{ stamp.id }}">{{ stamp.name }}</a>
                <div>
                    <form action="{{ path }}stamp/edit" method="post">
                        <input type="hidden" name="id" value="{{ stamp.id }}">
                        <input type="submit" class="icon" value="&#9998;">
                    </form>
                    <form action="{{ path }}stamp/delete" method="post">
                        <input type="hidden" name="id" value="{{ stamp.id }}">
                        <input type="submit" class="icon" value="&#128465;">
                    </form>
                </div>
            </li>
        {% endfor %}
        </ul>
        <a href="{{ path }}stamp/create" class="button">create</a>
    </section>

    <section>
        <h3><a href="{{ path }}user">Users</a></h3>
        <ul>
        {% for user in users %}
            <li class="item-row">
                <a href="{{ path }}user/show/{{ user.id }}">{{ user.name }}</a>
                <div>
                    <form action="{{ path }}user/edit" method="post">
                        <input type="hidden" name="id" value="{{ user.id }}">
                        <input type="submit" class="icon" value="&#9998;">
                    </form>
                    <form action="{{ path }}user/delete" method="post">
                        <input type="hidden" name="id" value="{{ user.id }}">
                        <input type="submit" class="icon" value="&#128465;">
                    </form>
                </div>
            </li>
        {% endfor %}
        </ul>
        <a href="{{ path }}user/create" class="button">create</a>
    </section>

    <section>
        <h3>Aspects</h3>
        <ul>
        {% for aspect in aspects %}
            <li class="item-row">{{ aspect.aspect }}
                <div>
                    <form action="{{ path }}aspect/edit" method="post">
                        <input type="hidden" name="id" value="{{ aspect.id }}">
                        <input type="submit" class="icon" value="&#9998;">
                    </form>
                    <form action="{{ path }}aspect/delete" method="post">
                        <input type="hidden" name="id" value="{{ aspect.id }}">
                        <input type="submit" class="icon" value="&#128465;">
                    </form>
                </div>
            </li>
        {% endfor %}
        </ul>
        <a href="{{ path }}aspect/create" class="button">create</a>
    </section>

    <section>
        <h3><a href="{{ path }}category">Categories</a></h3>
        <ul>
        {% for category in categories %}
            <li class="item-row">{{ category.category }}
                <div>
                    <form action="{{ path }}category/edit" method="post">
                        <input type="hidden" name="id" value="{{ category.id }}">
                        <input type="submit" class="icon" value="&#9998;">
                    </form>
                    <form action="{{ path }}category/delete" method="post">
                        <input type="hidden" name="id" value="{{ category.id }}">
                        <input type="submit" class="icon" value="&#128465;">
                    </form>
                </div>
            </li>
        {% endfor %}
        </ul>
        <a href="{{ path }}category/create" class="button">create</a>
    </section>
        
        
</main>