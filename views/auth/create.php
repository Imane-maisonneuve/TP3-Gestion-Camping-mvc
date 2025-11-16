{{ include('layouts/header.php', {title:'Login'})}}

<form class="form-base" method="POST">
    <h2>Connectez-vous! </h2>

    <label for="courriel">Courriel</label>
    <input id="courriel" name="courriel" type="email" />
    {% if errors.courriel is defined %}
    <span class="error">{{ errors.courriel }}</span>
    {% endif %}

    <label for="motDePasse">Mot de passe</label>
    <input id="motDePasse" name="motDePasse" type="password" />
    {% if errors.motDePasse is defined %}
    <span class="error">{{ errors.motDePasse }}</span>
    {% endif %}

    <input type="submit" value="Se connecter" class="bouton-submit" />
</form>

{{ include('layouts/footer.php')}}