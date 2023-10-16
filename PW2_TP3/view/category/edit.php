
<main>
    <header>
        <h2>Edit Category</h2>
    </header>
    <section>
       <form action="{{ path }}category/update" method="post">
        <input type="hidden" name="id" value="{{ category.id }}">
        <label>Category name
            <input type="text" name="category" value="{{ category.category }}" required>
            <span class="error">{{ errors.category }}</span>
        </label>
        <input type="submit" value="update" class="button">
       </form>
    </section>
</main>