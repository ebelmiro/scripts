<?php
	$arrIpsValidos = array('187.115.154.226', '177.52.17.254', '177.52.17.242', '187.115.154.72', 
							'177.52.19.190', '200.98.162.111', '200.98.201.42', '200.98.71.219', 
							'200.98.129.48', '200.98.129.42', '200.98.141.238', '200.98.140.197', 
							'200.98.144.50', '200.98.165.221', '200.98.137.219', '200.98.150.190', 
							'200.199.23.20', '200.221.128.106', '54.245.237.145', '200.221.128.94', 
							'187.113.166.219', '152.240.33.101');
	$headers = apache_request_headers(); 
	$real_client_ip = $headers["X-Forwarded-For"];

	echo $real_client_ip;
?>