<?php

function is_logged_in($role)
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('admin_auth');
    } else {
        $tipe = $ci->session->userdata('tipe');
        if ($tipe != $role) {
            if ($tipe == 'kadin') {
                redirect('kadin');
            } elseif ($tipe == 'sekdin') {
                redirect('general');
            } elseif ($tipe == 'kabid') {
                redirect('general');
            } elseif ($tipe == 'kasi') {
                redirect('general');
            } elseif ($tipe == 'staf') {
                redirect('general');
            } elseif ($tipe == 'super_admin') {
                redirect('operator');
            } else {
                redirect('admin_auth/logout');
            }
        }
    }
}
