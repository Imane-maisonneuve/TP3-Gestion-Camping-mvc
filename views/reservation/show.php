{{ include('layouts/header.php', {title:'Reservations show'})}}

<section>
    <h2>Mes reservations :</h2>

    {% for reservation in reservations %}
    <div class="reservation">
        {% for site in sites %}
        {% if site.id == reservation.siteId %}
        <picture><img src="{{asset}}{{ site.urlImage }}" alt=""></picture>
        <div class="infos">
            <h3>{{ site.siteNom }}</h3>
            {% endif %}
            {% endfor %}
            <p><strong>Date de reservation </strong>: {{ reservation.dateReservation }}</p>
            <p><strong>Date d'arrivee </strong>: {{ reservation.dateArrivee }} </p>
            <p><strong>Date de depart </strong>: {{ reservation.dateDepart }}</p>
            <p><strong>Nombre de personnes </strong>: {{ reservation.nbrDePersonnes }} personnes</p>
            {% for statut in statuts %}
            {% if statut.id == reservation.statutId %}
            <p><strong>Statut</strong> : {{ statut.statutDescription }}</p>
            {% endif %}
            {% endfor %}
            <div class="actions">
                <a href="{{base}}/reservation/edit?id={{ reservation.id }}" class="bouton bouton-submit">Modifier</a>
                <form action="{{base}}/reservation/delete" method="post">
                    <input type="hidden" name="id" value="{{ reservation.id }}">
                    <input type="hidden" name="courriel" value="{{ reservation.courriel }}">
                    <input type="submit" class="bouton bouton-submit" value="Supprimer">
                </form>
            </div>
        </div>
    </div>
    {% endfor %}
</section>

{{ include('layouts/footer.php')}}