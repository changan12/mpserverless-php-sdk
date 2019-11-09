<?php
/**
 * The following code, none of which has BUG.
 *
 * @author: BD<657306123@qq.com>
 * @date: 2019/11/8 13:48
 */
use duoguan\aliyun\serverless\logger\PrintLogger;
use duoguan\aliyun\serverless\Serverless;
use duoguan\aliyun\serverless\ServerlessException;

require_once '../vendor/autoload.php';

$serverless = new Serverless([
	'space_id'      => '439ed76d-0384-4a39-9c21-4034944aa24a',
	'private_key'   => '-----BEGIN PRIVATE KEY-----
MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQD3tIgxdoLuxtJjzXQo8sLHAx8YcW0ggzMTebp9cDCKbv68Oswum7jiPjH3fCPQpvJ2Vw/+fFuHgiAPlxwBFaQ4lqPnFgPTm5r5ZUNO8eGqkED5k+5PYo2tbdAhzUiZ3Vu4IMa2x5UZs9MX0DrL7s8WVymHdBx0PQRJD17OFbH5VtOG4E195ozTON7ZSmokI+N7czKnpc7FpiBRyFaEkk08xsKZXWKadHLc2W2EnwQ0FmO3eXZQNQkG7kWIHVBa0GlpfIv1cvVDbMghRN7lkzLCXfMFzq1wFPGMr0vwB1qZ6XcUffm75mWI5rS3uQo0MOPbq+qyvT9FezYs2KIp/817AgMBAAECggEBAPFCzUQgAfc/f7vlaLZZfI0J5UeRcpCwORdHAPUcSKsM4N/FBQqAcdsqaNB8AQZBFPdeZR2hUiTyAPguXgBQa9sSHiH9t0xrys4OaziBLyNJzX9JLlvzybqZspa5s3TpvWPhyKpOSlL2ayxOjHYE637+9lwQI4azx3DBn71qNCZ9GI2GhkmktI6LOxeHoP6EtXrFExChjIRy17hKgRbzJASFoJ7dizvlbzEQpJwD48n/1gDhwmIT1z2y1NwbHkLxQaj9iCil/+JspukMWa086LfKiW4R6J9W13yDazzlrk7thZ1IswC/CAXWs0x3YWVRufMOuSY96N9q8Fd+4Ql9BsECgYEA/RQ7Dhr/0kHzu7Ws3vMkFa1bmW6grzPFMZAlfcU3XzF6qjdftgP2nkqrJd/KI6hbXlO4/tDcW/L0j9i3rGSgW2LiJwuiiaKo+kc1Zq70ob1woz039RX6aQgC/Z++JkZCBvkfZ2F8TiltXDKcLUdiaRAgDKUhG/gsvwGcCSs/t20CgYEA+pBsYQrBAUSfKLXwzNfYrV63tRz1u/0K4dBalmQ4ExIXrlvGIMJQ3jPKJ4JGXBxR0R8f53zye4ioTUFZJnS61Snd7UdQoHgQWgl3w7N/MkF09XbK7ShX2daawcBaOm+2XvZyfq4EiqoCwghDJeXU7ni7+hMqDMohhDeoC6mjf4cCgYEAgpSor+uAaeV7tDPWQackzEaJh85L/Hpy2dLtdUqH+ocWKrOtn8XFvwD58+3XZ7SbiD0cq+XqfUsLoxkIFFxLXTvVQp4/PFMAazrIs/W75aRQdPnGYJ/5d64ZlPGSdD82HFD4QihLsiyv761xZe96OImIb93YCo1v0RIsh5KYKrUCgYARAXxZmcE/tMiYmsCdJokuOx98y1piR+pVKS78xhCIOtIgo1nvH0Ed06YEyHK+Da3/43zm2TQb7kp989F5KrMDhLPrRsvSGFQDyGC4h5Y6cvbdMhLTxckwn8AhJkz5aluWVmOu9WCZiLBnOuhTyiWJieg4MNTJyW486wocwIa4QQKBgQDlRZ01zglAKo97o/6wfWfHOSiGn6tZ7jguHYpBGo9MFjQt1OSGkEH07C+KE6Iqujq4fXVxDVnL23NjXUlDZX4LnxONrjTuFl1mDz5nk+Qq2QiUAEFuOaejWReSRWizYEArdC5nqHTbxz2RgTwP5NAhVI6OEisBvwCvsfb/ovQhOA==
-----END PRIVATE KEY-----',
	'failException' => true,
]);
$serverless->setLogger(new PrintLogger());

try{
	$file = $serverless->file;
	$info = $file->putFile('public', "./000.jpg");
	var_dump($info);
}catch(ServerlessException $e){
	echo $e->getMessage();
}

//try{
//	$file = $serverless->file;
//	$info = $file->putData('public', "./000.jpg", file_get_contents("./000.jpg"));
//	var_dump($info);
//}catch(ServerlessException $e){
//	echo $e->getMessage();
//}
