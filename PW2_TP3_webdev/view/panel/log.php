
<main>
    <header>
        <h2>Log</h2>
    </header>
    <section>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>IP address</th>
                    <th>Page</th>
                    <th>Date</th>
                    <th>User name</th>
                    <th>Privilege id</th>
                </tr>
            </thead>
            <tbody>
            {% for entry in log %}
                <tr>
                    <td>{{ entry.id }}</td>
                    <td>{{ entry.ip_address }}</td>
                    <td>{{ entry.page }}</td>
                    <td>{{ entry.date }}</td>
                    <td>{{ entry.user_name}}</td>
                    <td>{{ entry.privilege_id == "" ? "null" : entry.privilege_id }}</td>
                </tr>
            {% endfor %}
            </tbody>
        </table>
    </section>
</main>