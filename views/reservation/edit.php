{{ include('layouts/header.php', {title:'Reservation edit'})}}
<div class="container">
    <form class="form-base" method="post">

        <h2>{{ site.siteNom }}</h2>
        <picture><img src="{{asset}}{{ site.urlImage }}" alt=""></picture>
        <input type="hidden" name="id" value="{{ reservation.id }}">
        <input type="hidden" name="courriel" value="{{ reservation.courriel }}">

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

        <label>Statut</label>
        <select name="statutId">
            <option value="">Select</option>
            {% for statut in statuts %}
            <option value="{{ statut.id }}" {% if statut.id == reservation.statutId %} selected {% endif %}>{{ statut.statutDescription }}</option>
            {% endfor %}
        </select>
        {% if errors.statutId is defined %}
        <span class="error">{{ errors.statutId }}</span>
        {% endif %}

        <input type="submit" class="bouton-submit" value="Mettre à jour">
    </form>
</div>
{{ include('layouts/footer.php')}}