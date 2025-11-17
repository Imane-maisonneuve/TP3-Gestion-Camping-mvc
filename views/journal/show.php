{{ include('layouts/header.php', {title:'journal'})}}
<h2>Journal de bord:</h2>
<table>

    <tr>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Privilege</th>
        <th>Adresse IP</th>
        <th>Date et heure</th>
        <th>Page visitée</th>
        <th>Methode</th>
    </tr>

    {% for journal in journaux %}
    <tr>
        <td>{{ journal.nom }}</td>
        <td>{{ journal.prenom }}</td>


        {% if journal.privilege == '' %}
        <td>Pas de privilege</td>
        {% else %}
        {% for privilege in privileges %}
        {% if privilege.id == journal.privilege %}
        <td>{{ privilege.privilege }}</td>
        {% endif %}
        {% endfor %}
        {% endif %}
        <td>{{ journal.ip }}</td>
        <td>{{ journal.dateEtHeure }}</td>
        <td>{{ journal.pageVisite }}</td>
        <td>{{ journal.method }}</td>
    </tr>
    {% endfor %}
</table>


{{ include('layouts/footer.php')}}