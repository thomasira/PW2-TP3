

<main>
    <header>
<!--     {% if staff %}
    {% elseif customer %}
    {% endif %} -->
        <h2>Create {{ customer ? "Customer" : "Staff"}}</h2>
    </header>
    <section>
       <form action="{{ path }}user/store" method="post">
        <label>Name
            <input type="text" name="name" required>
        </label>
        <label>Email
            <input type="email" name="email" required>
        </label>
        <label>Password(at least 8 car.)
            <input type="password" name="password" required>
        </label>
    {% if staff %}
        <label>N.A.S
            <input type="text" name="nas" required>
        </label>
        <label>Privilege
            <select name="privilege_id">
            {% for privilege in privileges %}
                {% if privilege.id != 3 %}
                    <option value="{{ privilege.id }}" >{{ privilege.privilege }}</option>
                {% endif %}
            {% endfor %}
            </select>
        </label>
    {% elseif customer %}
            <input type="hidden" name="privilege_id" value="3">
    {% endif %}
        <input type="submit" value="create" class="button">
       </form>
    </section>
</main>