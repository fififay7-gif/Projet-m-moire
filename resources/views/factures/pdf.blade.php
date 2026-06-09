<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture EMS Voyage</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ffffff;
            color: #111827;
        }

        /* HEADER EMS */
        .header {
            text-align: center;
            padding: 20px;
            border-bottom: 3px solid #1e3a8a;
            margin-bottom: 25px;
        }

        .header h1 {
            color: #1e3a8a;
            font-size: 26px;
            margin: 0;
        }

        .header p {
            color: #6b7280;
            margin: 5px 0 0 0;
        }

        /* INFO BOX */
        .box {
            border-left: 5px solid #f97316;
            background: #f9fafb;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .box p {
            margin: 6px 0;
            font-size: 14px;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        thead {
            background: #1e3a8a;
            color: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #e5e7eb;
            text-align: left;
            font-size: 14px;
        }

        tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        /* TOTAL */
        .total {
            margin-top: 20px;
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #1e3a8a;
        }

        .amount {
            color: #10b981;
        }

        /* FOOTER */
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }

    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <h1>FACTURE EMS VOYAGE</h1>
        <p>Système de gestion des clients & billetterie</p>
    </div>

    <!-- INFOS FACTURE -->
    <div class="box">
        <p><strong>Numéro :</strong> {{ $facture->numero_facture ?? $facture->numero }}</p>
        <p><strong>Client :</strong> {{ $facture->client->nom ?? '' }}</p>
        <p><strong>Date :</strong> {{ $facture->created_at }}</p>
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Montant</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Service EMS Voyage</td>
                <td>{{ number_format($facture->montant, 0, ',', ' ') }} FCFA</td>
            </tr>
        </tbody>
    </table>

    <!-- TOTAL -->
    <div class="total">
        Total :
        <span class="amount">
            {{ number_format($facture->montant, 0, ',', ' ') }} FCFA
        </span>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        EMS Voyage - Document généré automatiquement par le système
    </div>

</body>
</html>
