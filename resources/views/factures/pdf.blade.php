<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture PDF</title>

    <style>
        body {
            font-family: Arial;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
        }

        .box {
            border: 1px solid #000;
            padding: 15px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>

<div class="header">
    <div class="title">FACTURE EMS SENEGAL</div>
    <p>Système de gestion des clients</p>
</div>

<div class="box">

    <p><strong>Numéro :</strong> {{ $facture->numero }}</p>
    <p><strong>Client :</strong> {{ $facture->client->nom ?? '' }}</p>
    <p><strong>Date :</strong> {{ $facture->created_at }}</p>

</div>

<br>

<table>
    <tr>
        <th>Description</th>
        <th>Montant</th>
    </tr>

    <tr>
        <td>Service EMS</td>
        <td>{{ $facture->montant }} FCFA</td>
    </tr>
</table>

<br>

<h3>Total : {{ $facture->montant }} FCFA</h3>

</body>
</html>
