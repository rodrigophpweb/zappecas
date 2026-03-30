<?php
/*
 * Função para retornar o telefone celular formatado
 * @return string Telefone celular formatado
*/

function linkPhone(){
    $phone = esc_html(get_field('phoneWebsite', 'option'));
    $phonelink = preg_replace('/[^0-9+]/', '', $phone);
    echo $phonelink;
}

/*
    * Função para retornar o telefone celular formatado
    * @return string Telefone celular formatado
*/

function cellPhone(){
    $phone = esc_html(get_field('cellPhoneWebsite', 'option'));
    $phonelink = preg_replace('/[^0-9+]/', '', $phone);
    echo $phonelink;
}