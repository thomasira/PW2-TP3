
<main>
<h3>Create user</h3>
    <form action="{{ path }}user/store" method="post">
        <label>Name: 
            <input type="text" name="name" value="{{ user.name }}">{{ errors.name }}
        </label>
        <label>Username: 
            <input type="email" name="username" placeholder="email@email.com" value="{{ user.username }}">{{ errors.username }}
        </label>
        <label>Password: 
            <input type="password" name="password" placeholder="password">{{ errors.password }}
        </label>
        <label>Privilege
            <select name="privilege_id">
                {% for privilege in privileges %}
                <option value="{{ privilege.id }}" {{ privilege.id == user.privilege_id ? "selected" : "" }}>{{ privilege.privilege }}</option>
                {% endfor %}
            </select>
        </label>
        <input type="submit" value="save">
    </form>
</main>
