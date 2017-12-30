<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nota Pedido</title>
	<style>
		body{
			width: 100%;
			/* margin-left: 10%; */
            /* border: 1px solid black; */
		}

		table{
            width:100%;
            border-collapse:collapse;
        }
        div.logo{
        	width: 19%;
        	height: 5%;
        	/* border: 1px solid black;
        	background-color: gray;*/
        	display: inline-block; 
        }
        div.info{
			width: 45%;
        	height: 10%;
        	display: inline-block;
        	/* border: 1px solid black; */
        	margin-top: 5px;
        	text-align: center;
        	font-size: 10px;
        }

        div.info > p{
        	margin: 1px;
        }

        div.nota{
			width: 28%;
        	height: 10%;
        	display: inline-block;
        	/* border: 1px solid black; */
        	text-align: center;
        }

        img.letra{
			width: 170px;
			height: 50px;
        }

        p.border-Title{
        	/* border-radius: 1px 1px 25px 1px; */
        	color: white;
        	/* border: 1px solid black; */
        	font-size: 12px;
        	font-weight: bold;
        	margin: 0px;
        	padding: 5px;
        }

        p.Red{
        	background-color: rgb(255,0,0);
        }

        p.Black{
        	background-color: rgb(0,0,0);
        }

		td.border{
			border: 1px solid black; 
		}

		.text-center{
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="logo">
		<img src="img/LogoSinLetra.jpg">
	</div>
	<div class="info">
		<img src="img/letra_logo.png?>" class="letra">
		<p>Orquidea #58 Fracc. la Primavera c.p 49600, Zapotiltic, Jal.</p>
		<p><b>Tels:</b> 01(341) 414-44-44, 414-44-45</p>
		<p><b>Email:</b> pinturaspegaza@hotmail.com</p>
	</div>
	<div class="nota">
		<p class="border-Title Red">FECHA</p>
		<p style="margin:2px;font-size:12px;"><b><?php echo $produccion->created_at ?> </b></p>
	</div>
	<br><br>
	<table style="border: 1px solid black;margin-top:15px;">
		<tbody>
			<tr>
				<td class="border text-center"><p class="border-Title Red">PRODUCTOS A PRODUCIR</p></td>
				<td class="border text-center"><p class="border-Title Black">MATERIAL A ENVIAR</p></td>
			</tr>
			<tr>
				<td class="border">
					<ul>
						<?php foreach ($productos as $producto): ?>
							<li><?php echo $producto ?></li>
						<?php endforeach ?>
					</ul>
				</td>
				<td class="border">
					<ul>
						<?php foreach ($materiales as $material): ?>
							<li><?php echo $material ?></li>
						<?php endforeach ?>
					</ul>
				</td>
			</tr>
		</tbody>
	</table>
	<p>
		<b>Memo:</b>
	</p>
	<p>
		<?php echo $produccion->pr_memo ?>
	</p>
</body>

</html>