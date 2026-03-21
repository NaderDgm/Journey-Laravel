<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Inventaire de Stock</h1>
    <p>{{$totalprix}} DH</p>
    <form action="{{route('Prods.store')}}" method="POST">
        @csrf
        <input type="text" name="designation" placehorlder="Entre le Nom" required>
        <input type="number" name="prix" placeholder="Entre le prix" required>
        <input type="number" name="quantite_stock" placeholder="Number" required>
        <button type="submit">Ajouter</button>
    </form>
    <table border=1 style="margin:10px;">
        <tr>
        <th>ID</th>
        <th>Designation</th>
        <th>Prix</th>
        <th>Quantite de Stock</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    @foreach($produit as $p)
    <tr>
        <td>{{$p->id}}</td>
        <td>{{$p->designation}}</td>
        <td>{{$p->prix}}</td>
        <td>{{$p->quantite_stock}}</td>
        <td>{{$p->created_at->format('d/m/Y')}}</td>
        <td>
            <form action="{{route('Prods.destroy',$p->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    @endforeach
    </table>
</body>
</html>