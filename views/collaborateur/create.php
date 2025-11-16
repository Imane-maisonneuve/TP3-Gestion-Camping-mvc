{{ include('layouts/header.php', {title:'Collaborateur Create'})}}
<div>

    <form class="form-base" method="post">

        <h2>Nouveau collaborateur</h2>

        <label>Nom</label>
        <input type="text" name="nom" value="{{ collaborateur.nom }}">
        {% if errors.nom is defined %}
        <span class="error">{{ errors.nom }}</span>
        {% endif %}

        <label>Prenom</label>
        <input type="text" name="prenom" value="{{ collaborateur.prenom }}">
        {% if errors.prenom is defined %}
        <span class="error">{{ errors.prenom }}</span>
        {% endif %}

        <label>Adresse</label>
        <input type="text" name="adresse" value="{{ collaborateur.adresse }}">
        {% if errors.adresse is defined %}
        <span class="error">{{ errors.adresse }}</span>
        {% endif %}

        <label>Code Postal</label>
        <input type="text" name="codePostal" value="{{ collaborateur.codePostal }}">
        {% if errors.codePostal is defined %}
        <span class="error">{{ errors.codePostal }}</span>
        {% endif %}

        <label>Telephone</label>
        <input type="text" name="telephone" value="{{ collaborateur.telephone }}">
        {% if errors.telephone is defined %}
        <span class="error">{{ errors.telephone }}</span>
        {% endif %}

        <label>Courriel</label>
        <input type="email" name="courriel" value="{{ collaborateur.courriel }}">
        {% if errors.courriel is defined %}
        <span class="error">{{ errors.courriel }}</span>
        {% endif %}

        <label>Mot De Passe</label>
        <input type="password" name="motDePasse" value="{{ collaborateur.motDePasse }}">
        {% if errors.motDePasse is defined %}
        <span class="error">{{ errors.motDePasse }}</span>
        {% endif %}

        <label>Matricule</label>
        <input type="text" name="matricule" value="{{ collaborateur.matricule }}">
        {% if errors.matricule is defined %}
        <span class="error">{{ errors.matricule }}</span>
        {% endif %}

        <label>Privilege</label>
        <select name="privilegeId">
            <option value="">Select</option>
            {% for privilege in privileges %}
            <option value="{{ privilege.id }}" {% if privilege.id == collaborateur.privilegeId %} selected {% endif %}>{{ privilege.privilege }}</option>
            {% endfor %}
        </select>
        {% if errors.privilegeId is defined %}
        <span class="error">{{ errors.privilegeId }}</span>
        {% endif %}

        <input type="submit" class="bouton-submit" value="Enregistrer">
    </form>
</div>
{{ include('layouts/footer.php')}}