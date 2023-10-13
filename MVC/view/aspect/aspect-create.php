
<main>
    <header>
        <h2>Create Aspect</h2>
    </header>
    <section>
       <form action="{{ path }}aspect/store" method="post">
        <label>Aspect name
            <input type="text" name="aspect" required>
        </label>
        <input type="submit" value="create" class="button">
       </form>
    </section>
</main>