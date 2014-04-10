<?php
/**
 * Verifica se uma notificação IPN é válida, fazendo a autenticação
 * da mensagem segundo o protocolo de segurança do serviço.
 * 
 * @param array $message Um array contendo a notificação recebida.
 * @return boolean TRUE se a notificação for autência, ou FALSE se
 *                 não for.
 */
function isIPNValid(array $message)
{
    $endpoint = 'https://www.paypal.com';
 
    if (isset($message['test_ipn']) && $message['test_ipn'] == '1') {
        $endpoint = 'https://www.sandbox.paypal.com';
    }
 
    $endpoint .= '/cgi-bin/webscr?cmd=_notify-validate';
 
    $curl = curl_init();
 
    curl_setopt($curl, CURLOPT_URL, $endpoint);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($message));
  
    $response = curl_exec($curl);
    $error = curl_error($curl);
    $errno = curl_errno($curl);
 
    curl_close($curl);
  
    return empty($error) && $errno == 0 && $response == 'VERIFIED';
}
