<?php
//INCLUDE CONFIG FILE
include 'config.php';

//INITAL CONTENT
$content = '';

//EXAMPLE META
//$content .= $html->meta('https://google.com', 5);

//EXAMPLE INPUT
$input = $html->input([
  'name' => 'nombre',
  'placeholder' => 'hola',
  'type' => 'text',
  'class' => 'form-control'
]);

//EXAMPLE BUTTON
$button = $html->button('Calcular', [
  'class' => 'btn btn-primary btn-block',
  'icon_left' => 'air-freshener'
]);

//sm
//md
//lg
//xl
$array_row = [
  ['html' => '', 'col' => 12, 'class' => 'pt-4'],
  ['html' => $input, 'col' => 6, 'sm' => 6, 'md' => 4, 'lg' => 4, 'xl' => 4],
  ['html' => $input, 'col' => 6, 'sm' => 6, 'md' => 4, 'lg' => 4, 'xl' => 4],
  ['html' => $button, 'class' => 'pt-4 pt-sm-4 pt-md-0 pt-lg-0 pt-xl-0', 'col' => 12, 'sm' => 12, 'md' => 4, 'lg' => 4, 'xl' => 4]
];

$content .= $html->row($array_row);

//EXAMPLE BR
$content .= $html->br(1);

//EXAMPLE TEXTAREA
$content .= $html->textarea('Valor', [
  'name' => 'caja',
  'placeholder' => 'Escribir aquí...',
  'rows' => 15,
  'class' => 'form-control'
]);

//EXAMPLE PARAGRAPH
$content .= $html->p('Esto es un párrafo');

//EXAMPLE DIV
$content .= $html->div(
  $html->h(5, 'Esto es un div'), [
  'id' => 'div_1'
]);

//EXAMPLE IMAGE
$content .= $html->img([
  'src' => 'https://www.w3schools.com/images/colorpicker.gif'
]);

//EXAMPLE SCRIPT
$script = 'console.log("Hey");';
$content .= $html->script($script);

//EXAMPLE HR
$content .= $html->hr();

//EXAMPLE BOLD
$content .= $html->b('Hello World');

//EXAMPLE HEADING
$content .= $html->h(1, 'Hello World');

//EXAMPLE LABEL
$content .= $html->label('Hello World Label');

$content .= $html->hr();

//EXAMPLE TABLE
$array_table = [];

//attr
$array_table['attr'] = ['class' => 'table table-dark'];

//th
$array_table['th'][] = ['Col 1', 'Col 2', 'Col 3'];

//td
$array_table['td'] = [
  ['a', 'b', 'c'],
  ['d', 'e', 'f'],
  ['g', 'h', '1'],
];

$content .= $html->table($array_table);

//EXAMPLE ALERT
$content .= $html->alert('Aviso', 'No cuentas con Internet', 'success');

//ECHO TEMPLATE
echo $html->template(TEMPLATE_JSON, ['html' => $content, 'class' => 'container']);
