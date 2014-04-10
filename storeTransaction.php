<?php
/**
 * Armazena os dados da transação recebidos em uma notificação IPN.
 *
 * @param PDO $pdo Objeto de conexão com a base.
 * @param array $message Mensagem IPN
 *
 * @return boolean
 */
function storeTransaction(PDO $pdo, array $message)
{
    $stm = $pdo->prepare('
        INSERT INTO `transaction` (
            `invoice`,
            `custom`,
            `txn_type`,
            `txn_id`,
            `payer_id`,
            `currency`,
            `gross`,
            `fee`,
            `handling`,
            `shipping`,
            `tax`,
            `payment_status`,
            `pending_reason`,
            `reason_code`
        ) VALUES (
            :invoice,
            :custom,
            :txn_type,
            :txn_id,
            :payer_id,
            :currency,
            :gross,
            :fee,
            :handling,
            :shipping,
            :tax,
            :payment_status,
            :pending_reason,
            :reason_code
        );');
 
    $transaction = array_merge(array(
        'invoice' => null,
        'custom' => null,
        'txn_type' => null,
        'txn_id' => null,
        'payer_id' => null,
        'mc_currency' => null,
        'mc_gross' => null,
        'mc_fee' => null,
        'mc_handling' => null,
        'mc_shipping' => null,
        'tax' => null,
        'payment_status' => null,
        'pending_reason' => null,
        'reason_code' => null,
    ), $message);
 
    $stm->bindValue(':invoice', $transaction['invoice']);
    $stm->bindValue(':custom', $transaction['custom']);
    $stm->bindValue(':txn_type', $transaction['txn_type']);
    $stm->bindValue(':txn_id', $transaction['txn_id']);
    $stm->bindValue(':payer_id', $transaction['payer_id']);
    $stm->bindValue(':currency', $transaction['mc_currency']);
    $stm->bindValue(':gross', $transaction['mc_gross']);
    $stm->bindValue(':fee', $transaction['mc_fee']);
    $stm->bindValue(':handling', $transaction['mc_handling']);
    $stm->bindValue(':shipping', $transaction['mc_shipping']);
    $stm->bindValue(':tax', $transaction['tax']);
    $stm->bindValue(':payment_status', $transaction['payment_status']);
    $stm->bindValue(':pending_reason', $transaction['pending_reason']);
    $stm->bindValue(':reason_code', $transaction['reason_code']);
 
    return $stm->execute();
}
