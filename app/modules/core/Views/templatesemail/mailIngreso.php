<table style="margin: auto;">
    <tr>
        <td>
            <img src="https://nomina.tacticaspanama.com/skins/page/images/logotacticas.png" alt="" height="100">
        </td>
    </tr>
</table>
<div style="font-family: Arial, sans-serif;  background-color: #f4f5f5; padding-top:20px; padding-bottom:20px;">
    <div style="width: 100%;max-width:500px; margin: auto; padding: 20px; background-color: #19A9C9; border-radius: 10px; color: #f4f5f5;">

        <div style="text-align: center; padding: 20px; background-color: #19A9C9; color: #f4f5f5; border-radius: 10px;">
            <h1>Estimado/a,</h1>
        </div>
        <p style="font-size:16px">
            Nos complace informarle que se ha generado una solicitud de ingreso a nombre de <?php echo $this->ingreso->ingreso_nombre . " " . $this->ingreso->ingreso_apellido; ?>. Por favor, haga clic en el siguiente enlace para continuar con su proceso de registro.
        </p>
        <p style="text-align:center">
            <a href="http://192.168.150.4:8042/page/login?emp=1&r=<?php echo $this->ingreso->ingreso_id; ?>" style="border:1px solid #FFF; border-color:#FFF; color:#FFF; display:inline-block; font-family:HMSans, Arial, sans-serif; font-size:16px; font-weight:700; line-height:20px; margin:0; outline:0; padding:12px; text-align:center; text-decoration:none; margin-top:15px;">Continuar</a>
        </p>

        <div style="text-align: center; padding: 20px;  border-radius: 10px; background-color: #19A9C9; color: #f4f5f5; border-radius: 10px;">

        </div>
    </div>
</div>