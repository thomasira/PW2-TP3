
<main>
    <header>
        <h2>Edit Aspect</h2>
    </header>
    <section>
       <form action="{{ path }}aspect/update" method="post">
        <input type="hidden" name="id" value="{{ aspect.id }}">
        <label>Aspect name
            <input type="text" name="aspect" value="{{ aspect.aspect }}" required>
            <span class="error">{{ errors.aspect }}</span>
        </label>
        <input type="submit" value="update" class="button">
       </form>
    </section>
</main>