
<main>
<h3>Login</h3>
    <form action="{{ path }}login/auth" method="post">
        <label>Username: 
            <input type="email" name="username" placeholder="email@email.com" value="{{ user.username }}">{{ errors.username }}
        </label>
        <label>Password: 
            <input type="password" name="password" placeholder="password">{{ errors.password }}
        </label>
        <input type="submit" value="login">
    </form>
</main>
