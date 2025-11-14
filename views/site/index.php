{{ include('layouts/header.php', {title:'Site index'})}}

<section class="grille">
    {% for site in sites %}
    <article class="carte">
        <picture><img src="{{asset}}{{ site.urlImage }}" alt=""></picture>
        <div class="carte-detail">
            <h3>{{ site.siteNom }}</h3>
            <p>{{ site.siteDescription }}</p>
            <p>{{ site.capacite }} personnes</p>
            <p>{{ site.prix }} $</p>
            <a href="{{base}}/reservation/create?id={{ site.id }}" class="bouton">Reserver</a>
    </article>
    {% endfor %}
</section>

{{ include('layouts/footer.php')}}