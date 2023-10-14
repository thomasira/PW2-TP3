<main>
    <header>
        <h2>Panel</h2>
    </header>
    <section>
        <a href="{{ path }}log"><h3>Log</h3></a>
    </section>
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
        <h3><a href="{{ path }}customer">Customer</a></h3>
        <ul>
        {% for customer in customers %}
            <li class="item-row">
                <a href="{{ path }}customer/show/{{ customer.id }}">{{ customer.name }}</a>
                <div>
                    <form action="{{ path }}customer/edit" method="post">
                        <input type="hidden" name="id" value="{{ customer.id }}">
                        <input type="submit" class="icon" value="&#9998;">
                    </form>
                    <form action="{{ path }}customer/delete" method="post">
                        <input type="hidden" name="id" value="{{ customer.id }}">
                        <input type="submit" class="icon" value="&#128465;">
                    </form>
                </div>
            </li>
        {% endfor %}
        </ul>
        <a href="{{ path }}customer/create" class="button">create</a>
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

{% if session.privilege_id == 1 %}
    <section>
        <h3><a href="{{ path }}staff">Staff</a></h3>
        <ul>
        {% for employee in staff %}
            <li class="item-row">
                <a href="{{ path }}staff/show/{{ employee.id }}">{{ employee.name }}</a>
                <p> | <strong>{{ employee.privilege }}</strong></p>
                <div>
                    <form action="{{ path }}staff/edit" method="post">
                        <input type="hidden" name="id" value="{{ employee.id }}">
                        <input type="submit" class="icon" value="&#9998;">
                    </form>
                    <form action="{{ path }}staff/delete" method="post">
                        <input type="hidden" name="id" value="{{ employee.id }}">
                        <input type="submit" class="icon" value="&#128465;">
                    </form>
                </div>
            </li>
        {% endfor %}
        </ul>
        <a href="{{ path }}staff/create" class="button">create</a>
    </section>
{% endif %}
</main>