{{ include('layouts/header.php', {title:'site edit'})}}

<div class="container">
    <form class="form-base" method="post">

        <h2>{{ site.siteNom }}</h2>
        <picture><img src="{{asset}}{{ site.urlImage }}" alt=""></picture>
        <input type="hidden" name="id" value="{{ site.id }}">

        <label>Nom du Site</label>
        <input type="text" name="siteNom" value="{{ site.siteNom }}">
        {% if errors.siteNom is defined %}
        <span class="error">{{ errors.siteNom }}</span>
        {% endif %}

        <label>Description du Site</label>
        <input type="text" name="siteDescription" value="{{ site.siteDescription }}">
        {% if errors.siteDescription is defined %}
        <span class="error">{{ errors.siteDescription }}</span>
        {% endif %}

        <label>Nombre de personnes</label>
        <input type="text" name="capacite" value="{{ site.capacite }}">
        {% if errors.capacite is defined %}
        <span class="error">{{ errors.capacite }}</span>
        {% endif %}

        <label>Prix</label>
        <input type="text" name="prix" value="{{ site.prix }}">
        {% if errors.prix is defined %}
        <span class="error">{{ errors.prix }}</span>
        {% endif %}

        <label>Lien url de l'image</label>
        <input type="text" name="urlImage" value="{{ site.urlImage }}">
        {% if errors.urlImage is defined %}
        <span class="error">{{ errors.urlImage }}</span>
        {% endif %}

        <label>Categorie</label>
        <select name="categorieId">
            <option value="">Select</option>
            {% for categorie in categories %}
            <option value="{{ categorie.id }}" {% if categorie.id == site.categorieId %} selected {% endif %}>{{ categorie.categorieNom }}</option>
            {% endfor %}
        </select>
        {% if errors.categorieId is defined %}
        <span class="error">{{ errors.categorieId }}</span>
        {% endif %}

        <input type="hidden" name="collaborateurId" value="{{ session.collaborateur_id }}">
        <input type="submit" class="bouton-submit" value="Enregistrer">
    </form>
</div>
{{ include('layouts/footer.php')}}