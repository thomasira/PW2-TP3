

<main>
    <section>
        {% if error %} 
        <p class="error">{{ error }}</p>
        {% endif %}
        <h2>Login</h2>
        {% if success %} 
        <p class="succes">{{ success }}</p>
        {% endif %}
        <form action="{{ path }}user/auth" method="post">
            <label>Email
                <input type="email" name="email" required>
            </label>
            <label>Password:
                <input type="password" name="password" required>
            </label>
            <input type="submit" value="login" class="button">
        </form>
    </section>

    <section>
        <h2>Create account</h2>
        <form action="{{ path }}user/store" method="post">
            <label>Name:
                <input type="text" name="name" required>
            </label>
            <label>Email:
                <input type="text" name="email" placeholder="valid email address" required>
            </label>
            <label>Password:
                <input type="password" name="password" placeholder="6-20 char.(A-z AND 0-9)" minlength="8" required>
            </label>
            <input type="submit" value="create" class="button">
        </form>
    </section>
</main>
    