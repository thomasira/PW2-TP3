
<main>
<h3>Edit</h3>
    <form action="{{ path }}client/update" method="post">
        <input type="hidden" name="id" value="{{ client.id }}">
        <label>Name: 
            <input type="text" name="name" value="{{ client.name }}" required>
        </label>
        <label>Address: 
            <input type="text" name="address" value="{{ client.address }}">
        </label>
        <label>Zip code: 
            <input type="text" name="zipCode" value="{{ client.zipCode }}">
        </label>
        <label>Phone: 
            <input type="text" name="phone" value="{{ client.phone }}">
        </label>
        <label>Email: 
            <input type="email" name="email" value="{{ client.email }}" required>
        </label>
        <label>Date of Birth: 
            <input type="date" name="dob" value="{{ client.dob }}">
        </label>
        <select name="city_id">
            {% for city in cities %}
            <option value="{{ city.id }}" {% if city.id == client.city_id %} selected {% endif %} >{{ city.city }}</option>
            {% endfor %}
        </select>
        <input type="submit" value="save">
    </form>
    <form action="{{ path }}client/delete" method="post">
            <input type="hidden" name="id" value="{{ client.id }}">
            <input type="submit" value="delete">
    </form>
</main>
