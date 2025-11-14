{{ include('layouts/header.php', {title:'reservation Create'})}}
<div>

    <form class="form-base" method="post">

        <h2>{{ site.siteNom }}</h2>

        <label>Date d'arrivee</label>
        <input type="date" name="dateArrivee" value="{{ reservation.dateArrivee }}">
        {% if errors.dateArrivee is defined %}
        <span class="error">{{ errors.dateArrivee }}</span>
        {% endif %}


        <label>Date de depart</label>
        <input type="date" name="dateDepart" value="{{ reservation.dateDepart }}">
        {% if errors.dateDepart is defined %}
        <span class="error">{{ errors.dateDepart }}</span>
        {% endif %}


        <label>Nombre de personnes</label>
        <input type="text" name="nbrDePersonnes" value="{{ reservation.nbrDePersonnes }}">
        {% if errors.nbrDePersonnes is defined %}
        <span class="error">{{ errors.nbrDePersonnes }}</span>
        {% endif %}

        <label>Votre Courriel</label>
        <input type="email" name="courriel" value="{{ reservation.courriel }}">
        {% if errors.courriel is defined %}
        <span class="error">{{ errors.courriel }}</span>
        {% endif %}

        <input type="hidden" name="siteId" value="{{ site.id }}">

        <input type="submit" class="bouton-submit" value="Enregistrer la reservation">
    </form>
</div>
{{ include('layouts/footer.php')}}