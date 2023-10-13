
<main>
    <header>
        <h2>Welcome Home     
        {% if session %}
            {{ session.username }}
        {% endif %}
        </h2>
        <p>This is a course about MVC architecture with OOP</p>
    </header>
</main>
