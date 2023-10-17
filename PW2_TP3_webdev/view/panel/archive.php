
<main>
    <header>
        <h2>Archive</h2>
    </header>
    <section>
        <table>
            <thead>
                <tr>
                    <th>Stamp Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Origin</th>
                    <th>Year</th>
                    <th>Aspect_id</th>
                    <th>Customer Id</th>
                </tr>
            </thead>
            <tbody>
            {% for stamp in archive %}
                <tr>
                    <td>{{ stamp.id }}</td>
                    <td>{{ stamp.name }}</td>
                    <td>{{ stamp.description }}</td>
                    <td>{{ stamp.origin }}</td>
                    <td>{{ stamp.year}}</td>
                    <td>{{ stamp.aspect_id }}</td>
                    <td>{{ stamp.customer_user_id }}</td>
                </tr>
            {% endfor %}
            </tbody>
        </table>
    </section>
</main>