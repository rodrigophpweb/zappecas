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

/*
    * Função para retornar o telefone do RH formatado para uso em link "tel:"
    * @return string Telefone do RH formatado
*/

function linkPhoneHR(){
    $phone = esc_html(get_field('wwu_hr_fone'));
    $phonelink = preg_replace('/[^0-9+]/', '', $phone);
    echo $phonelink;
}