{{ include('layouts/header.php', {title:'reservations'})}}
<div>

    <form class="form-base" action="{{base}}/reservation/show?courriel={{courriel}}">
        <label>Votre Courriel</label>
        <input type="email" name="courriel" value="">
        {% if errors.courriel is defined %}
        <span class="error">{{ errors.courriel }}</span>
        {% endif %}

        <input type="submit" class="bouton-submit" value="Voir mes reservations">
    </form>
</div>
{{ include('layouts/footer.php')}}