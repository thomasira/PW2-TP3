

<main>
    <header>
        <h2>Create User</h2>
    </header>
    <section>
       <form action="{{ path }}/user/store" method="post">
        <label>User name
            <input type="text" name="name" required>
        </label>
        <label>User email
            <input type="email" name="email" required>
        </label>
        <label>User password
            <input type="password" name="password" required>
        </label>
        <input type="submit" value="create" class="button">
       </form>
    </section>
</main>