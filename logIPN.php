<?php
/**
 * Grava a mensagem da notificação em uma base de dados para
 * verificação de duplicidade e, se for o caso, análise das
 * notificações recebidas.
 * 
 * @param PDO $pdo Objeto de conexão com a base.
 * @param array $message Mensagem IPN
 *
 * @return boolean
 */
function logIPN(PDO $pdo, array $message)
{
    $stm = $pdo->prepare('
        INSERT INTO `ipn`(
            `txn_id`,
            `txn_type`,
            `receiver_email`,
            `payment_status`,
            `pending_reason`,
            `reason_code`,
            `custom`,
            `invoice`,
            `notification`,
            `hash`
        ) VALUES (
            :txn_id,
            :txn_type,
            :receiver_email,
            :payment_status,
            :pending_reason,
            :reason_code,
            :custom,
            :invoice,
            :notification,
            :hash
        );');
 
    $ipn = array_merge(array(
        'txn_id' => null,
        'txn_type' => null,
        'payment_status' => null,
        'pending_reason' => null,
        'reason_code' => null,
        'custom' => null,
        'invoice' => null
    ), $message);
 
    $notification = serialize($message);
    $hash = md5($notification);
 
    $stm->bindValue(':txn_id', $ipn['txn_id']);
    $stm->bindValue(':txn_type', $ipn['txn_type']);
    $stm->bindValue(':receiver_email', $ipn['receiver_email']);
    $stm->bindValue(':payment_status', $ipn['payment_status']);
    $stm->bindValue(':pending_reason', $ipn['pending_reason']);
    $stm->bindValue(':reason_code', $ipn['reason_code']);
    $stm->bindValue(':custom', $ipn['custom']);
    $stm->bindValue(':invoice', $ipn['invoice']);
    $stm->bindValue(':notification', $notification);
    $stm->bindValue(':hash', $hash);
 
    return $stm->execute();
}
