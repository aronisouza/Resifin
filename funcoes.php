<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBSA', 'bk_resifin');
//define('DBSA', 'resifin');
define('URL', 'http://resifin/');

define('NUM', '18;25;7;0672');
define('IT', '19;25;8;4009');
define('CLICK', '09;15;7;3541');
define('NUD', '08;15;7;6069');
define('DIGIO', '21;25;4;5815');
define('MP', '15;20;5;7247');
define('DIN', '01;01;1;1111');


// Apenas para verificar alguns arrays
function getPre($string)
{
  echo '<pre>';
  print_r($string);
  echo '</pre>';
}

/**
 * $t: 0 -> cript.
 * $t: 1 -> descript.
 * $c: Texto/Número
*/
function getCrip($c, $t)
{
  $key = 'FiliD_Danela-Gatins';
  $iv = '2609105565050936';
  $method = 'AES-256-CBC';
  if ($t == 0) {
      $encrypted = openssl_encrypt($c, $method, $key, 0, $iv);
      $safeEncrypted = strtr(base64_encode($encrypted), '+/', '-_');
      return $safeEncrypted;
  } elseif ($t == 1) {
      $decoded = base64_decode(strtr($c, '-_', '+/'));
      $decrypted = openssl_decrypt($decoded, $method, $key, 0, $iv);
      return $decrypted;
  } 
}

/**
 * TIPOS: primary, secondary, success, danger, warning, info, light e dark 
*/
function getCard($tipo, $header, $title, $text)
{
echo "
  <div class='card text-bg-{$tipo} mt-3' style='max-width: 100%;'>
    <div class='card-header'>{$header}</div>
    <div class='card-body'>
      <h5 class='card-title'>{$title}</h5>
      <p class='card-text'>{$text}</p>
    </div>
  </div>
";
}

/**
 * getMessage
 * 
 * TIPOS: primary, secondary, success, danger, warning, info, light e dark 
*/
function getMessage($tipo, $text)
{
  echo "
  <div class='alert alert-{$tipo} alert-dismissible fade show mt-3' role='alert'>
    <p>
      {$text}
    </p>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>
  ";
}


/**
 * getIco
 * 
 * - $tipo: arrow-down-short , arrow-up-short , aspect-ratio, card-heading
 ** - currency-dollar, cash-coin, check-circle, x-circle, circle-fill, [ bezier2 RESFIN currency-rupee ]
 * - $cor: text-primary text-secondary text-success, text-danger, text-warning, text-info, text-light, text-dark
 */
function getIco($tipo, $cor, $i)
{
  $svg = 'fsdfsd';
  switch($tipo)
  {
    case 'arrow-up-short':
      $svg = '
        <svg xmlns="http://www.w3.org/2000/svg" width="'.$i.'" height="'.$i.'" fill="currentColor" class="bi bi-arrow-up-short" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5"/>
        </svg>
        ';
      break;

      case 'arrow-down-short':
        $svg = '
          <svg xmlns="http://www.w3.org/2000/svg" width="'.$i.'" height="'.$i.'" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4"/>
          </svg>
        ';
      break;

      case 'aspect-ratio':
        $svg = '
          <svg xmlns="http://www.w3.org/2000/svg" width="'.$i.'" height="'.$i.'" fill="currentColor" class="bi bi-aspect-ratio" viewBox="0 0 16 16">
            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
            <path d="M2 4.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H3v2.5a.5.5 0 0 1-1 0zm12 7a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H13V8.5a.5.5 0 0 1 1 0z"/>
          </svg>
        ';
      break;


      case 'card-heading':
        $svg = '
          <svg xmlns="http://www.w3.org/2000/svg" width="'.$i.'" height="'.$i.'" fill="currentColor" class="bi bi-card-heading" viewBox="0 0 16 16">
            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
            <path d="M3 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0-5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
          </svg>
        ';
      break;

      case 'currency-dollar':
        $svg = '
          <svg xmlns="http://www.w3.org/2000/svg" width="'.$i.'" height="'.$i.'"  fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
            <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z"/>
          </svg>
        ';
      break;

      case 'cash-coin':
        $svg = '
          <svg xmlns="http://www.w3.org/2000/svg" width="'.$i.'" height="'.$i.'" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
          </svg>
        ';
      break;

      case 'check-circle':
        $svg = '
          <svg xmlns="http://www.w3.org/2000/svg" width="'.$i.'" height="'.$i.'" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
          </svg>
        ';
      break;

      case 'x-circle':
        $svg = '
          <svg xmlns="http://www.w3.org/2000/svg" width="'.$i.'" height="'.$i.'" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
          </svg>
        ';
      break;

      
      case 'circle-fill':
        $svg = '
          <svg xmlns="http://www.w3.org/2000/svg" width="'.$i.'" height="'.$i.'" fill="currentColor" class="bi bi-c-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.146 4.992c.961 0 1.641.633 1.729 1.512h1.295v-.088c-.094-1.518-1.348-2.572-3.03-2.572-2.068 0-3.269 1.377-3.269 3.638v1.073c0 2.267 1.178 3.603 3.27 3.603 1.675 0 2.93-1.02 3.029-2.467v-.093H9.875c-.088.832-.75 1.418-1.729 1.418-1.224 0-1.927-.891-1.927-2.461v-1.06c0-1.583.715-2.503 1.927-2.503"/>
          </svg>
        ';
      break;
      
      
      case 'currency-rupee':
        $svg = '
        <svg xmlns="http://www.w3.org/2000/svg" width="'.$i.'" height="'.$i.'" fill="currentColor" class="bi bi-currency-rupee" viewBox="0 0 16 16">
          <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4z"/>
        </svg>';
      break;

      case 'RESIFIN':
        $svg = '
        <svg xmlns="http://www.w3.org/2000/svg" width="'.$i.'" height="'.$i.'" fill="currentColor" class="bi bi-currency-rupee mr-n" viewBox="0 0 16 16">
          <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4z"/>
        </svg>ESIFIN
        ';
      break;


      case 'Filid':
        $svg = '';
      break;
  }
 
  echo "
  <span class='{$cor}'>
    $svg
  </span>
  ";
}


function getRESFIN()
{
  //echo getIco('bezier2','text-light','20').' RESIFIN '.getIco('currency-rupee','text-light','20');
  echo getIco('currency-rupee','text-light','30')."RESIFIN";
}
