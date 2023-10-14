
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
                    <th>{{ entry.id }}</th>
                    <th>{{ entry.ip_address }}</th>
                    <th>{{ entry.page }}</th>
                    <th>{{ entry.date }}</th>
                    <th>{{ entry.user_name}}</th>
                    <th>{{ entry.privilege_id == "" ? "null" : entry.privilege_id }}</th>
                </tr>
            {% endfor %}
            </tbody>
        </table>
    </section>
</main>