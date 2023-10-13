
<main>
    <header>
        <h2>Edit User</h2>
    </header>
    <section>
       <form action="{{ path }}user/update" method="post">
        <label>User name
            <input type="text" name="name" value="{{ user.name }}" required>
        </label>
        <label>User email
            <input type="email" name="email" value="{{ user.email }}" required>
        </label>
        <input type="hidden" name="id" value="{{ user.id }}">
        <input type="submit" value="update" class="button">
       </form>
    </section>
</main>