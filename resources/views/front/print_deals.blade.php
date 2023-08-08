<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Deals For Weddings </title>

</head>

<body class="email-template">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td align="center">
					<table class="col-900" width="900" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:20px; margin-right:20px; border-width: 10px; border-style: solid;border-color: #636680;background-color: #fff8f7;">
						<tbody>
							<tr>
								<td height="20"></td>
							</tr>
							<tr>
								<td align="center"><img src="{{asset('/public/front/images/logo2.png')}}" alt="Deals For Weddings" /></td>
							</tr>
							<tr>
								<td height="20"></td>
							</tr>
							<tr>
								<td style="font-size:40px; padding:0 20px;font-weight: bold; color:#515151; text-transform: uppercase;">{{$deal->title}}</td>
							</tr>
							<tr>
								<td height="10"></td>
							</tr>
							<tr>
								<td align="center" style="padding:0 20px;font-family: 'Lato', sans-serif; font-size:14px; line-height:24px; font-weight: 300;"><img style="max-height: 500px; object-fit: contain;" src="{{asset('public/' . $deal->image)}}" width="100%">
									<p style="font-size: 3em; margin:0; margin-top:10px; font-weight: bold; color: green;">USE CODE: {{$deal->discountcode}}</p>
								</td>
							</tr>
							<tr>
								<td height="10"></td>
							</tr>
							<tr>
								<td style="padding:0 20px;font-family: 'Lato', sans-serif; font-size:30px;  font-weight: 700;color:#f2a391;">${{$deal->offer_price}}</td>
							</tr>
							<tr>
								<td height="10"></td>
							</tr>
							<tr>
								<td style="padding:0 20px;font-family: 'Lato', sans-serif; font-size:14px; line-height:24px; font-weight: 300;">{!! $deal->description !!}</td>
							</tr>
							<tr>
								<td height="15"></td>
							</tr>
							<tr>
								<td style="padding:0 20px;font-family: 'Lato', sans-serif;"><a href="{{route('home.deal_detail', $deal->slug)}}" style="color:#fff;text-decoration:none;background-color: #636680;border-color: #636680;text-transform: uppercase;display: table;padding: 10px 26px;font-size: 14px;font-weight: 800;border-radius: 6px;">Show Me Deals</a></td>
							</tr>
							<tr>
								<td height="20"></td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</body>

</html>