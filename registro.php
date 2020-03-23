<?php
//INCLUDE CONFIG FILE
include 'config.php';
$content = '';

//QUITAR ELEMNTO DE UN ARRAY con unset($array['key']);
//$array_td = [];
//PARA REALIZAR PRUEBAS DEV.
//$html->print_pre($_POST);

$input_class = 'form-control mt-4';

//DEFINIR INPUTS O BOTONES PRINCIPALES
$nombre = $utilities->post('nombre');
$apellido_p = $utilities->post('apellido_p');
$apellido_m = $utilities->post('apellido_m');
$telefono = $utilities->post('telefono');

//HACER VALIDACIONES DE REGISTRO
if(array_key_exists('nombre', $_POST)){
  if($nombre == '' || $apellido_p == '' || $apellido_m == '' || $telefono == ''){
    $html_alert = $html->alert('Mensaje', 'Revisa tu información', 'danger');
  }else{
    //AGREGAR NUEVO RENGLÓN
    $input_hidden_nombre = $html->input(['name' => 'valores[nombre][]', 'value' => $nombre, 'type' => 'hidden']);
    $input_hidden_apellido_p = $html->input(['name' => 'valores[apellido_p][]', 'value' => $apellido_p, 'type' => 'hidden']);
    $input_hidden_apellido_m = $html->input(['name' => 'valores[apellido_m][]', 'value' => $apellido_m, 'type' => 'hidden']);
    $input_hidden_telefono = $html->input(['name' => 'valores[telefono][]', 'value' => $telefono, 'type' => 'hidden']);

    $array_td[] = [
      '1',
      "{$input_hidden_nombre}{$nombre}",
      "{$input_hidden_apellido_p}{$apellido_p}",
      "{$input_hidden_apellido_m}{$apellido_m}",
      "{$input_hidden_telefono}{$telefono}"
    ];

    //RESTEAR VALORES
    $nombre = $apellido_p = $apellido_m = $telefono = '';

    //MOSTRAR MENSAJE SATISFACTORIO
    $html_alert = $html->alert('Mensaje', 'Datos registrados', 'success');
  }
  $content .= $html->div($html_alert, ['class' => 'mt-4']);
}

//RECUPERAR ARREGLO
$valores = $utilities->post('valores');
if(is_array($valores) && !empty($valores)){
  $arr_nombre = $utilities->key('nombre', $valores);

  if(is_array($arr_nombre) && !empty($arr_nombre)){

    $arr_apellido_p = $utilities->key('apellido_p', $valores);
    $arr_apellido_m = $utilities->key('apellido_m', $valores);
    $arr_telefono = $utilities->key('telefono', $valores);

    foreach($arr_nombre as $key => $val_nombre){
      $val_apellido_p = $utilities->key($key, $arr_apellido_p);
      $val_apellido_m = $utilities->key($key, $arr_apellido_m);
      $val_telefono = $utilities->key($key, $arr_telefono);

      //AGREGAR NUEVO RENGLÓN
      $array_td[] = [
        $key + 2,
        $html->input(['name' => 'valores[nombre][]', 'value' => $val_nombre, 'type' => 'hidden']).$val_nombre,
        $html->input(['name' => 'valores[apellido_p][]', 'value' => $val_apellido_p, 'type' => 'hidden']).$val_apellido_p,
        $html->input(['name' => 'valores[apellido_m][]', 'value' => $val_apellido_m, 'type' => 'hidden']).$val_apellido_m,
        $html->input(['name' => 'valores[telefono][]', 'value' => $val_telefono, 'type' => 'hidden']).$val_telefono,
      ];
    }
  }
}

//CONTENIDO PRINCIPAL
$input_nombre = $html->input(['name' => 'nombre', 'value' => $nombre, 'type' => 'text', 'placeholder' => 'Nombre', 'class' => $input_class]);
$input_apellido_p = $html->input(['name' => 'apellido_p', 'value' => $apellido_p, 'type' => 'text', 'placeholder' => 'Apellido P.', 'class' => $input_class]);
$input_apellido_m = $html->input(['name' => 'apellido_m', 'value' => $apellido_m, 'type' => 'text', 'placeholder' => 'Apellido M.', 'class' => $input_class]);
$input_telefono = $html->input(['name' => 'telefono', 'value' => $telefono, 'type' => 'text', 'placeholder' => 'Teléfono', 'class' => $input_class]);

//BUTTON - HTML
$btn_eliminar = $html->button('Eliminar', ['class' => 'btn btn-danger btn-block mt-4']);
$btn_registrar = $html->button('Registrar', ['class' => 'btn btn-primary btn-block mt-4']);

//CREAR TABLA HTML
if(empty($array_td))$html_table = '';
else{
  $array_table = [];
  $array_table['attr'] = ['class' => 'table table-striped table-dark mt-3'];
  $array_table['th'][] = ['No', 'Nombre', 'Ap.Paterno', 'Ap.Materno', 'Teléfono'];
  $array_table['td'] = $array_td;
  $html_table = $html->table($array_table);
}

//CREAR RENGLONES
$html_row = $html->row([
  ['html' => $input_nombre, 'col' => 12, 'sm' => 6, 'md' => 6, 'lg' => 3, 'xl' => 3],
  ['html' => $input_apellido_p, 'col' => 12, 'sm' => 6, 'md' => 6, 'lg' => 3, 'xl' => 3],
  ['html' => $input_apellido_m, 'col' => 12, 'sm' => 6, 'md' => 6, 'lg' => 3, 'xl' => 3],
  ['html' => $input_telefono, 'col' => 12, 'sm' => 6, 'md' => 6, 'lg' => 3, 'xl' => 3],
  ['html' => '', 'col' => 12, 'sm' => 12, 'md' => 6, 'lg' => 6, 'xl' => 6],
  ['html' => $btn_registrar, 'col' => 12, 'sm' => 12, 'md' => 6, 'lg' => 6, 'xl' => 6],
  ['html' => $html_table, 'col' => 12]
]);

//FORM - HTML
$content .= $html->form($html_row, ['method' => 'post']);

//ECHO TEMPLATE
echo $html->template(TEMPLATE_JSON, [
  'html' => $content,
  'class' => 'ml-3 mr-3'
]);
