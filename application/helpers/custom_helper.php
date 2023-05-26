<?php
function template($a = '')
{
    return base_url('assets/template_contoh/' . $a);
}
function temp($a = '')
{
    return base_url('assets/' . $a);
}
function templatefile($a = '')
{
    return base_url('asset/file/permohonan/' . $a);
}
function leaflet($a = '')
{
    return base_url('assets/leaflet/' . $a);
}
function content_open($title = '', $subtitle = '')
{
    return '<div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>' . $title . '</h3>
                    </div>

        
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12  ">
                        
';
}
function content_close()
{
    return '                
                        
                    </div>
                </div>
            </div>
';
}
