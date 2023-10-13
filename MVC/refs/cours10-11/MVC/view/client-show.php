
<main>
    <header>
        <h2>Welcome {{ s.name }}</h2>
    </header>
    <section>
        <article>
            <ul>
                <li>Email: <span>{{ client.email }}</span></li>
                <li>Phone: <span>{{ client.phone }}</span></li>
                <li>Address: <span>{{ client.address }}</span></li>
                <li>Zip Code: <span>{{ client.zipCode }}</span></li>
                <li>Date of Birth: <span>{{ client.dob }}</span></li>
                <li>City: <span>{{ client.city }}</span></li>
            </ul>
        </article>
        <a class="btn" href="{{ path }}client/edit/{{client.id}}">Modify</a>
    </section>
</main>