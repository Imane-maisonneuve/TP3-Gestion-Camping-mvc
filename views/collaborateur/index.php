{{ include('layouts/header.php', {title:'Liste des collaborateur'})}}
<h3>Liste des collaborateurs:</h3>
<table>

    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Adresse</th>
        <th>Code Postal</th>
        <th>Téléphone</th>
        <th>Courriel</th>
        <th>Matricule</th>
        <th>Privilege </th>
        <th>Date de création</th>
    </tr>

    {% for collaborateur in collaborateurs %}
    <tr>
        <td>{{ collaborateur.nom }}</td>
        <td>{{ collaborateur.prenom }}</td>
        <td>{{ collaborateur.adresse }}</td>
        <td>{{ collaborateur.codePostal }}</td>
        <td>{{ collaborateur.telephone }}</td>
        <td>{{ collaborateur.courriel }}</td>
        <td>{{ collaborateur.matricule }}</td>

        {% for privilege in privileges %}
        {% if privilege.id == collaborateur.privilegeId %}
        <td>{{ privilege.privilege }}</td>
        {% endif %}
        {% endfor %}

        <td>{{ collaborateur.created_at }}</td>
    </tr>
    {% endfor %}
</table>

{% if session.privilege_id ==1 %}
<a href="{{base}}/collaborateur/create" class="bouton bouton-submit "> Ajouter un collaborateur</a>
{% endif %}

{{ include('layouts/footer.php')}}