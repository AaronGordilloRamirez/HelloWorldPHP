<?php
//INCLUDE CONFIG FILE
include 'config.php';

$content = $alert = $numero = $table_inputs = '';

//$html->print_pre($_POST);

$operation = $utilities->post('operation');

//POST VALUE FORM
if($utilities->key('numero', $_POST) != ''){
  $numero = $utilities->post('numero');
  if(is_numeric($numero) && $numero > 0){

    //POST VALUES INPUT
    $values = $utilities->post('values');

    //CREAR TABLA DINÁMICA
    $array_table = [];
    $array_table['attr'] = ['class' => 'table table-striped table-dark mt-3'];
    $array_table['th'][] = ['No.', 'Valor'];
    $array_td = [];

    //CICLO - FOR
    $total = 0;
    for($no = 1; $no <= $numero; ++$no){

      $color = '';
      $get_value = $utilities->key($no, $values);

      if(is_numeric($get_value)){
        if($operation == 'suma')$total += $get_value;
        elseif($operation == 'resta')$total -= $get_value;
        else $total = 0;
      }else{
        if($get_value != '')$color = '#f5c6cb';
      }

      $td_input = $html->input([
        'name' => "values[{$no}]",
        'type' => 'text',
        'value' => $get_value,
        'class' => 'form-control',
        'style' => "background:{$color}"
      ]);

      $array_td[] = [$no, $td_input];
    }
    //CICLO - FOR
    $array_td[] = ['Total', $utilities->currency($total)];

    $array_table['td'] = $array_td;
    $table_inputs = $html->table($array_table);
    //CREAR TABLA DINÁMICA

  }else $alert = $html->alert('Error', 'Revisar tu valor', 'danger');
}

//INPUT - HTML
$input = $html->input([
  'name' => 'numero',
  'type' => 'text',
  'value' => $numero,
  'placeholder' => 'Ingresa tu número',
  'class' => 'form-control mt-md-4 mt-sm-4']);

//BUTTON - HTML
$button = $html->button('Calcular', [
  'class' => 'btn btn-primary btn-block mt-md-4'
]);

//SELECT - HTML
$selected_suma = $selected_resta = '';
if($operation == 'suma')$selected_suma = 'selected';
elseif($operation == 'resta')$selected_resta = 'selected';

$array_options = [
  ['option' => 'Suma', 'value' => 'suma', $selected_suma => $selected_suma],
  ['option' => 'Resta', 'value' => 'resta', $selected_resta => $selected_resta]
];
$select = $html->select($array_options, [
  'name' => 'operation',
  'class' => 'form-control mt-2 mb-4 mt-md-4'
]);

//ROW - HTML
$row = $html->row([
  ['html' => $alert, 'col' => 12],
  ['html' => $input, 'col' => 12, 'sm' => 12, 'md' => 4, 'lg' => 4, 'xl' => 4],
  ['html' => $select, 'col' => 12, 'sm' => 12, 'md' => 4, 'lg' => 4, 'xl' => 4],
  ['html' => $button, 'col' => 12, 'sm' => 12, 'md' => 4, 'lg' => 4, 'xl' => 4],
  ['html' => $table_inputs, 'col' => 12]
]);

//FORM - HTML
$content .= $html->form($row, ['method' => 'post']);

//ECHO TEMPLATE
echo $html->template(TEMPLATE_JSON, [
  'html' => $content,
  'class' => 'container'
]);
