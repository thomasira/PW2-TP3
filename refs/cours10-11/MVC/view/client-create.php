
<main>
<h3>Create</h3>
    <form action="{{ path }}client/store" method="post">
        <label>Name: 
            <input type="text" name="name" value="{{ client.name }}">{{ errors.name }}
        </label>
        <label>Address: 
            <input type="text" name="address" value="{{ client.address }}">{{ errors.address }}
        </label>
        <label>Zip code: 
            <input type="text" name="zipCode" placeholder="H4H 4H4" value="{{ client.zipCode }}">{{ errors.zipCode }}
        </label>
        <label>Phone: 
            <input type="text" name="phone" placeholder="514-555-5555" value="{{ client.phone }}">{{ errors.phone }}
        </label>
        <label>Email: 
            <input type="email" name="email" placeholder="email@email.com" value="{{ client.email }}">{{ errors.email }}
        </label>
        <label>Date of Birth: 
            <input type="date" name="dob" placeholder="1954" value="{{ client.dob }}">{{ errors.dob }}
        </label>
        <label>city
            <select name="city_id">
                {% for city in cities %}
                <option value="{{ city.id }}" {{ city.id == client.city_id ? "selected" : "" }}>{{ city.city }}</option>
                {% endfor %}
            </select>
        </label>
        <input type="submit" value="save">
    </form>
</main>
