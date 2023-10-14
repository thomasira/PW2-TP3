

<main>
    <header>
        <h2>Create Stamp</h2>
    </header>
    <form action="{{ path }}stamp/store" method="post" class="form-stamp" enctype="multipart/form-data">
        <section>
            <label>Name:
                <input type="text" name="name" required>
            </label>
            <label>Origin:
                <input type="text" name="origin">
            </label>
            <label>Year:
                <input type="year" name="year">
            </label>
            <label>Image: 
                <input type="file" accept="image/*" name="stampUpload">
            </label>
            
            </label>
            <label>Aspect:
                <select name="aspect_id">
                    {% for aspect in aspects %}
                    <option value="{{ aspect.id }}">{{ aspect.aspect }}</option>
                    {% endfor %}
                </select>
            </label>
            <label>description:
                <textarea name="description" cols="30" rows="10"></textarea>
            </label>
            {% if session.privilege_id < 3 %}
            <label>User
                <select name="customer_user_id">
                {% for customer in customers %}
                    <option value="{{ customer.user_id }}">{{ customer.name }}</option>
                {% endfor %}
                </select>
            </label>
            {% else %}
            <input type="hidden" name="customer.user_id" value="{{ session.id }}">
            {% endif %}
            <input type="submit" value="create" class="button">
        </section>

        <section>
            <div>
                <h4>choose from our categories</h4>
                <div>
                    {% for category in categories%}
                    <input type="checkbox" id="category_id[{{ category.id }}]" name="category_id[{{ category.id }}]" value="1">
                    <label for="category_id[{{ category.id }}]" class="item-category">{{ category.category }}</label>
                    {% endfor%}
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
