{{ include('layouts/header.php', {title:'Site index'})}}


<div class="entete-gestion-sites">
    <h3>Ajouter un site</h3>
    <a href="{{base}}/site/create?id={{ $_SESSION['collaborateur_id'] }}"><img src="{{asset}}img/add.png" alt=""></a>
</div>

<section class="grille">
    {% for site in sites %}
    <article class="carte">
        <picture><img src="{{asset}}{{ site.urlImage }}" alt=""></picture>
        <div class="carte-detail">
            <h3>{{ site.siteNom }}</h3>
            <p>{{ site.siteDescription }}</p>
            <p>{{ site.capacite }} personnes</p>
            <p>{{ site.prix }} $</p>
            {% if session is defined and session.privilege_id is empty %}
            <a href="{{base}}/reservation/create?id={{ site.id }}" class="bouton">Reserver</a>
            {% endif %}
            {% if session.privilege_id ==1 %}
            <div class="actions">
                <a href="{{base}}/site/edit?id={{ site.id }}" class="bouton bouton-submit">Modifier</a>
                <form action="{{base}}/site/delete" method="post">
                    <input type="hidden" name="id" value="{{ site.id }}">
                    <input type="submit" class="bouton bouton-submit" value="Supprimer">
                </form>
            </div>
            {% endif %}
    </article>
    {% endfor %}
</section>

{{ include('layouts/footer.php')}}