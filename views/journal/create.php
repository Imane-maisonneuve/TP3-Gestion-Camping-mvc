{{ include('layouts/header.php', {title:'journal'})}}
<h2>Journal de bord:</h2>
<table>

    <tr>

        <th>Adresse IP</th>
        <th>Date et heure</th>
        <th>Page visitée</th>
        <th>Methode</th>
    </tr>

    {% for journal in session.journaux %}
    <tr>

        <td>{{ journal.ip }}</td>
        <td>{{ journal.dateEtHeure }}</td>
        <td>{{ journal.pageVisite }}</td>
        <td>{{ journal.method }}</td>
    </tr>
    {% endfor %}
</table>


{{ include('layouts/footer.php')}}