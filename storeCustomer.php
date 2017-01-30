<?php
/**
 * Armazena os dados do cliente recebidos em uma notificação IPN.
 *
 * @param PDO $pdo Objeto de conexão com a base.
 * @param array $message Mensagem IPN
 *
 * @return boolean
 */
function storeCustomer(PDO $pdo, array $message)
{
    $stm = $pdo->prepare('
        INSERT INTO `customer` (
            `address_country`,
            `address_city`,
            `address_country_code`,
            `address_name`,
            `address_state`,
            `address_status`,
            `address_street`,
            `address_zip`,
            `contact_phone`,
            `first_name`,
            `last_name`,
            `business_name`,
            `email`,
            `paypal_id`
        ) VALUES (
            :address_country,
            :address_cit,
            :address_country_code,
            :address_name,
            :address_state,
            :address_status,
            :address_street,
            :address_zip,
            :contact_phone,
            :first_name,
            :last_name,
            :business_name,
            :email,
            :paypal_id
        );');

    $customer = array_merge(array(
        'address_country' => null,
        'address_city' => null,
        'address_country_code' => null,
        'address_name' => null,
        'address_state' => null,
        'address_status' => null,
        'address_street' => null,
        'address_zip' => null,
        'contact_phone' => null,
        'first_name' => null,
        'last_name' => null,
        'business_name' => null,
        'payer_email' => null,
        'payer_id' => null,
    ), $message);

    $stm->bindValue(':address_country', $customer['address_country']);
    $stm->bindValue(':address_city', $customer['address_city']);
    $stm->bindValue(':address_country_code', $customer['address_country_code']);
    $stm->bindValue(':address_name', $customer['address_name']);
    $stm->bindValue(':address_state', $customer['address_state']);
    $stm->bindValue(':address_status', $customer['address_status']);
    $stm->bindValue(':address_street', $customer['address_street']);
    $stm->bindValue(':address_zip', $customer['address_zip']);
    $stm->bindValue(':contact_phone', $customer['contact_phone']);
    $stm->bindValue(':first_name', $customer['first_name']);
    $stm->bindValue(':last_name', $customer['last_name']);
    $stm->bindValue(':business_name', $customer['business_name']);
    $stm->bindValue(':email', $customer['payer_email']);
    $stm->bindValue(':paypal_id', $customer['payer_id']);

    return $stm->execute();
}
