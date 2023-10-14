
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
                    <th>{{ stamp.id }}</th>
                    <th>{{ stamp.name }}</th>
                    <th>{{ stamp.description }}</th>
                    <th>{{ stamp.origin }}</th>
                    <th>{{ stamp.year}}</th>
                    <th>{{ stamp.aspect_id }}</th>
                    <th>{{ stamp.customer_user_id }}</th>
                </tr>
            {% endfor %}
            </tbody>
        </table>
    </section>
</main>