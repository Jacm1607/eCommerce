<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Aloha!</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td valign="top"><img src="https://hauscenter.com.bo/email/images/logo-hauscenter-horizontal.png" alt="" width="150"/></td>
        <td align="right">
            <h3>Recibo de compra virtual - {{ $id }}</h3>
            <pre>
                Hauscenter
                Av. cañoto N°256 entre c/florida y junín.
                Telf.: (3) 359 99 24
            </pre>
        </td>
    </tr>

  </table>

  <table width="100%">
    <tr>
        <td><strong>Nombre(s) apellidos:</strong> {{ $name }} {{ $lastname }}</td>
        <td><strong>CI:</strong> {{ $ci }}</td>
        <td><strong>Celular:</strong> {{ $cellphone }}</td>
    </tr>
    <tr>
        <td><strong>Razón social:</strong> {{ $razon_social }}</td>
        <td><strong>NIT:</strong> {{ $nit }}</td>
        <td><strong>Email:</strong> {{ $email }}</td>
    </tr>
    <tr>
        <td colspan="3"><strong>Método de pago:</strong> {{ $pago_type }}</td>
    </tr>
    <tr>
        <td colspan="3"><strong>Método de envío:</strong> {{ $envio_type }} - {{ $address }} </td>
    </tr>

  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->name }}</td>
                <td align="right">{{ $item->qty }}</td>
                <td align="right"> Bs. {{ $item->price }}</td>
                <td align="right">Bs. {{ $item->qty * $item->price }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td align="right">Subtotal Bs.</td>
            <td align="right">{{ $total - $shipping_cost }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Costo de envío Bs.</td>
            <td align="right">{{ $shipping_cost }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Total </td>
            <td align="right" class="gray">Bs. {{ $total }}</td>
        </tr>
    </tfoot>
  </table>

  <br><br>

  <table width="100%" style="background-color: #113e66;color:white">
    <tr>
        <td><center><strong>© Copyright 2021. Hauscenter todos los derechos reservados.</strong></center></td>
    </tr>
    <tr>
        <td><center><strong>Este es un documento sin valor legal.</strong></center></td>
    </tr>

  </table>

</body>
</html>
