
<body>
    <center>
        <div style="font-family: Arial, sans-serif; text-align: center; margin: 20px;">

            <h1 style="color: #333; font-size: 24px;">
                Tu registro ha sido exitoso
                <ul style="list-style-type: none; padding: 0;">
                    <li style="margin-top: 10px;">
                        <strong>Usuario:</strong> {{ $data['username'] }}
                    </li>
                    <li style="margin-top: 10px;">
                        @if ($data['password'] )
                        <strong>Contraseña:</strong> {{ $data['password'] }}
                        @else
                        <strong>Contraseña:</strong> Contraseña Antigua
                        @endif
                    </li>

                </ul>
            </h1>
        </div>
    </center>

</body>
