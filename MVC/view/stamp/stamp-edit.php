

<main>
    <header>
        <h2>Edit Stamp</h2>
    </header>
    <form action="{{ path }}stamp/update" method="post"  class="form-stamp">
        <section>
            <label>Name:
                <input type="text" name="name" value="{{ stamp.name }}"required>
            </label>
            <label>Origin:
                <input type="text" name="origin" value="{{ stamp.origin }}">
            </label>
            <label>Year:
                <input type="year" name="year" value="{{ stamp.year }}">
            </label>
            </label>
            <label>Aspect:
                <select name="aspect_id">
                    {% for aspect in aspects %}
                    <option value="{{ aspect.id }}"
                    {% if aspect.selected %}
                    {{ "selected" }}
                    {% endif %}>
                    {{ aspect.aspect }}</option>
                    {% endfor %}
                </select>
            </label>
            <label>description:
                <textarea name="description" cols="30" rows="10">{{ stamp.description }}</textarea>
            </label>
            {% if session_user.name == 'root' %}
            <label>User
                <select name="user_id">
                {% for user in users %}
                        <option value="{{ user.id }}">{{ user.name }}</option>
                {% endfor %}
                </select>
            </label>
            {% endif %}
            <input type="hidden" name="id" value="{{ stamp.id }}">
            <input type="submit" value="edit" class="button">
        </section>

        <section>
            <div>
                <h4>choose from our categories</h4>
                <div>
                    {% for category in categories %}
                        <input type="checkbox" name="category_id[{{ category.id }}]" value="1"
                        {% if category.checked %} {{ "checked" }}
                        {% endif %} id="category_id{{ category.id }}">
                        <label for="category_id{{ category.id }}" class="item-category">{{ category.category }}</label>
                    {% endfor %}
                </div>
            </div>
            <div>
                <h4>And/Or add your own categories(up to 5, you can add more by editing your stamps)</h4>

                <label>
                    <input type="text" name="new_categories[0]">
                </label>
                <label>
                    <input type="text" name="new_categories[1]">
                </label>
                <label>
                    <input type="text" name="new_categories[2]">
                </label>
                <label>
                    <input type="text" name="new_categories[3]">
                </label>
                <label>
                    <input type="text" name="new_categories[4]">
                </label>
            </div>
        </section>
    </form>
        

</main>
